@extends('admin.layouts.app')

@section('title', __('messages.advertisements'))

@section('content')
<div class="flex flex-col gap-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div class="flex flex-col gap-1">
            <h1 class="text-4xl font-black tracking-tight text-[#181811] dark:text-white">{{ __('messages.advertisements') }}</h1>
            <p class="text-base text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.manage_advertisements') }}</p>
        </div>
        <a href="{{ route('admin.advertisements.create') }}" class="flex h-12 items-center justify-center gap-2 rounded-full bg-primary px-6 text-sm font-bold text-[#181811] shadow-lg shadow-primary/20 hover:brightness-105 transition-all">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span>{{ __('messages.add_advertisement') }}</span>
        </a>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-[#e6e6db] bg-white shadow-sm dark:bg-[#32311b] dark:border-[#3a392a]">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] table-fixed">
                <thead>
                    <tr class="border-b border-[#e6e6db] bg-[#fcfcfb] dark:bg-[#2c2b18] dark:border-[#3a392a]">
                        <th class="w-[150px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.image') }}</th>
                        <th class="w-[200px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.owner') }}</th>
                        <th class="w-[150px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.place') }}</th>
                        <th class="w-[250px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.period') }}</th>
                        <th class="w-[100px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.hits') }}</th>
                        <th class="w-[150px] px-6 py-4 text-right text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e6e6db] dark:divide-[#3a392a]">
                    @forelse($ads as $ad)
                        <tr class="group hover:bg-[#f9f506]/5 dark:hover:bg-[#f9f506]/10 transition-colors">
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/'.$ad->image) }}" alt="Advertisement" class="size-20 rounded-xl object-cover border border-[#e6e6db] dark:border-[#3a392a]"/>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-[#181811] dark:text-white">{{ $ad->owner }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-primary/20 text-[#181811] dark:text-primary">
                                    {{ ucfirst(str_replace('_', ' ', $ad->place)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-[#181811] dark:text-white">
                                <div class="flex flex-col">
                                    <span>{{ $ad->start_time->format('M d, Y') }}</span>
                                    <span class="text-[#8c8b5f] dark:text-[#a1a18d] text-xs">→ {{ $ad->end_time->format('M d, Y') }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-[#181811] dark:text-white">{{ number_format($ad->hits) }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.advertisements.edit', $ad) }}" class="flex size-8 items-center justify-center rounded-full bg-[#f8f8f5] text-[#181811] hover:bg-primary transition-colors dark:bg-[#2c2b18] dark:text-white" title="{{ __('messages.edit') }}">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </a>
                                    <form action="{{ route('admin.advertisements.destroy', $ad) }}" method="POST" onsubmit="return confirm('{{ __('messages.delete_ad_confirm') }}');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex size-8 items-center justify-center rounded-full bg-[#f8f8f5] text-[#181811] hover:bg-red-100 hover:text-red-600 transition-colors dark:bg-[#2c2b18] dark:text-white" title="{{ __('messages.delete') }}">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">{{ __('messages.no_ads') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($ads->hasPages())
            <div class="flex items-center justify-between border-t border-[#e6e6db] bg-[#fcfcfb] px-6 py-4 dark:bg-[#2c2b18] dark:border-[#3a392a]">
                <span class="text-sm font-medium text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.showing_ads', ['first' => $ads->firstItem(), 'last' => $ads->lastItem(), 'total' => $ads->total()]) }}</span>
                <div class="flex items-center gap-2">
                    @if ($ads->onFirstPage())
                        <span class="flex size-8 items-center justify-center rounded-full border border-[#e6e6db] text-[#8c8b5f] dark:border-[#3a392a] dark:text-[#a1a18d] cursor-not-allowed">
                            <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                        </span>
                    @else
                        <a href="{{ $ads->previousPageUrl() }}" class="flex size-8 items-center justify-center rounded-full border border-[#e6e6db] text-[#8c8b5f] hover:bg-white hover:text-[#181811] dark:border-[#3a392a] dark:text-[#a1a18d] dark:hover:bg-[#3d3c22] transition-colors">
                            <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                        </a>
                    @endif

                    @foreach ($ads->getUrlRange(1, $ads->lastPage()) as $page => $url)
                        @if ($page == $ads->currentPage())
                            <span class="flex size-8 items-center justify-center rounded-full bg-primary text-sm font-bold text-[#181811]">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="flex size-8 items-center justify-center rounded-full text-sm font-medium text-[#8c8b5f] hover:bg-[#f0f0eb] dark:text-[#a1a18d] dark:hover:bg-[#3d3c22] transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($ads->hasMorePages())
                        <a href="{{ $ads->nextPageUrl() }}" class="flex size-8 items-center justify-center rounded-full border border-[#e6e6db] text-[#8c8b5f] hover:bg-white hover:text-[#181811] dark:border-[#3a392a] dark:text-[#a1a18d] dark:hover:bg-[#3d3c22] transition-colors">
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </a>
                    @else
                        <span class="flex size-8 items-center justify-center rounded-full border border-[#e6e6db] text-[#8c8b5f] dark:border-[#3a392a] dark:text-[#a1a18d] cursor-not-allowed">
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
