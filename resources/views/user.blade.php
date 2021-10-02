@extends('layouts.app')

@section('content')
<div class="card" style='height: 92vh;'>
    <div class="card-header">{{ $other_user->name }}のページ</div>

        <div class="card-body">
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
        <img src="{{ '/storage/' .$other_user->img }}" alt="" style="height: 120px; border:1px solid #ccc; margin-bottom: 20px;">
        <p>名前：{{ $other_user['name'] }}</p>
        
        
        <ul>
            <li><a href="{{ route('message',['id'=>$other_user['id']]) }}"><i class="fas fa-envelope-open mr-2"></i>メッセージを送る</a></li>
        </ul>
        <form action="{{ route('store_friend') }}" method="post">
        @csrf
            <input type="hidden" name="id" value="{{ $other_user['id'] }}">
            <button class="btn btn-primary"><i class="fas fa-user-friends mr-1"></i>友達に登録する</button>
        </form>
    </div>
</div>
@endsection
