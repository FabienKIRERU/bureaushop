@extends('admin.layouts.app')

@section('content')

@section('title', 'Toutes Vos Categories')
    
    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{ route('admin.category.create') }}" class="btn btn-dark">Add Your Category</a>
        
    </div>

    <table class="table table-stripped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Proprietaire</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td> {{ $category->name }} </td>
                    <td> {{ $category->user?->name }} </td>
                    
                    <td>
                        
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            @if ($user)
                                <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-light text-dark">
                                    Editer
                                </a>                                
                            @endif
                            <form action="{{ route('admin.category.delete', $category->id) }}" method="POST" onsubmit="return confirm('Es-tu sûr de vouloir supprimer cette catégorie ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light text-danger">Supprimer</button>
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