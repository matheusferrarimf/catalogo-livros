@extends('layout')

@section('title', 'Editar Autor')

@section('content')
    <h2 class="mb-4">Editar Autor</h2>

    <form action="{{ route('autores.update', $autor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ $autor->nome }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="biografia" class="form-label">Biografia:</label>
            <textarea name="biografia" id="biografia" class="form-control" rows="4">{{ $autor->biografia }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('autores.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
@endsection