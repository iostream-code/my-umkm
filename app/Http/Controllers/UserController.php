<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;

class UserController extends Controller
{
    public function users()
    {
        $users = User::all();

        return view('users.admin.users', compact('users'));
    }

    public function detailUser(User $user)
    {
        return view('users.admin.user_detail', compact('user'));
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return Redirect::route('users');
    }
}
