<x-app>
    <section class="d-flex justify-content-center">
        <div class="card mb-3 p-4" style="width: 90%;">
            <div class="row g-0">
                <div class="col-md-9 text-center">
                    <img src="{{ $product->file->route }}" class="card-img-top" style="max-height: 400px; object-fit: contain;" alt="Imagen Libro">
                </div>
                <div class="card col-md-12" style="width: 16rem;">
                    <div class="card-body">
                        <h4><strong>{{ $product->name }}</strong></h4>
                        <p class="h2">${{ $product->price }}</p>
						<br>
						<p class="h5">{{ $product->description }}</p>
						<br>
                        <p class="h5">Color: <strong>{{ $product->color }}</strong></p>
						<p class="h5">Stock: <strong>{{ $product->stock }} disponible</strong></p>
						<br>
                        <button class="btn btn-primary mx-4">Agregar al carrito <i class="fa-solid fa-cart-shopping"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app>
