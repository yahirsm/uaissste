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

class EmpleadoController extends Controller
{
    public function create()
    {
        $servicios = Servicio::all();
        $plazas    = Plaza::all();
        return view('usuarios.create', compact('servicios', 'plazas'));
    }

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
            'nombre.regex'           => 'El nombre solo puede contener letras y espacios.',
            'primer_apellido.regex'  => 'El primer apellido solo puede contener letras y espacios.',
            'segundo_apellido.regex' => 'El segundo apellido solo puede contener letras y espacios.',
            'numero_empleado.digits' => 'El número de empleado debe tener exactamente 6 dígitos.',
            'numero_empleado.unique' => 'Ya existe un empleado con este número.',
            'rfc.regex'              => 'El RFC debe tener exactamente 13 caracteres (mayúsculas y números).',
            'rfc.unique'             => 'Ya existe un empleado con este RFC.',
        ]);

        DB::transaction(function () use ($data) {
            // 1) Generar credenciales de usuario
            $nombre         = trim($data['nombre']);
            $primerApe      = trim($data['primer_apellido']);
            $segundoApe     = trim($data['segundo_apellido'] ?? '');
            $numEmp         = $data['numero_empleado'];

            // usuario base
            $username = strtolower($primerApe);
            if (User::where('username', $username)->exists()) {
                $username .= strtolower(substr($segundoApe ?: 'x', 0, 1));
            }

            // contraseña: iniciales + número + #
            $password = strtolower(substr($nombre, 0, 1))
                      . strtolower(substr($primerApe, 0, 1))
                      . strtolower(substr($segundoApe ?: 'x', 0, 1))
                      . $numEmp . '#';

            // 2) Crear User y asignar rol
            $user = User::create([
                'name'     => "{$nombre} {$primerApe}",
                'username' => $username,
                'email'    => "{$username}@issste.mx",
                'password' => Hash::make($password),
            ]);
            $user->assignRole($data['rol']);

            // 3) Crear Empleado
            $empleado = Empleado::create([
                'nombre'             => $nombre,
                'primer_apellido'    => $primerApe,
                'segundo_apellido'   => $segundoApe,
                'numero_empleado'    => $numEmp,
                'rfc'                => strtoupper($data['rfc']),
                'plaza_id'           => $data['plaza_id'],
                'servicio_actual_id' => $data['servicio_id'],
                'user_id'            => $user->id,
            ]);

            // 4) Historial de servicio
            EmpleadoServicio::create([
                'empleado_id'  => $empleado->id,
                'servicio_id'  => $empleado->servicio_actual_id,
                'fecha_inicio' => now(),
            ]);
        });

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario y empleado registrados correctamente.');
    }

    public function index(Request $request)
    {
        $query = Empleado::with(['servicioActual', 'plaza']);

        if ($request->filled('buscar')) {
            $b = $request->input('buscar');
            if (! preg_match('/^\d{6}$/', $b)) {
                return back()->with('error', 'El número de empleado debe tener 6 dígitos.');
            }
            $query->where('numero_empleado', $b);
        }

        $empleados = $query->paginate(10);
        return view('usuarios.usuarios', compact('empleados'));
    }

    public function show($id)
    {
        $empleado = Empleado::with('user')->findOrFail($id);
        return view('usuarios.show', compact('empleado'));
    }

    public function edit($id)
    {
        $empleado  = Empleado::with('user')->findOrFail($id);
        $plazas    = Plaza::all();
        $servicios = Servicio::all();

        // IMPORTANTE: en la vista usar $empleado->user para acceder al User
        return view('usuarios.edit', compact('empleado', 'plazas', 'servicios'));
    }

    public function update(Request $request, $id)
    {
        $empleado = Empleado::with('user')->findOrFail($id);
        $user     = $empleado->user;

        $data = $request->validate([
            'nombre'           => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,}$/u'],
            'primer_apellido'  => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,}$/u'],
            'segundo_apellido' => ['nullable', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/u'],
            'numero_empleado'  => ['required', 'digits:6', "unique:empleados,numero_empleado,{$id}"],
            'rfc'              => ['required', 'size:13', "unique:empleados,rfc,{$id}", 'regex:/^[A-Z0-9]{13}$/'],
            'plaza_id'         => ['required', 'exists:plazas,id'],
            'servicio_id'      => ['required', 'exists:servicios,id'],
            'rol'              => ['required', 'in:Administrador,Jefe Abasto,Solicitante'],
        ], [
            'numero_empleado.digits' => 'El número de empleado debe tener exactamente 6 dígitos.',
            'numero_empleado.unique' => 'Ya existe un empleado con este número.',
            'rfc.regex'              => 'El RFC debe tener 13 caracteres (solo mayúsculas y números).',
            'rfc.unique'             => 'Ya existe un empleado con este RFC.',
        ]);

        DB::transaction(function () use ($data, $empleado, $user) {
            // 1) Roles
            $user->syncRoles($data['rol']);

            // 2) Actualizar nombre de usuario (opcional)
            $user->update([
                'name' => "{$data['nombre']} {$data['primer_apellido']}",
            ]);

            // 3) Cerrar historial anterior
            EmpleadoServicio::where('empleado_id', $empleado->id)
                ->whereNull('fecha_fin')
                ->update(['fecha_fin' => now()]);

            // 4) Actualizar empleado
            $empleado->update([
                'nombre'             => $data['nombre'],
                'primer_apellido'    => $data['primer_apellido'],
                'segundo_apellido'   => $data['segundo_apellido'] ?? null,
                'numero_empleado'    => $data['numero_empleado'],
                'rfc'                => strtoupper($data['rfc']),
                'plaza_id'           => $data['plaza_id'],
                'servicio_actual_id' => $data['servicio_id'],
            ]);

            // 5) Nuevo historial
            EmpleadoServicio::create([
                'empleado_id'  => $empleado->id,
                'servicio_id'  => $data['servicio_id'],
                'fecha_inicio' => now(),
            ]);
        });

        return redirect()->route('usuarios.index')
                         ->with('success', 'Empleado y rol actualizados correctamente.');
    }

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

        return redirect()->route('usuarios.index')
                         ->with('success', 'Empleado y usuario eliminados correctamente.');
    }
}
