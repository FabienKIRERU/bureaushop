<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.2-web/fontawesome-free-6.5.2-web/css/all.min.css')}}">
    <link rel="shortcut icon" href="{{asset('logo/logo.ico')}}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
</head>
<body>

    <div class="container-fluid">
        <div class="row">

            {{-- Categories --}}
            <div class="col-md-3">
                <h5 class="mb-3">Filtrer par catégorie</h5>
                <form action="{{ route('properties.index') }}" method="GET">
                    <div class="mb-3">
                        <select name="category" class="form-select" onchange="this.form.submit()">
                            <option value="">Toutes les catégories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            <div class="col-md-9">
                <h3 class="mb-4">Liste des biens</h3>

                <div class="row">
                    @forelse ($properties as $property)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if($property->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" class="card-img-top" alt="Image du bien" style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="Image par défaut" style="height: 200px; object-fit: cover;">
                                @endif

                                {{-- <img src="{{ $property->images->first()->url ?? asset('images/default.jpg') }}" 
                                    class="card-img-top" 
                                    alt="Image du bien" 
                                    style="height: 200px; object-fit: cover;"> --}}

                                <div class="card-body">
                                    <h5 class="card-title">{{ $property->name }}</h5>
                                    <p class="card-text">{{ Str::limit($property->description, 80) }}</p>
                                    <p class="text-muted">{{ number_format($property->price, 2) }} USD</p>
                                    <a href="" class="btn btn-primary btn-sm">Voir détail</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Aucun bien trouvé pour cette catégorie.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
    
</body>
</html>

