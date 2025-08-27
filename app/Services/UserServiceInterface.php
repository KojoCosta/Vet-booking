<?php
// app/Services/UserServiceInterface.php

namespace App\Services;

use App\Models\User;

interface UserServiceInterface
{
    /**
     * Create a user and its related owner or veterinarian record.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data): User;
}