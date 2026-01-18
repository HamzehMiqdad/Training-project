{{-- Footer --}}
<footer class="bg-white dark:bg-[#32311b] border-t border-[#e6e6e0] dark:border-[#3a3928] py-12 px-8">
    <div class="max-w-[1440px] mx-auto flex flex-col md:flex-row justify-between gap-12">
        <div class="max-w-md">
            <a class="flex items-center gap-2 mb-4" href="{{ route('products.index') }}">
                <div class="size-8 bg-primary rounded-lg flex items-center justify-center text-[#181811]">
                    <span class="material-symbols-outlined">storefront</span>
                </div>
                <h1 class="text-xl font-bold tracking-tight text-[#181811] dark:text-white">MarketPlace</h1>
            </a>
            <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">Your one-stop shop for everything modern and essential. High quality products curated just for you. Explore the best market items from verified sellers across the globe.</p>
        </div>
        <div class="w-full md:w-80">
            <h4 class="font-bold text-[#181811] dark:text-white mb-4">Stay Updated</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Subscribe to our newsletter for latest updates and special member-only offers.</p>
            <form class="flex gap-2">
                <input class="flex-1 h-12 px-4 rounded-full bg-gray-100 dark:bg-[#23220f] border-none text-sm outline-none focus:ring-2 focus:ring-primary/20" placeholder="Email address" type="email"/>
                <button class="size-12 shrink-0 bg-primary text-[#181811] rounded-full flex items-center justify-center hover:opacity-90 shadow-lg shadow-primary/20" type="submit">
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </button>
            </form>
        </div>
    </div>
    <div class="max-w-[1440px] mx-auto mt-12 pt-6 border-t border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row justify-between items-center text-xs text-gray-400">
        <p>© 2026 MarketPlace Inc. All rights reserved.</p>
        <div class="flex gap-4 mt-4 sm:mt-0">
            <a class="hover:text-primary" href="#">Privacy Policy</a>
            <a class="hover:text-primary" href="#">Terms of Service</a>
        </div>
    </div>
</footer>

