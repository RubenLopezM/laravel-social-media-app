<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\Providers\Auth as ProvidersAuth;

class PostController extends Controller
{   

    protected $postRepository;

    public function __construct( PostRepositoryInterface $postRepository) {

        $this->postRepository = $postRepository;
    }

    public function getPost(Post $post){
        return $this->postRepository->getPost($post);
    }

    public function getPosts(Request $request)
    {
        $detailed = $request->query('detailed',false);
        if ($detailed){
            return $this->postRepository->getPostsWithDetails();
        }
        return $this->postRepository->getPosts();
    }

    public function storePost(Request $request){
        
        $post= Post::create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'user_id'=> Auth::id()
        ]);
        
        return response($post);
    }

    public function getUserPosts(Request $request, User $user){
        return $this->postRepository->getUserPosts($user);
    }

 
}
