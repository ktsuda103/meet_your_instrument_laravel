<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function insertMessage($user,$data){
        Post::insert([
            'user_id' => $user['id'],
            'destination_user_id' => $data['id'],
            'comment' => $data['comment'],
        ]);
    }
}
