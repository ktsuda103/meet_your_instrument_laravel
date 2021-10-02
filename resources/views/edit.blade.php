@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">編集する</div>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
           {{ session('success') }}
        </div>
    @endif
    <div class="card-body form-group my-card-body">
        <form action="/update" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $item->id }}">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <label for="name" class="col-form-label">商品名</label>
            <input type="text" name="name" id="name" value="{{ $item->name }}" class="form-control">
            <label for="price" class="col-form-label">価格</label>
            <input type="text" name="price" id="price" value="{{ $item->price }}" class="form-control">
            <label for="stock" class="col-form-label">個数</label>
            <input type="text" name="stock" id="stock" value="{{ $item->stock }}" class="form-control">
            <label for="img" class="col-form-label">画像</label>
            <input type="file" name="img" id="img" class="form-control" style="border: none;">
            <label for="type" class="col-form-label">楽器の種類</label>
            <select name="type" id="type" class="form-control">
                <option value="弦楽器" {{ $item->type === "弦楽器" ? "selected" : "" }}>弦楽器</option>
                <option value="木管楽器" {{ $item->type === "木管楽器" ? "selected" : "" }}>木管楽器</option>
                <option value="金管楽器" {{ $item->type === "金管楽器" ? "selected" : "" }}>金管楽器</option>
                <option value="その他" {{ $item->type === "その他" ? "selected" : "" }}>その他</option>
            </select>
            <label for="status" class="col-form-label">ステータス</label>
            <select name="status" id="status" class="form-control">
                <option value="0" {{ $item->status === 0 ? "selected" : "" }}>公開</option>
                <option value="1" {{ $item->status === 1 ? "selected" : "" }}>非公開</option>
            </select>
            <label for="comment" class="col-form-label">備考</label>
            <textarea name="comment" id="comment" rows="10" class="form-control">{{ $item->comment }}</textarea>
            <button class="btn btn-primary">編集する</button>
        </form>    
    </div>
</div>
@endsection
