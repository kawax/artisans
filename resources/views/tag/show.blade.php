@extends('layouts.app')

@section('title', $tag->tag . ' / ' . config('app.name', 'Laravel'))

@section('content')
    <div class="container">

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
