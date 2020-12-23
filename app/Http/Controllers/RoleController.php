<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use  App\Permission;
use Illuminate\Support\Facades\Gate;

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
        if (Gate::allows('isAdmin')) {
            abort(403);
        }
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

        $listOfPermissions = explode(',', $request->roles_permissions);

        foreach ($listOfPermissions as $per) {
            $permissions = new Permission();
            $permissions->name = $per;
            $permissions->slug = strtolower(str_replace(" ", "-", $per));
            $permissions->save();
            $role->permissions()->attach($permissions->id);
            $role->save();
        }
        return redirect()->action('RoleController@index');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Role $role)
    {
        //  $role = Role::findOrFail($id);
        return view('roles.edit', ['role' => $role]);
    }


    public function update(Request $request, $id)
    {

        $role = Role::findOrFail($id);
        $role->name = $request->get('name');
        $role->slug = $request->get('slug');
        $role->save();
        //borro y las relaciones también
        $role->permissions()->delete();
        $role->permissions()->detach();




        $listOfPermissions = explode(',', $request->roles_permissions);

        foreach ($listOfPermissions as $per) {
            $permissions = new Permission();
            $permissions->name = $per;
            $permissions->slug = strtolower(str_replace(" ", "-", $per));
            $permissions->save();
            $role->permissions()->attach($permissions->id);
            $role->save();
        }
        return redirect()->action('RoleController@index');
    }

    public function destroy($id)

    {
        $role = Role::findOrFail($id);
        $role->permissions()->delete();
        $role->delete();

        $role->permissions()->detach();
        return redirect()->route('roles.index');
    }
}
