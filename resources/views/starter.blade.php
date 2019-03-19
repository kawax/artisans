<div class="box">
    <h3 class="title is-3 has-text-centered has-text-primary">スターター</h3>

    <p class="has-text-centered">
        ユーザー数（非公開含む）に応じて自動解放されていきます。
    </p>

    <nav class="level is-mobile">
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">{{ config('artisans.starter.step1') }}</p>
                <p class="title is-5">募集投稿解放<br>掲載期間10日</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">{{ config('artisans.starter.step2') }}</p>
                <p class="title is-5">募集検索<br>掲載20日</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">{{ config('artisans.starter.step3') }}</p>
                <p class="title is-5">掲載30日</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">{{ config('artisans.starter.step4') }}</p>
                <p class="title is-5">完走</p>
            </div>
        </div>
    </nav>

    <progress class="progress is-primary is-large" value="{{ $user_count }}" max="{{ config('artisans.starter.step4') }}"></progress>

</div>
