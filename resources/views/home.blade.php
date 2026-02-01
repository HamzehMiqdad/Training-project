<!DOCTYPE html>
<html class="light" lang="{{ app()->getLocale() }}">
<head>
    @include('partials.head-assets')
    <title>{{ __('messages.marketplace') }} - {{ __('messages.products') }}</title>
    <style type="text/tailwindcss">
        * {
            box-sizing: border-box;
        }
        
        html, body {
            overflow-x: hidden;
            max-width: 100vw;
            width: 100%;
        }
        
        body {
            font-family: "Spline Sans", sans-serif;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .category-dropdown:hover .dropdown-content {
            display: block;
        }
        .filter-checkbox {
            @apply rounded border-[#e6e6e0] dark:border-[#3a3928] text-primary focus:ring-primary;
        }
        
        /* Scroll header transition */
        header.scrolled {
            background-color: rgba(248, 248, 245, 0.98);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .dark header.scrolled {
            background-color: rgba(35, 34, 15, 0.98);
        }
        
        /* Fade in animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .animate-delay-100 {
            animation-delay: 0.1s;
            opacity: 0;
        }
        
        .animate-delay-200 {
            animation-delay: 0.2s;
            opacity: 0;
        }
        
        .animate-delay-300 {
            animation-delay: 0.3s;
            opacity: 0;
        }
        
        .product-card-item {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        /* Hero gradient animation */
        @keyframes gradientShift {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }
        
        .hero-gradient {
            background: linear-gradient(270deg, #f9f50620, #f9f50610, #f9f50620);
            background-size: 200% 200%;
            animation: gradientShift 8s ease infinite;
        }
        
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-[#181811] dark:text-[#f5f5f0] min-h-screen flex flex-col font-display">
    <div id="app-wrapper" class="w-full">
    @include('partials.header')

    {{-- Landing Hero Section (Full Width) --}}
    @if(!request()->filled('q') && !request()->filled('category') && !request()->filled('subcategory'))
        <section class="relative w-full animate-fade-in-up group" style="padding-top:0px">
            <div class="relative w-full overflow-hidden min-h-[500px] md:min-h-[600px] flex items-center justify-center bg-gradient-to-br from-primary/20 via-background-light to-background-light dark:from-primary/10 dark:via-background-dark dark:to-background-dark">
                    {{-- Background decorative elements --}}
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl -mr-48 -mt-48 group-hover:scale-150 transition-transform duration-1000"></div>
                        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -ml-48 -mb-48 group-hover:scale-150 transition-transform duration-1000"></div>
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-1000"></div>
                    </div>
                    
                    <div class="relative z-10 w-full max-w-6xl mx-auto px-4 md:px-8 lg:px-12 py-12 md:py-16 text-center">
                        <div class="mb-6 animate-delay-100 animate-fade-in-up">
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/90 dark:bg-[#32311b]/90 backdrop-blur-md text-xs md:text-sm font-bold uppercase tracking-wider rounded-full text-[#181811] dark:text-white border border-primary/20 shadow-lg">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                {{ __('messages.welcome_to_marketplace') }}
                            </span>
                        </div>
                        
                        <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black text-[#181811] dark:text-white leading-tight mb-6 animate-delay-200 animate-fade-in-up">
                            {{ __('messages.discover_shop_sell') }}
                            <span class="block text-primary mt-2">{{ __('messages.amazing_products') }}</span>
                        </h1>
                        
                        <p class="text-lg md:text-xl lg:text-2xl text-gray-700 dark:text-gray-300 font-medium max-w-3xl mx-auto mb-8 leading-relaxed animate-delay-300 animate-fade-in-up">
                            {{ __('messages.home_description') }}
                        </p>
                        
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12 animate-delay-300 animate-fade-in-up">
                            @auth
                                <a href="{{ route('products.create') }}" class="w-full sm:w-auto px-8 py-4 bg-primary hover:bg-[#d9d505] text-[#181811] font-bold rounded-full text-base md:text-lg transition-all shadow-xl shadow-primary/30 hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">add_circle</span>
                                    {{ __('messages.list_your_product') }}
                                </a>
                                <a href="#new-arrivals" class="w-full sm:w-auto px-8 py-4 bg-white dark:bg-[#32311b] hover:bg-gray-50 dark:hover:bg-[#3a3928] text-[#181811] dark:text-white font-bold rounded-full text-base md:text-lg transition-all border-2 border-[#e6e6e0] dark:border-[#3a3928] shadow-lg hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">shopping_bag</span>
                                    {{ __('messages.browse_products') }}
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-primary hover:bg-[#d9d505] text-[#181811] font-bold rounded-full text-base md:text-lg transition-all shadow-xl shadow-primary/30 hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">person_add</span>
                                    {{ __('messages.get_started') }}
                                </a>
                                <a href="#new-arrivals" class="w-full sm:w-auto px-8 py-4 bg-white dark:bg-[#32311b] hover:bg-gray-50 dark:hover:bg-[#3a3928] text-[#181811] dark:text-white font-bold rounded-full text-base md:text-lg transition-all border-2 border-[#e6e6e0] dark:border-[#3a3928] shadow-lg hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">explore</span>
                                    {{ __('messages.explore_marketplace') }}
                                </a>
                            @endauth
                        </div>
                        
                        {{-- Trust indicators --}}
                        <div class="flex flex-wrap items-center justify-center gap-6 md:gap-8 text-sm md:text-base text-gray-600 dark:text-gray-400 animate-delay-300 animate-fade-in-up">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-xl">verified</span>
                                <span>{{ __('messages.verified_sellers') }}</span>
                            </div>
                          
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-xl">local_shipping</span>
                                <span>{{ __('messages.thousands_of_products') }}</span>
                            </div>
                        </div>
                    </div>
            </div>
        </section>

                    <section class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 animate-fade-in-up w-full max-w-[1440px] mx-auto px-4 md:px-8">
                        <div class="bg-white dark:bg-[#32311b] rounded-xl p-6 md:p-8 border border-[#e6e6e0] dark:border-[#3a3928] shadow-sm hover:shadow-md transition-shadow group relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                            <div class="relative z-10">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="size-12 bg-primary/20 dark:bg-primary/30 rounded-xl flex items-center justify-center">
                                        <span class="material-symbols-outlined text-2xl text-primary">people</span>
                                    </div>
                                </div>
                                <h3 class="text-3xl md:text-4xl font-black text-[#181811] dark:text-white mb-2">
                                    <span class="counter" data-target="{{ $stats['users'] }}">0</span>
                                </h3>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('messages.active_users') }}</p>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-[#32311b] rounded-xl p-6 md:p-8 border border-[#e6e6e0] dark:border-[#3a3928] shadow-sm hover:shadow-md transition-shadow group relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                            <div class="relative z-10">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="size-12 bg-primary/20 dark:bg-primary/30 rounded-xl flex items-center justify-center">
                                        <span class="material-symbols-outlined text-2xl text-primary">inventory_2</span>
                                    </div>
                                </div>
                                <h3 class="text-3xl md:text-4xl font-black text-[#181811] dark:text-white mb-2">
                                    <span class="counter" data-target="{{ $stats['products'] }}">0</span>
                                </h3>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('messages.available_products') }}</p>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-[#32311b] rounded-xl p-6 md:p-8 border border-[#e6e6e0] dark:border-[#3a3928] shadow-sm hover:shadow-md transition-shadow group relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                            <div class="relative z-10">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="size-12 bg-primary/20 dark:bg-primary/30 rounded-xl flex items-center justify-center">
                                        <span class="material-symbols-outlined text-2xl text-primary">category</span>
                                    </div>
                                </div>
                                <h3 class="text-3xl md:text-4xl font-black text-[#181811] dark:text-white mb-2">
                                    <span class="counter" data-target="{{ $stats['categories'] }}">0</span>
                                </h3>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('messages.product_categories') }}</p>
                            </div>
                        </div>
                    </section>
                
    @endif

    {{-- Main Content --}}
    <main class="flex-grow w-full max-w-[1440px] mx-auto px-4 md:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Sidebar Filters (Desktop) --}}
            <aside id="desktopFilterSidebar" class="hidden lg:block w-64 shrink-0 transition-all duration-300" style="display: none;">
                <div class="sticky top-24 space-y-8">
                    <div class="flex items-center justify-between px-1">
                        <h2 class="text-lg font-bold flex items-center gap-2">
                            <span class="material-symbols-outlined text-xl">tune</span>
                            {{ __('messages.filters') }}
                        </h2>
                        @if(request()->filled('category') || request()->filled('subcategory'))
                            <a href="{{ route('products.index') }}" class="text-xs font-semibold text-gray-400 hover:text-primary transition-colors">{{ __('messages.clear_all') }}</a>
                        @endif
            </div>

                    <form method="GET" action="{{ route('products.index') }}" class="space-y-6">
                        @if(request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif

                        {{-- Category Filters --}}
                        @if($categories->isNotEmpty())
                            <div class="space-y-3">
                                <h3 class="text-sm font-bold uppercase tracking-wider text-gray-400 px-1">{{ __('messages.categories') }}</h3>
                                <div class="space-y-2 px-1">
                    @foreach($categories as $category)
                                        <label class="flex items-center gap-3 group cursor-pointer">
                                            <input 
                                                class="filter-checkbox" 
                                                type="radio"
                                                name="category"
                                                value="{{ $category }}"
                                                {{ request('category') == $category ? 'checked' : '' }}
                                                onchange="this.form.submit()"
                                            />
                                            <span class="text-sm font-medium text-gray-600 dark:text-gray-300 group-hover:text-[#181811] dark:group-hover:text-white transition-colors">{{ $category }}</span>
                                        </label>
                    @endforeach
                                </div>
            </div>
                        @endif

                        {{-- Subcategory Filter --}}
                        @if($subcategories->isNotEmpty())
                            <div class="space-y-3">
                                <h3 class="text-sm font-bold uppercase tracking-wider text-gray-400 px-1">{{ __('messages.subcategories') }}</h3>
                                <div class="space-y-2 px-1">
                    @foreach($subcategories as $subcategory)
                                        <label class="flex items-center gap-3 group cursor-pointer">
                                            <input 
                                                class="filter-checkbox" 
                                                type="radio"
                                                name="subcategory"
                                                value="{{ $subcategory }}"
                                                {{ request('subcategory') == $subcategory ? 'checked' : '' }}
                                                onchange="this.form.submit()"
                                            />
                                            <span class="text-sm font-medium text-gray-600 dark:text-gray-300 group-hover:text-[#181811] dark:group-hover:text-white transition-colors">{{ $subcategory }}</span>
                                        </label>
                    @endforeach
            </div>
            </div>
                        @endif
        </form>
    </div>
            </aside>

            {{-- Main Content Area --}}
            <div class="flex-1 space-y-10 min-w-0">
                {{-- Statistics Counters Section --}}
                

                {{-- Hero Section --}}
            @if(!request()->filled('q') && !request()->filled('category') && !request()->filled('subcategory'))
                    <section class="grid grid-cols-1 xl:grid-cols-12 gap-6">
                            <div class="xl:col-span-8 relative rounded-xl overflow-hidden bg-gray-100 dark:bg-[#32311b] min-h-[400px] flex items-center group animate-fade-in-up">
                                <div class="absolute inset-0 hero-gradient"></div>
                                <div class="absolute inset-0 bg-gradient-to-r from-primary/20 via-primary/10 to-transparent"></div>
                                <div class="relative z-10 p-8 md:p-12 max-w-xl flex flex-col items-start gap-4">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur text-xs font-bold uppercase tracking-wider rounded-full text-[#181811] animate-delay-100 animate-fade-in-up">{{ __('messages.welcome') }}</span>
                                    <h1 class="text-4xl md:text-5xl font-black text-[#181811] dark:text-white leading-tight animate-delay-200 animate-fade-in-up">
                                        {{ __('messages.discover_amazing_products') }}
                                    </h1>
                                    <p class="text-gray-600 dark:text-gray-300 text-base md:text-lg font-medium max-w-md animate-delay-300 animate-fade-in-up">
                                        {{ __('messages.explore_marketplace_description') }}
                                    </p>
                                </div>
                            </div>

                        {{-- Top Categories Cards --}}
                        <div class="xl:col-span-4 flex flex-col gap-6">
                            @if($topCategories->count() > 0)
                                @foreach($topCategories->take(2) as $index => $category)
                @php
                    $sampleProduct = \App\Models\Product::where('category', $category)
                                        ->where('availabe_for_sale', true)
                                        ->inRandomOrder()
                                        ->first();
                                        $bgColors = [
                                            ['bg' => 'bg-[#e3f6f5]', 'dark' => 'dark:bg-[#2d4b49]'],
                                            ['bg' => 'bg-[#fef5e7]', 'dark' => 'dark:bg-[#4a3b2a]']
                                        ];
                                        $colors = $bgColors[$index % 2];
                @endphp
                                    <div class="flex-1 rounded-xl {{ $colors['bg'] }} {{ $colors['dark'] }} p-6 flex flex-col justify-center relative overflow-hidden group">
                                        <div class="absolute right-[-20px] {{ $index % 2 == 0 ? 'bottom-[-20px]' : 'top-[-20px]' }} size-32 rounded-full bg-primary/20 blur-2xl transition-all group-hover:scale-150"></div>
                                        <div class="relative z-10">
                                            <h3 class="text-2xl font-bold mb-1 text-[#181811] dark:text-white">{{ $category }}</h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">{{ __('messages.explore_category_products', ['category' => $category]) }}</p>
                                            <a href="{{ route('products.index', ['category' => $category]) }}" class="inline-flex items-center text-sm font-bold underline decoration-2 decoration-primary underline-offset-4 hover:text-primary transition-colors">{{ __('messages.browse_category') }}</a>
                                        </div>
                            @if($sampleProduct && $sampleProduct->image)
                                            <img 
                                                alt="{{ $category }}" 
                                                class="absolute right-4 top-1/2 -translate-y-1/2 w-24 h-auto object-contain drop-shadow-xl {{ $index % 2 == 0 ? '-rotate-12' : 'rotate-12' }} transition-transform group-hover:rotate-0" 
                                                src="{{ asset('storage/' . $sampleProduct->image) }}"
                                            />
                                        @endif
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </section>

                    {{-- Top Products Section --}}
                    @if($topProducts->count() > 0)
                        <section class="space-y-6 animate-fade-in-up">
                            <div class="flex items-center justify-between px-2">
                                <h2 class="text-xl font-bold text-[#181811] dark:text-white">{{ __('messages.top_products') }}</h2>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                                @foreach($topProducts as $index => $product)
                                    <div class="product-card-item" style="animation-delay: {{ min($index * 0.1, 0.5) }}s; opacity: 0;">
                                        @include('partials.product-card-new', ['product' => $product])
                </div>
            @endforeach
        </div>
                        </section>
                    @endif

                    {{-- New Arrivals Section --}}
                    @if($newProducts->count() > 0)
                        <section id="new-arrivals" class="space-y-6 animate-fade-in-up scroll-mt-24">
                            <div class="flex items-center justify-between px-2">
                                <h2 class="text-xl font-bold text-[#181811] dark:text-white">{{ __('messages.new_arrivals') }}</h2>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                                @foreach($newProducts as $index => $product)
                                    <div class="product-card-item" style="animation-delay: {{ min($index * 0.1, 0.5) }}s; opacity: 0;">
                                        @include('partials.product-card-new', ['product' => $product])
                                    </div>
                                @endforeach
    </div>
                        </section>
                    @endif

                    {{-- Additional Home Sections: Features, How It Works, Categories Showcase, CTA --}}
                    @include('partials.home-sections')
                @endif

                {{-- Main Products Grid --}}
                <section class="space-y-6" id="all-products">
                    <div class="flex items-center justify-between px-2">
                        <h2 class="text-xl font-bold text-[#181811] dark:text-white">
                            @if(request()->filled('q') || request()->filled('category'))
                                {{ __('messages.search_results') }}
                            @else
                                {{ __('messages.all_products') }}
                            @endif
                        </h2>
                    </div>

                    @if($products->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500 dark:text-gray-400 text-lg">{{ __('messages.no_products_found') }}</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                            @foreach($products as $product)
                                @include('partials.product-card-new', ['product' => $product])
                            @endforeach
                </div>

                        {{-- Pagination --}}
                        @if($products->hasPages())
                            <div class="flex justify-center mt-12 mb-8">
                                <div class="flex items-center gap-2">
                                    {{-- Previous Page Link --}}
                                    @if ($products->onFirstPage())
                                        <span class="px-4 py-2 rounded-full border border-gray-300 dark:border-gray-600 text-gray-400 cursor-not-allowed">
                                            <span class="material-symbols-outlined">chevron_left</span>
                                        </span>
                                    @else
                                        <a href="{{ $products->previousPageUrl() }}#all-products" class="px-4 py-2 rounded-full border border-gray-300 dark:border-gray-600 font-bold text-sm text-[#181811] dark:text-white hover:bg-white dark:hover:bg-[#32311b] hover:border-primary transition-colors shadow-sm">
                                            <span class="material-symbols-outlined">chevron_left</span>
                                        </a>
                                    @endif

                                    {{-- Page Numbers - Show current and a few around it --}}
                                    @php
                                        $current = $products->currentPage();
                                        $last = $products->lastPage();
                                        $start = max(1, $current - 2);
                                        $end = min($last, $current + 2);
                                    @endphp
                                    
                                    @if($start > 1)
                                        <a href="{{ $products->url(1) }}#all-products" class="px-4 py-2 rounded-full border border-gray-300 dark:border-gray-600 font-bold text-sm text-[#181811] dark:text-white hover:bg-white dark:hover:bg-[#32311b] hover:border-primary transition-colors shadow-sm">1</a>
                                        @if($start > 2)
                                            <span class="px-2 text-gray-400">...</span>
                                        @endif
                                    @endif

                                    @for ($page = $start; $page <= $end; $page++)
                                        @if ($page == $current)
                                            <span class="px-4 py-2 rounded-full bg-primary text-[#181811] font-bold text-sm shadow-sm">{{ $page }}</span>
                                        @else
                                            <a href="{{ $products->url($page) }}#all-products" class="px-4 py-2 rounded-full border border-gray-300 dark:border-gray-600 font-bold text-sm text-[#181811] dark:text-white hover:bg-white dark:hover:bg-[#32311b] hover:border-primary transition-colors shadow-sm">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endfor

                                    @if($end < $last)
                                        @if($end < $last - 1)
                                            <span class="px-2 text-gray-400">...</span>
                                        @endif
                                        <a href="{{ $products->url($last) }}#all-products" class="px-4 py-2 rounded-full border border-gray-300 dark:border-gray-600 font-bold text-sm text-[#181811] dark:text-white hover:bg-white dark:hover:bg-[#32311b] hover:border-primary transition-colors shadow-sm pagination-link">{{ $last }}</a>
                                    @endif

                                    {{-- Next Page Link --}}
                                    @if ($products->hasMorePages())
                                        <a href="{{ $products->nextPageUrl() }}#all-products" class="px-4 py-2 rounded-full border border-gray-300 dark:border-gray-600 font-bold text-sm text-[#181811] dark:text-white hover:bg-white dark:hover:bg-[#32311b] hover:border-primary transition-colors shadow-sm pagination-link">
                                            <span class="material-symbols-outlined">chevron_right</span>
                                        </a>
                                    @else
                                        <span class="px-4 py-2 rounded-full border border-gray-300 dark:border-gray-600 text-gray-400 cursor-not-allowed">
                                            <span class="material-symbols-outlined">chevron_right</span>
                                        </span>
                                    @endif
                    </div>
                            </div>
                        @endif
                    @endif
                </section>
                </div>

            {{-- Right Sidebar Advertisement --}}
            @if($ad_sidebar)
                <aside class="hidden xl:block w-56 shrink-0">
                    <div class="sticky top-24 space-y-6">
                        <div class="w-full bg-white dark:bg-[#32311b] rounded-xl overflow-hidden border border-[#e6e6e0] dark:border-[#3a3928] group">
                            <div class="p-2 border-b border-[#e6e6e0] dark:border-[#3a3928] flex items-center justify-between">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ __('messages.sponsored') }}</span>
                                <span class="material-symbols-outlined text-sm text-gray-400">info</span>
                            </div>
                            <a href="{{ route('ads.click', $ad_sidebar) }}" target="_blank" class="block relative aspect-[2/3] overflow-hidden">
                                <img 
                                    alt="Advertisement" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                                    src="{{ asset('storage/' . $ad_sidebar->image) }}"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex flex-col justify-end p-6">
                                    <h4 class="text-xl font-bold text-white mb-2">{{ __('messages.special_offer') }}</h4>
                                    <p class="text-white/80 text-sm mb-4">{{ __('messages.check_out_featured') }}</p>
                                    <button class="w-full py-2 bg-primary text-black font-bold rounded-lg hover:bg-white transition-colors">{{ __('messages.shop_now') }}</button>
                                </div>
                            </a>
                        </div>
                    </div>
                </aside>
            @endif
        </div>
    </main>

    {{-- Bottom Advertisement --}}
    @if($ad_bottom)
        <section class="w-full max-w-[1440px] mx-auto px-4 md:px-8">
            <div class="w-full bg-white dark:bg-[#32311b] rounded-xl overflow-hidden border border-[#e6e6e0] dark:border-[#3a3928] group">
                <div class="p-2 border-b border-[#e6e6e0] dark:border-[#3a3928] flex items-center justify-between">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ __('messages.sponsored') }}</span>
                    <span class="material-symbols-outlined text-sm text-gray-400">info</span>
                </div>
                <a href="{{ route('ads.click', $ad_bottom) }}" target="_blank" class="block relative aspect-[21/4] md:aspect-[21/3] lg:aspect-[21/2.5] overflow-hidden">
                    <img 
                        alt="Advertisement" 
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                        src="{{ asset('storage/' . $ad_bottom->image) }}"
                    />
                    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent flex items-center p-4 md:p-4 lg:p-5">
                        <div class="flex items-center gap-4 md:gap-4 lg:gap-5 flex-1">
                            <div class="flex-1">
                                <h4 class="text-base md:text-lg lg:text-lg font-bold text-white mb-0.5">{{ __('messages.special_offer') }}</h4>
                                <p class="text-white/90 text-xs md:text-xs lg:text-sm">{{ __('messages.check_out_featured') }}</p>
                            </div>
                            <button class="px-3 md:px-4 lg:px-5 py-1.5 md:py-2 lg:py-2.5 bg-primary text-black font-bold text-xs md:text-sm rounded-full hover:bg-white transition-colors shadow-lg shadow-primary/30 flex items-center gap-1.5 shrink-0">
                                <span>{{ __('messages.shop_now') }}</span>
                                <span class="material-symbols-outlined text-xs md:text-sm">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    @endif

    @include('partials.footer')

    {{-- Mobile Filter Sidebar --}}
    <div id="mobileFilterSidebar" class="fixed inset-0 z-50 lg:hidden hidden">
        <div class="absolute inset-0 bg-black/50" onclick="toggleMobileFilters()"></div>
        <div class="absolute right-0 top-0 bottom-0 w-80 bg-white dark:bg-[#32311b] shadow-xl overflow-y-auto">
            <div class="sticky top-0 bg-white dark:bg-[#32311b] border-b border-[#e6e6e0] dark:border-[#3a3928] p-4 flex items-center justify-between">
                <h2 class="text-lg font-bold flex items-center gap-2 text-[#181811] dark:text-white">
                    <span class="material-symbols-outlined text-xl">tune</span>
                    {{ __('messages.filters') }}
                </h2>
                <button onclick="toggleMobileFilters()" class="size-8 flex items-center justify-center rounded-full bg-gray-100 dark:bg-[#3a3928] text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-[#4a4928] transition-colors">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>
            <div class="p-4 space-y-6">
                @if(request()->filled('category') || request()->filled('subcategory'))
                    <div class="flex justify-end">
                        <a href="{{ route('products.index') }}" class="text-xs font-semibold text-gray-400 hover:text-primary transition-colors">{{ __('messages.clear_all') }}</a>
                    </div>
                @endif
                
                <form method="GET" action="{{ route('products.index') }}" class="space-y-6">
                    @if(request('q'))
                        <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif

                    {{-- Category Filters --}}
                    @if($categories->isNotEmpty())
                        <div class="space-y-3">
                            <h3 class="text-sm font-bold uppercase tracking-wider text-gray-400 px-1">{{ __('messages.categories') }}</h3>
                            <div class="space-y-2 px-1">
                                @foreach($categories as $category)
                                    <label class="flex items-center gap-3 group cursor-pointer">
                                        <input 
                                            class="filter-checkbox" 
                                            type="radio"
                                            name="category"
                                            value="{{ $category }}"
                                            {{ request('category') == $category ? 'checked' : '' }}
                                            onchange="this.form.submit()"
                                        />
                                        <span class="text-sm font-medium text-gray-600 dark:text-gray-300 group-hover:text-[#181811] dark:group-hover:text-white transition-colors">{{ $category }}</span>
                                    </label>
                                @endforeach
            </div>
        </div>
                    @endif

                    {{-- Subcategory Filter --}}
                    @if($subcategories->isNotEmpty())
                        <div class="space-y-3">
                            <h3 class="text-sm font-bold uppercase tracking-wider text-gray-400 px-1">{{ __('messages.subcategories') }}</h3>
                            <div class="space-y-2 px-1">
                                @foreach($subcategories as $subcategory)
                                    <label class="flex items-center gap-3 group cursor-pointer">
                                        <input 
                                            class="filter-checkbox" 
                                            type="radio"
                                            name="subcategory"
                                            value="{{ $subcategory }}"
                                            {{ request('subcategory') == $subcategory ? 'checked' : '' }}
                                            onchange="this.form.submit()"
                                        />
                                        <span class="text-sm font-medium text-gray-600 dark:text-gray-300 group-hover:text-[#181811] dark:group-hover:text-white transition-colors">{{ $subcategory }}</span>
                                    </label>
                                @endforeach
                </div>
            </div>
        @endif
                </form>
            </div>
        </div>
    </div>

    {{-- Filter Toggle Button (Mobile & Desktop) --}}
    <div class="fixed bottom-8 right-8 z-40">
        <button id="filterToggleButton" onclick="toggleFilters()" aria-label="Filters" class="h-14 w-14 bg-primary text-[#181811] rounded-full shadow-xl shadow-primary/30 flex items-center justify-center hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-3xl">filter_list</span>
        </button>
        </div>

    <script>
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Intersection Observer for fade-in animations on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.querySelectorAll('.animate-fade-in-up, .animate-delay-100, .animate-delay-200, .animate-delay-300, .product-card-item').forEach(el => {
            observer.observe(el);
        });

        // Counter animation
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000; // 2 seconds
            const step = target / (duration / 16); // 60fps
            let current = 0;

            const updateCounter = () => {
                current += step;
                if (current < target) {
                    element.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target;
                }
            };

            updateCounter();
        }

        // Observe counters and animate when visible
        const counterObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                    entry.target.classList.add('counted');
                    animateCounter(entry.target);
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.counter').forEach(counter => {
            counterObserver.observe(counter);
        });

        // Smooth scroll to products section when hash is present
        function scrollToProducts() {
            if (window.location.hash === '#products-section') {
                setTimeout(() => {
                    const productsSection = document.getElementById('products-section');
                    if (productsSection) {
                        const headerOffset = 100;
                        const elementPosition = productsSection.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                }, 100);
            }
        }

        // Scroll on page load
        scrollToProducts();

        // Scroll when hash changes (for pagination navigation)
        window.addEventListener('hashchange', scrollToProducts);

        function toggleMobileFilters() {
            const sidebar = document.getElementById('mobileFilterSidebar');
            if (sidebar) {
                sidebar.classList.toggle('hidden');
            }
        }

        function toggleDesktopFilters() {
            const sidebar = document.getElementById('desktopFilterSidebar');
            
            if (sidebar) {
                if (sidebar.style.display === 'none') {
                    // Show sidebar
                    sidebar.style.display = 'block';
                } else {
                    // Hide sidebar
                    sidebar.style.display = 'none';
                }
            }
        }

        function toggleFilters() {
            // Check if we're on mobile or desktop
            if (window.innerWidth < 1024) {
                toggleMobileFilters();
            } else {
                toggleDesktopFilters();
            }
        }
    </script>
    </div>{{-- End app-wrapper --}}
</body>
</html>
