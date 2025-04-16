<?php

namespace App\Services; 

use Storage;
use Exception;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use App\Repositories\PropertyRepository;

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

    public function getPropertiesWithCategories(){
        return $this->propertyRepository->getPropertiesWithCategories();
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

    public function createPropertyWithImages(array $data, array $images){
        $property = $this->propertyRepository->create($data);

        foreach ($data['categories'] as $category) {
            $property->categories()->attach($category);
        }

        foreach ($images as $image) {
            $path = $image->store('properties', 'public');
            $property->images()->create(['image_path' => $path]);
        }

        return $property;
    }

    public function updatePropertyWithImages(array $data, array $images, int $id){
        $property = $this->propertyRepository->findById($id);

        // Mettre à jour le bien
        $this->propertyRepository->update($id, $data);

        // Mettre à jour les catégories
        if (isset($data['categories'])) {
            $property->categories()->sync($data['categories']);
        }

        // Si de nouvelles images sont fournies
        if (!empty($images)) {
            // Ajouter les nouvelles images
            foreach ($images as $image) {
                $path = $image->store('properties', 'public');
                $property->images()->create(['image_path' => $path]);
            }
        }

        return $property;
    }



    public function updateProperty($id, array $data) {
        return $this->propertyRepository->update($id, $data);
    }

    public function deleteProperty($id) {
        return $this->propertyRepository->delete($id);
    }
}
