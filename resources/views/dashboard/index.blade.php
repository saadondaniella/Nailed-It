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

        <label style="margin-left:10px;">
            <input type="checkbox" name="in_stock" value="1" @checked(request()->boolean('in_stock'))>
            In stock only
        </label>

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