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
        $plazas = Plaza::all();
        return view('usuarios.create', compact('servicios', 'plazas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,}$/u'],
            'primer_apellido' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,}$/u'],
            'segundo_apellido' => ['nullable', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/u'],
            'numero_empleado' => ['required', 'digits:6', 'unique:empleados,numero_empleado'],
            'rfc' => ['required', 'string', 'size:13', 'regex:/^[A-Z0-9]{13}$/', 'unique:empleados,rfc'],
            'plaza_id' => ['required', 'exists:plazas,id'],
            'servicio_id' => ['required', 'exists:servicios,id'],
        ], [
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'primer_apellido.regex' => 'El primer apellido solo puede contener letras y espacios.',
            'segundo_apellido.regex' => 'El segundo apellido solo puede contener letras y espacios.',
            'numero_empleado.digits' => 'El número de empleado debe tener exactamente 6 dígitos.',
            'numero_empleado.unique' => 'Ya existe un empleado con este número.',
            'rfc.regex' => 'El RFC debe tener exactamente 13 caracteres (mayúsculas y números).',
            'rfc.unique' => 'Ya existe un empleado con este RFC.',
        ]);
        

        DB::transaction(function () use ($request) {
            $nombre = trim($request->nombre);
            $primerApellido = trim($request->primer_apellido);
            $segundoApellido = trim($request->segundo_apellido);
            $numeroEmpleado = $request->numero_empleado;

            // Usuario sugerido
            $usuario = strtolower($primerApellido);
            if (User::where('username', $usuario)->exists()) {
                $usuario .= strtolower(substr($segundoApellido ?? 'x', 0, 1));
            }

            // Contraseña generada
            $inicialNombre = strtolower(substr($nombre, 0, 1));
            $inicialPA = strtolower(substr($primerApellido, 0, 1));
            $inicialSA = strtolower(substr($segundoApellido ?? 'x', 0, 1));
            $passwordGenerada = "{$inicialNombre}{$inicialPA}{$inicialSA}{$numeroEmpleado}#";

            // Crear usuario
            $user = User::create([
                'name' => "{$nombre} {$primerApellido}",
                'username' => $usuario,
                'email' => "{$usuario}@issste.mx", // correo de ejemplo
                'password' => Hash::make($passwordGenerada),
            ]);

            // Crear empleado
            $empleado = Empleado::create([
                'nombre' => $nombre,
                'primer_apellido' => $primerApellido,
                'segundo_apellido' => $segundoApellido,
                'numero_empleado' => $numeroEmpleado,
                'rfc' => strtoupper($request->rfc),
                'plaza_id' => $request->plaza_id,
                'servicio_actual_id' => $request->servicio_id,
                'user_id' => $user->id,
            ]);

            // Registrar historial en tabla intermedia
            EmpleadoServicio::create([
                'empleado_id' => $empleado->id,
                'servicio_id' => $empleado->servicio_actual_id,
                'fecha_inicio' => now(),
            ]);
        });

        return redirect()->route('usuarios.index')->with('success', 'Usuario y empleado registrados correctamente.');
    }
    public function destroy($id)
    {
        $empleado = Empleado::with('user')->findOrFail($id);
    
        DB::transaction(function () use ($empleado) {
            // Eliminar historial de servicios
            EmpleadoServicio::where('empleado_id', $empleado->id)->delete();
    
            // Eliminar usuario si existe
            if ($empleado->user_id) {
                User::where('id', $empleado->user_id)->delete();
            }
    
            // Eliminar el empleado
            $empleado->delete();
        });
    
        return redirect()->route('usuarios.index')->with('success', 'Empleado y usuario eliminados correctamente.');
    }
    

    public function index()
    {
        $empleados = Empleado::paginate(10);
        $usuarios = Empleado::with('servicioActual')->get();
        // Puedes cambiar 10 por la cantidad deseada de registros por página
        return view('usuarios.usuarios', compact('empleados'));
    }
    public function show($id)
    {
        $empleado = Empleado::findOrFail($id); // Busca el empleado o lanza un error 404 si no existe
        return view('usuarios.show', compact('empleado'));
    }


    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        $plazas = Plaza::all(); // Recupera todas las plazas disponibles
        $servicios = Servicio::all(); // Recupera todos los servicios disponibles

        return view('usuarios.edit', compact('empleado', 'plazas', 'servicios'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'required|string|max:255',
            'numero_empleado' => 'required|numeric',
            'rfc' => 'required|string|max:13',
            'plaza' => 'required|string',
            'servicio_id' => 'required|exists:servicios,id',
        ]);

        $empleado = Empleado::findOrFail($id);

        // Si el empleado tiene un servicio actual, guardarlo en el historial
        if ($empleado->servicio_actual_id) {
            EmpleadoServicio::where('empleado_id', $empleado->id)
                ->whereNull('fecha_fin') // Asegura que no haya duplicados abiertos
                ->update(['fecha_fin' => now()]);
        }

        // Actualizar datos del empleado
        $empleado->update([
            'nombre' => $request->nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'numero_empleado' => $request->numero_empleado,
            'rfc' => $request->rfc,
            'plaza_id' => Plaza::where('nombre', $request->plaza)->first()->id ?? $empleado->plaza_id,
            'servicio_actual_id' => $request->servicio_id,
        ]);

        // Crear nuevo registro en historial de servicios
        EmpleadoServicio::create([
            'empleado_id' => $empleado->id,
            'servicio_id' => $request->servicio_id,
            'fecha_inicio' => now(),
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Empleado actualizado correctamente.');
    }
}
