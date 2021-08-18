<?php

namespace App\Models;

use App\Mail\NewUserWelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    /**
     * The user model of our application
     */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        /**
         * Upon boot(creation) of user modelBlade:
         *  -we create a profile for the user
         *  -and send an email to the new user
         */
        parent::boot();

        static::created(function ($user){
            //create profile. set profile title to user's username
            $user->profile()->create([
                'title' => $user->username,
            ]);

            //sending emails
           /**
            * Mail::to($user->email)->send(new NewUserWelcomeMail());
            */ 
        });
    }

    public function posts(){
        /**
         * Return posts of this user ordered by latest
         * A user has many posts
         */
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function profile(){
        /**
         * Return the profile of this user
         * A user has one post
         */
        return $this->hasOne(Profile::class);
    }

    public function following(){
        /**
         * Return profiles of those who this user follows
         */
        return $this->belongsToMany(Profile::class);
    }
}
