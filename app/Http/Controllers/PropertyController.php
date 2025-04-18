<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Services\PropertyService;

class PropertyController extends Controller
{
    protected $propertyService;
    protected $categoryService;

    public function __construct(PropertyService $propertyService, CategoryService $categoryService)
    {
        $this->propertyService = $propertyService;
        $this->categoryService = $categoryService;
    }


    public function index(Request $request){
        $categoryId = $request->query('category');


        $properties = $this->propertyService->getPropertiesWithCategories();
        // dd($properties);
        return view('properties.index',[
            'properties' => $properties,
            'categories' => $this->categoryService->getAllCategories(),
        ]);
    }

    public function show(int $id){
        // dd('ok');
        $property = $this->propertyService->getPropertyDetails($id);
    
        abort_if(!$property, 404);
    
        return view('properties.show', compact('property'));
    }
    

}
