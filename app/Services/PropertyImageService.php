<?php

namespace App\Services;

use App\Repositories\PropertyImageRepository;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class PropertyImageService {
    protected $propertyImageRepository;

    public function __construct(PropertyImageRepository $propertyImageRepository) {
        $this->propertyImageRepository = $propertyImageRepository;
    }

    public function getImagesByProperty(int $propertyId) {
        return $this->propertyImageRepository->getByPropertyId($propertyId);
    }

    public function addImageToProperty(int $propertyId, $imageFile) {
        DB::beginTransaction();
        try {            
            $path = $imageFile->store('properties', 'public');            
            $image = $this->propertyImageRepository->create([
                'property_id' => $propertyId,
                'image_path' => $path
            ]);
            DB::commit();
            return $image;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erreur lors d'ajout d'image : " . $e->getMessage());
        }
    }

    public function deleteImage($id) {
        DB::beginTransaction();
        try {
            $image = $this->propertyImageRepository->findById($id);
            Storage::disk('public')->delete($image->image_path);
            $this->propertyImageRepository->delete($image);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erreur de la suppression d'image : " . $e->getMessage());
        }
    }
}
