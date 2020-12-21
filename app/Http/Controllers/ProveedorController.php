<?php

namespace App\Http\Controllers;

use App\Proveedor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
    //
    public function index(Request $request)
    {

        $query = trim($request->get('busca'));
        $proveedores =  Proveedor::where('nombre', 'LIKE', '%' . $query . '%')
            ->orwhere('num_documento', 'LIKE', '%' . $query . '%')
            ->paginate(7);
        //
        return view('proveedores.index', ["proveedores" => $proveedores, "busca" => $query]);
    }
    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)


    {
        $request->validate([

            'nombre' => 'required|max:50',
            'tipo_documento' => 'required',
            'direccion' => 'max:256',
            'telefono' => 'numeric',
            'email' => 'email|unique:proveedores',
            'num_documento' => 'required|max:30',

        ]);
        $data = $request->all();

        $proveedor = Proveedor::create($data);

        $proveedor->save();

        return redirect()->action('ProveedorController@index');
    }

    public function show(Proveedor $proveedor)
    {
        return view('proveedores.show', compact('proveedor'));
    }

    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'nombre' => 'required|max:50',
            'tipo_documento' => 'required',
            'direccion' => 'max:256',
            'telefono' => 'numeric',
            'email' => 'exists:proveedores|email',
            'num_documento' => 'required|max:30',

        ]);


        $proveedor = Proveedor::findOrFail($id);
        $proveedor->nombre = $request->get('nombre');
        $proveedor->tipo_documento = $request->get('tipo_documento');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->telefono = $request->get('telefono');
        $proveedor->email = $request->get('email');
        $proveedor->num_documento = $request->get('num_documento');

        $proveedor->save();

        return redirect()->action('ProveedorController@index');
    }

    public function destroy($id)

    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return redirect()->route('proveedores.index');
    }
}
