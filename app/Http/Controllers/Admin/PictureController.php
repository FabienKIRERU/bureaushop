<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PropertyImageService;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    protected $propertyImageService;

    public function __construct(PropertyImageService $propertyImageService){
        $this->propertyImageService = $propertyImageService;
    }

    public function destroy($id){
        $this->propertyImageService->deleteImage($id);
        return '';
    }
}
