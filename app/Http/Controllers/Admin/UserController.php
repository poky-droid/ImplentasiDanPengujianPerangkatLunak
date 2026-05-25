<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);
        return view('admin.list-user', compact('users'));
    }

    public function store(Request $request)
    {
        // Create user logic
        return redirect()->route('admin.users.index');
    }

    public function update(Request $request, User $user)
    {
        // Update user logic
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
