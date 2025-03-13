<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Servicio;
use App\Models\Plaza;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    // Mostrar lista de empleados
    public function index()
    {
        $empleados = Empleado::with('servicioActual', 'plaza')->get(); // Carga relaciones correctamente
        return view('usuarios.usuarios', compact('empleados'));
    }
    

    // Mostrar un empleado específico
    public function show($id)
    {
        $empleado = Empleado::with('servicioActual', 'plaza')->findOrFail($id);
        return view('usuarios.show', compact('empleado'));
    }

    // Mostrar formulario para editar empleado
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        $servicios = Servicio::all(); // Recupera todos los servicios disponibles
        $plazas = Plaza::all(); // Recupera todas las plazas disponibles
        
        return view('usuarios.edit', compact('empleado', 'servicios', 'plazas'));
    }
    

    // Actualizar un empleado
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
    
        // Convertir el nombre de la plaza en el ID correspondiente
        $plaza = Plaza::where('nombre', $request->plaza)->first();
    
        // Validar que la plaza exista
        if (!$plaza) {
            return redirect()->back()->withErrors(['plaza' => 'La plaza seleccionada no es válida.']);
        }
    
        $empleado->update([
            'nombre' => $request->nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'numero_empleado' => $request->numero_empleado,
            'rfc' => $request->rfc,
            'plaza_id' => $plaza->id,
            'servicio_actual_id' => $request->servicio_id,
        ]);
    
        return redirect()->route('usuarios.index')->with('success', 'Empleado actualizado correctamente.');
    }
    
    

    

    // Eliminar un empleado
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();
        return redirect()->route('usuarios.index')->with('success', 'Empleado eliminado correctamente.');
    }
}
