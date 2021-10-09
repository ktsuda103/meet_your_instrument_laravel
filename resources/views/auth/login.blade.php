@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card  mb-5">
                <div class="card-header">{{ __('ログイン') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 top-content">
            <div class="row">
                <div class="col-6 col-md-8">
                    <div class="sentence">
                        <h2>meet_your_instrument</h2>
                        <p>使われなくなってしまった楽器をもつあなたと、</p>
                        <p>新しく楽器を始めたいあなたを出逢わせるサービスです。</p>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <img src="s3://meet-your-instrument-picture/test/121589.jpg" class=" top-image">
                </div>
            </div>
            <div class="row">
                <div class="col-3 col-md-4">
                    <img src="{{ asset('storage/building_music_gakki.png') }}" class=" top-image">
                </div>
                <div class="col-3 col-md-3">
                    <img src="{{ asset('storage/necchusyou_face_boy3.png') }}" class=" top-image">
                </div>
                <div class="col-6 col-md-5">
                    <div class="sentence">
                        <h3 class="mb-3">こんな方にオススメ！</h3>
                        <p>・使わなくなって押し入れで眠っている楽器がある</p>
                        <p>・昔楽器をやっていたけどやめてしまった</p>
                        <p>・新しく楽器を始めたいけど高くて買えない</p>
                    </div>
                </div>
                <div class="col-6 col-md-7">
                    <div class="sentence">
                        <h3 class="mb-3">こんな使い方ができます</h3>
                        <p>・楽器を出品することができます</p>
                        <p>・楽器を購入することができます</p>
                        <p>・楽器を売りたい人、買いたい人と繋がることができます。</p>
                        <p>・チャットで会話ができます</p>
                        <p></p>
                    </div>    
                </div>
                <div class="col-6 col-md-5">
                    <img src="{{ asset('storage/present_girls.png') }}" class=" top-image">
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary mb-3" id="start-btn">さっそく始める！</button>
                <p>会員登録がまだの方は<a href="{{ route('register') }}">こちら</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
