<?php
 
namespace App\Repositories;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Interfaces\PostRepositoryInterface;
use App\Models\User;

final class PostRepository implements PostRepositoryInterface{

    public function getPost(Post $post)
    {
        return new PostResource($post->loadCount('comments'));   
    }

    public function getPosts()
    {
        return Post::all();
    }

    public function getPostsWithDetails()
    {
        $posts = Post::with('comments')->get();
        return $posts;
    }

    public function getUserPosts(User $user){
        
        return PostResource::collection(Post::whereBelongsTo($user)
        ->withCount('comments')
        ->orderByDesc('comments_count')->get());
    }

    public function getUserLastPost(User $user){
        return new PostResource($user->latestPost);
    }

}