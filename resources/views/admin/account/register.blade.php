<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <title>Register Form</title>
</head>

<body>
    <div class="login">
        <img src="{{ asset('assets/img/login-bg.png') }}" alt="login image" class="login__img">
        <form action="" class="login__form registrationForm" name="registrationForm" id="registrationForm">
            <h1 class="login__title">Register</h1>

            <div class="login__content">
                <div class="login__box">
                    <i class="ri-user-3-line login__icon"></i>
                    <div class="login__box-input">
                        <input type="text" name="name" class="login__input name" id="name" placeholder=" ">
                        <label for="name" class="login__label">Name</label>
                        <p></p>
                    </div>
                </div>

                <div class="login__box">
                    <i class="ri-phone-line login__icon"></i>
                    <div class="login__box-input">
                        <input type="number" name="mobile" class="login__input mobile" id="mobile" placeholder=" ">
                        <label for="mobile" class="login__label">Phone Number</label>
                        <p></p>
                    </div>
                </div>

                <div class="login__box">
                    <i class="ri-mail-line login__icon"></i>
                    <div class="login__box-input">
                        <input type="email" name="email" class="login__input email" id="email" placeholder=" ">
                        <label for="email" class="login__label">Email</label>
                        <p></p>
                    </div>
                </div>

                <div class="login__box">
                    <i class="ri-lock-2-line login__icon"></i>
                    <div class="login__box-input">
                        <input type="password" name="password" class="login__input password" id="password"
                            placeholder=" ">
                        <label for="password" class="login__label">Password</label>
                        <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                        <p></p>
                    </div>
                </div>

                <div class="login__box">
                    <i class="ri-lock-password-line login__icon"></i>
                    <div class="login__box-input">
                        <input type="password" name="confirm_password" class="login__input confirm_password"
                            id="confirm_password" placeholder=" ">
                        <label for="confirm_password" class="login__label">Confirm Password</label>
                        <i class="ri-eye-off-line login__eye" id="login-eye1"></i>
                        <p></p>
                    </div>
                </div>
            </div>

            <button class="login__button">Register</button>

            <p class="login__register">
                Have an account? <a href="{{ route('login') }}">Login</a>
            </p>
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
    <script type="text/javascript">
        $("#registrationForm").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('processRegistration') }}',
                type: 'post',
                data: $('#registrationForm').serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === false) {
                        var errors = response.errors;
                        if (errors.name) {
                            $("#name").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.name);
                        } else {
                            $("#name").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html("");
                        }

                        // Similarly handle other fields
                        if (errors.mobile) {
                            $("#mobile").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.mobile);
                        } else {
                            $("#mobile").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html("");
                        }

                        if (errors.email) {
                            $("#email").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.email);
                        } else {
                            $("#email").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html("");
                        }

                        if (errors.password) {
                            $("#password").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.password);
                        } else {
                            $("#password").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html("");
                        }

                        if (errors.confirm_password) {
                            $("#confirm_password").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.confirm_password);
                        } else {
                            $("#confirm_password").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html("");
                        }
                    } else {
                        $("#name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html("");

                        $("#mobile").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html("");

                        $("#email").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html("");

                        $("#password").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html("");

                        $("#confirm_password").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html("");
                        window.location.href='{{ route("login") }}'
                    }
                }
            })
        })
    </script>
</body>

</html>
