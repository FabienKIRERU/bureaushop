<x-mail::message>
# Nouvelle demane du bien


{{ $data['name'] }} vous a envoye une demande pour le bien 
<a href="{{ route('properties.show', $property) }}">
    {{ $property->title }}
</a> 

par :
- Nom : {{ $data['name'] }}
- Prenom : {{ $data['first_name'] }}
- Numero : {{ $data['phone'] }}
- email : {{ $data['email'] }}

** Message ** <br>
{{ $data['message'] }}

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
