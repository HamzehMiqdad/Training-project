@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<style>
    .awesomplete {
    display: block !important;     
    width: 100% !important;        
}

.awesomplete input {
    width: 100% !important;         
}

.awesomplete ul {
    width: 100% !important;         
    z-index: 1000;                 
}
</style>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3 text-center">Add New Product</h3>

                {{-- Display Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Details --}}
                    <div class="mb-3">
                        <label class="form-label">Details</label>
                        <input type="text" name="details"
                               class="form-control @error('details') is-invalid @enderror"
                               value="{{ old('details') }}" required>
                        @error('details')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" id="category"
                               class="form-control @error('category') is-invalid @enderror"
                               value="{{ old('category') }}" required>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Subcategory --}}
                    <div class="mb-3">
                        <label class="form-label">Subcategory</label>
                        <input type="text" name="subcategory" id="subcategory"
                               class="form-control @error('subcategory') is-invalid @enderror"
                               value="{{ old('subcategory') }}" required>
                        @error('subcategory')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Code --}}
                    <div class="mb-3">
                        <label class="form-label">Product Code</label>
                        <input type="text" name="code"
                               class="form-control @error('code') is-invalid @enderror"
                               value="{{ old('code') }}">
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" step="1" name="price"
                               class="form-control @error('price') is-invalid @enderror"
                               value="{{ old('price') }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Available for Sale --}}
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="availabe_for_sale" id="availabe_for_sale"
                               {{ old('availabe_for_sale', default: true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="availabe_for_sale">
                            Available for Sale
                        </label>
                    </div>

                    {{-- Image --}}
                    <div class="mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Awesomplete for live combobox --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.min.js"></script>

<script>
function setupCombobox(fieldId) {
    const input = document.getElementById(fieldId);
    const awesomplete = new Awesomplete(input, { minChars: 1, maxItems: 10 });

    input.addEventListener('input', function() {
        fetch(`/products/suggestions/${fieldId}?q=${input.value}`)
            .then(res => res.json())
            .then(data => {
                awesomplete.list = data;
            });
    });
}

setupCombobox('category');
setupCombobox('subcategory');
</script>
@endsection
