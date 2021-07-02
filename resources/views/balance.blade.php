@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/style.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');

        body {
            font-family: 'Noto Sans', sans-serif
        }

        .card {
            border: none;
            border-radius: 10px;
            width: 410px;
            margin: 50px 0px 50px;
            background: #462847;
        }

        .fa-ellipsis-v {
            font-size: 10px;
            color: #C2C2C4;
            margin-top: 6px;
            cursor: pointer
        }

        .text-dark {
            font-weight: bold;
            margin-top: 8px;
            font-size: 13px;
            letter-spacing: 0.5px
        }

        .card-bottom {
            background: #3E454D;
            border-radius: 6px
        }

        .flex-column {
            color: #adb5bd;
            font-size: 13px
        }

        .flex-column p {
            letter-spacing: 1px;
            font-size: 18px
        }

        .btn-secondary {
            height: 40px !important;
            margin-top: 3px
        }

        .btn-secondary:focus {
            box-shadow: none
        }
    </style>
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')
    <script>var body = document.body; body.classList.add("body");</script>

    <section>
        <div class="container">
            <div class="card ">
                <div class="card-bottom pt-3 px-3 pb-3 mb-2 d-block">
                    <div class="d-flex flex-row justify-content-between text-align-center">
                        <div class="d-flex flex-column"><span>Balance amount</span>
                            <p>AED: <span class="text-white">{{$balance ? $balance->balance : 0}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <form action="{{route('make-payment')}}" method="POST">
                    <div class="card-bottom pt-3 px-3 pb-3 mb-2 d-block">
                        <div class="d-flex flex-row justify-content-between text-align-center">
                                @CSRF
                            <div class="d-flex flex-column">
                                <select class="form-control" name="card" >
                                    @foreach($cards as $card)
                                        <option value="{{$card->id}}">**** {{$card->number}}</option>
                                    @endforeach
                                </select>
                                <input type="number" class="form-control mt-2" name="amount" min="2" value="2">
                            </div>
                            <button class="btn btn-secondary"><i class="fas fa-arrow-right text-white"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mb-4">
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger text-center">
                        <p>{{ Session::get('error') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('style')
    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web_sayt/js/script.js') }}"></script>

@endsection
