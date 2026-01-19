<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $users = User::all();

        return view('roleviews.admin', compact('users'));
    }

    public function edit(User $user): View
    {
        $roles = ['analyst', 'broker', 'admin', 'inspector'];
        return view('roleviews.admin-edit-user', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:analyst,broker,admin,inspector'],
            'active' => ['nullable', 'boolean'],
        ]);

        $user->full_name = $validated['full_name'];
        $user->role = $validated['role'];
        $user->active = (bool) ($validated['active'] ?? false);
        $user->save();

        return redirect()->route('roleviews.admin');
    }
}
