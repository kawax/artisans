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
                        </div>
                    </article>

                    <article class="message">
                        <div class="message-header">
                            <p>GET /api/user</p>
                        </div>
                        <div class="message-body">
                            <p>ユーザーリストの取得。</p>

                            <article class="message is-info">
                                <div class="message-header">
                                    <p>レスポンス</p>
                                </div>
                                <div class="message-body">
                                    <pre>{{ collect([
                                    'data' => [[
                                        'id' => "1",
                                        'name' => 'test',
                                        'avatar' => 'https://',
                                        'title' => 'text',
                                        'message' => 'markdown',
                                        'updated_at' => now()->toDateTimeString(),
                                        'tags' => ['tag1', 'tag2'],
                                    ]],
                                    'links' => [
                                        'first' => 'https://localhost/api/user?page=1',
                                        'last' => 'https://localhost/api/user?page=2',
                                        'prev' => null,
                                        'next' => 'https://localhost/api/user?page=2',
                                    ],
                                    'meta' => [
                                        'current_page' => 1,
                                        'from' => 1,
                                        'last_page' => 10,
                                        'path' => 'http://',
                                        'per_page' => 20,
                                        'to' => 20,
                                        'total' => 100,
                                    ]])->toJson(JSON_PRETTY_PRINT) }}
                                    </pre>
                                </div>
                            </article>

                            <article class="message is-info">
                                <div class="message-header">
                                    <p>パラメータ</p>
                                </div>
                                <div class="message-body">
                                    <code>/api/user?page=2&q=test&limit=100</code>
                                    <dl>
                                        <dt class="has-text-weight-semibold">page</dt>
                                        <dd>ページ</dd>
                                        <dt class="has-text-weight-semibold">q</dt>
                                        <dd>キーワード検索。検索対象は名前とタイトルとメッセージ。</dd>
                                        <dt class="has-text-weight-semibold">limit</dt>
                                        <dd>取得件数。指定可能範囲1~100。デフォルト20。</dd>
                                    </dl>
                                </div>
                            </article>
                        </div>
                    </article>

                </div>
            </div>
        </div>
    </div>
@endsection
