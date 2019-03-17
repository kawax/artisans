@extends('layouts.app')

@section('card')
    @card

    @slot('name')
        @kawaxbiz
    @endslot

    @slot('description')
        {{ config('app.name') }}
    @endslot

    @slot('image')
        {{ route('image.home') }}
    @endslot

    @endcard
@endsection

@section('content')
    <div class="container">

        @include('about')

        <div class="columns">

            <div class="column is-half">

                <user-search-component></user-search-component>

                @include('home.users')

            </div>

            <div class="column is-half">

                @include('home.posts')

            </div>
        </div>
    </div>
@endsection
