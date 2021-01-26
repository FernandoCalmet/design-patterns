<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends  BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getWithSameFirstAndLastName(string $name)
    {
        $first = $this->model->where('first_name', $name);

        return $this->model->where('last_name', $name)
            ->union($first)
            ->get();
    }
}
