@extends('admin.layouts.app')

@section('title','Edit Advertisement')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h4>Edit Advertisement</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST"
              enctype="multipart/form-data"
              action="{{ route('admin.advertisements.update',$advertisement) }}">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Owner</label>
                <input class="form-control"
                       name="owner"
                       value="{{ $advertisement->owner }}">
            </div>

            <div class="mb-3">
                <label>Link</label>
                <input class="form-control"
                       name="link"
                       value="{{ $advertisement->link }}">
            </div>

            <div class="mb-3">
                <label>Place</label>
                <select name="place" class="form-select">
                    @foreach(['products_top','products_sidebar','products_bottom'] as $place)
                        <option value="{{ $place }}"
                            @selected($advertisement->place === $place)>
                            {{ ucfirst(str_replace('_',' ',$place)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Current Image</label><br>
                <img src="{{ asset('storage/'.$advertisement->image) }}"
                     width="150" class="rounded mb-2">
                <input type="file" name="image" class="form-control">
            </div>

            <div class="row">
                <div class="col">
                    <label>Start</label>
                    <input type="date" name="start_time"
                           class="form-control"
                           value="{{ $advertisement->start_time->format('Y-m-d') }}">
                </div>
                <div class="col">
                    <label>End</label>
                    <input type="date" name="end_time"
                           class="form-control"
                           value="{{ $advertisement->end_time->format('Y-m-d') }}">
                </div>
            </div>

            <button class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</div>
@endsection
