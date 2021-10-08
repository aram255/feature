@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/style.css') }}">
    <link href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css" rel="stylesheet">
    <style>
        .main{
            background-color: #F6FAFE;
            width: 100%;
        }
        .blog-title {
            text-align: center;
            font: normal normal 600 40px/49px Montserrat, sans-serif;
            color: #462847;
        }
        .blog-text {
            text-align: center;
            font: normal normal 500 18px/22px Montserrat, sans-serif;
            color: #00309E;
        }

        .owl-carousel-item {
            width: 100%;
            width: 352px;
        }
        .owl-carousel-card {
            border-radius: 32px;
            z-index: 1;
        }
        .item{
            padding: 60px;
        }
        .item-blue-bg,
        .item-yellow-bg {
            position: relative;

        }
        .item-blue-bg::before {
            content: "";
            position: absolute;
            background-image: url("{{ asset('web_sayt/img/blog/blue.svg') }}");
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
            max-width: 311px;
            max-height: 334px;
            left: 80px;
            bottom: 113px;
        }
        .item-yellow-bg::after {
            content: "";
            position: absolute;
            background-image: url("{{ asset('web_sayt/img/blog/yellow.svg') }}");
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
            max-width: 336px;
            max-height: 233px;
            bottom: -45px;
            right: 54px;

        }
        .owl-carousel-title {
            font: normal normal 500 17px/20px Montserrat, sans-serif;
            color: #462847;
        }
        .owl-carousel-text {
            text-align: left;
            font: normal normal 400 14px/20px Montserrat, sans-serif;
            color: #462847;
        }
        .card-carousel .owl-theme  .owl-dots .owl-dot span {
            background: #D9EAFD;
            margin-top: 35px;
            outline: none;

        }
        .card-carousel .owl-theme  .owl-dots .owl-dot span:focus {
            box-shadow: none;
            outline: none;
        }
        .card-carousel .owl-dots.active,
        .card-carousel .owl-dots:active {
            color: #8BA9EE;
        }

        .card-carousel  .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span {
            background: #8BA9EE;
        }

        .blog-bottom-image img {
            max-width: 100%;
            max-height: 100%;
        }
        .blog-bottom-image {
            width: 100%;
            max-width: 719px;
            height: max-content;
            margin-bottom: 20px;
        }
        .blog-bottom-rightside .blog-title{
            text-align: left;
            white-space: nowrap;
        }
        .blog-bottom-rightside .blog-text {
            text-align: left;
        }
        .blog-bottom-rightside .blog-text {
            position: relative;
        }
        .blog-bottom-rightside .blog-text::before {
            content: "";
            position: absolute;
            width: 105px;
            height: 6px;
            background: #FED638 0 0 no-repeat padding-box;
            border-radius: 5px;
            bottom: -15px;
        }
        .blog-bottom-rightside .owl-carousel-text {
            max-width: 804px;
            width: 100%;
            min-height: 170px;
        }
    </style>
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')

@section('content')
    <script>var body = document.body; body.classList.add("body");</script>

<section>
    <main class="main">
        <p class="blog-title mt-5">{{$BlogText->title}}</p>
        <p class="blog-text px-4">{{$BlogText->text}}</p>
        <div class="card-carousel container container-1640 mt-5">
            <div class="owl-carousel owl-theme">

      @if(!empty($Blog) and isset($Blog))
         @foreach($Blog as $BlogInfo)

                @php
                    $array = array("owl-carousel-item item-blue-bg","owl-carousel-item","owl-carousel-item item-yellow-bg");
                    $k = array_rand($array);
                    $color = $array[$k];
                @endphp
                <div class="item">
                    <div class="@php echo $color; @endphp">
                        <div class="card owl-carousel-card">
                            <img src="{{ asset('content/'.$BlogInfo->filename.'.'.$BlogInfo->ext) }}" class="card-img-top owl-carousel-img" alt="...">
                            <div class="card-body owl-carousel-body">
                                <p class="owl-carousel-title">{{$BlogInfo->title}}</p>
                                <p class="card-text owl-carousel-text">
                                    @php echo $BlogInfo->text; @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
           @endforeach
       @endif
            </div>
        </div>
        <div class="bottom-side  container container-1640  d-flex flex-column flex-lg-row justify-content-start mt-5 p-5">
            <div class="blog-bottom-image mr-5 col-lg-6">
                <img src="{{ asset('content/'.$BlogInfo->filename.'.'.$BlogInfo->ext) }}" alt="">
            </div>
            <div class="blog-bottom-rightside px-4 col-lg-6">
                <p class="blog-title ">{{$BlogFirst->title}}</p>
                <p class="blog-text">@php echo $BlogFirst->description; @endphp</p>
                <p class="card-text owl-carousel-text mt-5">
                    @php echo $BlogFirst->text; @endphp
                </p>
            </div>

        </div>
    </main>
</section>

@endsection
@section('style')
    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
    <script src="{{ asset('web_sayt/js/script.js') }}"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            items:4,
            loop:true,
            dots:true,
            margin:18,
            autoplay:true,
            autoplayTimeout:3000,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                920: {
                    items:2
                },
                1230:{
                    items:3,

                },
                1800:{
                    items:4,
                }
            }
        });
    </script>
@endsection

