{{-- resources/views/admin/advertisements/create.blade.php --}}
@extends('admin.layouts.app')

@section('title','Add Advertisement')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h4 class="mb-3">Add Advertisement</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" enctype="multipart/form-data"
              action="{{ route('admin.advertisements.store') }}">
            @csrf

            <div class="mb-3">
                <label>Owner</label>
                <input class="form-control" name="owner" required>
            </div>

            <div class="mb-3">
                <label>Link</label>
                <input class="form-control" name="link" required>
            </div>

            <div class="mb-3">
                <label>Place</label>
                <select name="place" class="form-select" required>
                    <option value="products_top">Products Top</option>
                    <option value="products_sidebar">Products Sidebar</option>
                    <option value="products_bottom">Products Bottom</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control" required>
            </div>

            <div class="row">
                <div class="col">
                    <label>Start</label>
                    <input type="date" name="start_time" class="form-control" required>
                </div>
                <div class="col">
                    <label>End</label>
                    <input type="date" name="end_time" class="form-control" required>
                </div>
            </div>

            <button class="btn btn-primary mt-3">Save</button>
        </form>
    </div>
</div>
@endsection
