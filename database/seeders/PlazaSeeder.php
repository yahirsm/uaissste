<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plaza;

class PlazaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plaza::insert([
            ['nombre' => 'Confianza'],
            ['nombre' => 'Base'],
            ['nombre' => 'Eventual'],
            ['nombre' => 'INSABI'],
        ]);
    }
}
