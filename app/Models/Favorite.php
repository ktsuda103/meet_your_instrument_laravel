<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public function confirmFavorite($data,$user){
        $favorite = Favorite::where('item_id', $data)->where('user_id', $user['id'])->first();
        return $favorite;
    }

    public function insertFavorite($user,$data){
        Favorite::insert([
            'user_id' => $user->id,
            'item_id' => $data,
        ]);
    }

    public function getFavorite($id){
        $favorites = Favorite::select('items.*','favorites.id as favorite_id','favorites.user_id','favorites.item_id')->join('items', 'favorites.item_id', '=', 'items.id')->where('favorites.user_id', $id)->get();
        return $favorites;
    }

    public function deleteFavorite($data){
        Favorite::where('id', $data)->delete();
    }
}
