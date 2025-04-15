<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(){
        // dd($this->categoryService->getCategoriesWithUser());
        // dd(Auth::id());
        return view('owner.categories.index', [
            'categories' => $this->categoryService->getCategoriesByUser(Auth::id()),
            'user' => Auth::user(),
        ]);
    }
    
    public function create(){
        return view('owner.categories.form',[

        ]);
    }

    public function store(Request $request){

        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = $this->categoryService->createCategory($data);
        return redirect()->route('owner.categories.index')->with('success', 'Catégorie créée avec succès.');
        
    }

    public function edit($id){
        // dd($this->categoryService->getCategoryById($id));
        return view('owner.categories.edit',[
            'category' => $this->categoryService->getCategoryById($id),
        ]);
    }
    

    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        // $data['user_id'] = Auth::id(); 

        $this->categoryService->updateCategory($id, $data);

        return redirect()->route('owner.categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy($id){
        $this->categoryService->deleteCategory($id);

        return redirect()->route('owner.categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }

}
