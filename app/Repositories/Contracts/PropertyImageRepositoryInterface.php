<?php

namespace App\Repositories\Contracts;

use App\Models\PropertyImage;

interface PropertyImageRepositoryInterface{


    public function getByPropertyId(int $propertyId);

    public function create(array $data);
    
    public function findById($id);

    public function delete($id);
}