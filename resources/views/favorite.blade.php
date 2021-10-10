@extends('layouts.app')

@section('javascript')
<script src="/js/confirm.js"></script>

@section('content')
<h1 class="title">お気に入り一覧</h1>
@if(session('success'))
    <div class="alert alert-success" role="alert">
       {{ session('success') }}
    </div>
@endif
<div class="container"> 
    <div class="row">
        @foreach($favorites as $favorite)    
            <div class="card col-md-4 p-0">
                <div class="card-header" style="background-color:#cccccc;">
                    {{ $favorite->name }}
                    
                </div>
                <div class="card-body" style="padding: 20px;">
                    <img src="{{ Storage::disk('s3')->url("$favorite->img") }}" class="img-fluid" style=" object-fit: contain; width: 200px; height: 140px;">
                </div>
                <div class="card-footer">
                    <p style="margin:0px;">価格：¥{{ number_format($favorite->price) }}</p>
                    <p style="margin:0px;">在庫数：{{ $favorite->stock }}</p>
                    <a href="{{ route('item_detail', ['id' => $favorite->item_id]) }}" class="btn btn-primary d-block w-100" style="margin-bottom:3px;">詳細</a>
                    <a href="{{ route('user', ['id' => $favorite->user_id]) }}" class="btn btn-primary d-block w-100" style="margin-bottom:3px;">出品者ページ</a>
                    <div class="d-flex flex-row-reverse mt-3">
                        @if($favorite->stock > 0)
                            <form class="d-inline mb-0" method="post" action="{{ route('store_cart') }}">
                            @csrf
                                <input type="hidden" name="item_id" value="{{ $favorite->item_id }}">
                                <input type="submit" value="&#xf217;" class="fas" style="border: none;">
                            </form>
                        @endif
                        <form class="d-inline mb-0" id="delete-form" action="{{ route('delete_favorite') }}" method="post">
                        @csrf
                            <input type="hidden" name="id" value="{{ $favorite->favorite_id }}">
                            <i class="fas fa-trash" onclick="deleteHandle(event);"></i>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
