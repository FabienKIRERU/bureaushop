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
        return view('properties.index',[
            'properties' => $properties,
            'categories' => $this->categoryService->getAllCategories(),
        ]);
    }
}
