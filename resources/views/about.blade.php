<div class="notification is-primary mt-3">
    <div class="content">
        <h1 class="has-text-white">Laravel職人を探すサービス</h1>

        <ul>
            <li>ユーザー登録はGitHubでのログインのみ。</li>
            <li><strong>情報提供</strong>のみのサービスです。連絡等は外部で行ってください。</li>
            <li>余計な情報は預からないのでメールアドレスさえも保存してません。</li>
            <li>通知先
                <a href="https://twitter.com/kawaxbiz" class="tag is-dark" target="_blank">Twitter</a>
                <a href="{{ config('artisans.discord_url') }}" class="tag is-dark">Discord</a>
                <b-tooltip label="無期限の招待リンクが作れないので保留"
                           type="is-dark"
                           position="is-right">
                    <del>Slack</del>
                </b-tooltip>
            </li>
            <li>
                <a href="https://widget.kawax.biz/" class="tag is-dark" target="_blank">Widget</a>
            </li>
            <li>ハッシュタグ
                <b-tooltip label="#自動 は自動ツイートをミュートしたい人用"
                           type="is-dark"
                           position="is-right">
                    <span class="tag is-dark">#laravel_jp</span>
                </b-tooltip>
            </li>
        </ul>
    </div>
    @guest
        <p class="mb-3">
            <a class="button is-dark" href="{{ route('login') }}">
                <i class="fab fa-github"></i>
                Login with GitHub
            </a>
        </p>
    @endguest
    <p>
        <x-tweet :url="route('home')"/>
    </p>
</div>
