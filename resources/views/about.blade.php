<div class="notification is-primary">
    <div class="content">
        <h1 class="has-text-white">Laravel職人を探すサービス</h1>

        <ul>
            <li>ユーザー登録はGitHubでのログインのみ。</li>
            <li>サービス内でのメッセージのやり取りはありません。Laravel職人なら外部の連絡先を用意できるでしょう。</li>
            <li>余計な情報は預からないのでメールアドレスさえも保存してません。</li>
            @if(Starter::can(config('artisans.starter.step1')))
                <li>募集側は業務委託のみ投稿可能です。雇用・求人情報は禁止なので注意してください。（法的な理由で）</li>
                <li>通知先
                    <a href="https://discord.gg/5VSJv5j" class="tag is-dark">Discord</a>
                    <b-tooltip label="無期限の招待リンクが作れないので保留"
                               type="is-dark"
                               position="is-right">
                        <del>Slack</del>
                    </b-tooltip>
                </li>
            @endif
        </ul>
    </div>
    <p class="mb-1">
        <a class="button is-dark" href="{{ route('login') }}">
            <i class="fab fa-github"></i>
            Login with GitHub
        </a>
    </p>
    <p>
        @tweet
        @endtweet
    </p>
</div>
