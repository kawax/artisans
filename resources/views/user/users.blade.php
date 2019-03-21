<article class="message is-primary">
    <div class="message-header">
        <p>Laravel職人（{{ $users->total() }}）</p>
    </div>
    <div class="message-body is-paddingless">

        <table class="table is-bordere is-striped is-hoverable is-fullwidth">
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <figure class="image is-32x32">
                            <img src="{{ $user->avatar }}" class="is-rounded" alt="{{ $user->name }}" title="{{ $user->name }}" lazyload="on">
                        </figure>
                    </td>
                    <td>
                        <a href="{{ route('user', $user->name) }}" class="has-text-weight-semibold has-text-primary">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td>
                        {{ Str::limit($user->title, 100) }}

                        <div class="tags">
                            @foreach($user->tags as $tag)
                                <span class="tag is-primary">
                                <a href="{{ route('tag', $tag->tag) }}">
                                        {{ $tag->tag ?? '' }}
                                        </a>
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</article>

<div class="mb-1">
    {{ $users->onEachSide(2)->links() }}
</div>