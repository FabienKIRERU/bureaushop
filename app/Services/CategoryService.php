<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Category;

class CategoryService {
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories() {
        return $this->categoryRepository->getAll();
    }

    public function getCategoryById(int $id) {
        return $this->categoryRepository->findById($id);
    }

    public function createCategory(array $data) {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->store($data);
            DB::commit();
            return $category;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erreur de la création de la catégorie : " . $e->getMessage());
        }
    }

    public function updateCategory(Category $category, array $data) {
        return $this->categoryRepository->update($category, $data);
    }

    public function deleteCategory(Category $category) {
        return $this->categoryRepository->delete($category);
    }
}
