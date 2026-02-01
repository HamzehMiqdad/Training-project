<div class="relative group">
    <button type="button" class="size-10 flex items-center justify-center rounded-full bg-white dark:bg-[#32311b] hover:bg-gray-100 dark:hover:bg-[#3d3c22] transition-colors border border-[#e6e6e0] dark:border-[#3a3928]">
        <span class="material-symbols-outlined text-lg text-[#181811] dark:text-white">language</span>
    </button>
    <div class="absolute right-0 top-full mt-2 w-40 bg-white dark:bg-[#32311b] rounded-xl shadow-xl border border-[#e6e6e0] dark:border-[#3a3928] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
        <div class="py-2">
            <a href="{{ route('language.switch', 'en') }}" class="flex items-center gap-3 px-4 py-2 text-sm font-medium text-[#181811] dark:text-white hover:bg-gray-100 dark:hover:bg-[#3d3c22] transition-colors {{ app()->getLocale() === 'en' ? 'bg-primary/10' : '' }}">
                <span class="text-lg">🇬🇧</span>
                <span>{{ __('messages.english') }}</span>
                @if(app()->getLocale() === 'en')
                    <span class="material-symbols-outlined text-sm ml-auto">check</span>
                @endif
            </a>
            <a href="{{ route('language.switch', 'ar') }}" class="flex items-center gap-3 px-4 py-2 text-sm font-medium text-[#181811] dark:text-white hover:bg-gray-100 dark:hover:bg-[#3d3c22] transition-colors {{ app()->getLocale() === 'ar' ? 'bg-primary/10' : '' }}">
                <span class="text-lg">🇸🇦</span>
                <span>{{ __('messages.arabic') }}</span>
                @if(app()->getLocale() === 'ar')
                    <span class="material-symbols-outlined text-sm ml-auto">check</span>
                @endif
            </a>
        </div>
    </div>
</div>

