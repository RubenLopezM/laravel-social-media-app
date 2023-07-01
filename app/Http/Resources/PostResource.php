<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'user'=>$this->user_id,
            'title'=>$this->title,
            'description'=>$this->description,
            'comments_count'=>$this->whenCounted('comments')
        ];
    }
}
