<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'NAILED IT')</title>

    {{-- Basic description + Open Graph / Twitter meta --}}
    <meta name="description" content="@yield('meta_description', 'NAILED IT - products and categories')">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <meta property="og:title" content="@yield('meta_title', trim($__env->yieldContent('title', 'NAILED IT')))">
    <meta property="og:description" content="@yield('meta_description', 'NAILED IT - products and categories')">
    <meta property="og:type" content="@yield('meta_type', 'website')">
    <meta property="og:url" content="@yield('meta_url', url()->current())">
    <meta property="og:image" content="@yield('meta_image', asset('images/og-default.png'))">

    <meta name="twitter:card" content="@yield('twitter_card', 'summary_large_image')">
    <meta name="twitter:title" content="@yield('meta_title', trim($__env->yieldContent('title', 'NAILED IT')))">
    <meta name="twitter:description" content="@yield('meta_description', 'NAILED IT - products and categories')">
    <meta name="twitter:image" content="@yield('meta_image', asset('images/og-default.png'))">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('head')
</head>

<body>
    @include('partials.header')

    <main class="container">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>

</html>