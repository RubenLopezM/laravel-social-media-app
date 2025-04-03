<?php

namespace App\Models;

use App\Events\CommentCreated;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Prunable;

class Comment extends Model
{
    use HasFactory, Prunable;

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

        /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
    ];

    protected static function boot()
{
    parent::boot();

    static::created(function ($comment) {
        event(new CommentCreated($comment));
    });
}   

    public function prunable(): Builder
    {
        return static::where('created_at', '<', now()->subYear());
    }

    public function user(){
    return $this->belongsTo(User::class);
    }

    public function post(){
    return $this->belongsTo(Post::class);
    }

}
