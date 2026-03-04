<header class="site-header">
    <div class="container">
        <a href="{{ route('dashboard.index') }}" class="brand">NAILED IT</a>

        <nav class="site-nav" aria-label="Main navigation">
            <a href="{{ route('dashboard.index', ['view' => 'categories']) }}">Categories</a>
            <a href="{{ route('dashboard.index', ['view' => 'products']) }}">Products</a>
            <a href="{{ route('products.create') }}">New product</a>
            @include('partials.logout')
        </nav>
    </div>
</header>