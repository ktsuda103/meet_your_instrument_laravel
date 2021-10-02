@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">出品する</div>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
           {{ session('success') }}
        </div>
    @endif
    <div class="card-body form-group my-card-body">
        <form action="/store" method="post" enctype="multipart/form-data">
        @csrf
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
            <input type="text" name="name" id="name" placeholder="商品名を入れてください" class="form-control">
            <label for="price" class="col-form-label">価格</label>
            <input type="text" name="price" id="price" placeholder="価格を入れてください" class="form-control">
            <label for="stock" class="col-form-label">個数</label>
            <input type="text" name="stock" id="stock" placeholder="個数を入れてください" class="form-control">
            <label for="img" class="col-form-label">画像</label>
            <input type="file" name="img" id="img" class="form-control" style="border: none;">
            <label for="type" class="col-form-label">楽器の種類</label>
            <select name="type" id="type" class="form-control">
                <option value="弦楽器">弦楽器</option>
                <option value="木管楽器">木管楽器</option>
                <option value="金管楽器">金管楽器</option>
                <option value="その他">その他</option>
            </select>
            <label for="status" class="col-form-label">ステータス</label>
            <select name="status" id="status" class="form-control">
                <option value="0">公開</option>
                <option value="1">非公開</option>
            </select>
            <label for="comment" class="col-form-label">備考</label>
            <textarea name="comment" id="comment" rows="10" class="form-control"></textarea>
            <button class="btn btn-primary">出品する</button>
        </form>    
    </div>
</div>
@endsection
