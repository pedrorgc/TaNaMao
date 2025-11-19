<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\StoreClienteRequest;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Prestador;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log; // <--- adicionado

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function createPrestador()
    {
        $categorias = Categoria::all();

        return view('pages.public.cadastro-prestador', compact('categorias'));
    }

    public function edit(Request $request): View
    {
        $user = $request->user();


        if ($user->isAdmin()) {
        }

        if ($user->isPrestador()) {
        }

        if ($user->isCliente()) {
        }

        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        if (!$user->isAdmin()) {
            $validated = $request->validated();
            unset($validated['role_id']);
        }

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }



    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        $user = $request->user();

        if (!$user) {
            return Redirect::to('/');
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
