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
i
@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')
    <script>var body = document.body; body.classList.add("body");</script>

    <main class="main mt-5">
        <form id="protocol" action="{{route('add-protocol',[app()->getLocale()])}}" method="post" enctype="multipart/form-data">
        <div class="container">
            <h1 class="protoco ml-5">Protocol</h1>
                @csrf
                <input type="hidden" name="user_id" value="{{ Request::segment(4) }}">
                <input type="hidden" name="service_id" value="{{ Request::segment(3) }}">
            <input type="hidden" name="meeting_id" value="{{ Request::segment(6) }}">

            <div class="d-flex justify-content-around protoco-container flex-wrap mt-5 ">
                <div class="plan d-flex justify-content-between">
                    <div>
                        <a href="#" class="my-plan">Select Protocol</a>
                    </div>
                    <div>
                        <i class="fas fa-chevron-right mt-2"></i>
                    </div>
                    <div class="form-group ml-3">
                        <div class="dropdown">
                            <button type="button" class="form-control select-acne-box dropdown-item" id="exampleFormControlSelect1" data-toggle="dropdown">
                                Choose Protocol <i class="fas fa-chevron-down ml-2"></i>
                            </button>
                            <div class="dropdown-menu w-100">
                                @foreach($ShowProtocol as $key => $ValProtocol)

                                    <a id="{{$ValProtocol->meeting_id}}" class="dropdown-item click_a"  title="{{$ValProtocol->user_id}}" data-toggle="{{$ValProtocol->service_id}}">Protocol {{$key}}</a>
                                @endforeach
                            </div>
                        </div>
                        <i class="fas fa-chevron-down fa-chevron-down-acne"></i>
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
                <img class="load img-fluid" src="http://new-feature/web_sayt/img/protocol-img/Group 2004.svg" alt="img">
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <div class="content mt-5">
                        <div class="content-background">
                            <div class="content-background-child">
                                <input type="hidden" name="id_another[]" >
                                <div class="d-block content-input remove_another" id="protocol__section-heading-text-another0">
                                    <div class="input-group content-input-group ml-4 mb-3">
                                        <input type="text" class="form-control form-input ml-4 another_ap" name="another[]"  aria-label="Text input with checkbox">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-5" id="add-text-another" style="cursor: pointer">
                                <p class="add-section mb-3">Add Another Section</p>
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
                <div class="d-block diet-content mt-5 text_heading" id="protocol__section-heading-text0">
                    <textarea class='diet-content-paragraph heading_apend' required name='text_heading[]' rows='6' cols='100' style='resize: none;' placeholder='Pinch of Himalayan salt first thing in the morning (appetite and energy) and before and directly after EVERY meal.'></textarea>
                </div>
                <div class="d-block diet-add-section mt-5">

                </div>
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
                    <div class="product-item1 m-2 product_remove" id="protocol__section-product-cont0">
                        <div class="item1-topside d-flex justify-content-around">
                            <div class="product-image1 d-flex justify-content-center align-items-center">
                                <input style="display: none" type="file" id="img-file0"  name="img[]" >
                                <label for="img-file0" class="img-file">
                                <img  class="upload"  src="{{ asset('web_sayt/img/protocol-img/protocol-img/product-img2.svg') }}" alt="img">
                                </label>
                            </div>
                            <div class="product-brand">
                                <input class="form-control input-product-brand" type="text"  name="title_product[]" placeholder="Add Product Brand" >
                            </div>
                        </div>
                        <div class="item1-bottomside d-flex justify-content-center mt-3">
                            <input class="form-control" type="url" name="product_link[]" placeholder="www.njhpifhqw.com" >
                            <i type="button" class="fas fa-arrow-alt-circle-right mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-block product-add-section">
                <div class="d-flex protocol__section-add"  id="add-product" data-id="0">
                    <i class="fas fa-plus-circle add-section-plus mr-3"></i>
                    <p class="add-another-section" style="cursor: pointer">Add Another Section</p>
                </div>
            </div>
        </div>
        <div class="link-background">
            <div class="container">
                <h4 class="mt-5 ml-5">Link:</h4>
                <div class="d-block link-container">
                    <div class="link-name d-md-flex justify-content-md-between justify-content-center align-items-center remove_link" id="protocol__section-link-cont0">
                        <div class="mb-3 col-md-5">
                            <label for="formGroupExampleInput" class="form-label link-name-label">Name:</label>
                            <input type="text" class="form-control link-name-form" id="formGroupExampleInput" name="link_title[]">
                        </div>

                        <div class="mb-3 col-md-5 link-input">
                            <label for="formGroupExampleInput2" class="form-label link-name-label">Link:</label>
                            <input type="url" class="form-control link-name-form" id="formGroupExampleInput2" name="link_link[]">
                            <i class="fas fa-link link-input-icon"></i>
                        </div>
                    </div><br>

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
        $(document).ready(function(){
            $('#clickme').click(function () {
                g  = (Math.floor(Math.random() * (9999)))

            })
            $(".click_a").click(function(){

                 var user_id    = $(this).attr("title");
                 var service_id = $(this).attr("data-toggle");
                 var meeting_id = $(this).attr("id");

                $.ajax({
                    url : '{{ route( 'view-protocol-practitioner-ajax',[app()->getLocale()] ) }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "user_id": user_id,
                        "service_id": service_id,
                        "meeting_id": meeting_id
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(data)
                    {

                        $(".text_heading").remove();
                        $(".product_remove").remove();
                        $(".remove_link").remove();
                        $(".remove_another").remove();


                        $.each(data.ProtocolAnother, function(k_another, v_another) {

                            $('.content-background-child').append(
                         "<div class='d-block content-input remove_another' id='protocol__section-heading-text-another"+k_another+"'>"+
                                "<div class='input-group content-input-group ml-4 mb-3'>"+
                                "<input type='text' class='form-control form-input ml-4 another_ap' value='"+v_another.name+"' required name='another[]' aria-label='Text input with checkbox'>"+
                                "</div>"+
                                "</div>"
                            )
                        });

                        $.each(data.ProtocolHeading, function(k_heading, v_heading) {

                            $('.diet-content-container').append(
                            "<div class='d-block diet-content mt-5 text_heading' id='protocol__section-heading-text"+k_heading+"' >"+
                                "<textarea class='diet-content-paragraph heading_apend' required name='text_heading[]' rows='6' cols='100' style='resize: none;' placeholder='Pinch of Himalayan salt first thing in the morning (appetite and energy) and before and directly after EVERY meal.'>"+v_heading.text_heading+"</textarea>"+
                                "</div>"
                            )
                        });

                        $.each(data.ProtocolProduct, function(k_product, v_product) {


                            if(v_product.img == '')
                            {

                                    $('#clickme').click(function () {
                                var g  = (Math.floor(Math.random() * (9999)))

                            })

                         $('.product').append(
                            "<div class='product-item1 product_remove' id='protocol__section-product-cont"+k_product+"'>"+
                               " <div class='item1-topside d-flex justify-content-around'>"+
                                "<div class='product-image1 d-flex justify-content-center align-items-center'>"+
                               " <input style='display: none' type='file' id='img-file"+k_product+"'  name='img[]' >"+
                               " <label for='img-file"+k_product+"' class='img-file'>"+
                                "<img  class='upload'  src='{{ asset('web_sayt/img/protocol-img/protocol-img/product-img2.svg') }}' alt='img'>"+
                               " </label>"+
                                "</div>"+
                                "<div class='product-brand'>"+
                                "<input class='form-control input-product-brand' type='text'  name='title_product[]' value='"+v_product.title_product+"' required placeholder='Add Product Brand' >"+
                               " </div>"+
                                "<div class='item1-bottomside d-flex justify-content-center mt-3'>"+
                                "<input class='form-control' type='url' name='product_link[]' placeholder='www.njhpifhqw.com' value='"+v_product.product_link+"' required>"+
                                "<i type='button' class='fas fa-arrow-alt-circle-right mt-2'></i>"+
                                "</div>"+
                               " </div>");
                            }else{

                                $('#add-product').attr('data-id', k_product);

                                $('.productt').append(
                                    "<div class='product-item1 product_remove' id='protocol__section-product-cont"+k_product+"'>"+
                                    " <div class='item1-topside d-flex justify-content-around'>"+
                                    "<div class='product-image1 d-flex justify-content-center align-items-center'>"+
                                    " <input style='display: none' type='file' id='img-file"+k_product+"'  name='img[]' >"+
                                    " <label for='img-file"+k_product+"' class='img-file'>"+
                                    "<img  class='upload'  src='{{ asset('web_sayt/img_protocol/') }}/"+v_product.img+"' alt='img'>"+
                                    " </label>"+
                                    "</div>"+
                                    "<div class='product-brand'>"+
                                    "<input class='form-control input-product-brand' type='text'  name='title_product[]' value='"+v_product.title_product+"' required placeholder='Add Product Brand' >"+
                                    " </div>"+
                                    "<div class='item1-bottomside d-flex justify-content-center mt-3'>"+
                                    "<input class='form-control' type='url' name='product_link[]' placeholder='www.njhpifhqw.com' value='"+v_product.product_link+"' required>"+
                                    "<i type='button' class='fas fa-arrow-alt-circle-right mt-2'></i>"+
                                    "</div>"+
                                    " </div>");
                            }

                        });

                        $.each(data.ProtocolLink, function(k_link, v_link) {

                            $('.link-container').append(
                            "<div class='link-name d-md-flex justify-content-md-between justify-content-center align-items-center remove_link link_apend' id='protocol__section-link-cont"+k_link+"'>"+
                               " <div class='mb-3 col-md-5'>"+
                               " <label for='formGroupExampleInput' class='form-label link-name-label' >Name:</label>"+
                           "<input type='text' class='form-control link-name-form' id='formGroupExampleInput' name='link_title[]' value='"+v_link.link_title+"' required>"+
                             "</div>"+
                                "<div class='mb-3 col-md-5 link-input'>"+
                                "<label for='formGroupExampleInput2' class='form-label link-name-label'>Link:</label>"+
                            "<input type='url' class='form-control link-name-form' id='formGroupExampleInput2' name='link_link[]' value='"+v_link.link_link+"' required>"+
                                "<i class='fas fa-link link-input-icon'></i>"+
                                "</div>"+
                                "</div><br>"
                            );
                        });

                    },
                    error: function()
                    {
                        //handle errors
                        alert('error...');
                    }
                });
            });

        });

        let url_chek = "{{ Request::segment(2) }}"

    </script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/protocol.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>


@endsection
