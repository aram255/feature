@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/star-rating.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/ProtocolViewAsACustomer.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .my-protocol-product-img{
            display: flex;
            align-items: center;
            border-radius: 10px;
            width: 150px;
            height: 150px;
            overflow: hidden;
            justify-content: center;
        }
        .protocol_imgg{
            width: 100%;
        }

    </style>
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')
    <script>var body = document.body; body.classList.add("body");</script>

    <main class="main mt-5">
        <div class="container">
            <h1 class="protoco ml-5">Protoco</h1>
            <div class="d-flex justify-content-between  mt-5 ">
                <div class="plan ml-5">
                    <a href="#" class="my-plan">My Plan</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="#" class="acne">{{$Services->title}}</a>
                </div>
                <div type="button" class="btn-arrow d-flex justify-content-center">
                    <i class="fas fa-arrow-down mt-3"></i>
                </div>
                <div class="duration mr-4">Duration 6 week</div>
            </div
        <div class="my-plan-background">
            <img class="load img-fluid" src="{{ asset('web_sayt/img/Group 2004.svg') }}" alt="img">
            <div class="text mt-5">5 Days left until check-in</div>
            <div class="d-flex justify-content-center align-items-center mt-5">
                <div class="content">
                    <form action="{{route('add-select-another',[app()->getLocale(),'practitioner_id' => Request::segment(5),'service_id' => Request::segment(3)])}}"  method="post">
                        @csrf
                        <div class="content-background">
                            <div class="d-block content-checkbox">
                                @foreach($ProtocolAnother as $key => $value)
                                <div class="form-group form-check mt-3">
                                    <input type="hidden" name="another_id[]" value="{{$value->id}}">
                                    <input type="checkbox" value="yes" @if($value->selected == 'yes') checked @endif class="form-check-input" name="another[]" id="exampleCheck{{$key}}">
                                    <label class="form-check-label ml-4" for="exampleCheck{{$key}}">{{$value->name}}</label>
                                </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center mt-5">
                                <button type="submit" class="follow-up-btn">Book follow-up appointment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <h6 class="heading ml-5">Heading</h6>
            <h3 class="diet ml-5 mt-5">Diet:</h3>
            <div class="d-block diet-content">
                @foreach($ProtocolHeading as $ValHeading)
                <div class="d-flex mt-3">
                    <i class="far fa-arrow-alt-circle-right mr-4"></i>
                    <div>{{$ValHeading->text_heading}}</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container">
            <h4 class="product ml-5">Product :</h4>
            <div class="d-flex justify-content-center flex-wrap mt-5 mb-5 product-items">
                @foreach($ProtocolProduct as $ValProduct)
                <div class="product-item1">
                    <div class="item1-topside d-flex justify-content-around">
                        <div class="product-image">
                            <img src="{{ asset('web_sayt/img_protocol/'.$ValProduct->img) }}" alt="img">
                        </div>
                        <div class="mt-4">{{$ValProduct->title_product}}</div>
                    </div>
                    <div class="item1-bottomside d-flex justify-content-center">
                        <input class="form-control" type="url" placeholder="{{$ValProduct->product_link}}" readonly>
                        <a href="{{$ValProduct->product_link}}"><i type="button" class="fas fa-arrow-alt-circle-right mt-2"></i></a>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
        <div class="link-background">
            <div class="container">
                <h4 class="mt-5 ml-5">Links:</h4>
                @php
                    $array = array("class='card' style='width: 18rem;'","class='card card-bottom1 mt-5' style='width: 18rem;'","class='card card-bottom2 mt-5' style='width: 18rem;'");
                    $k = array_rand($array);
                    $class = $array[$k];
                @endphp
                <div class="d-flex justify-content-around mt-5 flex-wrap align-items-center">
                    @foreach($ProtocolLink as $ValLink)
                    <div @php echo $class; @endphp>
                        <iframe class="card-img-top" width="291" height="152" src="https://www.youtube.com/embed/9uIk_91GQYI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                        <div class="card-body">
                            <h5 class="card-title">{{$ValLink->link_title}}</h5>
                            <div class="d-flex ">
                                <img src="{{ asset('web_sayt/img/youtube-icon.svg') }}" alt="">
                                <a href="{{$ValLink->link_link}}" class="btn card-btn">{{\Illuminate\Support\Str::limit($ValLink->link_link, 25)}}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>

        </div>

    </main>


@endsection

@section('style')
{{--    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('web_sayt/js/protocol.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>--}}
@endsection
