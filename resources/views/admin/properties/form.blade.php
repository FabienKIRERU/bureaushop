<style>
    .formtaxation{
        width: 65%;
        background-color: #fff;
        padding: 10;
        display: inline-block;
        border-radius: 10px;
        text-align: initial;
    }

</style>
@extends('admin.layouts.app')

@section('title', "Créer un bien")

@section('content')
{{-- <div class="contenuForm"> --}}
    <div class="formtaxation">
        <h2 style="text-align: center" class="text-secondary">@yield('title')</h2>
        <form action=""
                method="post" class="vstack gap-2" enctype="multipart/form-data">
            @csrf
            {{-- @method() --}}
            <div class="col">

                <div class="row">
                    <label for="name">Nom Du Bien: 
                        <input type="text" name="name" id="name" class="form-control"/>
                    </label>
                </div>
                <div class="row">
                    <label for="decription">Description : 
                        <input type="text" name="decription" id="decription" class="form-control"/>
                    </label>
                    @error('tax')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror    
                </div>
            </div>
            
            <div>
                <button class="btn btn-dark mt-3">
                    Enregistrer
                </button>
            </div>
        </form>
    
    </div>

{{-- </div> --}}
@endsection