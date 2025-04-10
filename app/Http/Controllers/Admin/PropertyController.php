<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Services\PropertyService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FormPropertyRequest;

class PropertyController extends Controller
{
    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    public function index(){
        $properties = $this->propertyService->getPropertiesWithCategories();
        return view('admin.properties.index',[
            'properties' => $properties,
        ]);
    }

    public function create(){
        return view('admin.properties.form',[
            // 'property' => new Property(),
            'categories' => Category::get(),
        ]);
    }

    public function store(FormPropertyRequest $formPropertyRequest){
        // dd($formPropertyRequest->validated());

        $property = $this->propertyService->createProperty($formPropertyRequest->validated());

        $allCategoryIds = $formPropertyRequest['categories'] ?? [];

        if (!empty($data['new_categories'])) {
            $newNames = array_map('trim', explode(',', $formPropertyRequest['new_categories']));
            foreach ($newNames as $name) {
                $category = Category::firstOrCreate(['name' => $name]);
                $allCategoryIds[] = $category->id;
            }
        }

        $property->categories()->sync($allCategoryIds);

        return redirect()->route('admin.property.index')->with('success', 'Propriété créée avec succès.');
    }

    public function delete(Property $property){
        $this->propertyService->deleteProperty($property);
        return redirect()->back()->with('success', 'Propriété supprimée avec succès.');
    }
}
