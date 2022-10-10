<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Usuario A',
            'email' => 'user.a@gmail.com',
            'password' => Hash::make('password'),
            'person_type_id' => 1,
            'document_value' => '0001'
        ])->assignRole(['arrendador', 'arrendatario', 'fiador']);
                
        User::create([
            'name' => 'Usuario B',
            'email' => 'user.b@gmail.com',
            'password' => Hash::make('password'),
            'person_type_id' => 2,
            'document_value' => '0001'
        ])->assignRole(['arrendador', 'arrendatario']);
                
        User::create([
            'name' => 'Usuario C',
            'email' => 'user.c@gmail.com',
            'password' => Hash::make('password'),
            'person_type_id' => 3,
            'document_value' => '0001'
        ])->assignRole(['arrendatario', 'fiador']);
                
        User::create([
            'name' => 'Usuario D',
            'email' => 'user.d@gmail.com',
            'password' => Hash::make('password'),
            'person_type_id' => 1,
            'document_value' => '0002'
        ])->assignRole(['arrendador', 'obligado']);
                
        User::create([
            'name' => 'Usuario E',
            'email' => 'user.e@gmail.com',
            'password' => Hash::make('password'),
            'person_type_id' => 2,
            'document_value' => '0002'
        ])->assignRole(['fiador']);
    }
}
