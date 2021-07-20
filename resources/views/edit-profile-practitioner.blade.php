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
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')


    <section class="edit-profile-section">
        <div class="container">
            <div class="edit-profile">
                <div class="edit-profile__contact">
                    <div class="edit-profile-info">
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
                        <div class="create__form ">
                            <form id="auth" method="POST">
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
                                        <input type="checkbox" name="male" value="Remember me" class="lg-sg__checkin"><label
                                            for="remember">Male</label>
                                        <input type="checkbox" name="female" value="Remember me" class="lg-sg__checkin"><label
                                            for="remember">Female</label>
                                        <input type="checkbox" name="other" value="Remember me" class="lg-sg__checkin"><label
                                            for="remember">Other</label>
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

                                    <div class="user-info odd">
                                        <p class="user-info-p">Insurance coverage</p>
                                        <input type="text" id="coverage" class="fadeIn" name="coverage">
                                    </div>
                                    <div class="user-info">
                                        <p class="user-info-p">Cases and specializations</p>
                                        <input type="text" id="tags" class="fadeIn" name="tags">
                                    </div>
                                    <br>
                                    <div class="user-info user-info-about">
                                        <p class="user-info-p">About me</p>
                                        <label for="about-me"></label>
                                        <textarea class="fadeIn" name="about-me" rows="6" cols="100"
                                                  style="resize: none;"></textarea>
                                    </div>

                                    <div class="lg-sg__button mob_save">
                                        <input type="submit" form="auth" class="btn bg-yellow" value="Save">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="edit-profile__other">
                    <h1 class="add_card-edit">Add Card</h1>


                    <div class="user-info odd">
                        <p class="user-info-p">Name on Card <span>*</span></p>
                        <input type="text" class="fadeIn" name="coverage">
                    </div>
                    <br>
                    <div class="user-info odd">
                        <p class="user-info-p">Card Number<span>*</span></p>
                        <input type="text"  class="fadeIn" name="coverage">
                    </div>
                    <br>
                    <div class="add-card-edit">
                        <div class="user-info odd">
                            <p class="user-info-p">Expiration Date<span>*</span></p>
                            <input type="text"  class="fadeIn" name="coverage" placeholder="Month">
                        </div>

                        <div class="user-info odd">

                            <input type="text"  class="fadeIn edit-select" name="coverage" placeholder="Year">
                        </div>
                        <div class="user-info odd">
                            <p class="user-info-p">CVC<span>*</span></p>
                            <input type="text"  class="fadeIn" name="coverage">
                        </div>

                    </div>
                    <div class="user-info create__checkbox flex-container check_addcard check-input edit-card">
                        <input type="checkbox" name="male" value="Remember me" class="lg-sg__checkin" checked=""><label for="remember"></label>
                        <p>Save Credit card information for the next time.</p>

                    </div>
                    <div class="add-card-edit-link">
                        <a href="#">Add New Card</a>
                    </div>
                </div>

            </div>

        </div>
{{--        </div>--}}
        <div class="lg-sg__button but_web">
            <input type="submit" form="auth" class="btn bg-yellow" value="Save">
        </div>
{{--        </div>--}}
{{--        </div>--}}
{{--        </div>--}}
    </section>
    <section>
        <div class="service mt-5 py-5">
            <h2 class="text-center">My Services</h2>
            <h4 class="text-uppercase text-center">ONE ON ONE PROGRAMS</h4>
            <div class=" flex-column flex-lg-row mt-5 d-flex ">
                <div class="col-lg-4 px-lg-5 mb-4">
                    <div class="bg-light p-5 br-10">
                        <h4 class="text-center mb-5">Add New Plan</h4>
                        <form action="#" class="mb-5">
                            <div class="form-group">
                                <label for="ConsultationName">Consultation Name</label>
                                <input type="text" class="form-control" id="ConsultationName">
                            </div>
                            <div class="form-group">
                                <label for="Price">Price</label>
                                <input type="number" class="form-control" id="Price">
                            </div>
                            <div class="form-group" >
                                <label for="Description">Add Description</label>
                                <input type="text" class="form-control mb-3" name="description[]" id="Description">
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
                                <input type="number" class="form-control mb-3" name="sessiont_title[]"  id="SSession">
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
                                <div class="item light-green">
                                    <div class="abs">
                                        <i class="fas fa-pen mr-3 edit_form1"></i>
                                        <i class="fas fa-times delete"></i>
                                    </div>
                                    <div class="d-flex flex-column align-items-center">
                                        <h4  class="mb-3 edit_f">{{$Value->title}}</h4>
                                        <div class="d-flex flex-column mx-auto align-items-center mb-3 italic-text">
                                            @foreach($ServiceSession as $valS)
                                                @foreach($valS as $valSS)
                                                    @if($valSS->services_id == $Value->id)
                                                        <span class="edit edit_f{{$valSS->id}}">{{$valSS->sessions}}</span>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="price d-flex flex-column align-items-center mb-3">
                                        <div class="d-flex">
                                            <sup class="">$</sup> <span class="edit_price">{{$Value->price}}</span>
                                        </div>
                                        <small>USD plus HST</small>
                                    </div>
                                    <ul class="list-unstyled px-5 overflow-auto">
                                        @foreach($ServiceDescription as $valD)
                                            @foreach($valD as $valDD)
                                                @if($valDD->services_id == $Value->id)
                                                    <li><i class="fas fa-angle-right mr-2" ></i> <span class="edit edit_description{{$valDD->id}}">{{$valDD->description}}</span></li>
                                                @endif
                                            @endforeach
                                        @endforeach

                                    </ul><br>
                                    <button class="bg-yellow br-10 px-4 py-2 fs-16"  >Save</button>
                                </div>
                                @endforeach

                                {{--                                    <div class="item light-yellow">--}}
                                {{--                                        <div class="abs">--}}
                                {{--                                            <i class="fas fa-pen mr-3"></i>--}}
                                {{--                                            <i class="fas fa-times"></i>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="d-flex flex-column align-items-center">--}}
                                {{--                                            <h4 class="mb-3">Get Glow <br> Complete</h4>--}}
                                {{--                                            <div class="d-flex flex-column mx-auto align-items-center mb-3 italic-text">--}}
                                {{--                                                <span>60 minute consult +</span>--}}
                                {{--                                                <span>30 minute follow up</span>--}}
                                {{--                                                <span>Customized acne healing plan</span>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="price d-flex flex-column align-items-center mb-3">--}}
                                {{--                                            <span>--}}
                                {{--                                               <sup>$</sup> 175--}}
                                {{--                                            </span>--}}
                                {{--                                            <small>USD plus HST</small>--}}
                                {{--                                        </div>--}}
                                {{--                                        <ul class="list-unstyled px-5 overflow-hidden">--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> 1 hour intimate consult (in person or video)</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> One 30 minute follow-up to make any necessary adjustments and track progress</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Unlimited email correspondence during working hours</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Bi-weekly check-ins and progress pictures</span></li>--}}
                                {{--                                        </ul>--}}
                                {{--                                    </div>--}}


                                {{--                                    <div class="item light-yellow">--}}
                                {{--                                        <div class="abs">--}}
                                {{--                                            <i class="fas fa-pen mr-3"></i>--}}
                                {{--                                            <i class="fas fa-times"></i>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="d-flex flex-column align-items-center">--}}
                                {{--                                            <h4 class="mb-3">Get Glow  <br> Complete</h4>--}}
                                {{--                                            <div class="d-flex flex-column mx-auto align-items-center mb-3 italic-text">--}}
                                {{--                                                <span>60 minute consult +</span>--}}
                                {{--                                                <span>30 minute follow up</span>--}}
                                {{--                                                <span>Customized acne healing plan</span>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="price d-flex flex-column align-items-center mb-3">--}}
                                {{--                                            <span>--}}
                                {{--                                               <sup>$</sup> 175--}}
                                {{--                                            </span>--}}
                                {{--                                            <small>USD plus HST</small>--}}
                                {{--                                        </div>--}}
                                {{--                                        <ul class="list-unstyled px-5 overflow-hidden">--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> 1 hour intimate consult (in person or video)</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> One 30 minute follow-up to make any necessary adjustments and track progress</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Unlimited email correspondence during working hours</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Bi-weekly check-ins and progress pictures</span></li>--}}
                                {{--                                        </ul>--}}
                                {{--                                    </div>--}}

                                {{--                                    <div class="item light-green">--}}
                                {{--                                        <div class="abs">--}}
                                {{--                                            <i class="fas fa-pen mr-3"></i>--}}
                                {{--                                            <i class="fas fa-times"></i>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="d-flex flex-column align-items-center">--}}
                                {{--                                            <h4 class="mb-3">Get Glow <br> Complete</h4>--}}
                                {{--                                            <div class="d-flex flex-column mx-auto align-items-center mb-3 italic-text">--}}
                                {{--                                                <span>60 minute consult +</span>--}}
                                {{--                                                <span>30 minute follow up</span>--}}
                                {{--                                                <span>Customized acne healing plan</span>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="price d-flex flex-column align-items-center mb-3">--}}
                                {{--                                <span>--}}
                                {{--                                   <sup>$</sup> 2100--}}
                                {{--                                </span>--}}
                                {{--                                            <small>USD plus HST</small>--}}
                                {{--                                        </div>--}}
                                {{--                                        <ul class="list-unstyled px-5 overflow-hidden">--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> 1 hour intimate consult (in person or video)</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> One 30 minute follow-up to make any necessary adjustments and track progress</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Unlimited email correspondence during working hours</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Bi-weekly check-ins and progress pictures</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Customized acne healing plan for your specific needs</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Tailored supplement and diet recommendations</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Customized skin care recommendations</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Holistic lifestyle recommendations</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> 2 week acne-friendly meal plan</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Emotional support and trauma work</span></li>--}}
                                {{--                                        </ul>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="item light-yellow">--}}
                                {{--                                        <div class="abs">--}}
                                {{--                                            <i class="fas fa-pen mr-3"></i>--}}
                                {{--                                            <i class="fas fa-times"></i>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="d-flex flex-column align-items-center">--}}
                                {{--                                            <h4 class="mb-3">Get Glow <br> Complete</h4>--}}
                                {{--                                            <div class="d-flex flex-column mx-auto align-items-center mb-3 italic-text">--}}
                                {{--                                                <span>60 minute consult +</span>--}}
                                {{--                                                <span>30 minute follow up</span>--}}
                                {{--                                                <span>Customized acne healing plan</span>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="price d-flex flex-column align-items-center mb-3">--}}
                                {{--                                            <span>--}}
                                {{--                                               <sup>$</sup> 175--}}
                                {{--                                            </span>--}}
                                {{--                                            <small>USD plus HST</small>--}}
                                {{--                                        </div>--}}
                                {{--                                        <ul class="list-unstyled px-5 overflow-hidden">--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> 1 hour intimate consult (in person or video)</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> One 30 minute follow-up to make any necessary adjustments and track progress</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Unlimited email correspondence during working hours</span></li>--}}
                                {{--                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Bi-weekly check-ins and progress pictures</span></li>--}}
                                {{--                                        </ul>--}}
                                {{--                                    </div>--}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
        @endsection

        @section('style')
{{--            <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>--}}
{{--            <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>--}}
{{--            <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>--}}
{{--            <script src="{{ asset('web_sayt/js/script.js') }}"></script>--}}


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

                    // Edit Plan
                    //  $("#edit_form1").parent().css({"display": "none","color": "red"});
                    // $('.edit_form1').click(function () {
                    //     $("#edit_form1").parent().css({"display": "block"});
                    // })
                    $(function() {

                    $('.edit_form1').on('click', function() {

                        var div = $(this);
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
                            'type':  'text',
                            'class': 'form-control',
                            'name':  'price',
                            'value':  div.parent().next().next().find('.edit_price').text()//set text box value from div current text
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

                                   // div.parent(".abs").next().next().next().children().children().children().find(clas{{$valDD->id}}).empty().append(tbd{{$valDD->id}});//add new text box
                        div.parent(".abs").next().next().next().children().find(clas{{$valDD->id}}).empty().append(tbd{{$valDD->id}});
                        tbd{{$valDD->id}}.focus();//put text box on focus
                                 @endif
                               @endforeach
                             @endforeach
                        @endforeach


                         }
                       //  var tb5;
                       //  var k = ".edit_description"+2;
                       // // alert(k);
                       //  tb5 = $('<input>').prop({
                       //      'type': 'text',
                       //      'class': 'form-control',
                       //      'value': div.parent().next().find(k).text()//set text box value from div current text
                       //  });
                       //
                       //  div.parent(".abs").next().next().next().children().find(k).empty().append(tb5);//add new text box
                       //  tb5.focus();//put text box on focus
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
            </script>
@endsection
