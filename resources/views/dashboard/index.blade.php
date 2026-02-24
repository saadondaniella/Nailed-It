<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard — Categories</title>
</head>

<body>
    <h1>Dashboard — Categories</h1>

    @if($categories->count())
    <ul>
        @foreach($categories as $category)
        <li>
            <a href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a>
            — {{ $category->products()->count() }} products
        </li>
        @endforeach
    </ul>
    @else
    <p>No categories found.</p>
    @endif

    <p><a href="/">Back to site</a></p>
</body>

</html>