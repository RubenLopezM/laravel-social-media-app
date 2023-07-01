<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

       /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
        'post_id',
        'user_id'        
    ];

    public function user(){
    return $this->belongsTo(User::class);
    }

    public function post(){
    return $this->belongsTo(Post::class);
    }

}
