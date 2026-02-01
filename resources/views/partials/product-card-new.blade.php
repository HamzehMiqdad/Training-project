<div class="group flex flex-col bg-white dark:bg-[#32311b] rounded-xl p-3 border border-transparent hover:border-[#e6e6e0] dark:hover:border-[#3a3928] hover:shadow-xl transition-all duration-300">
    <a href="{{ route('products.show', $product) }}" class="block">
        <div class="relative w-full aspect-[4/3] rounded-lg overflow-hidden bg-gray-100 dark:bg-black/20 mb-3">
            @if($product->image)
                <img 
                    alt="{{ $product->name }}" 
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                    src="{{ asset('storage/' . $product->image) }}"
                />
            @else
                <div class="w-full h-full flex items-center justify-center bg-gray-200 dark:bg-gray-700">
                    <span class="material-symbols-outlined text-gray-400 text-4xl">image</span>
                </div>
            @endif
            
          
            
            @if(!$product->availabe_for_sale)
                <div class="absolute inset-0 bg-[#181811]/60 flex items-center justify-center">
                    <span class="px-4 py-2 bg-red-500 text-white font-bold text-xs uppercase tracking-widest rounded-full">{{ __('messages.out_of_stock') }}</span>
                </div>
            @elseif($product->hits > 100)
                <div class="absolute inset-0 bg-blue-500/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="px-4 py-2 bg-white text-blue-600 font-bold text-xs uppercase tracking-widest rounded-full">{{ __('messages.popular') }}</span>
                </div>
            @endif
        </div>
        
        <div class="flex flex-col gap-1 px-1">
            <h3 class="text-base font-bold text-[#181811] dark:text-white line-clamp-1 group-hover:text-primary transition-colors">{{ $product->name }}</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $product->category }} @if($product->subcategory) &gt; {{ $product->subcategory }} @endif</p>
            <div class="flex items-center justify-between mt-2">
                @if($product->price)
                    <p class="text-lg font-bold text-[#181811] dark:text-white">{{ number_format($product->price) }} SYP</p>
                @else
                    <p class="text-lg font-bold text-gray-400">{{ __('messages.price_on_request') }}</p>
                @endif
                <a href="{{ route('products.show', $product) }}" class="px-3 py-1 bg-black text-white dark:bg-white dark:text-black rounded-full text-xs font-bold hover:bg-primary hover:text-black transition-colors">
                    {{ __('messages.details') }}
                </a>
            </div>
        </div>
    </a>
</div>

