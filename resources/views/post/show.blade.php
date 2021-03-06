@extends('layouts.app')

@section('title', $post->title . ' / ' . config('app.name'))

@section('card')

    <x-card>
        <x-slot name="title">
            {{ $post->title }} / {{ config('app.name') }}
        </x-slot>

        <x-slot name="description">
            {{ $post->title }}
        </x-slot>

        <x-slot name="image">
            {{ route('image.post', $post) }}?id={{ $post->updated_at->timestamp }}
        </x-slot>
    </x-card>
@endsection

@section('content')
    <div class="container">
        <div class="columns is-marginless is-centered">
            <div class="column is-12">

                <div class="card has-text-primary has-background-white mb-3">
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-48x48">
                                    <a href="{{ route('user', $post->user) }}">
                                        <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}"
                                             class="is-rounded">
                                    </a>
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4 has-text-primary">{{ $post->user->name }}</p>
                                <p class="subtitle is-6">
                                    <a href="https://github.com/{{ $post->user->name }}"
                                       target="_blank"
                                       rel="noopener noreferrer">
                                       <span class="icon has-text-black">
                                           <i class="fab fa-github"></i>
                                       </span>
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="content">
                            <h2 class="has-text-centered has-text-primary has-text-weight-bold is-size-2">
                                {{ $post->title }}
                            </h2>

                            <article class="message is-primary">
                                <div class="message-body">
                                    @markdown($post->message ?? '')
                                </div>
                            </article>

                            <div class="control mb-3">
                                <div class="field is-grouped is-grouped-multiline">
                                    <div class="control">
                                        <div class="tags has-addons">
                                            <span class="tag is-primary">投稿日</span>
                                            <span
                                                class="tag">{{ $post->created_at->toDateTimeString() }}</span>
                                        </div>
                                    </div>

                                    <div class="control">
                                        <div class="tags has-addons">
                                            <span class="tag is-primary">更新日</span>
                                            <span
                                                class="tag">{{ $post->updated_at->toDateTimeString() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <x-tweet/>
                        </div>
                    </div>
                </div>

                @auth
                    <div class="field has-addons">
                        @can('update', $post)
                            <p class="control">
                                <a href="{{ route('post.edit', $post) }}" class="button is-primary is-outlined mb-3">
                                    <span class="icon"><i class="fas fa-edit"></i></span>
                                    <span>変更</span>
                                </a>
                            </p>
                        @endcan
                        @can('delete', $post)
                            <p class="control">
                                <a href="{{ route('post.confirm', $post) }}"
                                   class="button is-primary is-outlined">削除確認</a>
                            </p>
                        @endcan
                        @cannot('delete', $post)
                            <p class="control">
                                <post-report-component post-id="{{ $post->id }}"></post-report-component>
                            </p>
                        @endcannot
                    </div>
                @endauth

                <post-search-component></post-search-component>

            </div>
        </div>
    </div>
@endsection
