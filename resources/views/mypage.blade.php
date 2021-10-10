@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">あなたのページ</div>

        <div class="card-body my-card-body">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <img src="{{ Storage::disk('s3')->url("$user->img") }}" alt="" style="height: 120px; border:1px solid #ccc; margin-bottom: 20px;">
        <p>名前：{{ $user['name'] }}</p>
        <p>メールアドレス：{{ $user['email'] }}</p>
        <div class="row">
            <ul class="col-md-4">
                <li><a href="{{ route('add_item') }}"><i class="fas fa-store mr-2"></i>出品する</a></li>
                <li><a href="{{ route('history', ['id' => $user->id]) }}"><i class="fas fa-history mr-2"></i>購入履歴</a></li>
            </ul>
            <ul class="col-md-4">
                <li><a href="{{ route('favorite', ['id' => $user->id]) }}"><i class="fas fa-heart mr-2"></i>お気に入り</a></li>
                <li><a href="{{ route('friend', ['id' => $user->id]) }}"><i class="fas fa-user-friends mr-2"></i>友達一覧</a></li>
            </ul>
        </div>
        <hr>
        <h4>出品一覧</h4>
        <div class="container">
            <div class="row">
                @foreach($my_items as $item)
                    <div class="card col-md-4 p-0">
                        <div class="card-header" style="background-color:#cccccc;">
                            {{ $item->name }}
                                <form action="{{ route('edit', ['id' => $item->id]) }}" class="d-inline mb-0">
                                @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="submit" value="&#xf044;" class="fas" style="border: none; background-color: #ccc;">
                                </form> 
                                <form action="{{ route('delete_mypage_item') }}" method="post" class="d-inline mb-0">
                                @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="submit" value="&#xf1f8;" class="fas" style="border: none; background-color: #ccc;">
                                </form>
                            
                        </div>
                        <div class="card-body text-center" style="padding: 20px;">
                            <img src="{{ Storage::disk('s3')->url("$item->img") }}" style=" object-fit: contain;height: 80px;">
                        </div>
                        <div class="card-footer">
                            <p style="margin:0px;">価格：￥{{ number_format($item->price) }}</p>
                            <p style="margin:0px;">個数：{{ number_format($item->stock) }}</p>  
                            
                            
                            <form action="{{ route('update_status') }}" method="post" class="d-inline">
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                @csrf
                                @if($item->status === 1)
                                    <input type="hidden" name="status" value="0">
                                    <button class="btn btn-secondary" type="submit">非公開→公開</button>
                                @elseif($item->status === 0)
                                <input type="hidden" name="status" value="1">
                                    <button class="btn btn-primary" type="submit">公開→非公開</button>
                                @endif
                            </form> 
                        </div>
                        
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>
</div>
@endsection
