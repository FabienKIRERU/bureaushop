<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface AuthRepositoryInterface{


    public function getAll();

    public function findById(int $id);

    public function findByEmail(string $email);

    public function create(array $data);

    public function update(User $user, array $data);

    public function delete(User $user);
}