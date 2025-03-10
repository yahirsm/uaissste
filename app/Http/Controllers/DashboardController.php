<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Definir los enlaces del menú de navegación
        $links = [
            ['header' => 'Menú Principal'],
            ['name' => 'Inicio', 'route' => route('dashboard'), 'icon' => 'fas fa-home'],
            ['name' => 'Inventario', 'route' => route('inventario.index'), 'icon' => 'fas fa-boxes'],
            ['name' => 'Vales', 'route' => '#', 'icon' => 'fas fa-receipt'],
            ['name' => 'Reportes', 'route' => '#', 'icon' => 'fas fa-chart-line'],
        ];

        return view('dashboard', compact('links'));
    }
}
