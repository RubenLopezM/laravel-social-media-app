<?php

namespace App\Interfaces;

use App\Models\Post;
use App\Models\User;

interface PostRepositoryInterface
{
    public function getPost(Post $post);
    public function updatePost(Post $post, array $attributes);
    public function getPosts();
    public function getPostsWithDetails();
    public function getUserPosts(User $user);
    public function getUserLastPost(User $user);
}