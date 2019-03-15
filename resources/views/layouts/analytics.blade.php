@unless(empty(config('artisans.analytics')))
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('artisans.analytics') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || []

        function gtag () {dataLayer.push(arguments)}

        gtag('js', new Date())

        gtag('config', '{{ config('artisans.analytics') }}')
    </script>
@endunless
