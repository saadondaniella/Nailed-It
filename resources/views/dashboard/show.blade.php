<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Category — {{ $category->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>ç
    <h1>{{ $category->name }}</h1>
    @if (session('success'))
    <p style="padding:10px; border:1px solid #4caf50; background:#e8f5e9;">
        {{ session('success') }}
    </p>
    @endif

    <form method="GET" action="{{ route('dashboard.show', $category) }}" style="margin: 15px 0;" aria-labelledby="filter-heading">
        <h2 id="filter-heading">Filter products</h2>

        <div style="margin-bottom:8px;">
            <label for="search">Search name</label>
            <input id="search" type="text" name="search" placeholder="Search name..." value="{{ request('search') }}" aria-describedby="search-help">
            <div id="search-help">Enter part or full product name.</div>
            @error('search')
            <p class="error" role="alert" aria-live="polite">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom:8px;">
            <label for="min_price">Minimum price (kr)</label>
            <input id="min_price" type="number" name="min_price" placeholder="Min price" value="{{ request('min_price') }}" step="0.01" aria-describedby="price-help">
            @error('min_price')
            <p class="error" role="alert" aria-live="polite">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom:8px;">
            <label for="max_price">Maximum price (kr)</label>
            <input id="max_price" type="number" name="max_price" placeholder="Max price" value="{{ request('max_price') }}" step="0.01" aria-describedby="price-help">
            <div id="price-help">Use decimals with a dot, e.g. 19.99.</div>
            @error('max_price')
            <p class="error" role="alert" aria-live="polite">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom:8px;">
            <label for="stock_filter">Stock</label>
            <select id="stock_filter" name="stock_filter" aria-describedby="stock-help">
                <option value="">All</option>
                <option value="in_stock" @selected(request('stock_filter')==='in_stock' )>
                    In stock only
                </option>
                <option value="out_of_stock" @selected(request('stock_filter')==='out_of_stock' )>
                    Out of stock
                </option>
            </select>
            <div id="stock-help">Filter products by availability.</div>
            @error('stock_filter')
            <p class="error" role="alert" aria-live="polite">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom:8px;">
            <label for="sort">Sort by</label>
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
        </div>

        <button type="submit">Filter</button>

        <a href="{{ route('dashboard.show', $category) }}" style="margin-left:10px;">
            Reset
        </a>
    </form>

    @if($products->count())

    @foreach($products as $product)
    <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc;">

        <h3>{{ $product->name }}</h3>

        <p>{{ $product->description }}</p>

        <p>
            Price: {{ $product->price }} kr <br>
            Stock: {{ $product->stock }}
        </p>

        {{-- EDIT --}}
        <a href="{{ route('products.edit', $product) }}" aria-label="Edit {{ $product->name }}">
            Edit
        </a>

        {{-- DELETE --}}
        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete {{ addslashes($product->name) }}?');">
            @csrf
            @method('DELETE')
            <button type="submit" aria-label="Delete {{ $product->name }}">Delete</button>
        </form>

    </div>
    @endforeach

    @else
    <p>No products in this category.</p>
    @endif

    <p>
        <a href="{{ route('dashboard.index') }}">
            Back to dashboard
        </a>
    </p>

    @include('partials.logout')
</body>

</html>