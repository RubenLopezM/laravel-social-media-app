<?php
 
namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

final class CommentRepository implements CommentRepositoryInterface {

    public function getAllComments()
    {
        return Comment::all();
    }

    public function storeComment($attributes){
        return Comment::create($attributes);
    }
}