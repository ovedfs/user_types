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
            'name' => 'pm',
            'document' => 'rfc'
        ]);
        
        PersonType::create([
            'name' => 'pfn',
            'document' => 'curp'
        ]);
        
        PersonType::create([
            'name' => 'pfe',
            'document' => 'nue'
        ]);
    }
}
