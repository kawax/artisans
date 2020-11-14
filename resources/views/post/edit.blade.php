@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is-marginless is-centered">
            <div class="column is-4">
                <img src="{{ route('image.post', $post) }}">


                @include('post.side')
            </div>
            <div class="column is-8">
                <div class="card mb-1">
                    <div class="card-content">
                        <div class="content">
                            <h1>投稿変更</h1>
                        </div>

                        <post-edit-component post-id="{{ $post->id }}"></post-edit-component>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
