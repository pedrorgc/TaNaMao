<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Cliente;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'Credenciais inválidas'])->withInput($request->only('email'));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'account_type' => 'nullable|string|in:cliente,prestador',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Assign a role/profile to the user (cliente or prestador). Admins must be created internally.
        $accountType = $data['account_type'] ?? 'cliente';
        $role = Role::where('name', $accountType)->first();
        if ($role) {
            Cliente::create([
                'user_id' => $user->id,
                'role_id' => $role->id,
                'telefone' => null,
            ]);
        }

        Auth::login($user);

        // Redirect users to different areas depending on role
        if ($accountType === 'prestador') {
            return redirect()->route('profile.prestador');
        }

        return redirect()->route('profile');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
