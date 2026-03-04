<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    @include('partials.header')

    <div class="layout">
        <aside class="sidebar">

            {{-- CATEGORIES VIEW --}}
            @if ($view === 'categories')
            <h2>Categories</h2>

            @if ($categories->count())
            <ul>
                @foreach ($categories as $category)
                <li>
                    <a href="{{ route('dashboard.show', $category) }}">{{ $category->name }}</a>
                    — {{ $category->products()->count() }} products
                </li>
                @endforeach
            </ul>
            @else
            <p>No categories found.</p>
            @endif
            @endif

            {{-- PRODUCTS VIEW (controls) --}}
            @if ($view === 'products')
            <h2>Filters</h2>

            <form method="GET" action="{{ route('dashboard.index') }}" class="filter-form">
                <input type="hidden" name="view" value="products">

                <label for="search">Search</label>
                <input id="search" type="text" name="search" placeholder="Search product..." value="{{ request('search') }}">

                <label for="category_id">Category</label>
                <select id="category_id" name="category_id">
                    <option value="">All categories</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id')==$category->id)>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>

                <label for="min_price">Min price</label>
                <input id="min_price" type="number" name="min_price" placeholder="Min price" value="{{ request('min_price') }}" step="0.01">

                <label for="max_price">Max price</label>
                <input id="max_price" type="number" name="max_price" placeholder="Max price" value="{{ request('max_price') }}" step="0.01">

                <label for="stock_filter">Stock</label>
                <select id="stock_filter" name="stock_filter">
                    <option value="">All</option>

                    <option value="in_stock"
                        @selected(request('stock_filter')==='in_stock' )>
                        In stock only
                    </option>

                    <option value="out_of_stock"
                        @selected(request('stock_filter')==='out_of_stock' )>
                        Out of stock
                    </option>
                </select>

                <label for="sort">Sort</label>
                <select id="sort" name="sort">

                    <option value="name_asc"
                        @selected(request('sort', 'name_asc' )==='name_asc' )>
                        Name (A–Z)
                    </option>

                    <option value="name_desc"
                        @selected(request('sort')==='name_desc' )>
                        Name (Z–A)
                    </option>

                    <option value="price_asc"
                        @selected(request('sort')==='price_asc' )>
                        Price (low → high)
                    </option>

                    <option value="price_desc"
                        @selected(request('sort')==='price_desc' )>
                        Price (high → low)
                    </option>

                    <option value="stock_asc"
                        @selected(request('sort')==='stock_asc' )>
                        Stock (low → high)
                    </option>

                    <option value="stock_desc"
                        @selected(request('sort')==='stock_desc' )>
                        Stock (high → low)
                    </option>

                </select>

                <button type="submit">Filter</button>

                <a href="{{ route('dashboard.index', ['view' => 'products']) }}" class="reset-link">
                    Reset
                </a>
            </form>

            @endif
        </aside>

        <main style="flex:1;">

            @if ($view === 'products')

            <h2 class="section-title">View all products</h2>

            {{-- PRODUCT LIST --}}
            @if ($products && $products->count())
            @foreach ($products as $product)
            <div class="product-card">
                <strong>{{ $product->name }}</strong><br>
                Category: {{ $product->category->name }}<br>
                Price: {{ $product->price }} kr<br>
                Stock: {{ $product->stock }}<br>

                <a href="{{ route('products.edit', $product) }}">Edit</a>

                <form action="{{ route('products.destroy', $product, false) }}" method="POST" class="inline-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
            @endforeach

            {{ $products->links() }}
            @else
            <p>No products found.</p>
            @endif
            @endif
        </main>
    </div>


    @include('partials.footer')
</body>

</html>