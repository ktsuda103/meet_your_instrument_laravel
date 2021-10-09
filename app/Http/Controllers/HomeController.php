<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ItemFormRequest;
use App\Http\Requests\PostFormRequest;
use App\Models\User;
use App\Models\Item;
use App\Models\Cart;
use App\Models\Post;
use App\Models\History;
use App\Models\Favorite;
use App\Models\Friend;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('mypage');
    }

    public function mypage()
    {
        $item_model = new Item();
        $items = $item_model->getItems();
        return view('mypage',compact('items'));
    }

    public function add_item()
    {
        return view('add_item');
    }

    public function store(ItemFormRequest $request)
    {
        if(empty($errors)){
            $user = \Auth::user();
            $data = $request->all();
            $img = $request->file('img');
            if($request->hasFile('img')){
                $path = \Storage::disk('s3')->put('/test', $img,'public');
                $path = explode('/', $path);
            } else {
                $path = null;
            }
            $item_model = new Item();
            $item_model->insertItem($data,$path,$user);
            
            return redirect()->route('add_item')->with('success', '商品を出品しました');
        }
    }

    public function delete(Request $request){
        $id = $request->input('id');
        $item_model = new Item();
        $item_model->deleteItem($id);
        return redirect()->route('item_list')->with('success', '商品を削除しました。');
    }

    public function delete_mypage_item(Request $request){
        $id = $request->input('id');
        $item_model = new Item();
        $item_model->deleteItem($id);
        return redirect()->route('mypage')->with('success', '商品を削除しました。');
    }

    public function edit($id)
    {
        $item_model = new Item();
        $item = $item_model->getEditItem($id);
        return view('edit', compact('item'));
    }

    public function update(ItemFormRequest $request)
    {
        if(empty($errors)){
            $item = $request->all();
            
            $img = $request->file('img');
                if($request->hasFile('img')){
                    $path = \Storage::put('/public', $img);
                    $path = explode('/', $path);
                } else {
                    $path = null;
                }
            //dd($item['id']);
            $item_model = new Item();
            $item_model->updateItem($item,$path);
        }
        return redirect('mypage')->with('success', '編集が完了しました。');

    }

    public function update_status(Request $request)
    {
        if(empty($errors)){
            $data = $request->all();
            $item_model = new Item();
            $item_model->updateStatus($data);
        }
        return redirect('mypage')->with('success', 'ステータスを変更しました');

    }

    public function item_list()
    {
        $item_model = new Item();
        $items = $item_model->getItems();
        return view('item_list',compact('items'));
    }

    public function item_detail($id)
    {
        $item_model = new Item();
        $item = $item_model->getItemDetail($id);
        return view('item_detail', compact('item'));
    }

    public function user($id)
    {
        $user = \Auth::user();
        $other_user = User::where('id', $id)->first();
        if($user['id'] === $other_user['id']){
            return redirect()->route('mypage');
        } else {
            return view('user', compact('other_user'));
        }   
    }

    public function store_cart(Request $request)
    {
        $user = \Auth::user();
        $data = $request->all();
        $cart_model = new Cart();
        //dd($data);
        $cart = $cart_model->getCart($user,$data);
        //dd($cart->amount);
        
        $cart_model->storeCart($cart,$user,$data);
        return redirect()->route('item_list')->with('success', '商品をカートに追加しました');
    }

    public function cart()
    {
        $user = \Auth::user();
        $cart_model = new Cart();
        $carts = $cart_model->getCarts($user);
        
        return view('cart', compact('carts'));
    }    

    public function delete_cart(Request $request)
    {
        $data = $request->all();
        $cart_model = new Cart();
        $carts = $cart_model->deleteCart($data);
        return redirect()->route('cart')->with('success', '商品を削除しました');
    }

    public function update_cart(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $cart_model = new Cart();
        $carts = $cart_model->updateCart($data);
        return redirect()->route('cart')->with('success', '個数を変更しました。');
    }

    public function buy(Request $request){
        $user = \Auth::user();
       
        $datas = DB::table('items')->join('carts', 'carts.item_id', '=', 'items.id')->where('carts.user_id', $user['id'])->get();
        DB::transaction(function() use($datas){
            foreach($datas as $data){
                if($data->stock >= $data->amount){
                    
                    DB::table('items')->where('id', $data->item_id)->update(['stock' => $data->stock - $data->amount]);
                    DB::table('carts')->where('id', $data->id)->delete();
                    History::insertGetId([
                        'user_id' => $data->user_id,
                        'item_id' => $data->item_id,
                    ]);
                } else {
                    return redirect()->route('cart')->with('error', '在庫が足りません。'); 
                }
            }   
        });
        
        return redirect()->route('cart')->with('success', '購入しました。'); 
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $item_model = new Item();
        $items = $item_model->search($keyword,$type);
        
        if($items === ''){
            return redirect()->route('item_list');
        } else {
            return view('item_list', compact('items'));
        }
    }

    public function message($id)
    {   
        $user = \Auth::user();
        $user_model = new User();
        $other_user = $user_model->getOtherUser($id);
        $posts = $user_model->getMessage($user,$other_user);
        
        return view('message',compact('other_user', 'posts'));
    }

    public function send_message(PostFormRequest $request)
    {
        $user = \Auth::user();
        $data = $request->all();
        $post_model = new Post();
        if(empty($errors)){
            $post_model->insertMessage($user,$data);
            return redirect()->route('message',['id'=>$data['id']])->with('success', 'メッセージを送信しました。');
        }
    }

    public function history($id)
    {
        $history_model = new History();
        $histories = $history_model->getHistory($id);
        return view('history', compact('histories'));
    }

    public function store_favorite(Request $request)
    {
        $user = \Auth::user();
        $data = $request->input('id');
        $favorite_model = new Favorite();
        $favorite = $favorite_model->confirmFavorite($data,$user);
        if(isset($favorite)){
            return redirect()->route('item_list')->with('danger', 'すでにお気に入りに登録されています。');
        } else {
            $favorite_model->insertFavorite($user,$data);
        }
        
        return redirect()->route('item_list')->with('success', 'お気に入りに登録しました。');
    }

    public function favorite($id)
    {
        $favorite_model = new Favorite();
        $favorites = $favorite_model->getFavorite($id);
        return view('favorite', compact('favorites'));
    }

    public function delete_favorite(Request $request)
    {
        $user = \Auth::user();
        $data = $request->input('id');
        $favorite_model = new Favorite();
        $favorite_model->deleteFavorite($data);
        return redirect()->route('favorite', ['id'=>$user->id])->with('success', '削除しました');
    }

    public function store_friend(Request $request)
    {
        $user = \Auth::user();
        $data = $request->input('id');
        $friend_model = new Friend();
        $friend = $friend_model->confirmFriend($data);
        if(isset($friend)){
            return redirect()->route('user', ['id'=>$data])->with('danger', 'すでに登録されています。');
        } else {
            $friend_model->insertFriend($user,$data);
        }
        
        return redirect()->route('user', ['id'=>$data])->with('success', '友達に登録しました。');
    }
    
    public function friend($id)
    {
        $friend_model = new Friend();
        $friends = $friend_model->getFriend($id);
        return view('friend', compact('friends'));
    }

    public function delete_friend(Request $request)
    {
        $user = \Auth::user();
        $data = $request->input('id');
        $friend_model = new Friend();
        $friend_model->deleteFriend($data);
        return redirect()->route('friend', ['id'=>$user->id])->with('success', '削除しました');
    }

}
