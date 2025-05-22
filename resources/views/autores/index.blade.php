@extends('layout')

@section('title', 'Lista de Autores')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Lista de Autores</h2>
            <a href="{{ route('autores.create') }}" class="btn btn-primary">Novo Autor</a>
        </div>

        <form method="GET" action="{{ route('autores.index') }}" class="mb-3 d-flex">
            <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar autor..." class="form-control me-2">
            <button type="submit" class="btn btn-outline-secondary">Buscar</button>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($autores->count())
            <ul class="list-group">
                @foreach ($autores as $autor)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $autor->nome }}
                        <div class="btn-group">
                            <a href="{{ route('autores.edit', $autor) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('autores.destroy', $autor) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="mt-3">
                {{ $autores->appends(['busca' => request('busca')])->links() }}
            </div>
        @else
            <div class="alert alert-info mt-3">Nenhum autor encontrado.</div>
        @endif
    </div>
@endsection
