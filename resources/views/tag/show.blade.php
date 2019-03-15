@extends('layouts.app')

@section('title')
    {{ $tag->tag }} / {{ config('app.name', 'Laravel') }}
@endsection

@section('content')
    <div class="container">

        @include('about')

        <div class="columns">

            <div class="column is-half">

                @include('home.users')

            </div>

            <div class="column is-half">

                @include('home.posts')

            </div>
        </div>
    </div>
@endsection
