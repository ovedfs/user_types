<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contract;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userA = User::find(1);
        $userB = User::find(2);
        $userC = User::find(3);
        $userD = User::find(4);

        Contract::create([
            'content' => 'Renta de un departamento 1 de User A',
            'property_id' => $userA->properties->first()->id,
            'arrendador_id' => $userA->id,
            'arrendatario_id' => $userB->id,
            'fiador_id' => $userC->id,
        ]);

        Contract::create([
            'content' => 'Renta de parte de un estacionamiento de User B',
            'property_id' => $userB->properties->first()->id,
            'arrendador_id' => $userB->id,
            'arrendatario_id' => $userA->id,
            'obligado_id' => $userD->id,
            'fiador_id' => $userC->id,
        ]);

        Contract::create([
            'content' => 'Renta de departamento 1 de User D',
            'property_id' => $userD->properties->first()->id,
            'arrendador_id' => $userD->id,
            'arrendatario_id' => $userC->id,
            'fiador_id' => $userA->id,
        ]);

        Contract::create([
            'content' => 'Renta de departamento 2 de User D',
            'property_id' => $userD->properties->last()->id,
            'arrendador_id' => $userD->id,
            'arrendatario_id' => $userB->id,
            'fiador_id' => $userA->id,
        ]);
    }
}
