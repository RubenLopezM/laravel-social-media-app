<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface{

    public function getUsersWithPosts();
    public function deleteUser(User $user);
    public function searchUsers($attributes);
}