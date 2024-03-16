<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->latest()->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('transactions.court');

        return view('admin.user.show', compact('user'));
    }
}
