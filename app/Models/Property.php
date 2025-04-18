<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{

    use HasFactory;    
    protected $fillable = [
        'user_id', 
        'name', 
        'description', 
        'price', 
        'stock', 
        'status'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'property_category');
    }

    public function images() {
        return $this->hasMany(PropertyImage::class);
    }
    
    public function getSlug(): string{
        return Str::slug($this->name);
    }

}
