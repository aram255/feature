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
                                          <input type="text" class="form-control form-input ml-4 another_ap" name="another[]" value="{{$valAnother->name}}"  aria-label="Text input with checkbox">
                                      </div>
                                  </div>
                              @endforeach
                          </div>

                            <div class="d-flex mt-5" id="add-text-another">
                                <p class="add-section" style="cursor: pointer" >Add Another Section</p>
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
                        <input type="hidden" class="headingg" value="{{$keyHeading}}">
                        <input type="hidden" name="id_text_heading[]" value="{{$ValHeading->id}}">
                        <textarea class='diet-content-paragraph' required name='text_heading[]' rows='6' cols='100' style='resize: none;' placeholder='Pinch of Himalayan salt first thing in the morning (appetite and energy) and before and directly after EVERY meal.'>{{$ValHeading->text_heading}}</textarea>
                    </div>
                    @endforeach
                </div>
                <div class="d-block diet-add-section mt-5">
                    <div class="d-flex">
                        <i class="fas fa-plus-circle add-section-plus"></i>
                        <p   class="add-another-section ml-3 protocol__section-add" id="add-text" style="cursor: pointer">Add Another Section</p>
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
                                    <label style=" position: relative; cursor: pointer;" for="img-file{{$keyProduct}}" class="img-file">
                                        <input  style="opacity: 0; position:absolute;" type="file" id="img-file{{$keyProduct}}"  name="img[]" >
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
                        <p class="add-another-section" style="cursor: pointer">Add Another Section</p>
                    </div>
                </div>
            </div>
            <div class="link-background">
                <div class="container">
                    <h4 class="mt-5 ml-5">Link:</h4>
                    <div class="d-block link-container">
                        @foreach($ProtocolLink as $keyLink => $ValLink)
                            <input type="hidden" class="linkk"  value="{{$keyLink}}">
                        <div class="link-name mb-3 d-md-flex justify-content-md-between justify-content-center align-items-center remove_link" id="protocol__section-link-cont{{$keyLink}}">
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
                    </div>
                    <div class="d-flex mt-5 col-6 mx-auto">
                        <i class="fas fa-plus-circle add-section-plus mr-3 protocol__section-add"  id="add-link"></i>
                        <p class="add-another-section" style="cursor: pointer">Add Another Section</p>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <button type="submit" class="btn link-save-btn">Save</button>
                    </div>
                </div>

            </div>
        </form>
    </main>

@endsection

@section('style')
    <script>
        var url_chek= "{{ Request::segment(2) }}";

    </script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/protocol.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>


@endsection
