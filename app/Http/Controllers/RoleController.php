<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function index(Request $request)
    {

        $query = trim($request->get('busca'));
        $roles =  Role::where('name', 'LIKE', '%' . $query . '%')->paginate(7);
        //
        return view('roles.index', ["roles" => $roles, "busca" => $query]);
    }
    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|max:50|min:4',
            'slug' => 'required|max:50|min:4',

        ]);


        $role = new Role;
        $role->name = $request->name;
        $role->slug = $request->slug;

        $role->save();
        return redirect()->action('RoleController@index');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role'));
    }


    public function update(Request $request, $id)
    {

        $role = Role::findOrFail($id);
        $role->name = $request->get('name');
        $role->slug = $request->get('slug');
        $role->save();
        return redirect()->action('RoleController@index');
    }

    public function destroy($id)

    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index');
    }
}
