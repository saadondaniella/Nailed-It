<!DOCTYPE html>
<html>

<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    <h1>Edit Product</h1>

    {{-- Success flash --}}
    @if(session('success'))
    <div style="color: green; margin-bottom:10px;">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PATCH')

        <div>
            <label for="name">Product name</label><br>
            <input type="text"
                id="name"
                name="name"
                value="{{ old('name', $product->name) }}">
        </div>

        <div>
            <label for="description">Description</label><br>
            <textarea id="description"
                name="description">{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label for="price">Price</label><br>
            <input type="number"
                step="0.01"
                id="price"
                name="price"
                value="{{ old('price', $product->price) }}">
        </div>

        <div>
            <label for="stock">Stock</label><br>
            <input type="number"
                id="stock"
                name="stock"
                value="{{ old('stock', $product->stock) }}">
        </div>

        <div>
            <label for="category_id">Category</label><br>
            <select id="category_id" name="category_id">
                @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id', $product->category_id) == $category->id)>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <br>

        <button type="submit">Save changes</button>

    </form>

    <br>

    <a href="{{ route('dashboard.show', $product->category) }}">Back to products</a>

    @include('partials.logout')

</body>

</html>