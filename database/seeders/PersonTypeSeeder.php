<?php

namespace Database\Seeders;

use App\Models\PersonType;
use Illuminate\Database\Seeder;

class PersonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PersonType::create([
            'name' => 'Persona Moral',
            'code' => 'PM'
        ]);
        
        PersonType::create([
            'name' => 'Persona Física Nacional',
            'code' => 'PFN'
        ]);
        
        PersonType::create([
            'name' => 'Persona Física Extranjera',
            'code' => 'PFE'
        ]);
        
        PersonType::create([
            'name' => 'Persona Otra',
            'code' => 'PO'
        ]);
    }
}
