<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public static function signUser(Request $request)
    {
        $exists = \App\Models\User::where('username', $request->username)->first();

        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:3|max:15',
            'isAdmi' => 'sometimes',
            'avatar' => 'sometimes|image|mimes:jpg,jpeg,svg,png,webp|max:4096'
        ], $messages = [
            'mimes' => 'Please insert jpg,jpeg,svg,png,webp image only',
            'max' => 'Image should be less than 4 MB'
        ]);

        $user = new \App\Models\User();
        $user->username = $request->input('username');
        $user->password = $request->input('password');

        if ($request->has('isAdmin')) {
            $user->is_admin = 1;
        }

        if ($request->has('avatar')) {

            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $file->move('images', $name);

            $user->avatar_path = $name;
        }

        $user->save();

        return back();
    }

    public static function showUser(Request $request)
    {
        $users = \App\Models\User::all();
        return view('sign-user', ['users' => $users]);
    }

    // Go to Edit User Page
    public static function editUser(Request $request, $id)
    {
        $user = \App\Models\User::where('id', $id)->first();
        return view('edit-user', ['user' => $user]);
    }

    public static function updateUser(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'isAdmin' => 'sometimes',
            'avatar' => 'sometimes|image|mimes:jpg,jpeg,svg,png,webp|max:4096'
        ], $messages = [
            'mimes' => 'Please insert jpg,jpeg,svg,png,webp image only',
            'max' => 'Image should be less than 4 MB'
        ]);

        $user = \App\Models\User::where('id', $request->current)->first();
//        if ($request->has('username')) {
        $user->username = $request->username;
//            $user->update(['username' => $request->username]);
//        }
//        if ($request->has('password')) {
        $user->password = $request->password;
//            $user->update(['password' => $request->password]);
//        }
        if ($request->has('isAdmin')) {
            $user->is_admin = 1;
        }

        if ($request->has('avatar')) {

            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $file->move('images', $name);

            $user->avatar_path = $name;
//            $user->update(['avatar_path' => $name]);

        }

        $user->save();
        return redirect('signUser');
    }

    public static function deleteUser(Request $request, $id)
    {
        $user = \App\Models\User::where('id', $id);
        $user->delete();
        return redirect('signUser');
    }

    public function usersList()
    {
        $users = \App\Models\User::all();
        return view('users-list', ['users' => $users]);
    }
}
