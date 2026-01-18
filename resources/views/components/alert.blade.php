@props(['type' => 'success', 'dismissible' => false])

@php
$styles = [
    'success' => 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800 text-green-600 dark:text-green-400',
    'error' => 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800 text-red-600 dark:text-red-400',
    'warning' => 'bg-yellow-50 dark:bg-yellow-900/20 border-yellow-200 dark:border-yellow-800 text-yellow-600 dark:text-yellow-400',
    'info' => 'bg-blue-50 dark:bg-blue-900/20 border-blue-200 dark:border-blue-800 text-blue-600 dark:text-blue-400',
];
$style = $styles[$type] ?? $styles['success'];
@endphp

<div x-data="{ show: true }" 
     x-show="show" 
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="p-4 rounded-xl border {{ $style }} {{ $attributes->get('class') }}">
    <div class="flex items-start gap-3">
        <div class="flex-1">
            {{ $slot }}
        </div>
        @if($dismissible)
            <button @click="show = false" 
                    class="shrink-0 text-current opacity-70 hover:opacity-100 transition-opacity"
                    aria-label="Dismiss">
                <span class="material-symbols-outlined text-lg">close</span>
            </button>
        @endif
    </div>
</div>

