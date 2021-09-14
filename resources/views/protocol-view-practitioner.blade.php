@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
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

    <section>
        <div class="container">
            <div class="protocol-container-view">

                <div class="protocol">

                    <div class="protocol__title">
                        <p class="protocol__title-p">Protocol</p>
                    </div>
{{--                    <div class="user-info">--}}
{{--                        <select class="fadeIn" id="country" name="country_id" onchange="location = this.value;">--}}
{{--                            <option value="" selected hidden>Choose Protocol</option>--}}
{{--                        @foreach($GetProtocol as $key => $ValProtocol)--}}
{{--                            <option value="{{route('view-protocol-practitioner',[--}}
{{--                                     app()->getLocale(),--}}
{{--                                    'user_id'      => $ValProtocol->user_id,--}}
{{--                                    'practitioner_id' => session()->get('UserID'),--}}
{{--                                    'service_id' => $ValProtocol->service_id--}}
{{--                                    ])}}" >Protocol {{$key}}</option>--}}
{{--                        @endforeach--}}
{{--                        </select>--}}

{{--                    </div>--}}
                    <div class="protocol__section">
                        <div class="protocol__section-heading">
                            <div class="protocol__section-title">Heading</div>
                            <div class="protocol__section-heading-view">
                                <div class="protocol__section-heading-view-title">
                                    Diet:
                                </div>
                                <div class="protocol__section-heading-view-text">
                                    @foreach($ProtocolHeading as $ValHeading)
                                        <div class="protocol__section-heading-view-text-cont">
                                            <div class="protocol__section-heading-view-text-cont-icon"></div>
                                            <div class="protocol__section-heading-view-text-cont-p">
                                                {{$ValHeading->text_heading}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="protocol__section-product-link-view">
                            <div class="protocol__section-product-title">Product</div>
                            <div class="protocol__section-product-view">
                                @foreach($ProtocolProduct as $ValProduct)
                                <div class="protocol__section-product-cont" id="protocol__section-product-cont0">
                                    <div class="protocol__section-product-view-cont-img my-protocol-product-img">
                                        <img src="{{ asset('web_sayt/img_protocol/'.$ValProduct->img) }}" alt="" class="protocol_imgg">
                                    </div>
                                    <div class="protocol__section-product-view-cont-title">
                                        <table class="protocol-product-table">
                                            <tbody class="protocol-product-table-tbody">
                                            <tr class="protocol-product-table-tbody-tr">
                                                <th class="protocol-product-table-tbody-tr-th">Product title:</th>
                                                <td class="protocol-product-table-tbody-tr-td">{{$ValProduct->title_product}}</td>
                                            </tr>
{{--                                            <tr>--}}
{{--                                                <th class="protocol-product-table-tbody-tr-th">Brand:</th>--}}
{{--                                                <td class="protocol-product-table-tbody-tr-td">{{$ValProduct->brand}}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <th class="protocol-product-table-tbody-tr-th">Dosage:</th>--}}
{{--                                                <td class="protocol-product-table-tbody-tr-td">{{$ValProduct->dosage}}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <th class="protocol-product-table-tbody-tr-th">Instructions:</th>--}}
{{--                                                <td class="protocol-product-table-tbody-tr-td">{{$ValProduct->instructions}}</td>--}}
{{--                                            </tr>--}}

                                            <tr>
                                                <th class="protocol-product-table-tbody-tr-th">Link:</th>
                                                <td class="protocol-product-table-tbody-tr-td">{{$ValProduct->product_link}}</td>
                                            </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="protocol__section-link-title">Link</div>
                            <div class="protocol__section-link-view">
                                @foreach($ProtocolLink as $ValLink)
                                <div class="protocol__section-link-cont-view">
                                    <div class="protocol__section-link-cont-view-item">
                                        <iframe width="291" height="152" src="{{$ValLink->link_link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        <div class="protocol__section-link-cont-view-item-text">
                                            </span><a href="{{$ValLink->link_link}}">
                                            <p class="link-text">{{$ValLink->link_title}}</p>
                                            <p class="link-url"><span class="link-icon"><img src="{{ asset('web_sayt/img/youtube-icon.svg') }}"></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection

@section('style')
    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/protocol.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>
@endsection
