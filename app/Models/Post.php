<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'follow_status',
    ];
    public function total_comments()
    {
        return $this->hasMany(comment::class, 'post_id', 'id');
    }
    public function total_like(){

        return $this->hasOne(Like::class, 'post_id' , 'id');
    }
}
