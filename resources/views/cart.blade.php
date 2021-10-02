@extends('layouts.app')

@section('content')
<h1 class="title">カート一覧</h1>
@if(session('success'))
    <div class="alert alert-success" role="alert">
       {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger" role="alert">
       {{ session('error') }}
    </div>
@endif
<div class="cart_item_list_head row">
    <span class="col-2">画像</span>
    <span class="col-6">商品名</span>
    <span class="col-2">価格</span>
    <span class="col-2">数量</span>    
</div>

@if(!$carts->isEmpty())
    @foreach($carts as $cart)
        <div class="row">
            <img src="{{ '/storage/' .$cart->img }}" class="col-2">
            <p class="col-4">{{ $cart->name }}</p>
            <form action="{{ route('delete_cart') }}" class="col-2" method="post">
            @csrf
                <input type="hidden" name="id" value="{{ $cart->cart_id }}">
                <button type="submit" class="btn btn-secondary">削除</button>
            </form>
            <p class="col-2">{{ $cart->price }}</p>
            <form action="{{ route('update_cart') }}" class="col-2 form-group" method="post">
            @csrf
                <input type="hidden" name="id" value="{{ $cart->cart_id }}">
                <input type="text" name="amount" class="form-control" value="{{ $cart->amount }}">
                <button type="submit" class="btn btn-secondary">変更</button>
            </form>
        </div>
        <hr>
    @endforeach
    <div class="row">
        <form action="{{ route('buy') }}" method="post" class="offset-9 col-md-3">
        @csrf    
            <input type="hidden" name="data" value="">
            <button class="btn btn-warning">購入する</button>
        </form> 
    </div>
@else
    <div class="alert alert-danger" role="alert">
        カートは空です
    </div>
@endif

@endsection
