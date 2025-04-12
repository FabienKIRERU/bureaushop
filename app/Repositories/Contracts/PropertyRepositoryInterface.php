<?php

namespace App\Repositories\Contracts;

use App\Models\Property;

interface PropertyRepositoryInterface{



    public function getAll();

    public function findById(int $id);

    public function getPropertiesByUser(int $userId);
    
    public function getPropertiesWithCategories();
    
    public function getByCategory(int $categoryId);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}