@extends('admin.layouts.app')

@section('title','Advertisements')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h4>Advertisements</h4>
    <a href="{{ route('admin.advertisements.create') }}" class="btn btn-primary">
        + Add Advertisement
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Owner</th>
                    <th>Place</th>
                    <th>Period</th>
                    <th>Hits</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($ads as $ad)
                <tr>
                    <td>
                        <img src="{{ asset('storage/'.$ad->image) }}"
                             width="80" class="rounded">
                    </td>
                    <td>{{ $ad->owner }}</td>
                    <td>
                        <span class="badge bg-secondary">{{ $ad->place }}</span>
                    </td>
                    <td>
                        {{ $ad->start_time->format('Y-m-d') }} →
                        {{ $ad->end_time->format('Y-m-d') }}
                    </td>
                    <td>{{ $ad->hits }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.advertisements.edit',$ad) }}"
                           class="btn btn-sm btn-outline-primary">Edit</a>

                        <form action="{{ route('admin.advertisements.destroy',$ad) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Delete ad?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3 d-flex justify-content-center">
    {{ $ads->links('pagination::bootstrap-5') }}
</div>
@endsection
