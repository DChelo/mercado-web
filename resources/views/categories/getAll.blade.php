<x-app title="Categorias">
    <div class="card-container">
        @foreach ($categories as $category)
            <a href="{{ route('products.category', ['category' => $category->id]) }}" class="category-link">
                <div class="category-card">
                    <h1>{{ $category->name }}</h1>
                </div>
            </a>
        @endforeach
    </div>
</x-app>

<style>
    .card-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }

    .category-card {
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        width: 300px;
        text-align: center;
        transition: transform 0.3s;
    }

    .category-card:hover {
        transform: scale(1.05);
    }

    .category-link {
        text-decoration: none;
        color: #333;
        cursor: pointer;
    }
</style>
