<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * [T-05] Método create exigido pelo plano.
     * @param array $data Os dados do utilizador (name, email, password, role, etc.)
     * @return User O Model User criado.
     */
    public function create(array $data): User;

    /**
     * [T-05] Método findByEmail exigido pelo plano.
     * @param string $email O email a ser procurado.
     * @return User|null O Model User encontrado ou null.
     */
    public function findByEmail(string $email): ?User;
}