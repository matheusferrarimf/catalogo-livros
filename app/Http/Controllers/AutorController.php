<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $autores = Autor::when($busca, function ($query, $busca) {
                return $query->where('nome', 'like', "%{$busca}%");
            })
            ->orderBy('nome')
            ->paginate(10);

        return view('autores.index', compact('autores', 'busca'));
    }

    public function create()
    {
        return view('autores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
        ]);

        Autor::create($request->only('nome', 'biografia'));

        return redirect()->route('autores.index')->with('success', 'Autor criado com sucesso!');
    }

    public function edit(Autor $autor)
    {
        return view('autores.edit', compact('autor'));
    }

    public function update(Request $request, Autor $autor)
    {
        $request->validate([
            'nome' => 'required',
        ]);

        $autor->update($request->only('nome', 'biografia'));

        return redirect()->route('autores.index')->with('success', 'Autor atualizado com sucesso!');
    }

    public function destroy(Autor $autor)
    {
        $autor->delete();

        return redirect()->route('autores.index')->with('success', 'Autor excluído com sucesso!');
    }
}