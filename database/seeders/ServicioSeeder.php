<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Servicio::insert([
            ['nombre' => 'Medicina General'],
            ['nombre' => 'Cirugía'],
            ['nombre' => 'Pediatría'],
            ['nombre' => 'Urgencias'],
            ['nombre' => 'Ginecología'],
            ['nombre' => 'Traumatología'],
            ['nombre' => 'Cardiología'],
            ['nombre' => 'Neurología'],
        ]);
    }
}
