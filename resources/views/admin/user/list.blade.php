@extends('admin.layouts.app')
@section('title', 'User')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body" style="background-color: #191c24">
                @include('message')
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="card-title" style="margin: 0;">User</h4>
                    <a href="{{ route('userCreate') }}" style="text-decoration: none;">Add User</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Role</th>
                                <th>Created At</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody style="color: #6c7293">
                            @if ($users->isNotEmpty())
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        @if ($user->image != '')
                                            <img src="{{ asset('adm/uploads/user/' . $user->image) }}" alt="User Image"
                                                style="width: 50px;height: 50px;" class="card-img-top">
                                        @else
                                            <img src="https://placehold.co/150x150?text=No Image" alt="No Image"
                                                style="width: 50px;height: 50px;" class="card-img-top">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td> {{ \Carbon\Carbon::parse($user->created_at)->format('d M,Y') }} </td>
                                    <td>
                                        <a href="{{ route('userEdit', $user->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('userDelete', $user->id) }}"
                                            onclick="return confirm('Are you sure you want to delete {{ $user->name }}?')"
                                            class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="mt-2">
                        @if ($users->isNotEmpty())
                        {{ $users->links() }}
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
