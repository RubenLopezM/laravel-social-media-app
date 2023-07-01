<?php

namespace App\Interfaces;

use App\Models\Post;
use App\Models\User;

interface PostRepositoryInterface
{
    public function getPost(Post $post);
    public function getPosts();
    public function getPostsWithDetails();
    public function getUserPosts(User $user);
}