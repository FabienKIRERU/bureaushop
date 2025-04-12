@extends('admin.layouts.app')

@section('content')

@section('title', 'Toutes les biens')
    
    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{ route('admin.property.create') }}" class="btn btn-dark">Add Bien</a>
        
    </div>

    <table class="table table-stripped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Categorie</th>
                <th>Statut</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($properties as $property)
                <tr>
                    <td> {{ $property->name }} </td>
                    <td>
                        @foreach ($property->categories as $category)
                            <span class="inline-block bg-gray-200 text-sm text-gray-700 px-2 py-1 rounded mr-1">{{ $category->name }}</span>
                        @endforeach
                    </td>
                    <td> {{ $property->status }} </td>
                    
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a href="{{ route('admin.property.edit', $property->id) }}" class="btn btn-light text-dark">Editer</a>

                            <form action="{{ route('admin.property.delete', $property->id) }}" method="POST" onsubmit="return confirm('Es-tu sûr de vouloir supprimer ce bien ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-light text-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
            <div class="bg bg-light text-danger"> Pas des biens pour l'instant </div>
            @endforelse
        </tbody>
    </table>
    {{-- {{ $options->links() }} --}}

@endsection