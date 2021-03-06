@extends('layouts.app')

@section('title', $user->name . ' / ' . config('app.name'))

@section('card')

    <x-card>
        <x-slot name="title">
            {{ $user->name }} / {{ config('app.name') }}
        </x-slot>

        <x-slot name="description">
            {{ $user->title }}
        </x-slot>

        <x-slot name="image">
            {{ route('image.user', $user) }}?id={{ $user->updated_at->timestamp }}
        </x-slot>
    </x-card>
@endsection

@section('content')
    <div class="container">
        <div class="columns is-marginless is-centered">
            <div class="column is-12">

                <div class="card has-text-white has-background-primary my-3">
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-48x48">
                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="is-rounded">
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4 has-text-white">{{ $user->name }}</p>
                                <p class="subtitle is-6">
                                    <a href="https://github.com/{{ $user->name }}"
                                       target="_blank">
                                       <span class="icon has-text-black">
                                           <i class="fab fa-github"></i>
                                       </span>
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="content">
                            <p class="has-text-centered has-text-white has-text-weight-bold is-size-2">
                                {{ $user->title }}
                            </p>

                            <div class="tags">
                                @foreach($user->tags as $tag)
                                    <span class="tag is-white">
                                        <a href="{{ route('tag', $tag) }}">
                                        {{ $tag->tag ?? '' }}
                                        </a>
                                    </span>
                                @endforeach
                            </div>

                            <article class="message is-dark">
                                <div class="message-body">
                                    @markdown($user->message ?? '')
                                </div>
                            </article>


                            <div class="control mb-3">
                                <div class="tags has-addons">
                                    <span class="tag is-dark">更新日</span>
                                    <span class="tag is-white">{{ $user->updated_at->toDateString() }}</span>
                                </div>
                            </div>

                            <x-tweet/>
                        </div>
                    </div>
                </div>

                @if($user->posts->count() > 0)
                    <article class="message is-primary my-3">
                        <div class="message-header">
                            <p>最近の投稿</p>
                        </div>
                        <div class="message-body content pt-0">
                            <ul>
                                @foreach($user->posts as $post)
                                    <li>
                                        <a href="{{ route('post.show', $post) }}"
                                           class="has-text-weight-semibold has-text-primary">
                                            {{ $post->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </article>
                @endif

                @auth
                    @if(auth()->user()->id === $user->id)
                        <a href="{{ route('profile.edit') }}" class="button is-primary is-outlined mb-3">
                            <span class="icon"><i class="fas fa-edit"></i></span>
                            <span>変更</span>
                        </a>
                    @endif
                @endauth

                <user-search-component></user-search-component>

            </div>
        </div>
    </div>
@endsection
