@extends('layouts.app')

@section('title',  '職人 / ' . config('app.name'))

@section('content')
    <div class="container">

        @include('about')

        <div class="columns">

            <div class="column is-full">

                <user-search-component></user-search-component>

                @include('user.users')

            </div>
        </div>
    </div>
@endsection
