<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\ActividadEconomica::factory()->create([
            'nombre' => 'Comercio',
        ]);

        \App\Models\ActividadEconomica::factory()->create([
            'nombre' => 'Servicio',

        ]);

        \App\Models\Role::factory()->create([
            'role_number' => 1,
            'name' => 'Administrador',
            
        ]);
        \App\Models\Role::factory()->create([
            'role_number' => 2,
            'name' => 'Usuario',
            
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Bryan',
            'email' => 'bryan@gmail.com',
            'password' => '87654321',
            'role_id' =>1,
            'numero' => '987654321',
            'dni' => '87654321',
            'status' =>1,
        ]);
    }
}
