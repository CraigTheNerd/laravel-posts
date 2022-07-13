<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    //  Check if a user has already liked a post
    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    //  Create a link back to each user's page with their posts
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
