@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    {{-- PROFILE FORM --}}
    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header fw-bold">Profile Information</div>

            <div class="card-body">
                <form method="POST"
                      action="{{ route('profile.update') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input class="form-control"
                                   name="first_name"
                                   value="{{ old('first_name', $user->first_name) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input class="form-control"
                                   name="last_name"
                                   value="{{ old('last_name', $user->last_name) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input class="form-control"
                                   name="phone_number"
                                   value="{{ old('phone_number', $user->phone_number) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">WhatsApp</label>
                            <input class="form-control"
                                   name="whatsapp"
                                   value="{{ old('whatsapp', $user->whatsapp) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Facebook</label>
                            <input class="form-control"
                                   name="facebook"
                                   value="{{ old('facebook', $user->facebook) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Store Name</label>
                            <input class="form-control"
                                   name="store_name"
                                   value="{{ old('store_name', $user->store_name) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Country</label>
                            <input class="form-control"
                                   name="country"
                                   value="{{ old('country', $user->country) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input class="form-control"
                                   name="city"
                                   value="{{ old('city', $user->city) }}">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Details</label>
                            <textarea class="form-control"
                                      rows="3"
                                      name="details">{{ old('details', $user->details) }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Store Logo</label>
                            <input type="file" class="form-control" name="logo">
                        </div>

                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- DANGER ZONE --}}
    <div class="col-lg-4">
        <div class="card border-danger shadow-sm">
            <div class="card-header bg-danger text-white fw-bold">
                Danger Zone
            </div>

            <div class="card-body">
                <p class="text-danger small">
                    Deleting your account is permanent and cannot be undone.
                </p>

                <form method="POST"
                      action="{{ route('profile.destroy') }}"
                      onsubmit="return confirm('Are you sure you want to delete your account?');">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger w-100">
                        Delete My Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
