<div class="card product-card h-100">
    <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">

        {{-- Image --}}
        <div class="product-image-wrapper">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}">
            @else
                <img src="https://via.placeholder.com/400x300?text=No+Image">
            @endif
        </div>

        {{-- Body --}}
        <div class="card-body">

            <h6 class="product-title">
                {{ $product->name }}
            </h6>

            <div class="product-category">
                {{ $product->category }} • {{ $product->subcategory }}
            </div>

            @if($product->price)
                <div class="product-price">
                    {{ number_format($product->price) }} SYP
                </div>
            @endif

        </div>
    </a>
</div>
<style>
    .product-card {
    border: 1px solid #eef2f7;
    border-radius: 14px;
    background: #fafbfc;
    overflow: hidden;
    transition: all 0.25s ease;
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(13, 110, 253, 0.12);
    border-color: #dbe7ff;
}

/* IMAGE */
.product-image-wrapper {
    height: 220px;
    overflow: hidden;
    background: #f1f5f9;
}

.product-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.35s ease;
}

.product-card:hover .product-image-wrapper img {
    transform: scale(1.05);
}

/* BODY */
.product-card .card-body {
    padding: 14px 16px 18px;
}

/* TITLE */
.product-title {
    font-size: 1rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 4px;
}

/* CATEGORY */
.product-category {
    font-size: 0.8rem;
    color: #64748b;
    margin-bottom: 10px;
}

/* PRICE */
.product-price {
    font-size: 1rem;
    font-weight: 700;
    color: #0d6efd;
    border-top: 1px dashed #e2e8f0;
    padding-top: 8px;
}

</style>