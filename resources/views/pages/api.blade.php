@extends('layouts.app')

@section('title', 'API / ' . config('app.name'))

@section('content')
    <div class="container">
        <div class="columns">
            <div class="column is-full">
                <div class="content">

                    <h1>API</h1>

                    <article class="message is-primary">
                        <div class="message-header">
                            <p>エンドポイント</p>
                        </div>
                        <div class="message-body">
                            すべて<code>{{ route('pages.api') }}</code>以下へ。
                            認証は不要。CORS対応。レート制限は1分間に60回。

                            <p>messageのhtmlはサニタイズ後のMarkdownをhtmlに変換してるのでそのまま表示しても安全（バグがなければ）。その他はエスケープが必要。</p>
                        </div>
                    </article>

                    @include('pages.api.user')

                    @include('pages.api.post')

                </div>
            </div>
        </div>
    </div>
@endsection
