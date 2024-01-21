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

    public function updatePost(Post $post, array $attributes)
    {
        $post->title = $attributes['title'];
        $post->description = $attributes['description'];
        $post->save();

        return new PostResource($post);
    }

    public function getPosts()
    {
        return Post::all(['id', 'user_id', 'title', 'description']);
    }

    public function getMonthPosts(){

        return Post::withCount('comments')->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)
            ->get();
    }

    public function getPostsWithDetails()
    {
        return Post::with('comments')->get();
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