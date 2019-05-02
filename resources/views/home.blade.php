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

                @include('user.users')

            </div>

            <div class="column is-half">

                <post-search-component></post-search-component>

                @auth
                    <a href="{{ route('post.create') }}"
                       class="button is-medium is-primary is-outlined is-fullwidth mb-1">新規募集</a>
                @endauth

                @include('post.posts')

            </div>
        </div>
    </div>
@endsection
