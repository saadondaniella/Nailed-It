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

    @if($category->products->count())

    @foreach($category->products as $product)
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