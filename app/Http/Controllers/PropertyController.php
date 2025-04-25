<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyContactRequest;
use App\Mail\PropertyContactMail;
use App\Models\Property;
use App\Models\User;
use App\Notifications\ContactRequestNotification;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Services\PropertyService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class PropertyController extends Controller
{
    protected $propertyService;
    protected $categoryService;

    public function __construct(PropertyService $propertyService, CategoryService $categoryService)
    {
        $this->propertyService = $propertyService;
        $this->categoryService = $categoryService;
    }


    public function index(Request $request){
        $categoryId = $request->query('category');


        $properties = $this->propertyService->getPropertiesWithCategories();
        // dd($properties);
        return view('properties.index',[
            'properties' => $properties,
            'categories' => $this->categoryService->getAllCategories(),
        ]);
    }

    public function show(int $id){
        // dd('ok');
        $property = $this->propertyService->getPropertyDetails($id);
    
        abort_if(!$property, 404);

        $user = $property->user;
        // dd($user->unreadNotifications);
    
        return view('properties.show', compact('property'));
    }

    public function contact(Property $property, PropertyContactRequest $request){
        // dd($property->user->email);
        // dd($property->user);

        // Envoyer l'email au proprietaire du bien entrer par l'utilisateur
        Mail::send(new PropertyContactMail($property, $request->validated()));

        // Notifier le proprio du bien q'\un utilisateur s'est interesse par sosn bien
        $user = $property->user; 
        // $user->notify(new ContactRequestNotification($property, $request->validated()));
        Notification::route('mail', $user->email)->notify(new ContactRequestNotification($property, $request->validated()));
        return back()->with('success', 'Votre demande est bien envoye');
    }
    

}
