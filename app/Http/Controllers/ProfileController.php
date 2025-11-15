<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
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

   public function storePrestador(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Mudei de 'nome' para 'name'
            'email' => 'required|email|unique:users,email',
            'documento' => 'required|string|unique:users,documento',
            'telefone' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
            'password' => 'required|min:8|confirmed',
            'cep' => 'required|string',
            'rua' => 'required|string',
            'numero' => 'required|string',
            'complemento' => 'nullable|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'estado' => 'required|string|size:2',
             
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role_id'] = 2;

        $user = User::create($validated);

        if ($user) {
            Log::info('Usuário criado com sucesso:', $user->toArray());
        } else {
            Log::error('Falha ao criar usuário');
        }

        return redirect()->route('prestadores.create')
                        ->with('success', 'Prestador cadastrado com sucesso!');
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
