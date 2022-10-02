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
        $userA = User::create([
            'name' => 'Usuario A',
            'email' => 'user.a@gmail.com',
            'password' => Hash::make('password'),
            'person_type_id' => 1,
        ])->assignRole(['arrendador', 'arrendatario', 'fiador']);
        
        $userA->moral()->create(['rfc' => 'ABCDEFG123456']);
        
        $userB = User::create([
            'name' => 'Usuario B',
            'email' => 'user.b@gmail.com',
            'password' => Hash::make('password'),
            'person_type_id' => 2,
        ])->assignRole(['arrendador', 'arrendatario']);
        
        $userB->national()->create(['curp' => 'A1B1C1D1E1F1']);
        
        $userC = User::create([
            'name' => 'Usuario C',
            'email' => 'user.c@gmail.com',
            'password' => Hash::make('password'),
            'person_type_id' => 3,
        ])->assignRole(['arrendatario', 'fiador']);
        
        $userC->foreign()->create(['nue' => '123456789']);
        
        $userD = User::create([
            'name' => 'Usuario D',
            'email' => 'user.d@gmail.com',
            'password' => Hash::make('password'),
            'person_type_id' => 1,
        ])->assignRole(['arrendador', 'obligado']);
        
        $userD->moral()->create(['rfc' => '987ERT765WERT']);
        
        $userE = User::create([
            'name' => 'Usuario E',
            'email' => 'user.e@gmail.com',
            'password' => Hash::make('password'),
            'person_type_id' => 2,
        ])->assignRole(['fiador']);
        
        $userE->national()->create(['rfc' => 'LKJH2345IUTR']);
    }
}
