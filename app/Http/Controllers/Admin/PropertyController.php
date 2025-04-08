<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Services\PropertyService;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    public function index(){
        $properties = $this->propertyService->getAllProperties();
        return view('admin.Properties.index',[
            'properties' => $properties,
        ]);
    }

    public function delete(Property $property){
        $this->propertyService->deleteProperty($property);
        return redirect()->back()->with('success', 'Propriété supprimée avec succès.');
    }
}
