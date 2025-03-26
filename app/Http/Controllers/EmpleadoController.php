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
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'required|string|max:255',
            'numero_empleado' => 'required|numeric|unique:empleados',
            'rfc' => 'required|string|max:13|unique:empleados',
            'plaza_id' => 'required|exists:plazas,id',
            'servicio_actual_id' => 'required|exists:servicios,id',
            'crear_usuario' => 'nullable|boolean',
            'password' => 'nullable|string|min:8',
        ]);

        DB::transaction(function () use ($request) {
            $empleado = Empleado::create($request->only([
                'nombre',
                'primer_apellido',
                'segundo_apellido',
                'numero_empleado',
                'rfc',
                'plaza_id',
                'servicio_actual_id'
            ]));

            if ($request->crear_usuario) {
                $password = $request->password ?: Hash::make('password123');
                $usuario = User::create([
                    'name' => $empleado->nombre . ' ' . $empleado->primer_apellido,
                    'email' => strtolower($empleado->numero_empleado . '@empresa.com'),
                    'password' => Hash::make($password),
                ]);

                $empleado->update(['user_id' => $usuario->id]);
            }
        });

        return redirect()->route('usuarios.index')->with('success', 'Empleado registrado correctamente.');
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
