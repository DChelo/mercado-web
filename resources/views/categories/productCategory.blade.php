<x-app title="{{ $category->name }} Products">

    <section class="my-3 d-flex justify-content-center">
        <h1>{{ $category->name }}</h1>
    </section>

    <div class="d-flex flex-wrap justify-content-center">
        @foreach ($products as $product)
            <div class="card mb-4 ms-3 smaller-card">
                <a href="{{ route('products.show', ['product' => $product->id]) }}"
                    style="text-decoration: none; color: #333;">
                    <img src="{{ $product->file->route }}" class="card-img-top" alt="Imagen Libro">
                    <div class="card-body">
                        <h5><strong>{{ $product->name }}</strong></h5>
                        <p class="h3">${{ $product->price }}</p>
                        <p class="h5">{{ $product->format_description }}</p>
                        <p class="h5">Color: <strong>{{ $product->color }}</strong></p>
                        <p class="h5">Stock: <strong>{{ $product->stock }}</strong></p>
                        <br>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</x-app>

<style>
    .smaller-card {
        width: 300px;
        height: 495px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .smaller-card a {
        color: inherit;
        text-decoration: none;
    }

    .smaller-card:hover {
        transform: scale(1.05);
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }
</style>
