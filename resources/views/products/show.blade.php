@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">

        <div class="card shadow-sm">
            {{-- Image --}}
            @if($product->image)
                <div class="ratio ratio-16x9 bg-light rounded">
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        class="img-fluid"
                        style="object-fit:contain;"
                        alt="{{ $product->name }}">
                </div>
            @endif

            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-3">
                    <div>
                        <h3 class="mb-1">{{ $product->name }}</h3>
                        <span class="badge {{ $product->availabe_for_sale ? 'bg-success' : 'bg-danger' }}">
                            {{ $product->availabe_for_sale ? 'Available' : 'Not Available' }}
                        </span>
                    </div>

                    {{-- Actions --}}
                    <div class="mt-2 mt-md-0">
                        @can('edit', $product)
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
                        @endcan

                        @can('destroy', $product)
                            <form action="{{ route('products.destroy', $product) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>

                <hr>

                {{-- Details --}}
                <p class="mb-3">{{ $product->details }}</p>

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <strong>Category:</strong>
                        {{ $product->category }} / {{ $product->subcategory }}
                    </div>

                    @if($product->price)
                        <div class="col-md-6 mb-2">
                            <strong>Price:</strong> {{ $product->price }} SYP
                        </div>
                    @endif

                    @if($product->code)
                        <div class="col-md-6 mb-2">
                            <strong>Code:</strong> {{ $product->code }}
                        </div>
                    @endif

                    <div class="col-md-6 mb-2">
                        <strong>Added on:</strong>
                        {{ $product->created_at->format('M d, Y') }}
                    </div>
                </div>
            </div>
        </div>
        @if($product->user->activated)
            <hr>

        <h5 class="mb-3">Seller Information</h5>

        <div class="card border-0 bg-light">
            <div class="card-body d-flex align-items-start gap-3">

                {{-- Logo / Image --}}
                @if($product->user->logo)
                    <img src="{{ asset('storage/' . $product->user->logo) }}"
                        alt="Store Logo"
                        style="width:70px; height:70px; object-fit:cover; border-radius:8px;">
                @elseif($product->user->user_image)
                    <img src="{{ asset('storage/' . $product->user->user_image) }}"
                        alt="User Image"
                        style="width:70px; height:70px; object-fit:cover; border-radius:50%;">
                @endif

                <div>
                    <h6 class="mb-1">{{ $product->user->store_name }}</h6>
                    <p class="mb-1 text-muted">
                        {{ $product->user->first_name }} {{ $product->user->last_name }}
                    </p>

                    <div class="small">
                        <div>
                            📞 {{ $product->user->phone_number }}
                        </div>

                        @if($product->user->whatsapp)
                            <div>
                                💬 <a href="https://wa.me/{{ $product->user->whatsapp }}"
                                    target="_blank" class="text-decoration-none">
                                    WhatsApp
                                </a>
                            </div>
                        @endif

                        @if($product->user->facebook)
                            <div>
                                🌐 <a href="{{ $product->user->facebook }}"
                                    target="_blank" class="text-decoration-none">
                                    Facebook
                                </a>
                            </div>
                        @endif

                        <p class="mb-0">
                            <strong>Location:</strong>
                            {{ $product->user->country }},
                            {{ $product->user->city }},
                            {{ $product->user->location }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        @endif

        {{-- Back --}}
        <div class="mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                ← Back
            </a>
        </div>

    </div>
</div>
@endsection
