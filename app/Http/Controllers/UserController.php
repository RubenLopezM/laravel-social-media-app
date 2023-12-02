<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{   

    protected $userRepository;

    public function __construct( UserRepositoryInterface $userRepository) {

        $this->userRepository = $userRepository;
    }

    public function showActiveUsers(){
        return $this->userRepository->getUsersWithPosts();
    }

    public function getUserByName(User $user){
        return $user;
    }

    public function deleteUser(User $user){
        return $this->userRepository->deleteUser($user);
    }

    public function searchUsers(Request $request){
        return $this->userRepository->searchUsers($request->query());
    }
}
