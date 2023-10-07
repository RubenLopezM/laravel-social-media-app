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

    public function storeComment($attributes)
    {
        return Comment::create($attributes);
    }

    public function searchComments($request)
    {
        $comments = Comment::query()
                        ->when($request->user_id, function ($query) use ($request){
                            $query->where('user_id', $request->user_id);
                        })
                        ->when($request->post_id, function ($query) use ($request){
                            $query->where('post_id', $request->post_id);
                        })
                        ->get();
        return CommentResource::collection($comments);
    }
}