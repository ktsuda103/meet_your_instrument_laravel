@extends('layouts.app')

@section('content')
<h1 class="title">購入履歴</h1>
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
    <span class="col-4">商品名</span>
    <span class="col-2">価格</span>
    <span class="col-2">購入日時</span>    
</div>

@if(!$histories->isEmpty())
    @foreach($histories as $history)
        <div class="row">
            <img src="{{ '/storage/' .$history->img }}" class="col-2" >
            <p class="col-4">{{ $history->name }}</p>
            <p class="col-2">￥{{ number_format($history->price) }}</p>
            <p class="col-2">{{ $history->created_at }}</p>
        </div>
        <hr>
    @endforeach
@else
    <div class="alert alert-danger" role="alert">
        購入履歴はありません。
    </div>
@endif

@endsection
