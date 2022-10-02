<?php

namespace App\Http\Controllers\Api\Arrendador;

use App\Models\User;
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContractController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:contracts.index')->only('index');
        $this->middleware('can:contracts.store')->only('store');
        $this->middleware('can:contracts.show')->only('show');
    }

    public function index()
    {
        return response()->json([
            'message' => 'Listado de contratos',
            'contracts' => auth()->user()->contracts->load('arrendador')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'property_id' => 'required|integer',
            'arrendatario_id' => 'required|integer',
            'obligado_id' => 'sometimes|integer',
            'fiador_id' => 'sometimes|integer',
        ]);

        $roles = [];
        array_push($roles, $request->arrendatario_id);
        $request->has('obligado_id') ?? array_push($roles, $request->obligado_id);
        $request->has('fiador_id') ?? array_push($roles, $request->fiador_id);

        if(! auth()->user()->hasProperty($request->property_id)) {
            return response()->json([
                'message' => 'Acción no autorizada, la propiedad no pertenece a este usuario',
            ]);
        }

        if(auth()->user()->isPropertyInContract($request->property_id)) {
            return response()->json([
                'message' => 'Acción no autorizada, la propiedad esta vinculada a otro contrato',
            ]);
        }

        if(! User::find($request->arrendatario_id)->hasRole('arrendatario')) {
            return response()->json([
                'message' => 'Acción no autorizada, El usuario que propone como arrendatario no tiene ese rol',
            ]);
        }

        if($request->has('obligado_id') && ! User::find($request->obligado_id)->hasRole('obligado')) {
            return response()->json([
                'message' => 'Acción no autorizada, El usuario que propone como obligado solidario no tiene ese rol',
            ]);
        }

        if($request->has('fiador_id') && ! User::find($request->fiador_id)->hasRole('fiador')) {
            return response()->json([
                'message' => 'Acción no autorizada, El usuario que propone como fiador no tiene ese rol',
            ]);
        }

        // Verificar que el arrendador no sea el arrendatario, obligado o fiador ...
        if(in_array(auth()->user()->id, $roles) ) {
            return response()->json([
                'message' => 'Acción no autorizada, Al arrendador no puede ser arrendatario, obligado o fiador en este contrato',
            ]);
        }

        $contract = new Contract();
        $contract->content = $request->content;
        $contract->property_id = $request->property_id;
        $contract->arrendador_id = auth()->user()->id;
        $contract->arrendatario_id = $request->arrendatario_id;
        $contract->obligado_id = $request->has('obligado_id') ? $request->obligado_id : null;
        $contract->fiador_id = $request->has('fiador_id') ? $request->fiador_id : null;

        if($contract->save()) {
            return response()->json([
                'message' => 'Contrato creado satisfactoriamente',
                'contract' => $contract->load(['arrendador', 'arrendatario', 'obligado', 'fiador'])
            ]);    
        }

        return response()->json([
            'message' => 'El Contrato no pudo ser creado'
        ]);
    }
}
