<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <title>Forgot Password</title>
</head>

<body>
    <div class="login">
        <img src="{{ asset('assets/img/login-bg.png') }}" alt="login image" class="login__img">
        <form action="{{ route('processForgotPassword') }}" class="login__form" method="POST">
            @csrf
            <h1 class="login__title">Rest Password</h1>

            <div class="login__content">
                @include('message')
                <div class="login__box">
                    <i class="ri-user-3-line login__icon"></i>

                    <div class="login__box-input">
                        <input type="text" name="email"
                            class="@error('email')
                                    is-invalid
                                @enderror login__input"
                            id="login-email" placeholder=" ">
                        <label for="login-email" class="login__label">Email</label>
                        @error('email')
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
