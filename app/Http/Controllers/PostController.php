<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
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

    public function getPostTitle($post){
        return $this->postRepository->getPosTitle($post);
    }

    public function getPosts(Request $request)
    {
         
        if ($request->query('detailed',false)){
            return $this->postRepository->getPostsWithDetails();
        }
       return Cache::remember('posts', 60 * 60, function(){return $this->postRepository->getPosts();});
    }

    public function getMonthPosts(){
        return $this->postRepository->getMonthPosts();
    }

    public function storePost(StorePostRequest $request){
    
       $validated = $request->validated();
       $post= $this->postRepository->storePost($validated); 
       return response($post);
    }

    public function updatePost(Request $request, Post $post){

        Gate::authorize('update-post', $post);
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'description' => 'required',
        ]);

        return $this->postRepository->updatePost($post, $request->all());
    }

    public function getUserPosts(Request $request, User $user){
        return $this->postRepository->getUserPosts($user);
    }

    public function getUserLastPost(Request $request, User $user){
        return $this->postRepository->getUserLastPost($user);
    }

 
}
