@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .protocol__section-product-cont-img{
            display: flex;
            align-items: center;
            border-radius: 10px;
            width: 150px;
            height: 150px;
            overflow: hidden;
            justify-content: center;
        }
        .upload{
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
            <div class="protocol-container">
                <div class="protocol">
                    <div class="protocol__title">
                        <p class="protocol__title-p">Protocol</p>
                    </div>
                    <div class="protocol__section">
                        <form id="protocol" action="{{route('edit-protocol',[app()->getLocale()])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Request::segment(4) }}">
                            <input type="hidden" name="service_id" value="{{ Request::segment(3) }}">

                            <div class="protocol__section-heading">
                                <div class="protocol__section-title">Heading</div>
                                <div class="protocol__section-heading-parent-text">

                                                                        @foreach($ProtocolHeading as $ValHeading)
                                    <div class="protocol__section-heading-text text_heading" id="protocol__section-heading-text0">
                                        <label for="protocol-heading-text"></label>
                                        <input type="hidden" name="id_text_heading[]" value="{{$ValHeading->id}}">
                                        <textarea class='remove_text_heading' required name='text_heading[]' rows='6' cols='100' style='resize: none;' placeholder='Pinch of Himalayan salt first thing in the morning (appetite and energy) and before and directly after EVERY meal.'>{{$ValHeading->text_heading}}</textarea>
                                    </div>
                                                                        @endforeach
                                </div>
                                <div class="protocol__section-add" id="add-text">
                                    <p>Add Another Section<span class="protocol__section-add-icon"> <img src="{{ asset('web_sayt/img/add-icon.svg') }}"
                                                                                                         alt=""></span></p>
                                </div>
                            </div>

                            <div class="protocol__section-product-link">
                                <div class="protocol__section-product">
                                    <div class="protocol__section-title">Product</div>
                                    <div class="protocol__section-product-parent-cont product">

                                   @foreach($ProtocolProduct as $ValProduct)
                                        <div class="protocol__section-product-cont product_remove" id="protocol__section-product-cont0">
                                            <div class="protocol__section-product-cont-img">
                                                <input type="file" id="img-file"  name="img[]" >
                                                <label for="img-file" class="img-file"><img class="upload"  @if($ValProduct->img != null) src="{{ asset('web_sayt/img_protocol/'.$ValProduct->img) }}" @else src="{{ asset('web_sayt/img/protocol-img.svg') }}" @endif
                                                                                             alt=""></label>
                                            </div>
                                            <input type="hidden" name="id_Product[]" value="{{$ValProduct->id}}">
                                            <div class="protocol__section-product-cont-title">
                                                <div class="protocol__section-product-cont-title-item">
                                                    <label fot="product-title" class="user-info-p">Product title:</label>
                                                    <input type="text" class="product-title" name="title_product[]" value="{{ $ValProduct->title_product }}" minlength="5" required>
                                                </div>
                                                <div class="protocol__section-product-cont-title-item">
                                                    <label fot="product-title" class="user-info-p">Brand:</label>
                                                    <input type="text" class="product-title" name="brand[]" minlength="5" value="{{ $ValProduct->brand }}" required>
                                                </div>

                                                <div class="protocol__section-product-cont-title-item">
                                                    <label fot="product-title" class="user-info-p">Dosage:</label>
                                                    <input type="text" class="product-title" name="dosage[]" minlength="5" value="{{ $ValProduct->dosage }}" required>
                                                </div>

                                                <div class="protocol__section-product-cont-title-item">
                                                    <label fot="product-title" class="user-info-p">Instructions:</label>
                                                    <input type="text" class="product-title" name="instructions[]" minlength="5" value="{{ $ValProduct->instructions }}" required>
                                                </div>

                                                <div class="protocol__section-product-cont-title-item">
                                                    <label fot="product-title" class="user-info-p">Link:</label>
                                                    <input type="text" class="product-title" name="product_link[]" value="{{ $ValProduct->product_link }}" required>
                                                </div>
                                            </div>
                                        </div>
                                                                                @endforeach
                                    </div>

                                    <div class="protocol__section-add" id="add-product">
                                        <p id="clickme" >Add Another Product<span class="protocol__section-add-icon"> <img
                                                    src="{{ asset('web_sayt/img/add-icon.svg') }}" alt=""></span></p>
                                    </div>
                                </div>
                                <div class="protocol__section-link">
                                    <div class="protocol__section-title">Link</div>
                                    <div class="protocol__section-link-parent">
                                                                                @foreach($ProtocolLink as $ValLink)
                                        <div class="protocol__section-link-cont remove_link" id="protocol__section-link-cont0">
                                            <div class="protocol__section-link-cont-title">
                                                <div class="protocol__section-link-cont-title-item">
                                                    <label fot="product-title" class="user-info-p">Name:</label>
                                                    <input type="text" class="product-title" name="link_title[]" minlength="6" value="{{ $ValLink->link_title }}" required>
                                                </div>
                                                <input type="hidden" value="{{$ValLink->id}}" name="link_id[]">
                                                <div class="protocol__section-link-cont-title-item">
                                                    <label fot="product-title" class="user-info-p">Iframe:</label>x
                                                    <input type="text" class="product-title" name="iframe[]" value="{{ $ValLink->iframe }}" required>
                                                </div>

                                                <div class="protocol__section-link-cont-title-item">
                                                    <label fot="product-title" class="user-info-p">Link:</label>
                                                    <input type="text" class="product-title" name="link_link[]" value="{{ $ValLink->link_link }}" required>
                                                </div>
                                            </div>
                                        </div>
                                                                                @endforeach
                                    </div>
                                    <div class="protocol__section-add" id="add-link">
                                        <p>Add Another Link<span class="protocol__section-add-icon"> <img src="{{ asset('web_sayt/img/add-icon.svg') }}"
                                                                                                          alt=""></span></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="protocol__section-button">
                        <input type="submit" form="protocol" class="btn bg-yellow protocol-save" value="Save">
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('style')

    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/protocol.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>


@endsection
