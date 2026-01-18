@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
<div class="flex flex-col gap-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div class="flex flex-col gap-1">
            <h1 class="text-4xl font-black tracking-tight text-[#181811] dark:text-white">Users Management</h1>
            <p class="text-base text-[#8c8b5f] dark:text-[#a1a18d]">Manage all registered users and their accounts.</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-[#e6e6db] bg-white shadow-sm dark:bg-[#32311b] dark:border-[#3a392a]">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px] table-fixed">
                <thead>
                    <tr class="border-b border-[#e6e6db] bg-[#fcfcfb] dark:bg-[#2c2b18] dark:border-[#3a392a]">
                        <th class="w-[250px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Store</th>
                        <th class="w-[250px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Email</th>
                        <th class="w-[150px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Phone</th>
                        <th class="w-[120px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Status</th>
                        <th class="w-[150px] px-6 py-4 text-right text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e6e6db] dark:divide-[#3a392a]">
                    @forelse($users as $user)
                        <tr class="group hover:bg-[#f9f506]/5 dark:hover:bg-[#f9f506]/10 transition-colors">
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.users.show', $user) }}" class="text-base font-bold text-[#181811] dark:text-white hover:text-primary transition-colors">
                                    {{ $user->store_name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-[#181811] dark:text-white">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm text-[#181811] dark:text-white">{{ $user->phone_number }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $user->activated ? 'bg-green-500/20 text-green-700 dark:text-green-400' : 'bg-red-500/20 text-red-700 dark:text-red-400' }}">
                                    {{ $user->activated ? 'Active' : 'Blocked' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.users.toggle', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="h-10 px-4 rounded-xl font-bold text-sm transition-colors {{ $user->activated ? 'bg-red-500/20 hover:bg-red-500/30 text-red-600 dark:text-red-400' : 'bg-green-500/20 hover:bg-green-500/30 text-green-600 dark:text-green-400' }} flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-lg">{{ $user->activated ? 'block' : 'check_circle' }}</span>
                                        <span>{{ $user->activated ? 'Deactivate' : 'Activate' }}</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="flex items-center justify-between border-t border-[#e6e6db] bg-[#fcfcfb] px-6 py-4 dark:bg-[#2c2b18] dark:border-[#3a392a]">
                <span class="text-sm font-medium text-[#8c8b5f] dark:text-[#a1a18d]">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users</span>
                <div class="flex items-center gap-2">
                    @if ($users->onFirstPage())
                        <span class="flex size-8 items-center justify-center rounded-full border border-[#e6e6db] text-[#8c8b5f] dark:border-[#3a392a] dark:text-[#a1a18d] cursor-not-allowed">
                            <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                        </span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="flex size-8 items-center justify-center rounded-full border border-[#e6e6db] text-[#8c8b5f] hover:bg-white hover:text-[#181811] dark:border-[#3a392a] dark:text-[#a1a18d] dark:hover:bg-[#3d3c22] transition-colors">
                            <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                        </a>
                    @endif

                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        @if ($page == $users->currentPage())
                            <span class="flex size-8 items-center justify-center rounded-full bg-primary text-sm font-bold text-[#181811]">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="flex size-8 items-center justify-center rounded-full text-sm font-medium text-[#8c8b5f] hover:bg-[#f0f0eb] dark:text-[#a1a18d] dark:hover:bg-[#3d3c22] transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="flex size-8 items-center justify-center rounded-full border border-[#e6e6db] text-[#8c8b5f] hover:bg-white hover:text-[#181811] dark:border-[#3a392a] dark:text-[#a1a18d] dark:hover:bg-[#3d3c22] transition-colors">
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
