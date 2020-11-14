@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is-marginless is-centered">
            <div class="column is-4">
                @include('post.side')
            </div>
            <div class="column is-8">
                <div class="card mb-1">
                    <div class="card-content">
                        <div class="content">
                            <h1>新規投稿</h1>
                        </div>

                        <post-create-component></post-create-component>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
