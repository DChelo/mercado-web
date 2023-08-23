<x-app title="Inicio">

    @php
        $productsByCategory = $products->groupBy('category_id');
    @endphp

    @foreach ($productsByCategory as $categoryId => $categoryProducts)
        @php
            $chunkedProducts = $categoryProducts->take(5)->chunk(4);
        @endphp

        <section class="my-4">
            <h2 class="text-start ms-4">{{ $categoryProducts->first()->category->name }}
                <a href="{{ route('products.category', ['category' => $categoryId]) }}"
                    class="btn btn-link btn-sm no-decoration">Ver
                    todos</a>
            </h2>
            <div id="carousel{{ $categoryId }}" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($chunkedProducts as $index => $chunk)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $product)
                                    <div class="col-md-3">
                                        <div class="card mb-4 ms-3 smaller-card">
                                            <a href="{{ route('products.show', ['product' => $product->id]) }}"
                                                style="text-decoration: none; color: #333;">
                                                <img src="{{ $product->file->route }}" class="card-img-top"
                                                    alt="Imagen Libro">
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
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button"
                    data-bs-target="#carousel{{ $categoryId }}"data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $categoryId }}"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
        </section>
    @endforeach
</x-app>

<style>
    .smaller-card {
        width: 300px;
        height: 495px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .smaller-card:hover {
        transform: scale(1.05);
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 60px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 3rem;
        height: 3rem;
    }

    .no-decoration {
        color: inherit;
    }
</style>
