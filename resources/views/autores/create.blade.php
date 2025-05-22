@extends('layout')

@section('title', 'Novo Autor')

@section('content')
    <h2 class="mb-4">Novo Autor</h2>

    <form action="{{ route('autores.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="biografia" class="form-label">Biografia:</label>
            <textarea name="biografia" id="biografia" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('autores.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
@endsection