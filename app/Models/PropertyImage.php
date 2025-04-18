<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'image_path',
        'is_featured'
    ];

    protected static function booted():void
    {
        static::deleting(function($id){
            $propertyImage = PropertyImage::firstOrFail($id);
            Storage::delete($propertyImage->image_path);
        });
    }


    public function property() {
        return $this->belongsTo(Property::class);
    }
}
