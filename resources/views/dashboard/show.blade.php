<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Category — {{ $category->name }}</title>
</head>

<body>
    <h1>{{ $category->name }}</h1>
    @if (session('success'))
    <p style="padding:10px; border:1px solid #4caf50; background:#e8f5e9;">
        {{ session('success') }}
    </p>
    @endif

    <form method="GET" action="{{ route('dashboard.show', $category) }}" style="margin: 15px 0;">
        <input type="text" name="search" placeholder="Search name..." value="{{ request('search') }}">

        <input type="number" name="min_price" placeholder="Min price" value="{{ request('min_price') }}" step="0.01">
        <input type="number" name="max_price" placeholder="Max price" value="{{ request('max_price') }}" step="0.01">

        <label style="margin-left:10px;">
            <input type="checkbox" name="in_stock" value="1" @checked(request()->boolean('in_stock'))>
            In stock only
        </label>

        <select name="sort">
            <option value="name_asc" @selected(request('sort', 'name_asc' )==='name_asc' )>Name (A–Z)</option>
            <option value="price_asc" @selected(request('sort')==='price_asc' )>Price (low → high)</option>
            <option value="price_desc" @selected(request('sort')==='price_desc' )>Price (high → low)</option>
        </select>

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
        <a href="{{ route('products.edit', $product) }}">
            Edit
        </a>

        {{-- DELETE --}}
        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
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