@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
<h2 class="mb-4">Users</h2>

<div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Store</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <a href="{{ route('admin.users.show', $user) }}"
                           class="fw-semibold text-decoration-none">
                            {{ $user->store_name }}
                        </a>
                    </td>

                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number }}</td>

                    <td>
                        <span class="badge {{ $user->activated ? 'bg-success' : 'bg-danger' }}">
                            {{ $user->activated ? 'Active' : 'Blocked' }}
                        </span>
                    </td>

                    <td class="text-end">
                        <form action="{{ route('admin.users.toggle', $user) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm {{ $user->activated ? 'btn-warning' : 'btn-success' }}">
                                {{ $user->activated ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>

<div class="mt-3">
    {{ $users->links('pagination::bootstrap-5') }}
</div>
@endsection
