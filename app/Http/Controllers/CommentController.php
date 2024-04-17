<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Repositories\CommentRepository;
use App\Http\Requests\CommentStoreRequest;
use App\Interfaces\CommentRepositoryInterface;


class CommentController extends Controller
{   

    protected $commentRepository;

    public function __construct( CommentRepositoryInterface $commentRepository) {

        $this->commentRepository = $commentRepository;
    }
  
    public function getComments(){
        
        return $this->commentRepository->getAllComments();
    }

    public function storeComment(CommentStoreRequest $request, Post $post){
        
        
        $validated = $request->validated();
        $attributes = array_merge($validated, array("post_id"=> $post->id, "user_id"=> Auth::id()));
        return $this->commentRepository->storeComment($attributes);

    }

    public function searchComments(Request $request){
        return $this->commentRepository->searchComments($request);
    }
}
