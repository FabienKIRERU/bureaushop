<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $property->name }}-Bureaushop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.2-web/fontawesome-free-6.5.2-web/css/all.min.css')}}">
    <link rel="shortcut icon" href="{{asset('logo/logo.ico')}}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="card shadow rounded-4" >
            <div class="row g-0">
                <!-- Images à gauche -->
                <div class="col-md-6">
                    @if ($property->images->count())
                        <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($property->images as $key => $image)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100 rounded-start-4" alt="Property Image" height="750" style="object-fit: contain">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    @else
                        <img src="https://via.placeholder.com/600x400?text=Aucune+image" class="img-fluid rounded-start-4" alt="Image par défaut">
                    @endif
                </div>

                <!-- Détails à droite -->
                <div class="col-md-6 p-4">
                    <h2 class="mb-3">{{ $property->name }}</h2>
                    <p><strong>Statut :</strong> {{ ucfirst($property->status ?? 'Indisponible') }}</p>
                    <p><strong>Prix :</strong> {{ number_format($property->price, 0, ',', ' ') }} USD</p>
                    <p><strong>Description :</strong> {{ $property->description ?? 'Aucune description fournie.' }}</p>

                    <div class="mb-3">
                        <strong>Catégories :</strong>
                        @forelse ($property->categories as $category)
                            <p class="badge bg-success">{{ $category->name }}</p>
                        @empty
                            <span class="text-muted">Aucune</span>
                        @endforelse
                    </div>

                    <hr>

                    <!-- Formulaire de contact -->
                    <h3>Contacter le propriétaire</h3>
                    <div class="alert alert-light">
                        <form method="" action="">
                            <h5>Envoyer un email</h5>
                            <div class="mb-3">
                                <label for="email" class="form-label">Votre email</label>
                                <input type="email" class="form-control" id="email" placeholder="example@gmail.com"/>
                            </div>
    
                            <div class="mb-3">
                                <label for="message" class="form-label">Votre message</label>
                                <textarea class="form-control" id="message" rows="3" placeholder="Bonjour, je suis intéressé par ce bien..."></textarea>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-dark">Envoyez mail</button>
                            </div>
                        </form>
                    </div>
                    Joindre le proprietaire
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-success">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-telephone"></i> Appeler
                        </a>
                        <a href="#" class="btn btn-secondary">
                            <i class="bi bi-chat-dots"></i> SMS
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
