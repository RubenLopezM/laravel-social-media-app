<?php

namespace App\Interfaces;

interface CommentRepositoryInterface{

    public function getAllComments();
    public function storeComment($attributes);
    public function searchComments($request);
}