<article class="message">
    <div class="message-header">
        <p>GET /api/post</p>
    </div>
    <div class="message-body">
        <p>募集リストの取得。</p>

        <article class="message is-info">
            <div class="message-header">
                <p>レスポンス</p>
            </div>
            <div class="message-body">
                <pre>{{ collect([
                'data' => [[
                    'id' => "1",
                    'user' => [
                        'name' => 'test',
                        'avatar' => 'https://',
                    ],
                    'title' => 'text',
                    'message' => 'markdown',
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ]],
                'links' => [
                    'first' => 'https://localhost/api/post?page=1',
                    'last' => 'https://localhost/api/post?page=2',
                    'prev' => null,
                    'next' => 'https://localhost/api/post?page=2',
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
                <code>/api/post?page=2&q=test&limit=100</code>
                <dl>
                    <dt class="has-text-weight-semibold">page</dt>
                    <dd>ページ</dd>
                    <dt class="has-text-weight-semibold">q</dt>
                    <dd>キーワード検索。検索対象はタイトルとメッセージ。</dd>
                    <dt class="has-text-weight-semibold">limit</dt>
                    <dd>取得件数。指定可能範囲1~100。デフォルト20。</dd>
                </dl>
            </div>
        </article>
    </div>
</article>
