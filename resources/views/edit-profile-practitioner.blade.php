@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/style.css') }}">
    <style>
        .hide{
            display: none;
        }
    </style>
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')
    <script>var body = document.body; body.classList.add("body");</script>

    <section>
        <div class="container">
            <div class="flex-container">
                <div class="upload_img_customer">
                    <img src="{{ asset('web_sayt/img/Group 1947.svg') }}" alt="">
                </div>
                <div class="form-customer">
                    <div class="create__form ">
                        <div class="form-info">
                            <form id="auth" method="POST">
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
                                <div class="user-info odd">
                                    <p class="user-info-p">Password</p>
                                    <input type="password" id="password" class="fadeIn" name="password">
                                </div>
                                <div class="user-info">
                                    <p class="user-info-p">Confirm Password</p>
                                    <input type="text" id="Confirm-Password" class="fadeIn" name="Confirm">
                                </div>

                                <div class="user-info create__checkbox user-info-editprofile">
                                    <p>Gender</p>
                                    <input type="checkbox" name="male" value="Remember me" class="lg-sg__checkin"><label
                                        for="remember">Male</label>
                                    <input type="checkbox" name="female" value="Remember me" class="lg-sg__checkin"><label
                                        for="remember">Female</label>
                                    <input type="checkbox" name="other" value="Remember me" class="lg-sg__checkin"><label
                                        for="remember">Other</label>
                                </div>
                                <div class="lg-sg__button  edit-prof-cust edit-profile-save">
                                    <input type="submit" form="auth" class="btn bg-yellow" value="Save">
                                </div>
                                <br>

                            </form>

                            <form role="form" action="{{ route('add-card') }}" method="post" class="stripe-payment"
                                  data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                  id="stripe-payment">
                                @csrf

                                <div class="add_card_customer user-info">

                                    @if (Session::has('success'))
                                        <div class="alert alert-primary text-center">
                                            <p>{{ Session::get('success') }}</p>
                                        </div>
                                    @endif

                                    <h1 class="add_card-h1">Add Card</h1>

                                    <p>Name on Card <span>*</span></p>

                                    <input type="text"  class="fadeIn" name="sender_name" placeholder="As show on the card">

                                    <p>Card Number <span>*</span></p>

                                    <div class="add-card"><input type="text" class="fadeIn card-num" name="num" value="4242424242424242" size='20' >
                                        <img src="{{ asset('web_sayt/img/visa-and-mastercard-logos-logo-visa-png-logo-visa-mastercard-png-visa-logo-white-png-awesome-logos-1.png') }}" alt="">
                                        <img src="{{ asset('web_sayt/img/Group 1948.png') }}" alt="">
                                        <img src="{{ asset('web_sayt/img/American-Express-copy.png') }}" alt="">
                                        <img src="{{ asset('web_sayt/img/unnamed.png') }}" alt="">
                                    </div>

                                </div>
                                <br>
                                <div class="expiration_date user-info flex-container edit-profil-card">
                                    <div>
                                        <p>Expiration Date <span>*</span></p>

                                        {{--  <select class="fadeIn card-expiry-month" >
                                                   <option value="select-sanguage">Month</option>
                                                   <option value="January">January</option>
                                               </select>--}}

                                        {{--  <select class="fadeIn card-expiry-year">
                                                   <option value="Year">Year</option>
                                                   <option value="2021">2021</option>
                                               </select>--}}

                                        <input type="number" style="width: 150px;margin-right: 5px"  class="fadeIn fadeIn card-expiry-month" name="month" placeholder="MM">
                                        <input type="number" style="width: 150px;margin-right: 10px"  class="fadeIn fadeIn card-expiry-year" name="year" placeholder="YYYY">
                                    </div>

                                    <div class="cvc display-block">
                                        <p>CVC <span>*</span></p>
                                        <input type="text" style="width: 150px;margin-right: 5px"   class="fadeIn card-cvc" name="cvc" size='4'>
                                    </div>

                                </div>

                                <div class='form-row row pl-5 pt-4 '>
                                    <div class='col-md-8 hide error form-group'>
                                        <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                    </div>
                                </div>

                                {{--   <div class="user-info create__checkbox flex-container check_addcard check-input edite-card-check">
                                       <input type="checkbox" name="male" value="Remember me" class="lg-sg__checkin" checked><label
                                           for="remember"></label>
                                       <p>Save Credit card information for the next time.</p>
                                   </div>--}}

                                <div class="lg-sg__button  edit-prof-cust edit-profile-save">
                                    <button class="btn btn-success btn-lg btn-block" type="submit">Add</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div id="accordion" class="d-block mb-4">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        My cards
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <ul class="list-group ">
                                        @foreach($cards as $card)
                                            <li class="list-group-item bg-light">
                                                <i class="fas fa-credit-card mr-3"></i>
                                                <span>**** **** **** {{$card->number}}</span>
                                                <i class="fas fa-trash text-danger ml-3" onclick="$(this).next().submit()"></i>
                                                <form action="{{route('remove-card', $card->id)}}" method="POST">
                                                    @csrf
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
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
   <script src="{{ asset('web_sayt/js/script.js') }}"></script>

            <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

            <script type="text/javascript">
                $(function () {
                    var $form = $(".stripe-payment");
                    $('form.stripe-payment').bind('submit', function (e) {
                        var $form = $(".stripe-payment"),
                            inputVal = ['input[type=email]', 'input[type=password]',
                                'input[type=text]', 'input[type=file]',
                                'textarea'
                            ].join(', '),
                            $inputs = $form.find('.required').find(inputVal),
                            $errorStatus = $form.find('div.error'),
                            valid = true;
                        $errorStatus.addClass('hide');

                        $('.has-error').removeClass('has-error');
                        $inputs.each(function (i, el) {
                            var $input = $(el);
                            if ($input.val() === '') {
                                $input.parent().addClass('has-error');
                                $errorStatus.removeClass('hide');
                                e.preventDefault();
                            }
                        });

                        if (!$form.data('cc-on-file')) {
                            e.preventDefault();
                            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                            Stripe.createToken({
                                number: $('.card-num').val(),
                                cvc: $('.card-cvc').val(),
                                exp_month: $('.card-expiry-month').val(),
                                exp_year: $('.card-expiry-year').val()
                            }, stripeRes);
                        }

                    });

                    function stripeRes(status, response) {
                        if (response.error) {
                            $('.error')
                                .removeClass('hide')
                                .find('.alert')
                                .text(response.error.message);
                        } else {
                            var token = response['id'];
                            $form.find('input[type=text]').empty();
                            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                            $form.get(0).submit();
                            $('.edit-prof-cust button').attr('disabled', true);
                        }
                    }

                });

            </script>
@endsection
