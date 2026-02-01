<!DOCTYPE html>
<html class="light" lang="{{ app()->getLocale() }}">
<head>
    @include('partials.head-assets')
    <title>{{ $product->name }} - {{ __('messages.marketplace') }}</title>
    <style>
        body {
            font-family: "Spline Sans", sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-[#181811] dark:text-white min-h-screen">

    @include('partials.header')

    <main class="max-w-[1280px] mx-auto px-4 md:px-10 py-8">
        {{-- Breadcrumbs --}}
        <nav class="flex items-center gap-2 mb-6 overflow-x-auto whitespace-nowrap scrollbar-hide">
            <a class="text-[#8c8b5f] text-sm font-medium hover:text-[#181811] dark:hover:text-white flex items-center gap-1" href="{{ route('products.index') }}">
                <span class="material-symbols-outlined text-sm">home</span> {{ __('messages.home') }}
            </a>
            <span class="text-[#8c8b5f] text-xs">/</span>
            <a class="text-[#8c8b5f] text-sm font-medium hover:text-[#181811] dark:hover:text-white" href="{{ route('products.index', ['category' => $product->category]) }}">
                {{ $product->category }}
            </a>
            @if($product->subcategory)
                <span class="text-[#8c8b5f] text-xs">/</span>
                <a class="text-[#8c8b5f] text-sm font-medium hover:text-[#181811] dark:hover:text-white" href="{{ route('products.index', ['category' => $product->category, 'subcategory' => $product->subcategory]) }}">
                    {{ $product->subcategory }}
                </a>
            @endif
            <span class="text-[#8c8b5f] text-xs">/</span>
            <span class="text-[#181811] dark:text-white text-sm font-semibold">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            {{-- Left Side: Product Image --}}
            <div class="lg:col-span-6">
                <div class="relative group">
                    <div class="aspect-square w-full rounded-xl bg-white dark:bg-white/5 overflow-hidden border border-[#f5f5f0] dark:border-white/10 shadow-sm">
                        @if($product->image)
                            <img 
                                alt="{{ $product->name }}" 
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                                src="{{ asset('storage/' . $product->image) }}"
                            />
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-100 dark:bg-gray-800">
                                <span class="material-symbols-outlined text-gray-400 text-6xl">image</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Center Side: Product Details --}}
            <div class="lg:col-span-4 flex flex-col gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        @if($product->availabe_for_sale)
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-primary/20 text-[#181811] dark:text-primary text-xs font-bold uppercase tracking-wider">
                                {{ __('messages.available_for_sale_badge') }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-500/20 text-red-600 dark:text-red-400 text-xs font-bold uppercase tracking-wider">
                                {{ __('messages.not_available') }}
                            </span>
                        @endif
                        <div class="flex items-center gap-1 text-[#8c8b5f] text-xs font-medium">
                            <span class="material-symbols-outlined text-[14px]">visibility</span>
                            {{ number_format($product->hits ?? 0) }} {{ __('messages.hits') }}
                        </div>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-2">{{ $product->name }}</h1>
                    @if($product->price)
                        <div class="flex items-baseline gap-3">
                            <span class="text-3xl font-bold">{{ number_format($product->price) }} SYP</span>
                        </div>
                    @else
                        <div class="flex items-baseline gap-3">
                            <span class="text-2xl font-bold text-[#8c8b5f]">{{ __('messages.price_on_request') }}</span>
                        </div>
                    @endif
                </div>

                {{-- Key Info Section --}}
                <div class="bg-white dark:bg-white/5 rounded-xl p-5 border border-[#f5f5f0] dark:border-white/10">
                    <div class="grid grid-cols-2 gap-4">
                        @if($product->code)
                            <div>
                                <p class="text-[10px] uppercase font-bold text-[#8c8b5f] mb-1">{{ __('messages.product_code') }}</p>
                                <p class="font-mono text-sm">{{ $product->code }}</p>
                            </div>
                        @endif
                        <div>
                            <p class="text-[10px] uppercase font-bold text-[#8c8b5f] mb-1">{{ __('messages.category') }}</p>
                            <p class="text-sm">{{ $product->category }}</p>
                        </div>
                        @if($product->subcategory)
                            <div>
                                <p class="text-[10px] uppercase font-bold text-[#8c8b5f] mb-1">{{ __('messages.subcategory') }}</p>
                                <p class="text-sm">{{ $product->subcategory }}</p>
                            </div>
                        @endif
                        <div>
                            <p class="text-[10px] uppercase font-bold text-[#8c8b5f] mb-1">{{ __('messages.added') }}</p>
                            <p class="text-sm">{{ $product->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-widest text-[#8c8b5f] mb-3">{{ __('messages.product_description') }}</h3>
                    <p class="text-[#181811]/70 dark:text-white/70 leading-relaxed text-base">
                        {{ $product->details }}
                    </p>
                </div>

                {{-- Action Section --}}
                <div class="flex flex-col gap-3 pt-4 border-t border-[#f5f5f0] dark:border-white/10">
                    @if($product->user && $product->user->activated)
                        @if($product->user->whatsapp || $product->user->phone_number)
                            <a 
                                href="https://wa.me/{{ $product->user->whatsapp ?? $product->user->phone_number }}" 
                                target="_blank"
                                class="w-full bg-primary hover:bg-[#e6e200] text-[#181811] h-14 rounded-full font-bold text-lg flex items-center justify-center gap-2 transition-all shadow-lg shadow-primary/20"
                            >
                                <span class="material-symbols-outlined">chat</span>
                                {{ __('messages.contact_seller') }}
                            </a>
                        @endif
                    @endif

                    @can('edit', $product)
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('products.edit', $product) }}" class="flex items-center justify-center gap-2 h-12 rounded-full border-2 border-primary font-bold text-sm hover:bg-primary hover:text-[#181811] transition-colors">
                                <span class="material-symbols-outlined text-xl">edit</span>
                                {{ __('messages.edit') }}
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete') }}');" class="flex items-center justify-center">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full flex items-center justify-center gap-2 h-12 rounded-full border-2 border-red-500 text-red-500 font-bold text-sm hover:bg-red-500 hover:text-white transition-colors">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                    {{ __('messages.delete') }}
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>

        </div>

        {{-- Seller Information Section --}}
        @if($product->user && $product->user->activated)
            <section class="mt-16 pt-8 border-t border-[#f5f5f0] dark:border-white/10">
                <h2 class="text-2xl font-bold mb-6">{{ __('messages.seller_information') }}</h2>
                <div class="bg-white dark:bg-white/5 rounded-xl p-6 border border-[#f5f5f0] dark:border-white/10">
                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        {{-- Logo / Image --}}
                        <div class="shrink-0">
                            @if($product->user->logo)
                                <img 
                                    src="{{ asset('storage/' . $product->user->logo) }}" 
                                    alt="{{ $product->user->store_name }}" 
                                    class="size-20 md:size-24 rounded-xl object-cover"
                                />
                            @elseif($product->user->user_image)
                                <img 
                                    src="{{ asset('storage/' . $product->user->user_image) }}" 
                                    alt="{{ $product->user->store_name }}" 
                                    class="size-20 md:size-24 rounded-full object-cover"
                                />
                            @else
                                <div class="size-20 md:size-24 rounded-xl bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl text-gray-400">storefront</span>
                                </div>
                            @endif
                        </div>

                        {{-- Seller Details --}}
                        <div class="flex-1">
                            <h3 class="text-xl font-bold mb-2">{{ $product->user->store_name }}</h3>
                            <p class="text-[#8c8b5f] mb-4">
                                {{ $product->user->first_name }} {{ $product->user->last_name }}
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-[#8c8b5f] mb-1">{{ __('messages.phone') }}</p>
                                    <p class="text-sm">{{ $product->user->phone_number }}</p>
                                </div>

                                @if($product->user->whatsapp)
                                    <div>
                                        <p class="text-[10px] uppercase font-bold text-[#8c8b5f] mb-1">{{ __('messages.whatsapp') }}</p>
                                        <a href="https://wa.me/{{ $product->user->whatsapp }}" target="_blank" class="text-sm text-yellow-400 hover:underline">
                                            {{ $product->user->whatsapp }}
                                        </a>
                                    </div>
                                @endif

                                @if($product->user->facebook)
                                    <div>
                                        <p class="text-[10px] uppercase font-bold text-[#8c8b5f] mb-1">{{ __('messages.facebook') }}</p>
                                        <a href="{{ $product->user->facebook }}" target="_blank" class="text-sm text-yellow-400 hover:underline">
                                            {{ __('messages.view_profile') }}
                                        </a>
                                    </div>
                                @endif

                                <div>
                                    <p class="text-[10px] uppercase font-bold text-[#8c8b5f] mb-1">{{ __('messages.location') }}</p>
                                    <p class="text-sm">
                                        {{ $product->user->location }}, {{ $product->user->city }}, {{ $product->user->country }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>

    @include('partials.footer')

</body>
</html>
