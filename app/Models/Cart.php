<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public function getCart($user,$data){
        $cart = Cart::where('user_id', $user['id'])->where('item_id', $data['item_id'])->first();
        return $cart;
    }

    public function storeCart($cart,$user,$data){
        if(isset($cart)){
            Cart::where('user_id', $user['id'])->where('item_id', $data['item_id'])->update(['amount' => (int)$cart->amount+1]);
            
        } else {
            Cart::insertGetId([
                'user_id' => $user['id'],
                'item_id' => $data['item_id'],
                'amount' => 1,
            ]);
            
        }
    }

    public function getCarts($user){
        $carts = Cart::select('items.*','carts.id as cart_id','carts.amount')->join('items', 'carts.item_id', '=', 'items.id')->where('carts.user_id', $user['id'])->get();
        return $carts;
    }

    public function deleteCart($data){
        Cart::where('id', (int)$data['id'])->delete();
    }

    public function updateCart($data){
        Cart::where('id', (int)$data['id'])->update(['amount' => $data['amount']]);
    }

    public function buyCart(){
        
    }
}
