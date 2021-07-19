@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
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
        </div>
        <div class="lg-sg__button but_web">
            <input type="submit" form="auth" class="btn bg-yellow" value="Save">
        </div>
        </div>
        </div>
        </div>
        @endsection

        @section('style')
            <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>
            <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('web_sayt/js/script.js') }}"></script>
@endsection
