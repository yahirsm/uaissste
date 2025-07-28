<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\EmpleadoServicio;
use App\Models\User;
use App\Models\Servicio;
use App\Models\Plaza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\CredentialsMail;
use Illuminate\Support\Facades\Mail;


class EmpleadoController extends Controller
{
    /**
     * Muestra el formulario de creación de un nuevo empleado/usuario.
     */
    public function create()
    {
        $servicios = Servicio::all();
        $plazas    = Plaza::all();

        return view('usuarios.create', compact('servicios', 'plazas'));
    }

    /**
     * Almacena en BD el nuevo usuario y su empleado asociado.
     */
   public function store(Request $request)
    {
       $data = $request->validate([
    'nombre'           => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,}$/u'],
    'primer_apellido'  => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,}$/u'],
    'segundo_apellido' => ['nullable', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/u'],
    'numero_empleado'  => ['required', 'digits:6', 'unique:empleados,numero_empleado'],
    'rfc'              => ['required', 'size:13', 'regex:/^[A-Z0-9]{13}$/', 'unique:empleados,rfc'],
    'plaza_id'         => ['required', 'exists:plazas,id'],
    'servicio_id'      => ['required', 'exists:servicios,id'],
    'rol'              => ['required', 'in:Administrador,Jefe Abasto,Solicitante'],
], [
    // mensajes 'required'
    'nombre.required'           => 'El nombre es obligatorio.',
    'primer_apellido.required'  => 'El primer apellido es obligatorio.',
    'segundo_apellido.required' => 'El segundo apellido es obligatorio.',
    'numero_empleado.required'  => 'El número de empleado es obligatorio.',
    'rfc.required'              => 'El RFC es obligatorio.',
    'plaza_id.required'         => 'Debe seleccionar una plaza.',
    'servicio_id.required'      => 'Debe seleccionar un servicio.',
    'rol.required'              => 'Debe asignar un rol.',

    // mensajes 'regex'
    'nombre.regex'              => 'El nombre sólo puede contener letras y espacios (mín. 2 caracteres).',
    'primer_apellido.regex'     => 'El primer apellido sólo puede contener letras y espacios (mín. 2 caracteres).',
    'segundo_apellido.regex'    => 'El segundo apellido sólo puede contener letras y espacios.',

    // mensajes 'digits' y 'unique' para número de empleado
    'numero_empleado.digits'    => 'El número de empleado debe tener exactamente 6 dígitos.',
    'numero_empleado.unique'    => 'Ya existe un usuario con ese número de empleado.',

    // mensajes 'size', 'regex' y 'unique' para RFC
    'rfc.size'                  => 'El RFC debe tener exactamente 13 caracteres.',
    'rfc.regex'                 => 'El RFC sólo puede contener mayúsculas y números (13 caracteres).',
    'rfc.unique'                => 'Ya existe un usuario con ese RFC.',

    // mensajes 'exists'
    'plaza_id.exists'           => 'La plaza seleccionada no es válida.',
    'servicio_id.exists'        => 'El servicio seleccionado no es válido.',

    // mensajes 'in' para el rol
    'rol.in'                    => 'El rol seleccionado no es válido. Opciones: Administrador, Jefe Abasto o Solicitante.',
]);


        DB::transaction(function () use ($data) {
            // 1) Preparar datos
            $nombre   = trim($data['nombre']);
            $ape1     = trim($data['primer_apellido']);
            $ape2     = trim($data['segundo_apellido'] ?? '');
            $numEmp   = $data['numero_empleado'];

            // 2) Generar username único
            $base     = Str::slug(strtolower($ape1), '');
            $username = $base;
            $pos      = 0;
            while (User::where('username', $username)->exists()) {
                if (isset($ape2[$pos])) {
                    $username = $base . strtolower($ape2[$pos]);
                } elseif (isset($base[$pos])) {
                    $username = $base . strtolower($base[$pos]);
                } else {
                    $username = $base . Str::random(1);
                }
                $pos++;
            }

            // 3) Email del usuario (puedes cambiarlo según tu lógica)
            $email = "yahirsanchez952@gmail.com";
           //"{$username}@issste.mx";
            // 4) Generar contraseña en texto plano
            $i1 = strtolower(substr($nombre, 0, 1));
            $i2 = strtolower(substr($ape1,   0, 1));
            $i3 = strtolower(substr($ape2 ?: 'x', 0, 1));
            $passwordPlain = "{$i1}{$i2}{$i3}{$numEmp}#";

            // 5) Crear User y asignar rol
            $user = User::create([
                'name'     => "{$nombre} {$ape1}",
                'username' => $username,
                'email'    => $email,
                'password' => Hash::make($passwordPlain),
            ]);
            $user->assignRole($data['rol']);

            // ─── NUEVO: enviar correo con credenciales ───────────────────────────
            Mail::to($user->email)
                ->send(new CredentialsMail($username, $passwordPlain));
            // ───────────────────────────────────────────────────────────────────────

            // 6) Crear Empleado vinculado
            $empleado = Empleado::create([
                'nombre'             => $nombre,
                'primer_apellido'    => $ape1,
                'segundo_apellido'   => $ape2,
                'numero_empleado'    => $numEmp,
                'rfc'                => strtoupper($data['rfc']),
                'plaza_id'           => $data['plaza_id'],
                'servicio_actual_id' => $data['servicio_id'],
                'user_id'            => $user->id,
            ]);

            // 7) Historial inicial de servicio
            EmpleadoServicio::create([
                'empleado_id'  => $empleado->id,
                'servicio_id'  => $empleado->servicio_actual_id,
                'fecha_inicio' => now(),
            ]);
        });

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario y empleado registrados correctamente, credenciales enviadas por correo.');
    }


    /**
     * Lista paginada de empleados.
     */
    public function index(Request $request)
    {
        $query = Empleado::with(['servicioActual', 'plaza']);

        if ($buscar = $request->input('buscar')) {
            if (! preg_match('/^\d{6}$/', $buscar)) {
                return back()->with('error', 'El número de empleado debe tener 6 dígitos.');
            }
            $query->where('numero_empleado', $buscar);
        }

        $empleados = $query->paginate(10);

        return view('usuarios.usuarios', compact('empleados'));
    }

    /**
     * Muestra datos de un empleado concreto.
     */
   public function show($id)
{
    $empleado = Empleado::with([
        'user',
        'servicioActual',
        'plaza',
        'serviciosAnteriores',   // ← la nueva relación
    ])->findOrFail($id);

    return view('usuarios.show', compact('empleado'));
}

    /**
     * Formulario de edición de empleado.
     */
    public function edit($id)
    {
        $empleado  = Empleado::with('user')->findOrFail($id);
        $plazas    = Plaza::all();
        $servicios = Servicio::all();

        return view('usuarios.edit', compact('empleado', 'plazas', 'servicios'));
    }

    /**
     * Actualiza datos de empleado y su user.
     */
    public function update(Request $request, $id)
{
    // 1) Sólo traemos el empleado y su user
    $empleado = Empleado::with('user')->findOrFail($id);
    $user     = $empleado->user;

    // 2) Validamos únicamente los campos editables
    $data = $request->validate([
        'rol'         => ['required', 'in:Administrador,Jefe Abasto,Solicitante'],
        'plaza_id'    => ['required', 'exists:plazas,id'],
        'servicio_id' => ['required', 'exists:servicios,id'],
        'password'    => ['nullable', 'string', 'min:6'],
    ]);

    DB::transaction(function() use ($data, $empleado, $user) {
        // 3) Rol
        $user->syncRoles($data['rol']);

        // 4) (Opcional) Cambiar contraseña si viene
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
            $user->save();
        }

        // 5) Cerrar historial anterior
        EmpleadoServicio::where('empleado_id', $empleado->id)
            ->whereNull('fecha_fin')
            ->update(['fecha_fin' => now()]);

        // 6) Actualizar plaza y servicio actual en Empleado
        $empleado->update([
            'plaza_id'           => $data['plaza_id'],
            'servicio_actual_id' => $data['servicio_id'],
        ]);

        // 7) Nuevo historial
        EmpleadoServicio::create([
            'empleado_id'  => $empleado->id,
            'servicio_id'  => $data['servicio_id'],
            'fecha_inicio' => now(),
        ]);
    });

    return redirect()
        ->route('usuarios.index')
        ->with('success', 'Empleado y rol actualizados correctamente.');
}

    /**
     * Elimina empleado y user asociado.
     */
    public function destroy($id)
    {
        $empleado = Empleado::with('user')->findOrFail($id);

        DB::transaction(function () use ($empleado) {
            EmpleadoServicio::where('empleado_id', $empleado->id)->delete();
            if ($empleado->user) {
                $empleado->user->delete();
            }
            $empleado->delete();
        });

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Empleado y usuario eliminados correctamente.');
    }
}
