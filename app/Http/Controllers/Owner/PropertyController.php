<?php

namespace App\Http\Controllers\Owner;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Services\PropertyService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    protected $propertyService;
    protected $categoryService;

    public function __construct(PropertyService $propertyService, CategoryService $categoryService)
    {
        $this->propertyService = $propertyService;
        $this->categoryService = $categoryService;
    }

    public function index(){
        $properties = $this->propertyService->getPropertiesByUser(Auth::id());
        // dd($properties);
        return view('owner.properties.index',[
            'properties' => $properties,
            $categories = $this->categoryService->getCategoriesByUser(Auth::id()),
        ]);
    }

    public function create(){

        $categories = $this->categoryService->getCategoriesByUser(Auth::id());
        return view('owner.properties.form',[
            // 'property' => new Property(),
            'categories' => $categories,
        ]);
    }
    

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'new_categories' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data['user_id'] = Auth::id(); 
        $images = $request->file('images', []);

        // $property = $this->propertyService->createProperty($data);

        $property = $this->propertyService->createPropertyWithImages($data, $images);
        // dd($data);

        $allCategoryIds = $request['categories'] ?? [];

        if (!empty($data['new_categories'])) {
            $newNames = array_map('trim', explode(',', $request['new_categories']));
            foreach ($newNames as $name) {
                $category = Category::firstOrCreate(['name' => $name]);
                $allCategoryIds[] = $category->id;
            }
        }

        $property->categories()->sync($allCategoryIds);
        return redirect()->route('owner.properties.index')->with('success', 'Propriété créée avec succès.');
    }

    public function edit($id){
        $categories = $this->categoryService->getCategoriesByUser(Auth::id());
            
        return view('owner.properties.edit',[
            'property' => $this->propertyService->getPropertyDetails($id),
            'categories' => $categories,
        ]);
    }

    public function update($id, Request $request){

        $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
                'stock' => 'required|numeric',
                'categories' => 'required|array',
                'categories.*' => 'exists:categories,id',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:18432',
        ]);
        $data['user_id'] = Auth::id(); 
        // dd($data);
        $images = $request->file('images', []);

        $this->propertyService->updatePropertyWithImages($data, $images, $id);
    
        return redirect()->route('owner.properties.index')->with('success', 'Bien mis à jour avec succès.');

    }

    public function destroy($id){
        $this->propertyService->deleteProperty($id);
        return redirect()->back()->with('success', 'Propriété supprimée avec succès.');
    }
}
