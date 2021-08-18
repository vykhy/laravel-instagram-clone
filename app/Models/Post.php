<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The model of a user's posts
     */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'caption',
        'image'
    ];

    /**
     * Each post belongs to one user only
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
