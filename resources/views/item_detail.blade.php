@extends('layouts.app')

@section('content')

        <div class="card p-0">
            <div class="card-header" >
                {{ $item->name }}
            </div>
            <div class="card-body text-center  my-card-body row">
                <img src="{{ '/storage/' .$item->img }}" class="col-md-6 picture">
                <div class="col-md-6 text-left">
            
                <p>価格：¥{{ number_format($item->price) }}</p>
                <p>種類：{{ $item->type }}</p>
                <p>個数：{{ $item->stock }}</p>
                <p>備考：{{ $item->comment }}</p>
                @if($user->id !== $item->user_id)
                    @if($item->stock > 0)
                        <form method="post" action="{{ route('store_cart') }}">
                        @csrf
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <button class="btn btn-warning d-block w-50">カートへ追加する</button>
                        </form>
                    @else
                        <div class="btn btn-danger d-block w-50">在庫切れです！</div>
                    @endif
                @else
                    <form method="post" action="{{ route('delete') }}">
                    @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <button class="btn btn-secondary w-100" style="margin-bottom: 3px;">削除する</button>
                    </form>
                    <a href="{{ route('edit', ['id' => $item->id]) }}" class="btn btn-success w-100">編集</a>
                @endif
                <p style="margin:0px;">投稿日時：{{ $item->updated_at }}</p>
            </div>
            </div>
            
        </div>
    

@endsection
