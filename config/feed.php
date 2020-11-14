<?php

return [
    'feeds' => [
        'user' => [
            /*
             * Here you can specify which class and method will return
             * the items that should appear in the feed. For example:
             * 'App\Model@getAllFeedItems'
             *
             * You can also pass an argument to that method:
             * ['App\Model@getAllFeedItems', 'argument']
             */
            'items' => App\Models\User::class.'@getFeedItems',

            /*
             * The feed will be available on this url.
             */
            'url'   => '/feed/user',

            'title' => 'Laravel職人を探す - 職人',

            /*
             * The view that will render the feed.
             */
            'view'  => 'feed::feed',
        ],
        'post' => [
            /*
             * Here you can specify which class and method will return
             * the items that should appear in the feed. For example:
             * 'App\Model@getAllFeedItems'
             *
             * You can also pass an argument to that method:
             * ['App\Model@getAllFeedItems', 'argument']
             */
            'items' => App\Models\Post::class.'@getFeedItems',

            /*
             * The feed will be available on this url.
             */
            'url'   => '/feed/post',

            'title' => 'Laravel職人を探す - 投稿',

            /*
             * The view that will render the feed.
             */
            'view'  => 'feed::feed',
        ],
    ],
];
