<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Categories</title>
</head>

<body>
    <h1>Categories</h1>
    @if(isset($categories) && $categories->count())
    <ul>
        @foreach($categories as $category)
        <li>{{ $category->name }} ({{ $category->products()->count() }} products)</li>
        @endforeach
    </ul>
    @else
    <p>No categories found.</p>
    @endif
</body>

</html>