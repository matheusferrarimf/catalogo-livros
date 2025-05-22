@extends('layout')

@section('title', 'Lista de Livros')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Lista de Livros</h2>
            <a href="{{ route('livros.create') }}" class="btn btn-primary">Novo Livro</a>
        </div>

        <form method="GET" action="{{ route('livros.index') }}" class="mb-3 d-flex">
            <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar por título ou gênero..." class="form-control me-2">
            <button type="submit" class="btn btn-outline-secondary">Buscar</button>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($livros->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Gênero</th>
                        <th>Autor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($livros as $livro)
                        <tr>
                            <td>{{ $livro->id }}</td>
                            <td>{{ $livro->titulo }}</td>
                            <td>{{ $livro->genero }}</td>
                            <td>{{ $livro->autor->nome }}</td>
                            <td>
                                <a href="{{ route('livros.edit', $livro) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('livros.destroy', $livro) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deseja excluir este livro?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $livros->appends(['busca' => request('busca')])->links() }}
            </div>
        @else
            <div class="alert alert-info">Nenhum livro encontrado.</div>
        @endif
    </div>
@endsection
