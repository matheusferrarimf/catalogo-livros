@extends('layout')

@section('title', 'Editar Livro')

@section('content')
    <h2 class="mb-4">Editar Livro</h2>

    <form action="{{ route('livros.update', $livro->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" name="titulo" id="titulo" value="{{ $livro->titulo }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="4">{{ $livro->descricao }}</textarea>
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Gênero:</label>
            <input type="text" name="genero" id="genero" value="{{ $livro->genero }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="autor_id" class="form-label">Autor:</label>
            <select name="autor_id" id="autor_id" class="form-select" required>
                @foreach ($autores as $autor)
                    <option value="{{ $autor->id }}" {{ $autor->id == $livro->autor_id ? 'selected' : '' }}>{{ $autor->nome }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('livros.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
@endsection