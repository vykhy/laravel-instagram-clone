<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    /**
     * User profile model
     * Profile is owned by user
     */
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
        /**
         * Function returns the user's profile image or default image if not set
         */
        return ($this->image) ? '/storage/'. $this->image : '/storage/user.jpg';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function followers(){
        /**
         * A profle will have many followers
         * Followers are users
         */
        return $this->belongsToMany(User::class);
    }
}
