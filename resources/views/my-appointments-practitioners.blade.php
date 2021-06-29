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
    <script>var body = document.body; body.classList.add("body");</script>
    <section>
        <div class="container">
            <div class="my-appointments">
                <div class="my-appointments__title">
                    <p>My Appointments</p>
                    <p>
                        <span class="my-appointments__title-li active">Complete</span>
                        <span class="my-appointments__title-border"></span>
                        <span class="my-appointments__title-li">In Process</span>
                    </p>
                </div>
                <div class="my-appointments__complete-process">
                    <div class="my-appointments__complete-process-content">
                        <div class="my-appointments__complete-process-content-flex">
                            <div class="my-appointments-person__info">
                                <div class="my-appointments-person__info-cont1">
                                    <img class="my-appointments-person__info-img" src="{{ asset('web_sayt/img/person-foto.png') }}" alt="">
                                </div>
                                <div class="my-appointments-person__info-cont2">
                                    <div class="my-appointments-person__info-name">Name Surname</div>
                                    <div class="my-appointments-person__info-specialist">Acne Specialist &amp; Holistic
                                        nutritionist (CNP)</div>
                                    <div class="my-appointments-person__info-data">June 10th ,2020 at 9:30am</div>
                                </div>
                            </div>
                            <div class="my-appointments-person__complete-process">
                                <div class="my-appointments-person__complete-process-time">30 Mins Consultation</div>
                                <div class="my-appointments-person__complete-process-session"><a href="#">Join session</a></div>
                                <button class="my-appointments-person__complete-process-button btn bg-yellow">Fill Intake
                                    Form</button>
                            </div>

                        </div>
                    </div>
                    <div class="my-appointments__complete-process-content">
                        <div class="my-appointments__complete-process-content-flex">
                            <div class="my-appointments-person__info">
                                <div class="my-appointments-person__info-cont1">
                                    <img class="my-appointments-person__info-img" src="{{ asset('web_sayt/img/person-foto.png') }}" alt="">
                                </div>
                                <div class="my-appointments-person__info-cont2">
                                    <div class="my-appointments-person__info-name">Name Surname</div>
                                    <div class="my-appointments-person__info-specialist">Acne Specialist &amp; Holistic
                                        nutritionist (CNP)</div>
                                    <div class="my-appointments-person__info-data">June 10th ,2020 at 9:30am</div>
                                </div>
                            </div>
                            <div class="my-appointments-person__complete-process">
                                <div class="my-appointments-person__complete-process-time">30 Mins Consultation</div>
                                <div class="my-appointments-person__complete-process-session"><a href="#">Join session</a></div>
                                <button class="my-appointments-person__complete-process-button btn bg-yellow">Fill Intake
                                    Form</button>
                            </div>

                        </div>
                    </div>

                    <div class="my-appointments__complete-process-content">
                        <div class="my-appointments__complete-process-content-flex">
                            <div class="my-appointments-person__info">
                                <div class="my-appointments-person__info-cont1">
                                    <img class="my-appointments-person__info-img" src="{{ asset('web_sayt/img/person-foto.png') }}" alt="">
                                </div>
                                <div class="my-appointments-person__info-cont2">
                                    <div class="my-appointments-person__info-name">Name Surname</div>
                                    <div class="my-appointments-person__info-specialist">Acne Specialist &amp; Holistic
                                        nutritionist (CNP)</div>
                                    <div class="my-appointments-person__info-data">June 10th ,2020 at 9:30am</div>
                                </div>
                            </div>
                            <div class="my-appointments-person__complete-process">
                                <div class="my-appointments-person__complete-process-time">30 Mins Consultation</div>
                                <div class="my-appointments-person__complete-process-session"><a href="#">Join session</a></div>
                                <button class="my-appointments-person__complete-process-button btn bg-yellow">Fill Intake
                                    Form</button>
                            </div>

                        </div>
                    </div>
                </div>



                <!-- In Process -->
                <div class="my-appointments__complete-process d-none">
                    <div class="my-appointments__complete-process-content">
                        <div class="my-appointments__complete-process-content-flex">
                            <div class="my-appointments-person__info">
                                <div class="my-appointments-person__info-cont1">
                                    <img class="my-appointments-person__info-img" src="{{ asset('web_sayt/img/person-foto.png') }}" alt="">
                                </div>
                                <div class="my-appointments-person__info-cont2">
                                    <div class="my-appointments-person__info-name">Name Surname</div>
                                    <div class="my-appointments-person__info-specialist">Acne Specialist &amp; Holistic
                                        nutritionist (CNP)
                                    </div>
                                    <div class="my-appointments-person__info-data">June 10th ,2020 at 9:30am</div>
                                </div>
                            </div>
                            <div class="my-appointments-person__complete-process">
                                <div class="my-appointments-person__complete-process-time">30 Mins Consultation</div>
                                <button
                                    class="my-appointments-person__complete-process-button procces-button btn bg-yellow">View
                                    Protocol</button>
                            </div>

                        </div>
                    </div>

                    <div class="my-appointments__complete-process-content">
                        <div class="my-appointments__complete-process-content-flex">
                            <div class="my-appointments-person__info">
                                <div class="my-appointments-person__info-cont1">
                                    <img class="my-appointments-person__info-img" src="{{ asset('web_sayt/img/person-foto.png') }}" alt="">
                                </div>
                                <div class="my-appointments-person__info-cont2">
                                    <div class="my-appointments-person__info-name">Name Surname</div>
                                    <div class="my-appointments-person__info-specialist">Acne Specialist &amp; Holistic
                                        nutritionist (CNP)
                                    </div>
                                    <div class="my-appointments-person__info-data">June 10th ,2020 at 9:30am</div>
                                </div>
                            </div>
                            <div class="my-appointments-person__complete-process">
                                <div class="my-appointments-person__complete-process-time">30 Mins Consultation</div>
                                <button
                                    class="my-appointments-person__complete-process-button procces-button btn bg-yellow">View
                                    Protocol</button>
                            </div>

                        </div>
                    </div>

                    <div class="my-appointments__complete-process-content">
                        <div class="my-appointments__complete-process-content-flex">
                            <div class="my-appointments-person__info">
                                <div class="my-appointments-person__info-cont1">
                                    <img class="my-appointments-person__info-img" src="{{ asset('web_sayt/img/person-foto.png') }}" alt="">
                                </div>
                                <div class="my-appointments-person__info-cont2">
                                    <div class="my-appointments-person__info-name">Name Surname</div>
                                    <div class="my-appointments-person__info-specialist">Acne Specialist &amp; Holistic
                                        nutritionist (CNP)
                                    </div>
                                    <div class="my-appointments-person__info-data">June 10th ,2020 at 9:30am</div>
                                </div>
                            </div>
                            <div class="my-appointments-person__complete-process">
                                <div class="my-appointments-person__complete-process-time">30 Mins Consultation</div>
                                <button
                                    class="my-appointments-person__complete-process-button procces-button btn bg-yellow">View
                                    Protocol</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="my-appointments__pagination">
                    <a class="page-item-sign" href="#">&lt;</a>
                    <a class="page-item page-item-first" href="#">1</a>
                    <a class="page-item" href="#">2</a>
                    <a class="page-item" href="#">3</a>
                    <a class="page-item" href="#">...</a>
                    <a class="page-item page-item-last" href="#">7</a>
                    <a class="page-item-sign" href="#">&gt;</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/my-appointments.js') }}"></script>
    &lt;
    <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>

@endsection
