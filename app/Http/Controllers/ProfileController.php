<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\ProfileService;
use App\Models\Categoria;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Display the user's profile form.
     */
    public function createPrestador(): View
    {
        $categorias = Categoria::all();
        return view('pages.public.cadastro-prestador', compact('categorias'));
    }

   public function show(Request $request): View
{
    $user = $request->user();
    $profileData = $this->profileService->getUserProfileData($user);

    return view('pages.public.profile', $profileData);
}

    public function edit(Request $request): View
    {
        $user = $request->user();

        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $data = $request->validated();

        if (!$user->isAdmin()) {
            unset($data['role_id']);
        }

        try {
            $this->profileService->updateUserProfile($user, $data);

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
                $user->save();
            }

            return Redirect::route('profile')->with('status', 'Perfil atualizado com sucesso!');

        } catch (\Exception $e) {
            return Redirect::route('profile')
                ->with('error', 'Erro ao atualizar perfil: ' . $e->getMessage());
        }
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $user = $request->user();

        try {
            $this->profileService->updateUserSettings($user, [
                'notificacao_email' => $request->has('notificacao_email'),
                'notificacao_push' => $request->has('notificacao_push'),
            ]);

            return Redirect::route('profile')->with('status', 'Configurações atualizadas com sucesso!');

        } catch (\Exception $e) {
            return Redirect::route('profile')
                ->with('error', 'Erro ao atualizar configurações: ' . $e->getMessage());
        }
    }

    public function updateAgenda(Request $request): RedirectResponse
    {
        $user = $request->user();

        try {
            $this->profileService->updatePrestadorAgenda($user, $request->dias);

            return Redirect::route('profile')->with('status', 'Agenda atualizada com sucesso!');

        } catch (\Exception $e) {
            return Redirect::route('profile')
                ->with('error', 'Erro ao atualizar agenda: ' . $e->getMessage());
        }
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
