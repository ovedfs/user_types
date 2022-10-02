<?php

namespace App\Http\Controllers\Api\Arrendador;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:properties.index')->only('index');
        $this->middleware('can:properties.store')->only('store');
        $this->middleware('can:properties.show')->only('show');
    }

    public function index()
    {
        return response()->json([
            'message' => 'Listado de propiedades',
            'properties' => auth()->user()->properties->load('arrendador')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'title' => 'required',
        ]);

        $property = new Property();
        $property->address = $request->address;
        $property->title = $request->title;
        $property->arrendador_id = auth()->user()->id;

        if($property->save()) {
            return response()->json([
                'message' => 'propiedad creada correctamente',
                'property' => $property->load('arrendador'),
            ]);
        }

        return response()->json([
            'message' => 'La propiedad no pudo ser creada',
        ], 500);
    }
}
