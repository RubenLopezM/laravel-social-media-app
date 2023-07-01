<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

       /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];



    protected static function newFactory(): Factory
{
    return PostFactory::new();
}

public function setTitleAttribute($value)
{
    $this->attributes['title'] = ucfirst($value);
}

    public function user(){
    return $this->belongsTo(User::class);   
    }

    public function comments(){
    return $this->hasMany(Comment::class);
    }

}
