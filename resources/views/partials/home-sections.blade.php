{{-- Features/Benefits Section --}}
<section class="py-12 md:py-16 animate-fade-in-up">
    <div class="text-center mb-10 px-2">
        <h2 class="text-3xl md:text-4xl font-black text-[#181811] dark:text-white mb-4">{{ __('messages.why_choose_us') }}</h2>
        <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">{{ __('messages.why_choose_description') }}</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $features = [
                [
                    'icon' => 'verified_user',
                    'title' => __('messages.verified_sellers_feature'),
                    'description' => __('messages.verified_sellers_desc')
                ],
                [
                    'icon' => 'security',
                    'title' => __('messages.secure_platform'),
                    'description' => __('messages.secure_platform_desc')
                ],
                [
                    'icon' => 'search',
                    'title' => __('messages.easy_discovery'),
                    'description' => __('messages.easy_discovery_desc')
                ],
                [
                    'icon' => 'support_agent',
                    'title' => __('messages.support_24_7'),
                    'description' => __('messages.support_24_7_desc')
                ]
            ];
        @endphp
        @foreach($features as $index => $feature)
            <div class="bg-white dark:bg-[#32311b] rounded-xl p-6 border border-[#e6e6e0] dark:border-[#3a3928] hover:shadow-lg transition-all duration-300 group relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-primary/5 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="size-14 bg-primary/20 dark:bg-primary/30 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl text-primary">{{ $feature['icon'] }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#181811] dark:text-white mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $feature['description'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- How It Works Section --}}
<section class="py-12 md:py-16 bg-gradient-to-br from-primary/10 via-transparent to-primary/5 dark:from-primary/5 dark:via-transparent dark:to-primary/5 rounded-2xl px-6 md:px-8 animate-fade-in-up">
    <div class="text-center mb-10">
        <h2 class="text-3xl md:text-4xl font-black text-[#181811] dark:text-white mb-4">{{ __('messages.how_it_works') }}</h2>
        <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">{{ __('messages.how_it_works_desc') }}</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
        @php
            $steps = [
                [
                    'number' => '01',
                    'icon' => 'person_add',
                    'title' => __('messages.create_account_step'),
                    'description' => __('messages.create_account_step_desc')
                ],
                [
                    'number' => '02',
                    'icon' => 'search',
                    'title' => __('messages.browse_search_step'),
                    'description' => __('messages.browse_search_step_desc')
                ],
                [
                    'number' => '03',
                    'icon' => 'shopping_cart',
                    'title' => __('messages.connect_buy_step'),
                    'description' => __('messages.connect_buy_step_desc')
                ]
            ];
        @endphp
        @foreach($steps as $index => $step)
            <div class="relative text-center">
                {{-- Connection Line (Desktop) --}}
                @if($index < count($steps) - 1)
                    <div class="hidden md:block absolute top-12 left-1/2 w-full h-0.5 bg-gradient-to-r from-primary/30 via-primary/50 to-transparent -z-10"></div>
                @endif
                <div class="relative bg-white dark:bg-[#32311b] rounded-2xl p-6 md:p-8 border border-[#e6e6e0] dark:border-[#3a3928] shadow-sm hover:shadow-lg transition-all duration-300 group">
                    <div class="text-5xl md:text-6xl font-black text-primary/20 dark:text-primary/10 mb-4">{{ $step['number'] }}</div>
                    <div class="size-16 bg-primary/20 dark:bg-primary/30 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl text-primary">{{ $step['icon'] }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-[#181811] dark:text-white mb-3">{{ $step['title'] }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $step['description'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- Top Categories Showcase --}}
@if(isset($topCategories) && $topCategories->count() > 2)
    @php
        $allCategories = isset($categories) ? $categories : collect([]);
        $displayedCategoryNames = $topCategories->take(8)->toArray();
        $remainingCategories = $allCategories->reject(fn($cat) => in_array($cat, $displayedCategoryNames));
        $hasMoreCategories = $remainingCategories->count() > 0;
    @endphp
    <section class="py-12 md:py-16 animate-fade-in-up">
        <div class="flex items-center justify-between mb-10 px-2">
            <div>
                <h2 class="text-3xl md:text-4xl font-black text-[#181811] dark:text-white mb-2">{{ __('messages.shop_by_category') }}</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ __('messages.explore_popular_categories') }}</p>
            </div>
            @if($hasMoreCategories)
                <button type="button" onclick="toggleAllCategories(event)" id="toggleCategoriesBtn" class="relative z-10 hidden md:flex items-center gap-2 text-sm font-bold text-primary hover:underline transition-colors cursor-pointer">
                    <span id="toggleCategoriesText">{{ __('messages.view_all') }}</span>
                    <span class="material-symbols-outlined text-lg" id="toggleCategoriesIcon">expand_more</span>
                </button>
            @endif
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6" id="categoriesGrid">
            @foreach($topCategories->take(8) as $index => $category)
                @php
                    $sampleProduct = \App\Models\Product::where('category', $category)
                        ->where('availabe_for_sale', true)
                        ->inRandomOrder()
                        ->first();
                    $bgGradients = [
                        'from-blue-100 to-purple-100 dark:from-blue-900/20 dark:to-purple-900/20',
                        'from-pink-100 to-red-100 dark:from-pink-900/20 dark:to-red-900/20',
                        'from-green-100 to-emerald-100 dark:from-green-900/20 dark:to-emerald-900/20',
                        'from-yellow-100 to-orange-100 dark:from-yellow-900/20 dark:to-orange-900/20',
                        'from-indigo-100 to-blue-100 dark:from-indigo-900/20 dark:to-blue-900/20',
                        'from-rose-100 to-pink-100 dark:from-rose-900/20 dark:to-pink-900/20',
                        'from-cyan-100 to-teal-100 dark:from-cyan-900/20 dark:to-teal-900/20',
                        'from-amber-100 to-yellow-100 dark:from-amber-900/20 dark:to-yellow-900/20',
                    ];
                    $gradient = $bgGradients[$index % count($bgGradients)];
                @endphp
                <a href="{{ route('products.index', ['category' => $category]) }}" class="category-card group relative bg-gradient-to-br {{ $gradient }} rounded-xl p-6 aspect-square flex flex-col justify-between overflow-hidden border border-white/50 dark:border-[#3a3928] hover:shadow-xl transition-all duration-300 hover:scale-105">
                    @if($sampleProduct && $sampleProduct->image)
                        <img 
                            src="{{ asset('storage/' . $sampleProduct->image) }}" 
                            alt="{{ $category }}"
                            class="absolute inset-0 w-full h-full object-cover opacity-20 group-hover:opacity-30 transition-opacity"
                        />
                    @endif
                    <div class="relative z-10">
                        <h3 class="text-lg md:text-xl font-bold text-[#181811] dark:text-white mb-2 group-hover:text-primary transition-colors">{{ $category }}</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                            @php
                                $count = \App\Models\Product::where('category', $category)->where('availabe_for_sale', true)->count();
                            @endphp
                            {{ trans_choice('messages.product_count', $count, ['count' => $count]) }}
                        </p>
                    </div>
                    <div class="relative z-10 flex items-center gap-2 text-sm font-bold text-primary opacity-0 group-hover:opacity-100 transition-opacity">
                        <span>{{ __('messages.explore') }}</span>
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </div>
                </a>
            @endforeach
            
            {{-- Additional categories (hidden by default) --}}
            @php
                $allCategories = \App\Models\Product::select('category')->distinct()->where('availabe_for_sale', true)->pluck('category');
                $displayedCategories = $topCategories->take(8)->toArray();
                $remainingCategories = $allCategories->reject(fn($cat) => in_array($cat, $displayedCategories));
            @endphp
            @if($remainingCategories->count() > 0)
                @foreach($remainingCategories as $index => $category)
                    @php
                        $sampleProduct = \App\Models\Product::where('category', $category)
                            ->where('availabe_for_sale', true)
                            ->inRandomOrder()
                            ->first();
                        $bgGradients = [
                            'from-blue-100 to-purple-100 dark:from-blue-900/20 dark:to-purple-900/20',
                            'from-pink-100 to-red-100 dark:from-pink-900/20 dark:to-red-900/20',
                            'from-green-100 to-emerald-100 dark:from-green-900/20 dark:to-emerald-900/20',
                            'from-yellow-100 to-orange-100 dark:from-yellow-900/20 dark:to-orange-900/20',
                            'from-indigo-100 to-blue-100 dark:from-indigo-900/20 dark:to-blue-900/20',
                            'from-rose-100 to-pink-100 dark:from-rose-900/20 dark:to-pink-900/20',
                            'from-cyan-100 to-teal-100 dark:from-cyan-900/20 dark:to-teal-900/20',
                            'from-amber-100 to-yellow-100 dark:from-amber-900/20 dark:to-yellow-900/20',
                        ];
                        $gradient = $bgGradients[($index + 8) % count($bgGradients)];
                    @endphp
                    <a href="{{ route('products.index', ['category' => $category]) }}" class="category-card category-card-hidden group relative bg-gradient-to-br {{ $gradient }} rounded-xl p-6 aspect-square flex flex-col justify-between overflow-hidden border border-white/50 dark:border-[#3a3928] hover:shadow-xl transition-all duration-300 hover:scale-105 hidden">
                        @if($sampleProduct && $sampleProduct->image)
                            <img 
                                src="{{ asset('storage/' . $sampleProduct->image) }}" 
                                alt="{{ $category }}"
                                class="absolute inset-0 w-full h-full object-cover opacity-20 group-hover:opacity-30 transition-opacity"
                            />
                        @endif
                        <div class="relative z-10">
                            <h3 class="text-lg md:text-xl font-bold text-[#181811] dark:text-white mb-2 group-hover:text-primary transition-colors">{{ $category }}</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                @php
                                    $count = \App\Models\Product::where('category', $category)->where('availabe_for_sale', true)->count();
                                @endphp
                                {{ trans_choice('messages.product_count', $count, ['count' => $count]) }}
                            </p>
                        </div>
                        <div class="relative z-10 flex items-center gap-2 text-sm font-bold text-primary opacity-0 group-hover:opacity-100 transition-opacity">
                            <span>{{ __('messages.explore') }}</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
        @if($remainingCategories->count() > 0)
            <div class="flex md:hidden justify-center mt-6">
                <button type="button" onclick="toggleAllCategories(event)" id="toggleCategoriesBtnMobile" class="relative z-10 flex items-center gap-2 text-sm font-bold text-primary hover:underline transition-colors cursor-pointer">
                    <span id="toggleCategoriesTextMobile">{{ __('messages.view_all_categories') }}</span>
                    <span class="material-symbols-outlined text-lg" id="toggleCategoriesIconMobile">expand_more</span>
                </button>
            </div>
        @endif
    </section>

    @if(isset($remainingCategories) && $remainingCategories->count() > 0)
        <script>
            let showAllCategories = false;
            
            function toggleAllCategories(event) {
                if (event) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                showAllCategories = !showAllCategories;
                const hiddenCards = document.querySelectorAll('.category-card-hidden');
                const toggleText = document.getElementById('toggleCategoriesText');
                const toggleTextMobile = document.getElementById('toggleCategoriesTextMobile');
                const toggleIcon = document.getElementById('toggleCategoriesIcon');
                const toggleIconMobile = document.getElementById('toggleCategoriesIconMobile');
                
                hiddenCards.forEach((card, index) => {
                    if (showAllCategories) {
                        setTimeout(() => {
                            card.classList.remove('hidden');
                            card.style.opacity = '0';
                            card.style.transform = 'translateY(20px)';
                            requestAnimationFrame(() => {
                                card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                                card.style.opacity = '1';
                                card.style.transform = 'translateY(0)';
                            });
                        }, index * 50);
                    } else {
                        card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            card.classList.add('hidden');
                        }, 300);
                    }
                });
                
                // Update button text and icon
                if (toggleText) {
                    toggleText.textContent = showAllCategories ? '{{ __('messages.show_less') }}' : '{{ __('messages.view_all') }}';
                }
                if (toggleTextMobile) {
                    toggleTextMobile.textContent = showAllCategories ? '{{ __('messages.show_less') }}' : '{{ __('messages.view_all_categories') }}';
                }
                if (toggleIcon) {
                    toggleIcon.textContent = showAllCategories ? 'expand_less' : 'expand_more';
                }
                if (toggleIconMobile) {
                    toggleIconMobile.textContent = showAllCategories ? 'expand_less' : 'expand_more';
                }
            }
        </script>
    @endif
@endif

{{-- CTA Section --}}
<section class="py-12 md:py-16 relative rounded-2xl overflow-hidden animate-fade-in-up">
    <div class="absolute inset-0 bg-gradient-to-br from-primary/20 via-primary/10 to-transparent dark:from-primary/10 dark:via-primary/5"></div>
    <div class="absolute inset-0">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -ml-48 -mb-48"></div>
    </div>
    <div class="relative z-10 text-center max-w-3xl mx-auto px-4">
        <div class="mb-6">
            <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/90 dark:bg-[#32311b]/90 backdrop-blur-md text-xs font-bold uppercase tracking-wider rounded-full text-[#181811] dark:text-white border border-primary/20">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                {{ __('messages.join_today') }}
            </span>
        </div>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#181811] dark:text-white mb-4 leading-tight">
            {{ __('messages.ready_to_start') }}
        </h2>
        <p class="text-lg md:text-xl text-gray-700 dark:text-gray-300 mb-8 leading-relaxed">
            {{ __('messages.cta_description') }}
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            @auth
                <a href="{{ route('products.create') }}" class="w-full sm:w-auto px-8 py-4 bg-primary hover:bg-[#d9d505] text-[#181811] font-bold rounded-full text-base md:text-lg transition-all shadow-xl shadow-primary/30 hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">add_circle</span>
                    {{ __('messages.list_your_product') }}
                </a>
            @else
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-primary hover:bg-[#d9d505] text-[#181811] font-bold rounded-full text-base md:text-lg transition-all shadow-xl shadow-primary/30 hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">person_add</span>
                    {{ __('messages.get_started_free') }}
                </a>
            @endauth
            <a href="#new-arrivals" class="w-full sm:w-auto px-8 py-4 bg-white dark:bg-[#32311b] hover:bg-gray-50 dark:hover:bg-[#3a3928] text-[#181811] dark:text-white font-bold rounded-full text-base md:text-lg transition-all border-2 border-[#e6e6e0] dark:border-[#3a3928] shadow-lg hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">explore</span>
                {{ __('messages.browse_products') }}
            </a>
        </div>
    </div>
</section>

