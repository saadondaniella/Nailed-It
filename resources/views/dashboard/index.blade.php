<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
</head>

<body>
    <h1>NAILED IT</h1>

    <p>
        <a href="{{ route('dashboard.index', ['view' => 'categories']) }}">Show categories</a> |
        <a href="{{ route('dashboard.index', ['view' => 'products']) }}">Show all products</a>
    </p>

    <p>
        <a href="{{ route('products.create') }}">+ Create new product</a>
    </p>

    {{-- CATEGORIES VIEW --}}
    @if ($view === 'categories')
    <h2>Dashboard — Categories</h2>

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

    {{-- PRODUCTS VIEW --}}
    @if ($view === 'products')
    <h2>Dashboard — Products</h2>

    {{-- FILTER FORM --}}
    <form method="GET" action="{{ route('dashboard.index') }}" style="margin: 15px 0;">
        <input type="hidden" name="view" value="products">

        <input type="text" name="search" placeholder="Search product..." value="{{ request('search') }}">

        <select name="category_id">
            <option value="">All categories</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(request('category_id')==$category->id)>
                {{ $category->name }}
            </option>
            @endforeach
        </select>

        <input type="number" name="min_price" placeholder="Min price"
            value="{{ request('min_price') }}" step="0.01">

        <input type="number" name="max_price" placeholder="Max price"
            value="{{ request('max_price') }}" step="0.01">

        <select name="stock_filter">
            <option value="">All</option>

            <option value="in_stock"
                @selected(request('stock_filter') === 'in_stock')>
                In stock only
            </option>

            <option value="out_of_stock"
                @selected(request('stock_filter') === 'out_of_stock')>
                Out of stock
            </option>
        </select>

        <select name="sort">

            <option value="name_asc"
                @selected(request('sort', 'name_asc') === 'name_asc')>
                Name (A–Z)
            </option>

            <option value="name_desc"
                @selected(request('sort') === 'name_desc')>
                Name (Z–A)
            </option>

            <option value="price_asc"
                @selected(request('sort') === 'price_asc')>
                Price (low → high)
            </option>

            <option value="price_desc"
                @selected(request('sort') === 'price_desc')>
                Price (high → low)
            </option>

            <option value="stock_asc"
                @selected(request('sort') === 'stock_asc')>
                Stock (low → high)
            </option>

            <option value="stock_desc"
                @selected(request('sort') === 'stock_desc')>
                Stock (high → low)
            </option>

        </select>

        <button type="submit">Filter</button>

        <a href="{{ route('dashboard.index', ['view' => 'products']) }}" style="margin-left:10px;">
            Reset
        </a>
    </form>

    {{-- PRODUCT LIST --}}
    @if ($products && $products->count())
    @foreach ($products as $product)
    <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc;">
        <strong>{{ $product->name }}</strong><br>
        Category: {{ $product->category->name }}<br>
        Price: {{ $product->price }} kr<br>
        Stock: {{ $product->stock }}<br>

        <a href="{{ route('products.edit', $product) }}">Edit</a>

        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
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


    @include('partials.logout')
</body>

</html>