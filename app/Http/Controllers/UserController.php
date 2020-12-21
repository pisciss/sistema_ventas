<?php

namespace App\Http\Controllers;

use App\User;
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
    public function create()
    {
        return view('users.create');
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

        return redirect()->action('UserController@index');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'exists:users|email',
            'password' => 'required|max:20',
            'password_confirm' => 'required|max:20',
        ]);



        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($request->password != null) {

            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->action('UserController@index');
    }

    public function destroy($id)

    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
