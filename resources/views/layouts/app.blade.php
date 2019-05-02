<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('layouts.analytics')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @include('feed::links')

    @yield('card')

</head>
<body>
<div id="app">
    <nav class="navbar has-shadow mb-1" role="navigation" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <a href="{{ url('/') }}" class="navbar-item">{{ config('app.name', 'Laravel') }}</a>

                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navMenu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div class="navbar-menu" id="navMenu">
                <div class="navbar-start">
                    <a class="navbar-item" href="{{ route('user.index') }}">職人</a>
                    <a class="navbar-item" href="{{ route('post.index') }}">募集</a>
                </div>

                <div class="navbar-end">
                    @if (Auth::guest())
                        <a class="navbar-item" href="{{ route('login') }}">Login</a>
                    @else
                        <a href="{{ route('user', auth()->user()->name) }}" class="navbar-item">
                            マイページ
                        </a>
                        <a href="{{ route('profile.edit') }}" class="navbar-item">
                            プロフィール
                        </a>

                        <a href="{{ route('post.create') }}" class="navbar-item">新規募集</a>

                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link" href="#">{{ Auth::user()->name }}</a>

                            <div class="navbar-dropdown">
                                <a class="navbar-item" href="{{ route('profile.destroy') }}">
                                    アカウント削除
                                </a>
                                <a class="navbar-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    ログアウト
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>

    @include('layouts.footer')
</div>


</body>
</html>
