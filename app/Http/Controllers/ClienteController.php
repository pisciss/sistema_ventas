<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //
    public function index(Request $request)
    {

        $query = trim($request->get('busca'));
        $clientes =  Cliente::where('nombre', 'LIKE', '%' . $query . '%')
            ->orwhere('num_documento', 'LIKE', '%' . $query . '%')
            ->paginate(7);
        //
        return view('clientes.index', ["clientes" => $clientes, "busca" => $query]);
    }
    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)


    {
        $request->validate([

            'nombre' => 'required|max:50',
            'tipo_documento' => 'required',
            'direccion' => 'max:256',
            'telefono' => 'numeric',
            'email' => 'email|unique:clientes',
            'num_documento' => 'required|max:30',

        ]);
        $data = $request->all();

        $cliente = Cliente::create($data);

        $cliente->save();

        return redirect()->action('ClienteController@index');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'nombre' => 'required|max:50',
            'tipo_documento' => 'required',
            'direccion' => 'max:256',
            'telefono' => 'numeric',
            'email' => 'exists:clientes|email',
            'num_documento' => 'required|max:30',

        ]);


        $cliente = Cliente::findOrFail($id);
        $cliente->nombre = $request->get('nombre');
        $cliente->tipo_documento = $request->get('tipo_documento');
        $cliente->direccion = $request->get('direccion');
        $cliente->telefono = $request->get('telefono');
        $cliente->email = $request->get('email');
        $cliente->num_documento = $request->get('num_documento');

        $cliente->save();

        return redirect()->action('ClienteController@index');
    }

    public function destroy($id)

    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index');
    }
}
