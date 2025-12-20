@extends('layouts.app')

@section('title', 'Create Account')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow-sm">
            <div class="card-body">

                <h3 class="text-center mb-3">Create Account</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        {{-- First Name --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   value="{{ old('first_name') }}" required>
                            @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Last Name --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   value="{{ old('last_name') }}" required>
                            @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Phone Number --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone_number"
                                   class="form-control @error('phone_number') is-invalid @enderror"
                                   value="{{ old('phone_number') }}" required>
                            @error('phone_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Store Name --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Store Name</label>
                            <input type="text" name="store_name"
                                   class="form-control @error('store_name') is-invalid @enderror"
                                   value="{{ old('store_name') }}" required>
                            @error('store_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Location --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location"
                                   class="form-control @error('location') is-invalid @enderror"
                                   value="{{ old('location') }}" required>
                            @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Country --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Country</label>
                            <input type="text" name="country"
                                   class="form-control @error('country') is-invalid @enderror"
                                   value="{{ old('country') }}" required>
                            @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- City --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city"
                                   class="form-control @error('city') is-invalid @enderror"
                                   value="{{ old('city') }}" required>
                            @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Age --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" name="age"
                                   class="form-control @error('age') is-invalid @enderror"
                                   value="{{ old('age') }}" required>
                            @error('age') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Gender --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender"
                                    class="form-select @error('gender') is-invalid @enderror"
                                    required>
                                <option value="">Select</option>
                                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- WhatsApp --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">WhatsApp</label>
                            <input type="text" name="whatsapp"
                                   class="form-control @error('whatsapp') is-invalid @enderror"
                                   value="{{ old('whatsapp') }}" required>
                            @error('whatsapp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Facebook --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Facebook URL</label>
                            <input type="text" name="facebook"
                                   class="form-control @error('facebook') is-invalid @enderror"
                                   value="{{ old('facebook') }}" required>
                            @error('facebook') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- User Image --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Profile Image</label>
                            <input type="file" name="user_image"
                                   class="form-control @error('userImage') is-invalid @enderror"
                                   required>
                            @error('user_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Logo --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Store Logo</label>
                            <input type="file" name="logo"
                                   class="form-control @error('logo') is-invalid @enderror">
                            @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Details --}}
                        <div class="col-12 mb-3">
                            <label class="form-label">Details</label>
                            <textarea name="details"
                                      class="form-control @error('details') is-invalid @enderror"
                                      rows="3">{{ old('details') }}</textarea>
                            @error('details') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Password --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                   class="form-control" required>
                        </div>

                    </div>

                    <button class="btn btn-success w-100 mt-2">Create Account</button>

                    <p class="text-center mt-3">
                        Already have an account?
                        <a href="{{ route('login') }}">Log in</a>
                    </p>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
