<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:creator" content="{{ $name ?? '' }}">
<meta property="og:title" content="{{ $title ?? config('app.name', 'Laravel') }}">
<meta property="og:description" content="{{ $description ?? '' }}">
<meta property="og:image" content="{{ $image ?? route('image.home') }}">
