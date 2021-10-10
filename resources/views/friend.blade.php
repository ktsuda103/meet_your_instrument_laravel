@extends('layouts.app')

@section('javascript')
<script src="/js/confirm.js"></script>

@section('content')
<h1 class="title">友達一覧</h1>
@if(session('success'))
    <div class="alert alert-success" role="alert">
       {{ session('success') }}
    </div>
@endif
<div class="container">
    <div class="row">
        @foreach($friends as $friend)
            <div class="card col-md-4 p-0">
                <div class="card-header" style="background-color:#cccccc;">
                    {{ $friend->name }}
                </div>
                <div class="card-body text-center" style="padding: 20px;">
                <a href="{{ route('user', ['id' => $friend->other_user_id]) }}">
                    <img src="{{ Storage::disk('s3')->url("$friend->img") }}" class="img-fluid" style=" object-fit: contain; width: 200px; height: 140px;">
                </a>
                </div>
                <div class="card-footer">
                    <a class="btn btn-info w-100" style="margin-bottom: 3px;" href="{{ route('message',['id'=>$friend['other_user_id']]) }}"><i class="fas fa-arrow-circle-right"></i>メッセージを送る</a>
                    <div class=" d-flex flex-row-reverse mt-2">
                        <form class="d-inline mb-0" id="delete-form" action="{{ route('delete_friend') }}" method="post">
                        @csrf
                            <input type="hidden" name="id" value="{{ $friend->id }}">
                            <i class="fas fa-trash" onclick="deleteHandle(event);"></i>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
