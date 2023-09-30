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

    public function searchUsers($attributes){
        
        $users = User::with(['posts' => fn($query) => $query->where('title', 'like', '%'.$attributes['title'].'%')])
        ->whereHas('posts', fn ($query) => $query->where('title', 'like', '%'.$attributes['title'].'%'))->get();

        return response($users);
    }
}