@extends('layouts.app')

@section('content')
<div class="card" style='height: 92vh;'>
    <div class="card-header">{{ $other_user['name'] }}へメッセージを送る</div>
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    <form action="{{ route('send_message') }}" method="post" class="form-group row">
    @csrf
        <input type="hidden" name="id" value="{{ $other_user['id'] }}">
        <input type="text" name="comment" placeholder="メッセージを記入してください" class="form-control col-8" style="margin:20px;">
        <button type="submit" class="btn btn-primary col-1" style="margin:20px 0;">送信</button>
    </form>
        <div class="card-body">
        @foreach($posts as $post)
            <div class="row">
                <div class="col-2">
                    <img src="{{ Storage::disk('s3')->url("$post->img") }}" alt="" style="height: 50px; border:1px solid #ccc; margin-bottom: 20px;">
                </div>
                <div class="col-10">
                    <p>{{ $post->comment }}</p>
                    <p>投稿日時：{{ $post->created_at }}</p>
                </div>
            </div>
            <hr>
        @endforeach
        <div class="row">
        <div class="offset-5"> 
            {{ $posts->links() }}
        </div>
        </div>
    </div>
</div>
@endsection
