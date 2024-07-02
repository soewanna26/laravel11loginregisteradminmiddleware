@extends('admin.layouts.app')
@section('title', 'User Edit')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body" style="background-color: #191c24">
                <h4 class="card-title">User Edit</h4>
                <form class="forms-sample" action="{{ route('userUpdate', $user->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" value="{{ old('name', $user->name) }}"
                            class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            placeholder="Name">
                        @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" value="{{ old('email', $user->email) }}"
                            class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                            placeholder="Email">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="number" value="{{ old('mobile', $user->mobile) }}"
                            class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile"
                            placeholder="Mobile Number">
                        @error('mobile')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Password">
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Gender</label>
                        <select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                            </option>
                        </select>
                        @error('role')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="image" class="file-upload-default" accept="image/*">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                        @if (!empty($user->image))
                            <img src="{{ asset('adm/uploads/user/' . $user->image) }}" alt="" class="w-25 my-3">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a class="btn btn-dark" href="{{ route('user') }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('customJs')
    <script type="text/javascript">
        (function($) {
            'use strict';
            $(function() {
                $('.file-upload-browse').on('click', function() {
                    var file = $(this).parent().parent().parent().find('.file-upload-default');
                    file.trigger('click');
                });
                $('.file-upload-default').on('change', function() {
                    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i,
                        ''));
                });
            });
        })(jQuery);
    </script>
@endsection
