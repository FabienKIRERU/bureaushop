<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Cache;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

/**
 * Class CatgoryRepository
 */
 class CategoryRepository implements CategoryRepositoryInterface {

    /**
     * @return string
     * Return the model
     */

    protected $category;

    public function __construct(?Category $category = null)
    {
       $this->category = $category ?? new Category();
    }

    public function getAll(){

       return Cache::remember('categories', 60 * 60 * 60 * 24 * 10, function() {
           return $this->category->all();
       });
    }

    public function getWithUser(){
        return Cache::remember('categories', 60 * 60 * 24, function () {
            return $this->category->get();
        });
    }

    public function getByUser(int $userId){
        return $this->category->get();
        // return Category::whereHas('properties', function ($query) use ($userId) {
        //     $query->where('user_id', $userId);
        // })->get();
    }

    public function findById($id)
    {
       return $this->category->findorFail($id);
    }

    public function store(array $inputs)
    {
        Cache::forget('categories');
        return $this->category->create($inputs);
    }

    public function update($id, array $inputs)
    {
        Cache::forget('categories');
        return $this->findById($id)->update($inputs);
    }

    public function delete($id)
    {
        Cache::forget('categories');
        $this->findById($id)->delete();
    }
    
    

 }