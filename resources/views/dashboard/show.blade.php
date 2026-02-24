<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Category — {{ $category->name }}</title>
</head>

<body>
    <h1>{{ $category->name }}</h1>

    @if($category->products->count())
    <ul>
        @foreach($category->products as $product)
        <li>
            <strong>{{ $product->name }}</strong><br>
            {{ $product->description }}<br>
            Price: {{ $product->price }} — Stock: {{ $product->stock }}
        </li>
        @endforeach
    </ul>
    @else
    <p>No products in this category.</p>
    @endif

    <p><a href="{{ route('dashboard.index') }}">Back to dashboard</a></p>
</body>

</html>