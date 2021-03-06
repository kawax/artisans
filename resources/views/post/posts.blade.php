<article class="message is-primary mb-3" v-lazy-container="{ selector: 'img[lazyload=on]' }">
    <div class="message-header">
        <p>投稿（{{ $posts->total() }}）</p>
    </div>
    <div class="message-body is-paddingless has-background-white">
        @foreach($posts as $post)
            <article class="media">
                <figure class="media-left image is-32x32">
                    <img src="{{ $post->user->avatar }}"
                         class="is-rounded"
                         alt="{{ $post->user->name }}"
                         title="{{ $post->user->name }}"
                         loading="lazy"
                    >
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
                                {{--<img src="{{ route('image.post', $post) }}" alt="{{ $post->title }}">--}}
                                @markdown($post->message)
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
    </div>
</article>

<div class="mb-1">
    {{ $posts->onEachSide(2)->links() }}
</div>
