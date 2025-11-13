<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 *implementação do UserRepository.
 */
class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }


    public function create(array $data): User
    {

        $data['password'] = Hash::make($data['password']);


        return $this->model->create($data);
    }


    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }
}