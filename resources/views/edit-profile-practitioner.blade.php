@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl-carousel-min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/star-rating.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/service.css') }}">
    <link href="{{ asset('web_sayt/css/tagger.css')}}" rel="stylesheet">
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')


    <section class="edit-profile-section">
        <div class="container">
            <div class="profile-edit-flex">
                <div >
                    <p> <img src="{{ asset('web_sayt/img/add.svg') }}">Add Photo</p>

                    <div class="edit-profile__contact-img">
                        <input type="file" id="img-file" name="img-file">
                        <label for="img-file"><img class="upload" src="{{ asset('web_sayt/img/img-file.svg') }}" alt=""></label>
                    </div>
                </div>
                <div class="add-photo-edit">
                    <p><img src="{{ asset('web_sayt/img/add.svg') }}">Add Video</p>
                    <div class="edit-profile__contact-img edit-profile__contact-video">
                        <input type="file" id="img-file" name="img-file">
                        <label for="img-file"><img class="upload" src="{{ asset('web_sayt/img/video-file.svg') }}" alt="" width="38px"></label>
                    </div>
                </div>
            </div>
            <div class="edit-profile">
                <div class="edit-profile__contact">
                    <div class="edit-profile-info ml-0">
                        <div class="create__form pt-0">
                            <form action="#" id="auth" method="POST">
                                <div class="form-info">
                                    <div class="user-info odd">
                                        <p class="user-info-p">First Name</p>
                                        <input type="text" id="firsName" class="fadeIn" name="firsName">
                                    </div>
                                    <div class="user-info">
                                        <p class="user-info-p">Last Name</p>
                                        <input type="text" class="fadeIn" name="lastName">
                                    </div>
                                    <br>
                                    <div class="user-info odd">
                                        <p class="user-info-p">E-mail</p>
                                        <input type="email" id="email" class="fadeIn" name="emali">
                                    </div>
                                    <div class="user-info">
                                        <p class="user-info-p">Phone Number</p>
                                        <input type="tel" id="phone" class="fadeIn" name="phone">
                                    </div>
                                    <br>
                                    <div class="user-info create__checkbox">
                                        <p>Gender</p>
                                        <input type="checkbox" name="male" id="Male" value="Remember me" class="lg-sg__checkin"><label
                                            for="Male">Male</label>
                                        <input type="checkbox" name="female" id="Female" value="Remember me" class="lg-sg__checkin"><label
                                            for="Female">Female</label>
                                        <input type="checkbox" name="other" id="Other"  value="Remember me" class="lg-sg__checkin"><label
                                            for="Other">Other</label>
                                    </div>
                                    <br>
                                    <div class="user-info odd">
                                        <p class="user-info-p">Current Password</p>
                                        <input type="password" id="password" class="fadeIn" name="password">
                                    </div>
                                    <div class="user-info odd">
                                        <p class="user-info-p">New Password</p>
                                        <input type="password" id="password" class="fadeIn" name="password">
                                    </div>
                                    <br>

                                    <div class="user-info odd">
                                        <p class="user-info-p">Confirm New Password</p>
                                        <input type="password" id="password" class="fadeIn" name="password">
                                    </div>
                                    <div class="user-info odd">
                                        <p class="create-p">Language</p>
                                        <select class="fadeIn" name="language" id="state">
                                            <option value="select-sanguage">Select Language</option>
                                            <option value="English">English</option>
                                        </select>
                                    </div>
                                     <div class="lg-sg__button mob_save">
                                        <input type="submit" form="auth" class="btn bg-yellow" value="Save">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="edit-profile__other mt-0">
                    <div class="user-info odd">
                        <p class="user-info-p">Insurance coverage</p>
                        <input type="text" id="coverage" class="fadeIn" name="coverage">
                    </div>
                    <div class="user-info">
                        <p class="user-info-p">Cases and specializations</p>
                        <input type="text" value="#enterTag" name="tags" />
                    </div>
                    <br>
                    <div class="user-info-about mb-4">
                        <p class="user-info-p">About me</p>
                        <textarea class="fadeIn" name="about-me" rows="6" cols="100" style="resize: none;"></textarea>
                    </div>
                    <div class="user-info odd">
                        <p class="user-info-p">Card Number<span>*</span></p>
                        <input type="text"  class="fadeIn" name="coverage">
                    </div>
                    <br>
                    <div class="add-card-edit-link">
                        <a href="#">Add New Card Number</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg-sg__button but_web">
            <input type="submit" form="auth" class="btn bg-yellow" value="Save">
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
                                <input type="text" class="form-control" id="ConsultationName" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="Price">Price</label>
                                <input type="number" class="form-control" id="Price" name="price" required>
                            </div>
                            <div class="form-group" >
                                <label for="Description">Add Description</label>
                                <input type="text" class="form-control mb-3" name="description[]" id="Description" required>
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
                                <input type="text" class="form-control mb-3" name="sessiont_title[]"  id="SSession" required>
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

                                        <a href="{{route('delete-service',[app()->getLocale(),'id'=>$Value->id])}}"><i class="fas fa-times delete"></i></a>

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
            <script src="{{ asset('web_sayt/js/filter.js') }}"></script>
            <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>
            <script type="text/javascript" src="{{ asset('web_sayt/js/slidebar.js') }}"></script>
            <script>
                $(document).ready(function(){


                    $(function() {

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
                var t1 = tagger(document.querySelector('[name="tags"]'), {
                    allow_duplicates: false,
                    allow_spaces: true,
                    add_on_blur: true,
                    completion: {list: []}
                });

                </script>
@endsection
