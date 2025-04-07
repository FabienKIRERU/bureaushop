<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    
    public function getAll();
 
    public function findById($id);
 
    public function store(array $inputs);
 
    public function update($id, array $inputs);
 
    public function delete($id);
}
