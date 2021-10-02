<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    public function confirmFriend($data){
        $friend = Friend::where('other_user_id', $data)->first();
        return $friend;
    }

    public function insertFriend($user,$data){
        Friend::insertGetId([
            'user_id' => $user->id,
            'other_user_id' => $data,
        ]);
    }

    public function getFriend($id){
        $friends = User::join('friends', 'friends.other_user_id', '=', 'users.id')->where('friends.user_id', $id)->get();
        return $friends;
    }

    public function deleteFriend($data){
        Friend::where('id', $data)->delete();
    }
}
