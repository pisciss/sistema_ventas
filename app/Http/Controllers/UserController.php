<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {

        $query = trim($request->get('busca'));
        $users =  User::where('name', 'LIKE', '%' . $query . '%')
            ->orwhere('email', 'LIKE', '%' . $query . '%')
            ->paginate(7);
        //
        return view('users.index', ["users" => $users, "busca" => $query]);
    }
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::where('id', $request->role_id)->first();
            $permissions = $roles->permissions;
            return $permissions;
        }
        $roles = Role::all();
        return view('users.create', ['roles' => $roles]);
    }

    public function store(Request $request)

    {
        $request->validate([

            'name' => 'required|max:50|min:4',
            'email' => 'unique:users|email|required',
            'password' => 'required|between:4,20|confirmed',
            'password_confirmation' => 'required'

        ]);


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        if ($request->role != null) {

            $user->roles()->attach($request->role);
            $user->save();
        }

        if ($request->permissions != null) {
            foreach ($request->permissions as $permission) {
                $user->permissions()->attach($permission);
                $user->save();
            }
        }
        return redirect()->action('UserController@index');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();
        $userRole = $user->roles->first();
        if ($userRole != null) {
            $rolePermissions = $userRole->allRolePermissions;
        } else {
            $rolePermissions = null;
        }
        $userPermissions = $user->permissions;
        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRole' => $userRole,
            'rolePermissions' => $rolePermissions,
            'userPermissions' => $userPermissions
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'exists:users|email',
            'password' => 'confirmed',

        ]);



        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($request->password != null) {

            $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->roles()->detach();
        $user->permissions()->detach();

        if ($request->role != null) {
            $user->roles()->attach($request->role);
            $user->save();
        }
        if ($request->permissions != null) {
            foreach ($request->permissions as $permission) {
                $user->permissions()->attach($permission);
                $user->save();
            }
        }

        return redirect()->action('UserController@index');
    }

    public function destroy($id)

    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        return redirect()->route('users.index');
    }
}
