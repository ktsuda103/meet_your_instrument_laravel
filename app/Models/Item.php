<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function insertItem($data,$path,$user){
        Item::insert([
            'user_id' => $user['id'],
            'name' => $data['name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'img' => $path[1],
            'type' => $data['type'],
            'status' => $data['status'],
            'comment' => $data['comment'],
            
        ]);
    }

    public function updateItem($item,$path){
        Item::where('id', $item['id'])->update([
            'name'=>$item['name'], 
            'price'=>$item['price'], 
            'img'=>$path[1],
            'status'=>$item['status'], 
            'stock'=>$item['stock'], 
            'type'=>$item['type'], 
            'comment'=>$item['comment'],
        ]);
    }

    public function getItems(){
        $query = Item::where('status', 0)->orderBy('created_at', 'DESC');
        $items = $query->simplePaginate(6);

        return $items;
    }

    public function getMyItems($id){
        $my_items = Item::where('user_id', $id)->orderBy('created_at', 'DESC')->simplePaginate(3);
        return $my_items;
    }

    public function getEditItem($id){
        $item = Item::where('id', $id)->first();
        return $item;
    }

    public function updateStatus($data){
        Item::where('id', $data['id'])->update(['status' => $data['status']]);
    }

    public function deleteItem($id){
        $delete_item = Item::where('id', $id)->delete();
        return $delete_item;
    }
    
    public function getItemDetail($id){
        $item = Item::where('status', 0)->where('id', $id)->first();
        return $item;
    }

    public function search($keyword,$type){
        if(!empty($keyword) && !empty($type)){
            $items = Item::where('name', 'LIKE', "%{$keyword}%")->where('type', $type)->where('status', 0)->orderBy('created_at', 'DESC')->simplePaginate(6);
        }
        if(empty($type)){
            $items = Item::where('name', 'LIKE', "%{$keyword}%")->where('status', 0)->orderBy('created_at', 'DESC')->simplePaginate(6);
        }
        if(empty($keyword)){
            $items = Item::where('type', $type)->where('status', 0)->orderBy('created_at', 'DESC')->simplePaginate(6);
        }
        if(empty($keyword) && empty($type)){
            $items = '';
        }
        
        return $items;
    }    

}
