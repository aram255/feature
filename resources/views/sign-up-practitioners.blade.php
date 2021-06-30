
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
        <title>Create</title>
    </head>

    <body>



    @if (Session::has('UserID'))
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
            <div class="create">

                <div class="create__img ">
                    <p>Create Account</p>
                    <img src="{{ asset('web_sayt/img/Group 1613.svg') }}" alt="">
                </div>
                <div class="create__form ">
                    <form class="auth" method="POST" action="{{ route('register.custom',[app()->getLocale()]) }}" enctype='multipart/form-data'>
                        {{csrf_field()}}
                        <div class="form-info">

                            <div class="user-info">
                                <p class="create-p">First Name</p>
                                <input type="text"  class="fadeIn" name="first_name" value="{{ old('first_name') }}">
                                <p style="color: red;">@if ($errors->has('first_name')){{ $errors->first('first_name') }}@endif</p>
                            </div>
                            <div class="user-info">
                                <p class="user-info-p">Last Name</p>
                                <input type="text"  class="fadeIn" name="last_name" value="{{ old('last_name') }}">
                                <p style="color: red;">@if ($errors->has('last_name')){{ $errors->first('last_name') }}@endif</p>
                            </div>
                            <br>
                            <div class="user-info">
                                <p class="user-info-p">E-mail</p>
                                <input type="email" class="fadeIn" name="email" value="{{ old('email') }}">
                                <p style="color: red;">@if ($errors->has('email')){{ $errors->first('email') }}@endif</p>
                            </div>
                            <div class="user-info">
                                <p class="user-info-p">Phone Number</p>
                                <input type="tel" class="fadeIn" name="phone_number" value="{{ old('phone_number') }}">
                                <p style="color: red;">@if ($errors->has('phone_number')){{ $errors->first('phone_number') }}@endif</p>
                            </div>
                            <br>
                            <div class="user-info">
                                <p class="user-info-p">Password</p>
                                <input type="password" class="fadeIn" name="password" >
                                <p style="color: red;">@if ($errors->has('password')){{ $errors->first('password') }}@endif</p>
                            </div>
                            <div class="user-info">
                                <p class="user-info-p">Confirm Password</p>
                                <input type="password" class="fadeIn" name="password">
                                <p style="color: red;">@if ($errors->has('password')){{ $errors->first('password') }}@endif</p>
                            </div>
                            <br>
                            <div class="user-info">
                                <p class="user-infop">Country</p>
                                <select class="fadeIn" id="country" name="country_id">
                                    <option value=""></option>
                                    @foreach($GetCountry as $Country)
                                     <option value="{{$Country->id}}" @if (old('country_id') == $Country->id) selected="selected" @endif >{{$Country->title}}</option>
                                    @endforeach
                                </select>
                                <p style="color: red;">@if ($errors->has('country_id')){{ $errors->first('country_id') }}@endif</p>
                            </div>

                            <div class="user-info">
                                <p class="user-info-p">City</p>
                                <select class="fadeIn" id="city" name="city_id">
                                    <option  value=""></option>
                                </select>
                                <p style="color: red;">@if ($errors->has('city_id')){{ $errors->first('city_id') }}@endif</p>
                            </div>
                            <br>
                            <div class="user-info">
                                <p class="user-info-p">Address</p>
                                <input type="text" class="fadeIn" name="address" value="{{ old('address') }}">
                                <p style="color: red;">@if ($errors->has('address')){{ $errors->first('address') }}@endif</p>
                            </div>

                            <div class="user-info">
                                <p class="user-info-p">Time Zone</p>
                                <select class="fadeIn" id="country" name="time_zone">
                                    <option value=""></option>
                                    @foreach($GetTimeZone as $Country)
                                      @php  $Array = json_decode($Country->timezones); @endphp
                                        @foreach($Array as $TimeZone)
                                          <option value="{{$TimeZone->zoneName}} {{$TimeZone->gmtOffsetName}} {{$TimeZone->tzName}}" @if (old('time_zone') == $TimeZone->zoneName.' '.$TimeZone->gmtOffsetName.' '.$TimeZone->tzName) selected="selected" @endif >{{$TimeZone->zoneName}} {{$TimeZone->gmtOffsetName}} {{$TimeZone->tzName}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                <p style="color: red;">@if ($errors->has('time_zone')){{ $errors->first('time_zone') }}@endif</p>
                            </div>
                            <br>
                            <div class="user-info">
                                <p class="create-p">Practice type</p>
                                <select class="fadeIn" name="practice_id" class="state">
                                    <option value=""></option>
                                    @foreach($GetPractice as $Practice)
                                    <option value="{{$Practice->id}}" @if (old('practice_id') == $Practice->id) selected="selected" @endif>{{$Practice->title}}</option>
                                    @endforeach
                                </select>
                                <p style="color: red;">@if ($errors->has('practice_id')){{ $errors->first('practice_id') }}@endif</p>
                            </div>

                            <div class="user-info">
                                <p class="create-p">Speciality</p>
                                <select class="fadeIn" name="speciality_id">
                                    <option value=""></option>
                                    @foreach($GetSpecialities as $Specialities)
                                    <option value="{{$Specialities->id}}" @if (old('speciality_id') == $Specialities->id) selected="selected" @endif>{{$Specialities->title}}</option>
                                    @endforeach
                                </select>
                                <p style="color: red;">@if ($errors->has('speciality_id')){{ $errors->first('speciality_id') }}@endif</p>
                            </div>
                            <br>

                            <div class="user-info create__checkbox">
                                <p>Mode of delivery</p>
                                <input type="radio" name="mode_of_delivery" value="virtual" @if(old('mode_of_delivery') == 'virtual') checked @endif class="lg-sg__checkin" /><label for="remember"> Virtual</label>
                                <input type="radio" name="mode_of_delivery" value="in_persion" @if(old('mode_of_delivery') == 'in_persion')   checked @endif class="lg-sg__checkin" /><label for="remember">In Person</label>
                                <p style="color: red;">@if ($errors->has('mode_of_delivery')){{ $errors->first('mode_of_delivery') }}@endif</p>
                            </div>

                            <div class="user-info box">
                                <p>ID or Passport</p>
                                <input type="file" id="idPass" name="id_or_passport">
                                <label for="idPass"><img value="{{ old('id_or_passport') }}" name="id_or_poassport" class="upload" src="{{ asset('web_sayt/img/upload.svg') }}" alt=""></label>
                                <p style="color: red;">@if ($errors->has('id_or_passport')){{ $errors->first('id_or_passport') }}@endif</p>
                            </div>
                            <br>
                            <div class="user-info box">
                                <p>Certifications and Licensing</p>
                                <input type="file" id="certificat" name="certifications_licensing">
                                <label for="certificat"><img class="upload" src="{{ asset('web_sayt/img/upload.svg') }}" alt=""></label>
                                <p style="color: red;">@if ($errors->has('certifications_licensing')){{ $errors->first('certifications_licensing') }}@endif</p>
                            </div>

                            <div class="user-info box">
                                <p>Additional documents</p>
                                <input type="file" id="document" name="additional_document">
                                <label for="document"><img class="upload" src="{{ asset('web_sayt/img/upload.svg') }}" alt=""></label>
                                <p style="color: red;">@if ($errors->has('additional_document')){{ $errors->first('additional_document') }}@endif</p>
                            </div>

                        </div>
                        <div class="create__button">
                            <input type="submit"  class="btn bg-yellow"  value="Sign Up">

                        </div>
                        <div class="create__signup">
                            <p class="login-p">Already have an account?<a href="{{route('login-practitioners',[app()->getLocale()])}}"><span> Sign In </span></a></p>

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
    </body>
    </html>






