{{-- @extends('app.layouts.dashboard')
@section('content')

<div class="container">
     <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">Reset Password</div>

               <div class="card-body">
                    @if (session('status'))
                         <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <form method="POST" action="{{ route('forget-password',[app()->getLocale()]) }}">
                        @csrf
                          <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                   <div class="form-group row mb-0">
                         <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection --}}


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
                    <form method="POST" action="{{ route('forget-password-practitioners',[app()->getLocale()]) }}">
                       @csrf
                        <p class="lg-sg-p">E-mail</p>
                        <input type="email" class="fadeIn email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                         @error('email')<a style="color: red">{{ $message }}</a>@enderror
                        @if (session('status'))<a style="color: red">{{ session('status') }}</a>  @endif
                        @if (session('success'))<a style="color: green">{{ session('success') }}</a>  @endif
                        <a class="lg-sg__forgot-back " href="{{ route('login-practitioners',[app()->getLocale()]) }}">Back to again</a>
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




