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


            <!-- Change Pass -->
            <div class="change-pass lg-sg__form">
                <div class="lg-sg__form-text">Change Password</div>
                <form method="POST" action="{{ route('password.update',[app()->getLocale()]) }}">

                    @csrf
                    <input type="hidden" name="token" value="{{ Request::segment(3) }}">

                    <p class="lg-sg-p">E-mail</p>
                    <input type="email" class="fadeIn email" name="email" value="{{old('email') }}" autocomplete="email" autofocus required>
                    @error('email')<a style="color: red">{{ $message }}</a>@enderror
                    @if (session('error'))<a style="color: red">{{ session('error') }}</a>  @endif


                    <p class="lg-sg-p">New Password</p>
                    <input class="change-control fadeIn" id="password" name="password" type="password"autocomplete="new-password" >
                    @error('password')<p  class="lg-sg-p" style="color: red">{{ $message }}</p>@enderror
                    <img src="./img/eye.svg" alt="" toggle="#password_1" class="fa fa-fw fa-eye field-icon toggle-password">

                    <p class="lg-sg-p">Confirm New Password</p>
                    <input class="change-control fadeIn" id="password_2" name="password_confirmation" autocomplete="new-password" type="password">
                    <img src="./img/eye.svg" alt="" toggle="#password_2" class="fa fa-fw fa-eye field-icon toggle-password">



                    <div class="lg-sg__button">
                        <a><input type="submit"  class="btn bg-yellow" value="Save Password"></a>
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




