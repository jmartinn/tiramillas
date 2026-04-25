<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            ['name' => 'Lorena Bergaz', 'email' => 'lorena@tiramillas.test'],
            ['name' => 'María Sanz', 'email' => 'maria@tiramillas.test'],
            ['name' => 'Pedro García', 'email' => 'pedro@tiramillas.test'],
            ['name' => 'Carlos Ruiz', 'email' => 'carlos@tiramillas.test'],
            ['name' => 'Ana López', 'email' => 'ana@tiramillas.test'],
            ['name' => 'Sergio Molina', 'email' => 'sergio@tiramillas.test'],
        ];

        foreach ($usuarios as $datos) {
            User::updateOrCreate(
                ['email' => $datos['email']],
                array_merge($datos, [
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]),
            );
        }
    }
}
