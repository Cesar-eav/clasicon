<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Crear un usuario administrador
        // User::create([
        //     'name' => 'Cesar Andrade',
        //     'email' => 'cesar.eav@gmail.com',
        //     'password' => ('qwedsa123'),
        // ]);

        // Crear otros usuarios de prueba
        User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'janesmith@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Carlos Rodríguez',
            'email' => 'carlos@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'María Fernández',
            'email' => 'maria@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Luis García',
            'email' => 'luis@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Ana López',
            'email' => 'ana@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'David Johnson',
            'email' => 'davidj@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Emily Brown',
            'email' => 'emilyb@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Michael Wilson',
            'email' => 'michaelw@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Sophia Martinez',
            'email' => 'sophiam@example.com',
            'password' => Hash::make('password'),
        ]);
 
    }
}
