<style>
    .formproperty{
        width: 65%;
        background-color: #fff;
        padding: 10;
        display: inline-block;
        border-radius: 10px;
        text-align: initial;
    }

</style>
@extends('owner.layouts.app')

@section('title', "Editer un bien")

@section('content')
    <div class="formproperty">
        <h2 style="text-align: center" class="text-secondary">@yield('title')</h2>
        <form action="{{ route('owner.property.update', $property->id) }}" method="post" class="vstack gap-2" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="col">

                <div class="row">
                    <label for="name">Nom Du Bien: 
                        <input type="text" value="{{ $property->name }}" name="name" id="name" class="form-control @error('name') is-invalid @enderror"/>
                    </label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror    
                </div>
                <div class="row">
                    <label for="description">Description : 
                    </label>
                        <textarea  name="description" id="description" col="10" row="30" class="form-control @error('description') is-invalid @enderror">
                            {{ $property->description }}
                        </textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror    
                </div>
                <div class="form-groupe row">
                    <div class="col">
                        <label for="price">Prix (en USD):
                            <input type="number" value="{{ $property->price }}"  name="price" id="price" class="form-control @error('price') is-invalid @enderror"/>
                        </label>
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror 
                    </div>
                    <div class="col">
                        <label for="stock">Combien en stock :
                            <input type="number" value="{{ $property->stock }}"  name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror"/>
                        </label>
                        @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror 
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="categories" class="block font-semibold mb-1">Catégories :</label>
                <select name="categories[]" multiple class="w-full border rounded p-2 @error('categories') is-invalid @enderror">
                    @foreach($categories as $category)
                    
                        <option value="{{ $category->id }}"
                            @selected(in_array($category->id, old('categories', $property->categories->pluck('id')->toArray())))
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('categories')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror 
            </div>
            <div class="col vstack gap-4 form_picture alert alert-light container" style="">
                Les Images du bien
                <div class="container mt-4">
                    <div class="row">
                        @foreach ($property->images as $picture)
                            <div class="col-md-3 mb-4">
                                <div class="card h-100" id="picture{{$picture->id}}">
                                    <img src="{{ asset('storage/' . $picture->image_path) }}" alt="" class="p-1 card-img-top w-100 d-block" style="object-fit: contain">
                                    <button type="button" hx-delete="{{ route('admin.picture.destroy', $picture->id) }}"
                                        class="btn btn-danger position-absolute bottom-0 w-100 start-0"
                                        hx-target="#picture{{$picture->id}}" hx-swap="delete">
                                            <span class="htmlx-indicator spinner-border spinner-border-sm" role="status" aria-hidden="true">
                                            </span> Supprimer
                                    </button>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="mb-3 form-control">
                    <label for="images" class="form-label">Ajouter Les Images</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                </div>
            </div>
            
            <div>
                <button type="submit" class="btn btn-dark mt-3">
                    Mettre a jour
                </button>
            </div>
        </form>
    
    </div>
@endsection