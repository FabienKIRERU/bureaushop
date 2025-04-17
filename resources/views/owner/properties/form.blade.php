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

@section('title', "Créer un bien")

@section('content')
    <div class="formproperty">
        <h2 style="text-align: center" class="text-secondary">@yield('title')</h2>
        <form action="{{ route('owner.property.store') }}" method="post" class="vstack gap-2" enctype="multipart/form-data">
            @csrf
            {{-- @method('post') --}}
            <div class="col">

                <div class="row">
                    <label for="name">Nom Du Bien: 
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"/>
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
                        <textarea name="description" id="description" col="10" row="30" class="form-control @error('description') is-invalid @enderror">
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
                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror"/>
                        </label>
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror 
                    </div>
                    <div class="col">
                        <label for="stock">Combien en stock :
                            <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror"/>
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
                <label for="categories" class="block font-semibold mb-1">Catégories existantes</label>
                <select name="categories[]" multiple class="w-full border rounded p-2 @error('categories') is-invalid @enderror">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('categories')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror 
            </div>

            <div class="mb-4">
                <label for="new_categories" class="block font-semibold mb-1">Nouvelles catégories (séparées par une virgule)</label>
                <input type="text" name="new_categories" class="w-full border rounded p-2" placeholder="ex: Scanner, Imprimante Pro">
            </div>


            <div class="mb-3 form-control">
                <label for="images" class="form-label">Images</label>
                <input type="file" name="images[]" class="form-control" multiple>
            </div>
            
            <div>
                <button type="submit" class="btn btn-dark mt-3">
                    Enregistrer
                </button>
            </div>
        </form>
    
    </div>
@endsection