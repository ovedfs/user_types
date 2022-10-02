<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $abogado = Role::create(['name' => 'abogado']);
        $asesor = Role::create(['name' => 'asesor']);
        $vendedor = Role::create(['name' => 'vendedor']);
        $arrendador = Role::create(['name' => 'arrendador']);
        $arrendatario = Role::create(['name' => 'arrendatario']);
        $obligado = Role::create(['name' => 'obligado']);
        $fiador = Role::create(['name' => 'fiador']);

        Permission::create(['name' => 'contracts.index'])
            ->syncRoles([$arrendador, $arrendatario, $asesor, $abogado, $vendedor]);
        Permission::create(['name' => 'contracts.store'])
            ->syncRoles([$arrendador, $asesor]);
        Permission::create(['name' => 'contracts.show'])
            ->syncRoles([$arrendador, $arrendatario, $asesor, $abogado, $vendedor]);

        Permission::create(['name' => 'properties.index'])
            ->syncRoles([$arrendador, $arrendatario, $asesor, $abogado, $vendedor]);
        Permission::create(['name' => 'properties.store'])
            ->syncRoles([$arrendador]);
        Permission::create(['name' => 'properties.show'])
            ->syncRoles([$arrendador, $arrendatario, $asesor, $abogado, $vendedor]);
    }
}
