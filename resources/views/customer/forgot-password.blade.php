<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <title>Login</title>
</head>

<body>
<section>

    <div class="container">
        <div class="lg-sg">
            <div class="lg-sg__img">
                <img src="{{ asset('web_sayt/img/Group 1613.svg') }}" alt="">
            </div>

            <!-- Forgat Pass -->
            <div>
                <div class="lg-sg__form-text">Forgot Password?</div>
                <form method="POST"  action="{{ route('password.reset',[app()->getLocale()]) }}">
                    @csrf
                    <p class="lg-sg-p">E-mail</p>
                    <input type="email" class="fadeIn email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')<a style="color: red">{{ $message }}</a>@enderror
                    @if (session('status'))<a style="color: red">{{ session('status') }}</a>  @endif
                    @if (session('success'))<a style="color: green">{{ session('success') }}</a>  @endif
{{--                    <a class="lg-sg__forgot-back " href="{{ route('login-practitioners',[app()->getLocale()]) }}">Back to login</a>--}}
                    <div class="lg-sg__button reset-pass">
                        <input type="submit"  class="btn bg-yellow" value="Reset Password">
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
<script src="{{ asset('web_sayt/js/jquery.js') }}"></script>
<script src="{{ asset('web_sayt/js/change-pass.js') }}"></script>
</body>
</html>




