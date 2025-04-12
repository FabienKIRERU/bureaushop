<?php

namespace App\Repositories;

use App\Models\Property;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\PropertyRepositoryInterface;

class PropertyRepository implements PropertyRepositoryInterface {
    
    protected $property;

    public function __construct(?Property $property = null)
    {
        $this->property = $property ?? new Property();
    }
    
    public function getAll(): Collection {
        return Property::with(['category', 'user', 'images'])->latest()->get();
    }
    
    public function getPropertiesByUser(int $userId) {
        return Property::where('user_id', $userId)->get();
    }
    
    public function findById(int $id): ?Property {
        return Property::with(['categories', 'user', 'images'])->findOrFail($id);
    }

    public function getByCategory(int $categoryId): Collection {
        return Property::where('category_id', $categoryId)->with(['images'])->get();
    }

    public function getPropertiesWithCategories(): Collection{
        return Property::with(['categories', 'images'])->get();
    }

    // public function create(array $data): Property {
    //     return Property::create($data);
    // }
    public function create(array $data){
        $property = new Property($data);
        $property->user_id = $data['user_id']; // Association utilisateur
        $property->save();

        if (isset($data['categories'])) {
            $property->categories()->attach($data['categories']);
        }

        return $property;
    }


    // public function updateProperty(Property $property, array $data): Property {
    //     $property->update($data);
    //     return $property;
    // }

    public function update(int $id, array $data){
        // $property = Property::findOrFail($id);
        // $property->update($data);

        // // Mettre à jour les catégories liées (table pivot)
        // if (isset($data['categories'])) {
        //     $property->categories()->sync($data['categories']);
        // }

        // return $property;


        $property = Property::findOrFail($id);

        // Vérifier que c'est bien le bien de l'utilisateur connecté
        if ($property->user_id !== $data['user_id']) {
            throw new \Exception("Vous n'avez pas l'autorisation de modifier ce bien.");
        }

        $property->update($data);

        if (isset($data['categories'])) {
            $property->categories()->sync($data['categories']);
        }

        return $property;
    }


    public function delete($id){
        Cache::forget('property');
        return $this->findById($id)->delete();
        // $property = Property::firstOrFail($id);
        // return $property->delete();
    }
}
