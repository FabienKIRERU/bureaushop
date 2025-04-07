<?php

namespace App\Services; 

use App\Repositories\PropertyRepository;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Exception;

class PropertyService {
    protected $propertyRepository;

    public function __construct(PropertyRepository $propertyRepository) {
        $this->propertyRepository = $propertyRepository;
    }

    public function getAllProperties() {
        return $this->propertyRepository->getAll();
    }

    public function getPropertiesByUser(int $userId){
        return $this->propertyRepository->getPropertiesByUser($userId);
    }

    public function getPropertyDetails(int $id) {
        return $this->propertyRepository->findById($id);
    }

    public function getPropertiesByCategory(int $categoryId) {
        return $this->propertyRepository->getByCategory($categoryId);
    }

    public function createProperty(array $data) {
        DB::beginTransaction();
        try {
            $property = $this->propertyRepository->create($data);
            DB::commit();
            return $property;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erreur lors de la création du bien : " . $e->getMessage());
        }
    }

    public function updateProperty(Property $property, array $data) {
        return $this->propertyRepository->update($property, $data);
    }

    public function deleteProperty(Property $property) {
        return $this->propertyRepository->delete($property);
    }
}
