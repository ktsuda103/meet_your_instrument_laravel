<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    public function getHistory($id){
        $histories = History::join('items', 'histories.item_id', '=', 'items.id')->where('histories.user_id', $id)->select('img','name','price','histories.created_at')->get();
        return $histories;
    }
}
