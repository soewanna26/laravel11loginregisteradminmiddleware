<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <title>Reset Password</title>
</head>

<body>
    <div class="login">
        <img src="{{ asset('assets/img/login-bg.png') }}" alt="login image" class="login__img">
        <form action="{{ route('processResetPassword') }}" class="login__form" method="POST">
            @csrf
            <h1 class="login__title">Reset Password</h1>
            <input type="hidden" name="token" value="{{ $tokenString }}">
            <div class="login__content">
                @include('message')
                <div class="login__box">
                    <i class="ri-lock-2-line login__icon"></i>

                    <div class="login__box-input">
                        <input type="password" name="new_password"
                            class="@error('new_password')
                                    is-invalid
                                @enderror login__input"
                            id="password" placeholder=" ">
                        <label for="password" class="login__label">New Password</label>
                        <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                        @error('new_password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="login__box">
                    <i class="ri-lock-2-line login__icon"></i>

                    <div class="login__box-input">
                        <input type="password" name="confirm_password"
                            class="@error('confirm_password')
                                    is-invalid
                                @enderror login__input"
                            id="confirm_password" placeholder=" ">
                        <label for="confirm_password" class="login__label">Confirm Password</label>
                        <i class="ri-eye-off-line login__eye" id="login-eye1"></i>
                        @error('confirm_password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <button class="login__button">Submit</button>
        </form>
    </div>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>
