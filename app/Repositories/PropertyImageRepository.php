<?php

namespace App\Repositories;

use App\Models\PropertyImage;
use App\Repositories\Contracts\PropertyImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PropertyImageRepository implements PropertyImageRepositoryInterface {

    protected $propertyImage;

    public function __construct(?PropertyImage $propertyImage = null)
    {
       $this->propertyImage = $propertyImage ?? new PropertyImage();
    }
    
    public function getByPropertyId(int $propertyId): Collection {
        return PropertyImage::where('property_id', $propertyId)->get();
    }

    public function findById($id)
    {
       return $this->propertyImage->findorFail($id);
    }

    public function create(array $data): PropertyImage {
        return PropertyImage::create($data);
    }

    public function delete($id): bool {
        return PropertyImage::delete($id);
    }
}
