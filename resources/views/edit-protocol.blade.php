@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('web_sayt/css/ProtocolCreate.css') }}">
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

{{--    <section>--}}
{{--        <div class="container">--}}
{{--            <div class="protocol-container">--}}
{{--                <div class="protocol">--}}
{{--                    <div class="protocol__title">--}}
{{--                        <p class="protocol__title-p">Protocol</p>--}}
{{--                    </div>--}}
{{--                    <div class="protocol__section">--}}
{{--                        <form id="protocol" action="{{route('edit-protocol',[app()->getLocale()])}}" method="post" enctype="multipart/form-data">--}}
{{--                            @csrf--}}
{{--                            <input type="hidden" name="user_id" value="{{ Request::segment(4) }}">--}}
{{--                            <input type="hidden" name="service_id" value="{{ Request::segment(3) }}">--}}

{{--                            <div class="protocol__section-heading">--}}
{{--                                <div class="protocol__section-title">Heading</div>--}}
{{--                                <div class="protocol__section-heading-parent-text">--}}

{{--                                                                        @foreach($ProtocolHeading as $ValHeading)--}}
{{--                                    <div class="protocol__section-heading-text text_heading" id="protocol__section-heading-text0">--}}
{{--                                        <label for="protocol-heading-text"></label>--}}
{{--                                        <input type="hidden" name="id_text_heading[]" value="{{$ValHeading->id}}">--}}
{{--                                        <textarea class='remove_text_heading' required name='text_heading[]' rows='6' cols='100' style='resize: none;' placeholder='Pinch of Himalayan salt first thing in the morning (appetite and energy) and before and directly after EVERY meal.'>{{$ValHeading->text_heading}}</textarea>--}}
{{--                                    </div>--}}
{{--                                                                        @endforeach--}}
{{--                                </div>--}}
{{--                                <div class="protocol__section-add" id="add-text">--}}
{{--                                    <p>Add Another Section<span class="protocol__section-add-icon"> <img src="{{ asset('web_sayt/img/add-icon.svg') }}"--}}
{{--                                                                                                         alt=""></span></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="protocol__section-product-link">--}}
{{--                                <div class="protocol__section-product">--}}
{{--                                    <div class="protocol__section-title">Product</div>--}}
{{--                                    <div class="protocol__section-product-parent-cont product">--}}

{{--                                   @foreach($ProtocolProduct as $key => $ValProduct)--}}
{{--                                        <div class="protocol__section-product-cont product_remove" id="protocol__section-product-cont{{$key}}">--}}
{{--                                            <div class="protocol__section-product-cont-img">--}}
{{--                                                <input type="file" id="img-file{{$key}}"  name="img[]" >--}}
{{--                                                <label for="img-file{{$key}}" class="img-file"><img class="upload"  @if($ValProduct->img != null) src="{{ asset('web_sayt/img_protocol/'.$ValProduct->img) }}" @else src="{{ asset('web_sayt/img/protocol-img.svg') }}" @endif--}}
{{--                                                                                             alt=""></label>--}}
{{--                                            </div>--}}
{{--                                            <input type="hidden" name="id_Product[]" value="{{$ValProduct->id}}">--}}
{{--                                            <div class="protocol__section-product-cont-title">--}}
{{--                                                <div class="protocol__section-product-cont-title-item">--}}
{{--                                                    <label fot="product-title" class="user-info-p">Product title:</label>--}}
{{--                                                    <input type="text" class="product-title" name="title_product[]" value="{{ $ValProduct->title_product }}" minlength="5" required>--}}
{{--                                                </div>--}}
{{--                                                <div class="protocol__section-product-cont-title-item">--}}
{{--                                                    <label fot="product-title" class="user-info-p">Brand:</label>--}}
{{--                                                    <input type="text" class="product-title" name="brand[]" minlength="5" value="{{ $ValProduct->brand }}" required>--}}
{{--                                                </div>--}}

{{--                                                <div class="protocol__section-product-cont-title-item">--}}
{{--                                                    <label fot="product-title" class="user-info-p">Dosage:</label>--}}
{{--                                                    <input type="text" class="product-title" name="dosage[]" minlength="5" value="{{ $ValProduct->dosage }}" required>--}}
{{--                                                </div>--}}

{{--                                                <div class="protocol__section-product-cont-title-item">--}}
{{--                                                    <label fot="product-title" class="user-info-p">Instructions:</label>--}}
{{--                                                    <input type="text" class="product-title" name="instructions[]" minlength="5" value="{{ $ValProduct->instructions }}" required>--}}
{{--                                                </div>--}}

{{--                                                <div class="protocol__section-product-cont-title-item">--}}
{{--                                                    <label fot="product-title" class="user-info-p">Link:</label>--}}
{{--                                                    <input type="text" class="product-title" name="product_link[]" value="{{ $ValProduct->product_link }}" required>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                                                                @endforeach--}}
{{--                                    </div>--}}

{{--                                    <div class="protocol__section-add" id="add-product" data-id="0">--}}
{{--                                        <p id="clickme" >Add Another Product<span class="protocol__section-add-icon"> <img--}}
{{--                                                    src="{{ asset('web_sayt/img/add-icon.svg') }}" alt=""></span></p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="protocol__section-link">--}}
{{--                                    <div class="protocol__section-title">Link</div>--}}
{{--                                    <div class="protocol__section-link-parent">--}}
{{--                                                                                @foreach($ProtocolLink as $ValLink)--}}
{{--                                        <div class="protocol__section-link-cont remove_link" id="protocol__section-link-cont0">--}}
{{--                                            <div class="protocol__section-link-cont-title">--}}
{{--                                                <div class="protocol__section-link-cont-title-item">--}}
{{--                                                    <label fot="product-title" class="user-info-p">Name:</label>--}}
{{--                                                    <input type="text" class="product-title" name="link_title[]" minlength="6" value="{{ $ValLink->link_title }}" required>--}}
{{--                                                </div>--}}
{{--                                                <input type="hidden" value="{{$ValLink->id}}" name="link_id[]">--}}
{{--                                                <div class="protocol__section-link-cont-title-item">--}}
{{--                                                    <label fot="product-title" class="user-info-p">Iframe:</label>x--}}
{{--                                                    <input type="text" class="product-title" name="iframe[]" value="{{ $ValLink->iframe }}" required>--}}
{{--                                                </div>--}}

{{--                                                <div class="protocol__section-link-cont-title-item">--}}
{{--                                                    <label fot="product-title" class="user-info-p">Link:</label>--}}
{{--                                                    <input type="text" class="product-title" name="link_link[]" value="{{ $ValLink->link_link }}" required>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                                                                @endforeach--}}
{{--                                    </div>--}}
{{--                                    <div class="protocol__section-add" id="add-link">--}}
{{--                                        <p>Add Another Link<span class="protocol__section-add-icon"> <img src="{{ asset('web_sayt/img/add-icon.svg') }}"--}}
{{--                                                                                                          alt=""></span></p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                    <div class="protocol__section-button">--}}
{{--                        <input type="submit" form="protocol" class="btn bg-yellow protocol-save" value="Save">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}



    <main class="main mt-5">
        <form id="protocol" action="{{route('edit-protocol',[app()->getLocale()])}}" method="post" enctype="multipart/form-data" method="post" >
            <div class="container">
                <h1 class="protoco ml-5">Protocol</h1>


                @csrf
                <input type="hidden" name="user_id" value="{{ Request::segment(4) }}">
                <input type="hidden" name="service_id" value="{{ Request::segment(3) }}">
                <input type="hidden" name="meeting_id" value="{{ Request::segment(6) }}">

                <div class="d-flex justify-content-around protoco-container flex-wrap mt-5 ">
                    <div class="plan d-flex justify-content-between">
                        <div>
                            <a href="#" class="my-plan">My Plan</a>
                            <i class="fas fa-chevron-right mt-2"></i>
                            {{$Service->title}}
                        </div>


                    </div>
                    <div class="btn-arrow-1">
                        <div type="button" class="btn-arrow d-flex justify-content-center">
                            <i class="fas fa-arrow-down mt-3"></i>
                        </div>
                    </div>
                    <div class="form-group duration mr-4">
                        <select class="form-control duration-select" id="exampleFormControlSelect2">
                            <option class="selected" selected>Select Duration week</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                        <i class="fas fa-chevron-down fa-chevron-down-duration"></i>
                    </div>

                </div>
            </div>
            <div class="my-plan-background">
                <img class="load img-fluid" src="{{ asset('web_sayt/img/protocol-img/Group 2004.svg') }}" alt="img" >
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <div class="content mt-5">
                        <div class="content-background" >
                          <div class="content-background-child">
                              @foreach($ProtocolAnother as $KeyAnother => $valAnother)
                                  <input type="hidden" name="id_another[]" value="{{$valAnother->id}}">
                                  <div class="d-block content-input remove_another" id="protocol__section-heading-text-another0">
                                      <div class="input-group content-input-group ml-4 mb-3">
                                          <input type="text" class="form-control form-input ml-4" name="another[]" value="{{$valAnother->name}}"  aria-label="Text input with checkbox">
                                      </div>
                                  </div>
                              @endforeach
                          </div>

                            <div class="d-flex mt-5" id="add-text-another">
                                <p class="add-section" >Add Another Section</p>
                                <i class="fas fa-plus-circle ml-4 mt-2 add-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <h6 class="heading ml-5">Heading</h6>
                <h3 class="diet ml-5 mt-5">Diet:</h3>
                <div class="diet-content-container">
                    @foreach($ProtocolHeading as $keyHeading => $ValHeading)
                    <div class="d-block diet-content mt-5 text_heading" id="protocol__section-heading-text{{$keyHeading}}">
                        <input type="hidden" name="id_text_heading[]" value="{{$ValHeading->id}}">
                        <textarea class='diet-content-paragraph' required name='text_heading[]' rows='6' cols='100' style='resize: none;' placeholder='Pinch of Himalayan salt first thing in the morning (appetite and energy) and before and directly after EVERY meal.'>{{$ValHeading->text_heading}}</textarea>
                    </div>
                    @endforeach
                    <div class="d-block diet-add-section mt-5">
                        <div class="d-flex">
                            <i class="fas fa-plus-circle add-section-plus"></i>
                            <p   class="add-another-section ml-3 protocol__section-add" id="add-text">Add Another Section</p>
                        </div>
                    </div>

                </div>


            </div>
            <div class="container">
                <h4 class="product ml-5 mt-5">Product:</h4>
                <div class="d-block product-items">
                    <div class="d-flex justify-content-center flex-wrap mt-5 mb-5 productt">
                        @foreach($ProtocolProduct as $keyProduct => $ValProduct)
                        <div class="product-item1 m-2 product_remove" id="protocol__section-product-cont{{$keyProduct}}">
                            <div class="item1-topside d-flex justify-content-around">
                                <div class="product-image1 d-flex justify-content-center align-items-center">
                                    <input class="id_Product" type="hidden" name="id_Product[]" value="{{$ValProduct->id}}">
                                    <label
                                        style="
    /*                                    width: 85px;*/
    /*height: 90px;*/
    /*position: absolute;*/
    /*top: 0;*/
    /*left: 0;*/
    /*display: flex;*/
    /*justify-content: center;*/
    /*align-items: center;*/
    /*opacity: 0;*/
" for="img-file{{$keyProduct}}" class="img-file">

                                        <input  style="display: none" type="file" id="img-file{{$keyProduct}}"  name="img[]" >
                                        <img  class="upload" @if($ValProduct->img != null) src="{{ asset('web_sayt/img_protocol/'.$ValProduct->img) }}" @else src="{{ asset('web_sayt/img/protocol-img/protocol-img/product-img2.svg') }}" @endif   alt="img">
                                    </label>

                                </div>
                                <div class="product-brand">
                                    <input class="form-control input-product-brand" type="text"  name="title_product[]" value="{{ $ValProduct->title_product }}" placeholder="Add Product Brand" >
                                </div>
                            </div>
                            <div class="item1-bottomside d-flex justify-content-center mt-3">
                                <input class="form-control" type="url" name="product_link[]" value="{{ $ValProduct->product_link }}" placeholder="www.njhpifhqw.com" >
                                <i type="button" class="fas fa-arrow-alt-circle-right mt-2"></i>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-block product-add-section " >
                    <div class="d-flex protocol__section-add"  id="add-product" data-id="{{$keyProduct}}">
                        <i class="fas fa-plus-circle add-section-plus mr-3"></i>
                        <p class="add-another-section">Add Another Section</p>
                    </div>
                </div>
            </div>
            <div class="link-background">
                <div class="container">
                    <h4 class="mt-5 ml-5">Link:</h4>
                    <div class="d-block link-container">
                        @foreach($ProtocolLink as $keyLink => $ValLink)
                        <div class="link-name d-md-flex justify-content-md-between justify-content-center align-items-center remove_link" id="protocol__section-link-cont{{$keyLink}}">
                            <div class="mb-3 col-md-5">
                                <input type="hidden" value="{{$ValLink->id}}" name="link_id[]">
                                <label for="formGroupExampleInput" class="form-label link-name-label">Name:</label>
                                <input type="text" class="form-control link-name-form" id="formGroupExampleInput" name="link_title[]" value="{{ $ValLink->link_title }}" required>
                            </div>

                            <div class="mb-3 col-md-5 link-input">
                                <label for="formGroupExampleInput2" class="form-label link-name-label">Link:</label>
                                <input type="url" class="form-control link-name-form" id="formGroupExampleInput2" value="{{ $ValLink->link_link }}" name="link_link[]">
                                <i class="fas fa-link link-input-icon"></i>
                            </div>
                        </div><br>
                        @endforeach


                        <div class="d-flex mt-5">
                            <i class="fas fa-plus-circle add-section-plus mr-3 protocol__section-add"  id="add-link"></i>
                            <p class="add-another-section">Add Another Section</p>
                        </div>
                        <div class="d-flex justify-content-center mt-5">
                            <button type="submit" class="btn link-save-btn">Save</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </main>

@endsection

@section('style')

    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/protocol.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>




@endsection
