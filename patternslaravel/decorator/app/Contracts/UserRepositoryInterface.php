<?php

namespace App\Contracts;

interface UserRepositoryInterface
{
    public function getWithSameFirstAndLastName(string $name);
}