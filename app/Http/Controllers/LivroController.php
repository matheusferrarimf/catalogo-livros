<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Autor;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $livros = Livro::with('autor')
            ->when($busca, function ($query, $busca) {
                return $query->where('titulo', 'ilike', "%{$busca}%")
                            ->orWhere('genero', 'ilike', "%{$busca}%");
            })
            ->orderBy('titulo')
            ->paginate(10);

        return view('livros.index', compact('livros'));
    }


    public function create()
    {
        $autores = Autor::all();
        return view('livros.create', compact('autores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'genero' => 'required',
            'autor_id' => 'required|exists:autors,id'
        ]);

        Livro::create($request->only('titulo', 'descricao', 'genero', 'autor_id'));

        return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso!');
    }

    public function edit(Livro $livro)
    {
        $autores = Autor::all();
        return view('livros.edit', compact('livro', 'autores'));
    }

    public function update(Request $request, Livro $livro)
    {
        $request->validate([
            'titulo' => 'required',
            'genero' => 'required',
            'autor_id' => 'required|exists:autors,id'
        ]);

        $livro->update($request->only('titulo', 'descricao', 'genero', 'autor_id'));

        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy(Livro $livro)
    {
        $livro->delete();

        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso!');
    }
}