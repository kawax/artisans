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

        @include('starter')

        <div class="columns">

            <div class="column is-half">

                <user-search-component></user-search-component>

                @include('user.users')

            </div>

            <div class="column is-half">

                @if(Starter::can(config('artisans.starter.step2')))
                    <post-search-component></post-search-component>
                @endif

                @auth
                    @if(Starter::can(config('artisans.starter.step1')))
                        <a href="{{ route('post.create') }}"
                           class="button is-medium is-primary is-outlined is-fullwidth mb-1">新規募集</a>
                    @endif
                @endauth

                @include('post.posts')

            </div>
        </div>
    </div>
@endsection
