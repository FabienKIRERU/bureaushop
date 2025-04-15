<?php

namespace App\Models;
use App\Models\User;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
    ];

    public function properties() {
        return $this->belongsToMany(Property::class, 'property_category');
    }
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

}
