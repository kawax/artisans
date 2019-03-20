@extends('layouts.app')

@section('title', $tag->tag . ' / ' . config('app.name'))

@section('content')
    <div class="container">

        @include('about')

        <div class="columns">

            <div class="column is-half">

                @include('user.users')

            </div>

            <div class="column is-half">

                @include('post.posts')

            </div>
        </div>
    </div>
@endsection
