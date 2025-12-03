<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data, int $roleId = null): User
    {
        if (!$roleId) {
            $roleId = User::ROLE_CLIENTE;
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $roleId,
        ]);
    }

    public function updateUser(User $user, array $data): User
    {
        $updateData = [
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        if (isset($data['role_id'])) {
            $updateData['role_id'] = $data['role_id'];
        }

        $user->update($updateData);

        return $user;
    }
}
