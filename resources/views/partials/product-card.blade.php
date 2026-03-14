<div class="product-card">
    <h3>{{ $product->name }}</h3>

    <p>{{ $product->description }}</p>

    <p>
        @if (!empty($product->color))
        Color: {{ $product->color }}<br>
        @endif

        @if (!empty($showCategory))
        Category: {{ $product->category->name }}<br>
        @endif

        Price: {{ $product->price }} kr<br>
        Stock: {{ $product->stock }}
    </p>

    <a
        href="{{ route('products.edit', $product) }}"
        class="editButton"
        aria-label="Edit {{ $product->name }}">
        Edit
    </a>

    <form
        action="{{ route('products.destroy', $product) }}"
        method="POST"
        class="inline-form"
        data-confirm-delete>

        @csrf
        @method('DELETE')

        <button type="submit" aria-label="Delete {{ $product->name }}">
            Delete
        </button>
    </form>
</div>