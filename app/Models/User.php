<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function getOtherUser($id){
        $other_user = User::where('id', $id)->first();
        return $other_user;
    }

    public function getMessage($user,$other_user){
        $posts = User::join('posts', 'posts.user_id','=','users.id')->where(function($query) use($user, $other_user){
            $query->where('user_id', $user['id'])->where('destination_user_id', $other_user['id']);
        })->orWhere(function($query) use($user, $other_user){
            $query->where('destination_user_id', $user['id'])->where('user_id', $other_user['id']);
        })->orderBy('posts.created_at', 'DESC')->get();

        return $posts;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'img',
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
}
