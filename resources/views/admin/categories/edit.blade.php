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
@extends('admin.layouts.app')

@section('title', "éditer une Categorie")

@section('content')
    <div class="formproperty">
        <h2 style="text-align: center" class="text-secondary">@yield('title')</h2>
        <form action="{{ route('admin.category.update', $category->id) }}" method="post" class="vstack gap-2" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="col">

                <div class="row">
                    <label for="name">Nom De la Categorie: 
                        <input type="text" value="{{ $category->name }}" name="name" id="name" class="form-control @error('name') is-invalid @enderror"/>
                    </label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror    
                </div>
            </div>
            
            <div>
                <button type="submit" class="btn btn-dark mt-3">
                    Enregistrer
                </button>
            </div>
        </form>
    
    </div>
@endsection