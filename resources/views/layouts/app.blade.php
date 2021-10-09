<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'meet_your_instrument') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('javascript')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Explora&display=swap" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            
            <a class="navbar-brand app-name" href="{{ route('mypage') }}">
                {{ config('app.name', 'meet_your_instrument') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-link"><a href="{{ route('mypage') }}" class="link">マイページ</a></li>
                    <li class="nav-link"><a href="{{ route('item_list') }}" class="link">商品一覧</a></li>
                    <li class="nav-link"><a href="{{ route('cart') }}" class="link">カート</a></li>
                
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('ログアウト') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>        
        </nav>

        <main class="">
            <div class="row">
                <div class="col-md-4 pr-0"> 
                    <div class="card">
                    <div class="card-header">検索</div>
                    <div class="card-body my-card-body">
                        <form action="{{ route('search') }}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="keyword">キーワード検索</label>
                                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="キーワードを入力してください">
                            </div>
                            <div class="form-group">  
                                <label for="type">楽器種類検索</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">選択してください</option>
                                    <option value="弦楽器">弦楽器</option>
                                    <option value="木管楽器">木管楽器</option>
                                    <option value="金管楽器">金管楽器</option>
                                    <option value="その他">その他</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">検索</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8 pl-0">
                @yield('content')
                </div>
                
            </div>
            
        </main>
    </div>
</body>
</html>
