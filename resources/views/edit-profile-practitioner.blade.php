@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl-carousel-min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/star-rating.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link href="{{ asset('web_sayt/css/tagger.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/multiSelect.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/service.css') }}">
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')


    <section class="edit-profile-section">
        <form method="post" action="{{route('edit-profile-practitioner-post',[app()->getLocale()])}}" enctype="multipart/form-data">
            @csrf
        <div class="container">
            <div class="profile-edit-flex">
                <div >
                    <p> <img src="@if(empty($Practitioners->img)){{ asset('web_sayt/img/add.svg') }}@else{{ asset('web_sayt/img/remove.svg') }}@endif">@if(empty($Practitioners->img)) Add Photo @else

                        <a href="{{route('delete-photo-video',[app()->getLocale(),1])}}">Remove Photo</a>

                        @endif</p>

                    <div class="edit-profile__contact-img">
                        <input type="file" id="img-file" name="img">
                        <label for="img-file">
                            <img class="upload" src="@if(empty($Practitioners->img)){{asset('web_sayt/img/img-file.svg')}}@else{{ asset('web_sayt/img_practitioners/'.$Practitioners->img)}} @endif" alt="">
                        </label>
                    </div>
                </div>
                <div class="add-photo-edit">
{{--                    <input  type="file" id="img-file" name="video">--}}

                    <p class="position-relative">

                        <img src="@if(empty($Practitioners->video)){{ asset('web_sayt/img/add.svg') }}@else{{ asset('web_sayt/img/remove.svg') }}@endif">@if(empty($Practitioners->video))
                            Add Video  <input id="file-input" type="file" accept="video/*" style="position: absolute; left: 0; opacity: 0">
                        @else

{{--                            style="background:white;font-weight:unset;color: #00309e;"--}}
                            <a href="{{route('delete-photo-video',[app()->getLocale(),2])}}">Remove Video</a>
                        @endif</p>

                    <div class="edit-profile__contact-img edit-profile__contact-video">
                        <input  type="file" id="video-file">
                        <label for="video-file">
{{--                            <img src="{{ asset('web_sayt/img/video-file.svg') }}" alt="" width="40">--}}
                            <video id="video" width="200" height="200" ></video>
                        </label>
                    </div>











                </div>
            </div>
            <div class="edit-profile">
                <div class="edit-profile__contact">
                    <div class="edit-profile-info ml-0">
                        <div class="create__form pt-0">
{{--                            <form action="#" id="auth" method="POST">--}}
                                <div class="form-info">
                                    <div class="user-info odd">
                                        <p class="user-info-p">First Name</p>
                                        <input autocomplete="off" type="text" id="firsName" class="fadeIn" value="{{$Practitioners->first_name}}" name="first_name">
                                    </div>
                                    <div class="user-info">
                                        <p class="user-info-p">Last Name</p>
                                        <input autocomplete="off" type="text" class="fadeIn" value="{{$Practitioners->last_name}}" name="last_name">
                                    </div>
                                    <br>
                                    <div class="user-info odd">
                                        <p class="user-info-p">E-mail</p>
                                        <input autocomplete="off" type="email" id="email" class="fadeIn" value="{{$Practitioners->email}}" name="email">
                                    </div>
                                    <div class="user-info">
                                        <p class="user-info-p">Phone Number</p>
                                        <input type="tel" id="phone" class="fadeIn" value="{{$Practitioners->phone_number}}" name="phone_number" >
                                    </div>
                                    <br>
                                    <div class="user-info create__checkbox">
                                        <p>Gender</p>
                                        <input type="radio"  {{ ($Practitioners->gender=="Male")? "checked" : "" }} name="gender" id="Male" value="Male" class="lg-sg__checkin"><label
                                            for="Male" style="margin-left:10px;font-size:15px;">Male</label>
                                        <input type="radio" {{ ($Practitioners->gender=="Famale")? "checked" : "" }} name="gender" id="Female" value="Famale" class="lg-sg__checkin"><label
                                            for="Female" style="margin-left:10px;font-size:15px;">Female</label>
                                        <input type="radio" {{ ($Practitioners->gender=="Other")? "checked" : "" }} name="gender" id="Other"  value="Other" class="lg-sg__checkin"><label
                                            for="Other" style="margin-left:10px;font-size:15px;">Other</label>
                                    </div>
                                    <br>
                                    <div class="user-info odd">
                                        <p class="user-info-p">Current Password</p>
                                        <input autocomplete="off" type="password" class="fadeIn" name="password">
                                    </div>
                                    <div class="user-info odd">
                                        <p class="user-info-p">New Password</p>
                                        <input autocomplete="off" type="password"  class="fadeIn" name="new_password">
                                    </div>
                                    <br>

                                    <div class="user-info odd">
                                        <p class="user-info-p">Confirm New Password</p>
                                        <input autocomplete="off" type="password" id="password" class="fadeIn" name="conf_password" >
                                    </div>
                                    <div class="user-info odd">
                                        <p class="create-p">Language</p>
{{--                                        <select class="fadeIn" name="language" id="state">--}}
{{--                                            <option value="select-sanguage">Select Language</option>--}}
{{--                                            <option value="English">English</option>--}}
{{--                                        </select>--}}


                                                <select id="choices-multiple-remove-button2" class="fadeIn form-control choices__input is-hidden" name="lang[]" multiple="" tabindex="-1" aria-hidden="true" data-choice="active">
                                                    {{--  List of added Tags--}}
                                                    @foreach($Lang as  $GetLang)
                                                        <option class="delete_teg" value="{{$GetLang->id}}" @if($GetLang->selected == 1) selected="" @endif>{{$GetLang->title}}</option>
                                                    @endforeach

                                                </select>


                                    </div>
                                     <div class="lg-sg__button mob_save">
                                        <input type="submit"  class="btn bg-yellow" value="Save">
                                    </div>
                                </div>
{{--                            </form>--}}
                        </div>
                    </div>
                </div>

                <div class="edit-profile__other mt-0">
                    <div class="d-flex">
                        <div class="user-info odd">
                            <p class="user-info-p" style="margin-bottom:15px">Insurance coverage</p>
{{--                            <input type="text" id="coverage" class="fadeIn" name="coverage">--}}
                            <input type="radio" {{ ($Practitioners->insurance=="Yes")? "checked" : "" }}  name="insurance" id="yes" value="Yes" class="lg-sg__checkin"><label
                                for="yes" style="margin-left:6px;">Yes</label>
                            <input type="radio" {{ ($Practitioners->insurance=="No")? "checked" : "" }} name="insurance" id="No" value="No" class="lg-sg__checkin" style="margin-left:33px;"><label style="margin-left:6px;"
                                for="No">No</label>
                        </div>
                        <div class="user-info">
                            <p class="user-info-p ml-4">Cases and specializations</p>

                            <div class="input-group ml-auto mb-3" style="max-width: 340px;margin-left:21px !important;">
                                <input autocomplete="off" id="add_new_tag" type="text" class="fadeIn" style="width: 85%" placeholder="Select" aria-label="Select" aria-describedby="basic-addon2">
                                <div class="input-group-append ml-auto">
                                    <button class="btn px-3 text-white fs-18" style="border-radius: 5px; background-color: #8ba9ee" type="button" id="add_new_tag_submit">+</button>
                                </div>
                            </div>

                            <div class="">

                                <div class="" style="margin-left:21px;">
                                    <div class="choices" data-type="select-multiple" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" dir="ltr">
                                            <select id="choices-multiple-remove-button" class="form-control choices__input is-hidden" multiple="" tabindex="-1" aria-hidden="true" data-choice="active">
                                                {{--  List of added Tags--}}
                                                @foreach($MyTagManagements as $ind => $GetTagManagements)
                                                    <option class="delete_teg" value="{{$GetTagManagements->id}}" @if($GetTagManagements->selected == 1) selected="" @endif>{{$GetTagManagements->name}}</option>
                                                @endforeach

                                            </select>
                                     </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="user-info-about mb-4">
                        <p class="user-info-p">About me</p>
                        <textarea class="fadeIn" name="description" rows="6" cols="100" style="resize: none;">{{$Practitioners->description}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg-sg__button but_web">
            <input type="submit"  class="btn bg-yellow" value="Save">
        </div>

     </form>
        <div class="container">
            <div>
                <form role="form" action="{{ route('add-card-practitioner') }}" method="post" class="stripe-payment"
                      data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                      id="stripe-payment">
                    @csrf

                    <div class="user-info odd">
                        <p class="user-info-p">Card Number<span>*</span></p>
                        <input autocomplete="off" type="text"  class="fadeIn card-num" name="card_number" value="{{$Practitioners->card_number ?? ''}}">
                        @if(!empty($Practitioners->card_number))
                        <button class="btn px-4 text-white fs-18" style="border-radius: 5px; background-color: #8ba9ee; height: 46px;" type="button" id="add_new_tag_submit">
                            <a style="color: white;" href="{{route('remove-card-practitioner',[app()->getLocale()])}}">X</a></button>
                        @endif
                        @if($errors->has('card_number'))
                            <span class="text-danger d-block" role="alert">
                               <strong>{{ $errors->first('card_number') }}</strong>
                        </span>
                            @enderror
                            @if($message = Session::get('success'))
                                <span class="text-success d-block" role="alert">
                               <strong>{{ $message }}</strong>
                        </span>
                            @endif
                    </div>
                    <br>
                    <div class="add-card-edit-link">
                        <button type="submit" class="bg-yellow br-10 px-4 py-2 fs-16">Add </button>

                    </div>

                </form>
            </div>
        </div>

    </section>

    <section>
        <div class="service mt-5 py-5 container container-1640">
            <h2 class="text-center">My Services</h2>
            <h4 class="text-uppercase text-center">ONE ON ONE PROGRAMS</h4>
            <div class=" flex-column flex-lg-row mt-5 d-flex ">
                <div class="col-lg-4 px-lg-5 mb-4">
                    <div class="bg-light p-5 br-10">
                        <h4 class="text-center mb-5">Add New Plan</h4>
                        <form action="{{route('add-service',[app()->getLocale()])}}" method="post" class="mb-5">
                            @csrf
                            <div class="form-group">
                                <label for="ConsultationName">Consultation Name</label>
                                <input autocomplete="off" type="text" class="form-control" id="ConsultationName" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="Price">Price</label>
                                <input type="number" class="form-control" id="Price" name="price" required>
                            </div>
                            <div class="form-group" >
                                <label for="Description">Add Description</label>
                                <input autocomplete="off" type="text" class="form-control mb-3" name="description[]" id="Description" required>
                            </div>
                            <div class="form-group"  id="Bdescription">
                                <div class="d-flex align-items-center" role="button">
                                    <img src="{{ asset('web_sayt/img/add.svg') }}" alt="" width="28" height="28" class="mr-2">Add Description
                                </div>
                            </div>
                            <div class="scrollable-space"></div>
                            <div class="form-group" >
                                <div class="d-flex align-items-center" role="button"  id="Bsessions">
                                    <img src="{{ asset('web_sayt/img/add.svg') }}" alt="" width="28" height="28" class="mr-2">Add Sessions
                                </div>
                            </div>
                            <div class="scrollable-space1"></div>
                            <div class="form-group" >
                                <label for="SessionTitle">Session Title</label>
                                <input autocomplete="off" type="text" class="form-control mb-3" name="sessiont_title[]"  id="SSession" required>
                            </div>
                            <button class="bg-yellow br-10 px-4 py-2 fs-16">Save Plan</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="">

                        <!-- 1 -->

                        <div class="profile-practitioner__consultation-carusel-block">
                            <div id="customer-testimonals" class="owl-carousel owl-theme owl-loaded owl-drag">

                              @foreach($Service as $Value)

                                    @php
                                        $array = array("item scrl light-green","item light-yellow");
                                        $k = array_rand($array);
                                        $color = $array[$k];
                                    @endphp

                                    <form action="{{route('edit-service',[app()->getLocale()])}}" method="post">
                                        @csrf
                                        <input type="hidden" name="serveice_id" value="{{$Value->id}}">
                                <div class="@php echo $color; @endphp">
                                    <div class="abs">
                                        <i class="fas fa-pen mr-3 edit_form1"></i>
                                        <a class="remove_service_id" id="{{$Value->id}}" ><i class="fas fa-times delete"></i></a>

                                    </div>
                                    <div class="d-flex flex-column align-items-center">
                                        <h4  class="mb-3 edit_f">{{$Value->title}}</h4>
                                        <div class="d-flex flex-column mx-auto align-items-center mb-3 italic-text">
                                            @foreach($ServiceSession as $valS)
                                                @foreach($valS as $valSS)
                                                    @if($valSS->services_id == $Value->id)
                                                        <span class="edit edit_f{{$valSS->id}}">{{$valSS->sessions}}</span>
                                                        <input type="hidden" name="sessions_id[]" value="{{$valSS->id}}">
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="price d-flex flex-column align-items-center mb-3">
                                        <div class="d-flex">
                                            <span class="">$</span> <span class="edit_price">{{$Value->price}}</span>
                                        </div>
                                        <small>USD plus HST</small>
                                    </div>
                                    <ul class="list-unstyled px-5 overflow-auto">
                                        @foreach($ServiceDescription as $valD)
                                            @foreach($valD as $valDD)
                                                @if($valDD->services_id == $Value->id)
                                                    <li><i class="fas fa-angle-right mr-2" ></i> <span class="edit edit_description{{$valDD->id}}">{{$valDD->description}}</span></li>
                                                    <input type="hidden" name="description_id[]" value="{{$valDD->id}}">
                                                @endif
                                            @endforeach
                                        @endforeach

                                            </ul>
                                            <button class="bg-yellow br-10 px-4 py-2 fs-16 mt-4 save">Save</button>
                                        </div>
                                    </form>
{{--                                    <script>--}}
{{--                                        $('.removeee').on('click',function () {--}}

{{--                                            if (confirm("2555 Are you sure you want to remove it?")) {--}}
{{--                                                $(this).attr("href", "http://www.google.com/")--}}
{{--                                            }--}}
{{--                                        })--}}

{{--                                    </script>--}}
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

            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="{{ asset('web_sayt/js/star-rating.js') }}"></script>
            <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>
            <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('web_sayt/js/owl.carousel.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('web_sayt/js/carusel.js') }}"></script>
{{--            <script src="{{ asset('web_sayt/js/filter.js') }}"></script>--}}
            <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>
{{--            <script type="text/javascript" src="{{ asset('web_sayt/js/slidebar.js') }}"></script>--}}

            <script>
                $(document).ready(function(){
                    $(function() {
                    $('.remove_service_id').on('click',function () {

                        if (confirm("Are you sure you want to remove it?")) {

                            var DeleteIDS = $(this).attr('id');
                            var _token = $('input[name="_token"]').val();
                            var th = $(this);

                            $.ajax({
                                url: "{{route('delete-service',[app()->getLocale()])}}",
                                type: "POST",
                                data: {
                                    DeleteIDS: DeleteIDS,
                                    _token:_token
                                },
                                success: function (data) {
                                   return location.href = window.location.href;
                                },
                                error: function(returnval) {
                                    alert('The service was not removed.');
                                }
                            });
                        }
                    });




                    $('.edit_form1').on('click', function(i) {

                        // Disable too click
                        var $btn = $(this);
                        var count = ($btn.data("click_count") || 0) + 1;
                        $btn.data("click_count", count);
                        if ( count == 1 ){

                         var div = $(this);
                         // Show Save button
                         div.parent().next().next().next().next('.save').css("display", "block");

                         var tb = div.find('input:text');//get textbox, if exist
                         if (tb.length) {//text box already exist
                             div.text(tb.val());//remove text box & put its current value as text to the div

                         } else {
                             tb1 = $('<input>').prop({
                                 'type': 'text',
                                 'class': 'form-control',
                                 'name': 'title',
                                 'value': div.parent().next().find('.edit_f').text()//set text box value from div current text
                             });
                             div.parent(".abs").next().find('.edit_f').empty().append(tb1);//add new text box
                             tb1.focus();//put text box on focus

                             var price = $('<input>').prop({
                                 'type': 'text',
                                 'class': 'form-control',
                                 'name': 'price',
                                 'value': div.parent().next().next().find('.edit_price').text()//set text box value from div current text
                             });
                             div.parent(".abs").next().next().find('.edit_price').empty().append(price);//add new text box
                             price.focus();//put text box on focus


                             // Session
                                 @foreach($Service as $Valu)
                                 @foreach($ServiceSession as $valSs)
                                 @foreach($valSs as $valSSS)
                                 @if($valSSS->services_id == $Valu->id)

                             var tbs{{$valSSS->id}} = ".edit_f{{$valSSS->id}}";
                             var cl{{$valSSS->id}} = ".edit_f{{$valSSS->id}}";


                             tbs{{$valSSS->id}} = $('<input>').prop({
                                 'type': 'text',
                                 'class': 'form-control',
                                 'name': 'session[]',
                                 'value': div.parent().next().children().find(cl{{$valSSS->id}}).text()//set text box value from div current text
                             });

                             div.parent(".abs").next().find(cl{{$valSSS->id}}).empty().append(tbs{{$valSSS->id}});//add new text box
                             tbs{{$valSSS->id}}.focus();//put text box on focus
                             @endif
                             @endforeach
                             @endforeach


                             // Description
                                 @foreach($ServiceDescription as $valD)
                                 @foreach($valD as $valDD)
                                 @if($valDD->services_id == $Valu->id)

                             var tbd{{$valDD->id}} = ".edit_description{{$valDD->id}}";
                             var clas{{$valDD->id}} = ".edit_description{{$valDD->id}}";


                             tbd{{$valDD->id}} = $('<input>').prop({
                                 'type': 'text',
                                 'class': 'form-control',
                                 'name': 'description[]',
                                 'value': div.parent(".abs").next().next().next().children().find(clas{{$valDD->id}}).text()//set text box value from div current text
                             });


                             div.parent(".abs").next().next().next().children().find(clas{{$valDD->id}}).empty().append(tbd{{$valDD->id}});
                             tbd{{$valDD->id}}.focus();//put text box on focus
                             @endif
                             @endforeach
                             @endforeach
                             @endforeach


                         }
                        }


                    });
                });


                    $("#rightMenu").click(function(){
                        $(".right-sidebar").addClass("active");
                    });

                    $("#close-right-sidebar").click(function() {
                        $(".right-sidebar").removeClass("active");
                    });
                });

                $('[data-toggle="popover"]').popover();


                // Clone Add New Plan

                $("#Bdescription").click(function() {
                    var x = $("#Description"),
                        y = x.clone();
                    x.attr("class", "mb-3 form-control");
                    y.insertAfter("#Bdescription");
                    var scrollableSpace = $ (".scrollable-space")
                    $( scrollableSpace ).append( y );
                });

                $("#Bsessions").click(function() {
                    var a = $("#SSession"),
                        b = a.clone();
                    a.attr("class", "mb-3 form-control");
                    b.insertAfter("#Bsessions");
                    var scrollableSpace1 = $ (".scrollable-space1")
                    $( scrollableSpace1 ).append( b );
                });


            </script>
            <script src="{{ asset('web_sayt/js/tagger.js') }}"></script>

            <script>
                var t1 = tagger(document.querySelector('#country_name'), {
                    allow_duplicates: false,
                    allow_spaces: true,
                    add_on_blur: true,
                    completion: {list: []}
                });

                </script>

            <script>
                $(document).ready(function() {
                    $(document).on('#country_name', 'click', function () {
                        alert('asd');
                    })
                });
            </script>

            {{--   Multiselect  option--}}
            <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
            <script>
                $(document).ready(function(){

                    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                        removeItemButton: true,
                        searchResultLimit:5,
                        renderChoiceLimit:5,

                    });

                    var multipleCancelButton1 = new Choices('#choices-multiple-remove-button1', {
                        removeItemButton: true,
                        searchResultLimit:5,
                        renderChoiceLimit:5,
                    });

                    var multipleCancelButton2 = new Choices('#choices-multiple-remove-button2', {
                        removeItemButton: true,
                        searchResultLimit:5,
                        renderChoiceLimit:5,
                    });


                    // lang Add
                    multipleCancelButton2.passedElement.element.addEventListener(
                        'addItem',
                        function(event) {

                            var _token = $('input[name="_token"]').val();

                            $.ajax({
                                url: "{{route('add-lang-practitioner',[app()->getLocale()])}}",
                                type: "POST",
                                data: {
                                    lang_id: event.detail.value,
                                    _token:_token
                                },
                                success: function (data) {
                                    console.log(data)
                                    alert("The language you selected has been added.");
                                },
                                error: function(returnval) {
                                    alert('The language you selected has not been added.');
                                }
                            });
                        },
                        false,
                    );

                    // lang remove
                    multipleCancelButton2.passedElement.element.addEventListener(
                        'removeItem',
                        function(event) {

                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: "{{route('delete-lang-practitioner',[app()->getLocale()])}}",
                                type: "POST",
                                data: {
                                    lang_id: event.detail.value,
                                    _token:_token
                                },
                                success: function (data) {
                                    console.log(data)
                                    alert("Your specified language removed.");
                                },
                                error: function(returnval) {
                                    alert('The language you specified was not removed.');
                                }
                            });

                        },
                        false,
                    );



                    // Teg
                    multipleCancelButton.passedElement.element.addEventListener(
                        'removeItem',
                        function(event) {
                            // console.log('removeItem');
                            // do something creative here...
                            //console.log(event.detail.id);
                             console.log(event.detail.value);
                            // console.log(event.detail.label);
                            // console.log(event.detail.customProperties);
                            // console.log(event.detail.groupValue);
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: "{{route('delete-tag-management',[app()->getLocale()])}}",
                                type: "POST",
                                data: {
                                    teg_managements_id: event.detail.value,
                                    _token:_token
                                },
                                success: function (data) {
                                    console.log(data)
                                    alert("Your tag has been removed.");
                                },
                                error: function(returnval) {
                                    alert('Your tag has not been removed.');
                                }
                            });
                        },
                        false,
                    );

                    multipleCancelButton.passedElement.element.addEventListener(
                        'addItem',
                        function(event) {
                          //  console.log('add');
                            // do something creative here...
                           // console.log(event.detail.id);
                            console.log(event.detail.value);
                            // console.log(event.detail.label);
                            // console.log(event.detail.customProperties);
                            // console.log(event.detail.groupValue);
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: "{{route('add-tag-my-list-management',[app()->getLocale()])}}",
                                type: "POST",
                                data: {
                                    teg_managements_id: event.detail.value,
                                    _token:_token
                                },
                                success: function (data) {
                                    console.log(data)
                                    alert("The tag you selected has been added to your list.");
                                },
                                error: function(returnval) {
                                    alert('The tag you selected has not been added to your list, or it has already been added.');
                                }
                            });
                        },
                        false,
                    );


                    // add new tag
                    $('#add_new_tag_submit').on('click',function () {

                        var add_teg = $("#add_new_tag").val();

                                var _token = $('input[name="_token"]').val();
                                $.ajax({
                                    url:"{{route('add-tag-management',[app()->getLocale()])}}",
                                    method:"POST",
                                    data:{add_teg:add_teg, _token:_token},
                                    success:function(data){
                                            alert('The tag you entered has been added.')
                                    },error: function (error) {
                                        if(error.status == 500)
                                        {
                                            alert('The tag you entered was not entered, or it currently exists.')
                                        }
                                    }
                                });

                    })
                });

            </script>


            <script>
                const input = document.getElementById('file-input');
                const video = document.getElementById('video');
                const videoSource = document.createElement('source');

                input.addEventListener('change', function() {
                    const files = this.files || [];

                    if (!files.length) return;

                    const reader = new FileReader();

                    reader.onload = function (e) {
                        videoSource.setAttribute('src', e.target.result);
                        video.appendChild(videoSource);
                        video.load();
                        video.play();
                    };

                    reader.onprogress = function (e) {
                        console.log('progress: ', Math.round((e.loaded * 100) / e.total));
                    };

                    reader.readAsDataURL(files[0]);
                });
            </script>

@endsection
