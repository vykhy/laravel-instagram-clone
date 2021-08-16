<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'user_id',
        'description',
        'url',
        'title'
    ];

    public function profileImage()
    {
        return ($this->image) ? '/storage/'. $this->image : '/storage/user.jpg';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function followers(){
        return $this->belongsToMany(User::class);
    }
}
