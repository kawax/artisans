@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is-marginless is-centered">
            <div class="column is-12">
                <div class="card">
                    <div class="card-content">
                        <div class="content">
                            <h1>削除確認</h1>

                            <ul>
                                <li>取り消しはできません。</li>
                            </ul>
                        </div>

                        <form action="{{ route('post.destroy', $post) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <input class="button is-primary" type="submit" value="削除">
                        </form>

                        <div class="content">
                            <p class="has-text-centered has-text-primary has-text-weight-bold is-size-2">
                                {{ $post->title }}
                            </p>

                            <article class="message is-primary">
                                <div class="message-body">
                                    @markdown($post->message ?? '')
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
