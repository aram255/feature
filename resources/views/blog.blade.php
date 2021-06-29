@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/style.css') }}">
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

                                <br>

                                <div class="add_card_customer user-info">
                                    <h1 class="add_card-h1">Add Card</h1>
                                    <p>Name on Card <span>*</span></p>
                                    <input type="text"  class="fadeIn" name="tags" placeholder="As show on the card">
                                    <p>Card Number <span>*</span></p>
                                    <div class="add-card"><input type="text" class="fadeIn" name="tags" >
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
                                        <select class="fadeIn" >
                                            <option value="select-sanguage">Month</option>
                                            <option value="January">January</option>
                                        </select>

                                        <select class="fadeIn">
                                            <option value="Year">Year</option>
                                            <option value="2021">2021</option>
                                        </select>
                                    </div>

                                    <div class="cvc">
                                        <p>CVC <span>*</span></p>
                                        <input type="text"  class="fadeIn" name="tags">
                                    </div>

                                </div>

                                <div class="user-info create__checkbox flex-container check_addcard check-input edite-card-check">
                                    <input type="checkbox" name="male" value="Remember me" class="lg-sg__checkin" checked><label
                                        for="remember"></label>
                                    <p>Save Credit card information for the next time.</p>
                                </div>
                                <div class="user-info add-new-card">
                                    <a href="#">Add New Card</a>
                                </div>
                                <div class="lg-sg__button  edit-prof-cust edit-profile-save">
                                    <input type="submit" form="auth" class="btn bg-yellow" value="Save">
                                </div>
                            </div>
                        </form>
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
@endsection
