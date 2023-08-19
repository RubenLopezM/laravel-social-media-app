<?php
 
namespace App\Repositories;

use App\Http\Resources\CommentResource;
use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

final class CommentRepository implements CommentRepositoryInterface {

    public function getAllComments()
    {
        return CommentResource::collection(Comment::simplePaginate(10));
    }

    public function storeComment($attributes){
        return Comment::create($attributes);
    }
}