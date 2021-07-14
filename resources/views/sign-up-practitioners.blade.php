
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
              integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
              crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
        <link rel="stylesheet" href="{{ asset('web_sayt/css/multiSelect.css') }}">



        <title>Create</title>
        <style>
            #css-dropdown
            {
                position: absolute;
                top: 0;
                right: 0;
                left: 0;
                width: 300px;
                height: 42px;
                margin: 100px auto 0 auto;
            }
        </style>
    </head>

    <body>



    @if (Session::has('UserID'))`
        <div class="alert alert-success" role="alert">
            {{ Session::get('UserID') }}
        </div>
        <div class="alert alert-success" role="alert">
            {{ Session::get('UserEmail') }}
        </div>
        <div class="alert alert-success" role="alert">
            {{ Session::get('UserName') }}
        </div>
        <div class="alert alert-success" role="alert">
            {{ Session::get('UserLastName') }}
        </div>

    @endif
    <section>

        <div class="container">
            <div class="mt-5">
                <a href="{{route('index')}}" style="color: #585858;font-size: 26px">
                    <i class="fas fa-times"></i>
{{--                    <i class="fas fa-long-arrow-alt-left mr-1"></i>Back--}}
                </a>
            </div>
            <div class="create">

                <div class="create__img ">
                    <p>Create Account</p>
                    <img src="{{ asset('web_sayt/img/Group 1613.svg') }}" alt="">
                </div>
                <div class="create__form" style="flex: 1">
                    <form class="auth" method="POST" action="{{ route('register.custom',[app()->getLocale()]) }}" enctype='multipart/form-data'>
                        {{csrf_field()}}
                        <div class="form-info">
                            <div class="d-flex justify-content-lg-around">
                                <div class="user-info">
                                    <p class="create-p">First Name</p>
                                    <input type="text"  class="fadeIn" name="first_name" value="{{ old('first_name') }}">
                                    <p style="color: red; font-size: 12px">@if ($errors->has('first_name')){{ $errors->first('first_name') }}@endif</p>
                                </div>
                                <div class="user-info">
                                    <p class="user-info-p">Last Name</p>
                                    <input type="text"  class="fadeIn" name="last_name" value="{{ old('last_name') }}">
                                    <p style="color: red; font-size: 12px">@if ($errors->has('last_name')){{ $errors->first('last_name') }}@endif</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-lg-around">
                                <div class="user-info">
                                    <p class="user-info-p">E-mail</p>
                                    <input type="email" class="fadeIn" name="email" value="{{ old('email') }}">
                                    <p style="color: red; font-size: 12px">@if ($errors->has('email')){{ $errors->first('email') }}@endif</p>
                                </div>
                                <div class="user-info">
                                    <p class="user-info-p">Phone Number</p>
                                    <input type="tel" class="fadeIn" name="phone_number" value="{{ old('phone_number') }}">
                                    <p style="color: red; font-size: 12px">@if ($errors->has('phone_number')){{ $errors->first('phone_number') }}@endif</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-lg-around">
                                <div class="user-info">
                                    <p class="user-info-p">Password</p>
                                    <input type="password" class="fadeIn" name="password" >
                                    <p style="color: red;font-size: 12px">@if ($errors->has('password')){{ $errors->first('password') }}@endif</p>
                                </div>
                                <div class="user-info">
                                    <p class="user-info-p">Confirm Password</p>
                                    <input type="password" class="fadeIn" name="password">
                                    <p style="color: red; font-size: 12px">@if ($errors->has('password')){{ $errors->first('password') }}@endif</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-lg-around">
                                <div class="user-info">
                                    <p class="user-infop">Country</p>
                                    <select class="fadeIn" id="country" name="country_id">
                                        <option value=""></option>
                                        @foreach($GetCountry as $Country)
                                            <option value="{{$Country->id}}" @if (old('country_id') == $Country->id) selected="selected" @endif >{{$Country->title}}</option>
                                        @endforeach
                                    </select>
                                    <p style="color: red; font-size: 12px">@if ($errors->has('country_id')){{ $errors->first('country_id') }}@endif</p>
                                </div>
                                <div class="user-info">
                                    <p class="user-info-p">City</p>
                                    <select class="fadeIn" id="city" name="city_id">
                                        <option  value=""></option>
                                    </select>
                                    <p style="color: red; font-size: 12px">@if ($errors->has('city_id')){{ $errors->first('city_id') }}@endif</p>
                                </div>
                            </div>
                          <div class="d-flex justify-content-lg-around">
                              <div class="user-info">
                                  <p class="user-info-p">Address</p>
                                  <input type="text" class="fadeIn" name="address" value="{{ old('address') }}">
                                  <p style="color: red; font-size: 12px">@if ($errors->has('address')){{ $errors->first('address') }}@endif</p>
                              </div>
                              <div class="user-info">
                                  <p class="user-info-p">Time Zone</p>
                                  <select class="fadeIn" id="country" name="time_zone">
                                      <option value=""></option>
                                      @foreach($GetTimeZone as $TimeZone)
                                          <option value="{{$TimeZone->title}}"  @if (old('time_zone') == $TimeZone->title) selected="selected" @endif >{{$TimeZone->title}}</option>
                                      @endforeach
                                  </select>
                                  <p style="color: red; font-size: 12px">@if ($errors->has('time_zone')){{ $errors->first('time_zone') }}@endif</p>
                              </div>
                          </div>
                          <div class="d-flex justify-content-lg-around">
                              <div class="user-info">
                                  <p class="create-p">Practice type</p>



                                  <div class="">
                                      <select id="choices-multiple-remove-button" class="form-control" name="options[]" multiple>
                                          <option value="Author" onclick="filterSelection('Author')">Author</option>
                                          <option value="MSelect">Multiselect Dropdown</option>
                                          <option value="Accordions" >Accordions</option>
                                          <option value="Radio Buttons">Radio Buttons</option>
                                          <option value="SearchBox">Search Boxes</option>
                                          <option value="Tables">Tables</option>
                                          <option value="Profiles">Profiles</option>
                                          <option value="Sliders">Sliders</option>
                                          <option value="Tabs">Tabs</option>
                                          <option value="NavMenu">Navigation Menu</option>
                                          <option value="Cities">Cities</option>
                                          <option value="Countries">Countries</option>
                                          <option value="Regions">Regions</option>
                                      </select>
                                  </div>

{{--                                  <select class="fadeIn" name="practice_id" class="state">--}}
{{--                                  <select class="selectpicker" multiple data-live-search="true">--}}
{{--                                      <option value=""></option>--}}
{{--                                      @foreach($GetPractice as $Practice)--}}
{{--                                          <option value="{{$Practice->id}}" @if (old('practice_id') == $Practice->id) selected="selected" @endif>{{$Practice->title}}</option>--}}
{{--                                      @endforeach--}}
{{--                                  </select>--}}
                                  <p style="color: red; font-size: 12px">@if ($errors->has('practice_id')){{ $errors->first('practice_id') }}@endif</p>
                              </div>
                              <div class="user-info">
                                  <p class="create-p">Speciality</p>

                                  <div class="">
                                      <select id="choices-multiple-remove-button1" class="form-control" name="options[]" multiple>
                                          <option value="Author" onclick="filterSelection('Author')">Author</option>
                                          <option value="MSelect">Multiselect Dropdown</option>
                                          <option value="Accordions" >Accordions</option>
                                          <option value="Radio Buttons">Radio Buttons</option>
                                          <option value="SearchBox">Search Boxes</option>
                                          <option value="Tables">Tables</option>
                                          <option value="Profiles">Profiles</option>
                                          <option value="Sliders">Sliders</option>
                                          <option value="Tabs">Tabs</option>
                                          <option value="NavMenu">Navigation Menu</option>
                                          <option value="Cities">Cities</option>
                                          <option value="Countries">Countries</option>
                                          <option value="Regions">Regions</option>
                                      </select>
                                  </div>
{{--                                  <select class="fadeIn" name="speciality_id">--}}
{{--                                      <option value=""></option>--}}
{{--                                      @foreach($GetSpecialities as $Specialities)--}}
{{--                                          <option value="{{$Specialities->id}}" @if (old('speciality_id') == $Specialities->id) selected="selected" @endif>{{$Specialities->title}}</option>--}}
{{--                                      @endforeach--}}
{{--                                  </select>--}}
                                  <p style="color: red;font-size: 12px">@if ($errors->has('speciality_id')){{ $errors->first('speciality_id') }}@endif</p>
                              </div>
                          </div>

                            <div class="d-flex justify-content-lg-around">
                                <div class="user-info create__checkbox">
                                    <p class="mb-3">Mode of delivery</p>
                                    <input type="checkbox" name="virtual" id="Virtual" value="virtual" @if(old('virtual') == 'virtual') checked @endif class="lg-sg__checkin" />
                                    <label for="Virtual"> Virtual</label>
                                    <input type="checkbox" name="in_persion" id="in-person" value="in_persion" @if(old('in_person') == 'in_persion')   checked @endif class="lg-sg__checkin" />
                                    <label for="in-person">In Person</label>
                                    <p style="color: red; font-size: 12px">@if ($errors->has('virtual')){{ $errors->first('virtual') }}@endif</p>
{{--                                    <p style="color: red;">@if ($errors->has('in_person')){{ $errors->first('in_person') }}@endif</p>--}}
                                </div>
                                <div class="user-info box">
                                    <p>ID or Passport</p>
                                    <input type="file" id="idPass" name="id_or_passport" class="file_name_trigger">
                                    <label for="idPass">
                                        <span class="put_label"></span>
                                        <img value="{{ old('id_or_passport') }}" name="id_or_poassport" class="upload" src="{{ asset('web_sayt/img/upload.svg') }}" alt=""></label>
                                    <p style="color: red; font-size: 12px">@if ($errors->has('id_or_passport')){{ $errors->first('id_or_passport') }}@endif</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-lg-around">
                                <div class="user-info box">
                                    <p>Certifications and Licensing</p>
                                    <input type="file" id="certificat" class="file_name_trigger_multiple"  multiple name="certifications_licensing[]">
                                    <label for="certificat">
                                        <span class="put_label"></span>
                                        <img class="upload" src="{{ asset('web_sayt/img/upload.svg') }}" alt=""></label>
                                    <p style="color: red; font-size: 12px">@if ($errors->has('certifications_licensing')){{ $errors->first('certifications_licensing') }}@endif</p>
                                </div>
                                <div class="user-info box">
                                    <p>Additional documents</p>
                                    <input type="file" id="document" name="additional_document[]" multiple class="file_name_trigger_multiple">
                                    <label for="document">
                                        <span class="put_label"></span>
                                        <img class="upload" src="{{ asset('web_sayt/img/upload.svg') }}" alt=""></label>
                                    <p style="color: red; font-size: 12px">@if ($errors->has('additional_document')){{ $errors->first('additional_document') }}@endif</p>
                                </div>
                            </div>
                        </div>
                        <div class="create__button">
                            <input type="submit"  class="btn bg-yellow"  value="Sign Up">

                        </div>
                        <div class="create__signup">
                            <p class="login-p">Already have an account?
                                <a  href="{{route('login-practitioners',[app()->getLocale()])}}"><span> Sign In </span></a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>
    <script type=text/javascript src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web_sayt/js/countries.js') }}"></script>


    <script>
        populateCountries("country", "state");
    </script>
    <script type='text/javascript'>
        $(document).ready(function(){

            $('.file_name_trigger').on('change', function () {
                let name = $(this).val().split('\\').pop();
                $(this).next().find('.put_label').html(name);
            })

            $('.file_name_trigger_multiple').on('change', function () {
                let name = "";
                var names = [];
                for (var i = 0; i < $(this).get(0).files.length; ++i) {
                    names.push(' ' + $(this).get(0).files[i].name.split('\\').pop());
                }
                if(names.length > 1){
                    name = names.length + ' files';
                }else{
                    name = names[0];
                }

                $(this).next().find('.put_label').html(name);
                $(this).next().attr('title',names);
            })



            // Department Change
            $('#country').change(function(){

                // Department id
                var id = $(this).val();

                // Empty the dropdown
                $('#city').find('option').not(':first').remove();

                // AJAX request
                $.ajax({
                    url: 'get-city/'+id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        // alert(id)
                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }

                        if(len > 0){
                        //    Read data and create <option >
                            for(var i=0; i<len; i++){

                                var id = response['data'][i].id;
                                var title = response['data'][i].title;
                                <?php
                                //echo '<script language="javascript">'"+id+"'</script>';

                                ?>
                                var option = "<option value='"+id+"'>"+title+"</option>";

                                $("#city").append(option);
                            }
                        }

                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script>
        $(document).ready(function(){

            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                searchResultLimit:5,
                renderChoiceLimit:5
            });

            var multipleCancelButton1 = new Choices('#choices-multiple-remove-button1', {
                removeItemButton: true,
                searchResultLimit:5,
                renderChoiceLimit:5
            });


        });

    </script>

    </body>
    </html>







