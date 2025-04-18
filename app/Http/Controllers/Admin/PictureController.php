<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\PropertyImageService;

class PictureController extends Controller
{
    protected $propertyImageService;

    public function __construct(PropertyImageService $propertyImageService){
        $this->propertyImageService = $propertyImageService;
    }

    public function destroy($id){
        dd('ok');
        Log::info('Suppression de l\'image');
        $this->propertyImageService->deleteImage($id);
        return response()->json(['message' => 'Image supprimée']);
        // dd('ok');
        // $this->propertyImageService->deleteImage($id);
        // return '';
    }
}
