<?php
 
namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

final class UserRepository implements UserRepositoryInterface{
    
    public function getUsersWithPosts(){
        return User::has('posts')->get();
    }

    public function deleteUser(User $user)
    {
        $user->is_active=0;
        $user->save();
        return response($user);
    }
}