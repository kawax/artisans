@extends('layouts.app')

@section('title',  '募集 / ' . config('app.name'))

@section('content')
    <div class="container">

        @include('about')

        <div class="columns">

            <div class="column is-full">

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
