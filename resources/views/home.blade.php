@extends('layouts.app')

@section('card')

    <x-card>
        <x-slot name="title">
            {{ $title ?? config('app.name') }}
        </x-slot>

        <x-slot name="description">
            {{ config('app.name')  }}
        </x-slot>

        <x-slot name="image">
            {{ route('image.home') }}
        </x-slot>
    </x-card>
@endsection

@section('content')
    <div class="container">

        @include('about')

        <div class="columns">

            <div class="column is-half">

                <user-search-component></user-search-component>

                @include('user.users')

            </div>

            <div class="column is-half">

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
