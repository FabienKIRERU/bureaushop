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
            
            <div>
                <button type="submit" class="btn btn-dark mt-3">
                    Mettre a jour
                </button>
            </div>
        </form>
    
    </div>
@endsection