@extends('layouts.app')

@section('title',  '投稿 / ' . config('app.name'))

@section('content')
    <div class="container">

        @include('about')

        <div class="columns">

            <div class="column is-full">

                <post-search-component></post-search-component>

                @auth
                    <a href="{{ route('post.create') }}"
                       class="button is-medium is-primary is-outlined is-fullwidth mb-1">新規投稿</a>
                @endauth

                @include('post.posts')
            </div>
        </div>
    </div>
@endsection
