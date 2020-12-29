<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {

        $query = trim($request->get('busca'));
        $categorias =  Categoria::where('nombre', 'LIKE', '%' . $query . '%')->paginate(7);
        //
        return view('categorias.index', ["categorias" => $categorias, "busca" => $query]);
    }
    public function create()
    {
        return view('categorias.create');
    }

    public function store(CategoriaForm $request)
    {
        $data = $request->all();

        $categoria = Categoria::create($data);

        $categoria->save();

        return redirect()->action('CategoriaController@index');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {


        $request->validate([
            'nombre' => 'required|max:50',
            'descripcion' => 'required|max:200'

        ]);

        $categoria = Categoria::findOrFail($id);
        $this->authorize('update', $categoria);
        $categoria->nombre = $request->get('nombre');
        $categoria->descripcion = $request->get('descripcion');
        $categoria->save();
        return redirect()->action('CategoriaController@index');
    }

    public function destroy($id)

    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return redirect()->route('categorias.index');
    }
}
