{{-- Announcement Banner --}}
<div class="w-full bg-[#181811] text-white py-2 px-4 overflow-hidden relative">
    <div class="max-w-[1440px] mx-auto flex items-center justify-center gap-4 text-xs md:text-sm font-semibold tracking-wide animate-fade-in-up">
        <span class="bg-primary text-black px-2 py-0.5 rounded text-[10px] uppercase font-bold animate-pulse">Featured</span>
        <p class="flex items-center gap-2">
            <span>Special Offer: Up to 70% off on all clearance items.</span>
            <a class="underline hover:text-primary transition-colors font-bold" href="#">Shop Now</a>
        </p>
    </div>
</div>

{{-- Header --}}
<header id="mainHeader" class="sticky top-0 z-50 w-full bg-background-light/90 dark:bg-background-dark/90 backdrop-blur-md border-b border-[#e6e6e0] dark:border-[#3a3928] transition-all duration-300">
    <div class="max-w-[1440px] mx-auto px-4 md:px-8 py-3 flex items-center justify-between gap-4">
        <a class="flex items-center gap-2 group shrink-0" href="{{ route('products.index') }}">
            <div class="size-8 bg-primary rounded-lg flex items-center justify-center text-[#181811]">
                <span class="material-symbols-outlined">storefront</span>
            </div>
            <h1 class="text-xl font-bold tracking-tight text-[#181811] dark:text-white hidden sm:block">MarketPlace</h1>
        </a>
        
        <form method="GET" action="{{ route('products.index') }}" class="flex flex-1 max-w-lg mx-2 md:mx-4">
            <label class="relative flex w-full items-center">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 md:pl-4 pointer-events-none text-gray-500">
                    <span class="material-symbols-outlined text-lg md:text-xl">search</span>
                </div>
                <input 
                    name="q"
                    value="{{ request('q') }}"
                    class="w-full h-10 md:h-12 pl-10 md:pl-12 pr-3 md:pr-4 rounded-full bg-white dark:bg-[#32311b] border-2 border-transparent focus:border-primary focus:ring-0 text-sm font-medium transition-all outline-none placeholder:text-gray-400 dark:text-white" 
                    placeholder="Search..." 
                    type="text"
                />
            </label>
        </form>

        <div class="flex items-center gap-3">
            @auth
                <a href="{{ route('products.create') }}" class="hidden sm:flex h-10 px-4 items-center justify-center gap-2 rounded-full font-bold text-sm bg-white dark:bg-[#32311b] hover:bg-gray-100 dark:hover:bg-[#3d3c22] transition-colors border border-[#e6e6e0] dark:border-[#3a3928]">
                    <span class="material-symbols-outlined text-[20px]">cloud_upload</span>
                    <span class="hidden lg:inline">Upload</span>
                </a>
                <div class="relative group">
                    <button type="button" class="size-10 flex items-center justify-center rounded-full bg-primary text-[#181811] hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20 overflow-hidden border-2 border-primary">
                       
                        @if(auth()->user()->logo)
                            <img src="{{ asset('storage/' . auth()->user()->logo) }}" alt="Profile" class="size-full object-cover rounded-full"/>
                        @else
                            <span class="material-symbols-outlined text-[22px]">account_circle</span>
                        @endif
                    </button>
                    <div class="absolute right-0 top-full mt-2 w-48 bg-white dark:bg-[#32311b] rounded-xl shadow-xl border border-[#e6e6e0] dark:border-[#3a3928] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="py-2">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2 text-sm font-medium text-[#181811] dark:text-white hover:text-yellow-600 dark:hover:bg-[#3d3c22] transition-colors">
                                <span class="material-symbols-outlined text-lg">dashboard</span>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-sm font-medium text-[#181811] dark:text-white hover:text-yellow-600 dark:hover:bg-[#3d3c22] transition-colors">
                                <span class="material-symbols-outlined text-lg">person</span>
                                <span>Profile</span>
                            </a>
                            <div class="border-t border-[#e6e6e0] dark:border-[#3a3928] my-2"></div>
                            <form action="{{ route('logout') }}" method="POST" class="inline w-full">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm font-medium text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:bg-red-900/20 transition-colors">
                                    <span class="material-symbols-outlined text-lg">logout</span>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="size-10 flex items-center justify-center rounded-full bg-primary text-[#181811] hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined text-[22px]">account_circle</span>
                </a>
            @endauth
        </div>
    </div>
</header>

