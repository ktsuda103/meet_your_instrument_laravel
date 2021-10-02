@extends('layouts.app')

@section('javascript')
<script src="/js/confirm.js"></script>

@section('content')
<h1 class="title">商品一覧</h1>
<p><input type="submit" value="&#xf217;" class="fas" style="border: none;">：カートに追加　<input type="submit" value="&#xf004;" class="fas" style="border: none;">：お気に入りに追加</p>
@if(session('success'))
    <div class="alert alert-success" role="alert">
       {{ session('success') }}
    </div>
@endif
@if(session('danger'))
    <div class="alert alert-danger" role="alert">
       {{ session('danger') }}
    </div>
@endif
<div class="container">
<div class="row">
    @foreach($items as $item)
        <div class="card col-md-4 p-0">
            <div class="card-header" style="background-color:#cccccc;">
                {{ $item->name }}
                @if($user->id !== $item->user_id)
                    @if($item->stock > 0)
                        <form method="post" action="{{ route('store_cart') }}" class="d-inline mb-0">
                        @csrf
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <input type="submit" value="&#xf217;" class="fas" style="border: none; background-color: #ccc;">
                        </form>
                    @endif
                    <form action="{{ route('store_favorite') }}" method="post" class="d-inline mb-0">
                    @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <input type="submit" value="&#xf004;" class="fas" style="border: none; background-color: #ccc;">
                    </form>
                @endif
            </div>
            <div class="card-body text-center" style="padding: 20px;">
                <img src="{{ '/storage/' .$item->img }}" class="img-fluid" style=" object-fit: contain; width: 200px; height: 140px;">
            </div>
            <div class="card-footer">
                <p style="margin:0px;">価格：￥{{ number_format($item->price) }}</p>
                <p style="margin:0px;">個数：{{ number_format($item->stock) }}</p>
                    <a href="{{ route('item_detail', ['id' => $item->id]) }}" class="btn btn-primary d-block w-100" style="margin-bottom:3px;">詳細</a>
                    <a href="{{ route('user', ['id' => $item->user_id]) }}" class="btn btn-primary d-block w-100" style="margin-bottom:3px;">出品者ページ</a>
                    <div class="d-flex flex-row-reverse mt-3">
                    
                </div>    
            </div>
        </div>
    @endforeach
    <div class="offset-5 col-7">{{ $items->links() }}</div>
</div>
</div>
@endsection
