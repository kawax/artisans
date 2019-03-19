<article class="message is-primary mb-1">
    <div class="message-header">
        <p>募集したい側</p>
    </div>
    <div class="message-body is-paddingless has-background-white">
        @if(Starter::can(config('artisans.starter.step1')))
            @foreach($posts as $post)
                <article class="media">
                    <figure class="media-left image is-32x32">
                        <img src="{{ $post->user->avatar }}" class="is-rounded" title="{{ $post->user->name }}">
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <a href="{{ route('post.show', $post) }}" class="has-text-primary">
                                    <strong>{{ Str::limit($post->title, 100) }}</strong>
                                </a>
                            </p>
                            <article class="message is-dark">
                                <div class="message-body">
                                    @markdown(Str::limit($post->message, 300))
                                </div>
                            </article>
                        </div>
                        <nav class="level is-mobile">
                            <div class="level-left">
                                <small class="level-item">
                                    <div class="tags has-addons">
                                        <span class="tag">投稿日</span>
                                        <span class="tag">{{ $post->created_at }}</span>
                                    </div>
                                </small>
                                <small class="level-item">
                                    <div class="tags has-addons">
                                        <span class="tag">更新日</span>
                                        <span class="tag">{{ $post->updated_at }}</span>
                                    </div>
                                </small>
                            </div>
                        </nav>
                    </div>
                </article>
            @endforeach
        @else
            準備中。ユーザーがある程度増えたら開始。
        @endif

    </div>
</article>
