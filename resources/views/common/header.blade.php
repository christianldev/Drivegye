  <!-- start of preloader -->
    <div class="preloader position-fixed d-flex align-items-center justify-content-center">
        <div class="block">
            <div class="loader-image mb-20">
                <img src="{{ url(PAGE_LOGO_URL)}}" alt="">
            </div>
            <div class="loader-text text-uppercase">
                <span class="mb-1">Welcome to</span>
                <span>{{$site_name}}</span>
            </div>
        </div>
    </div>
    <!-- end of preloader -->
<header class="header-nav position-relative bg-light-gray shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-xl navbar-light px-0">
            <a class="navbar-brand p-0" href="{{ url('/') }}">
                <img class="img-fluid" style="width: 109px;background-color: white;margin-top: 15px;height: 50px !important;"src="{{ $logo_url }}" alt="{{$site_name}}"></a>
            <!-- logo -->

            <button class="navbar-toggler bg-white rounded-0 p-0" type="button" data-toggle="collapse" data-target="#navlinks" aria-controls="navlinks" aria-expanded="false" aria-label="Toggle navigation">
                <svg class="nav-toggle-icon" viewBox="0 0 100 100" width="40" onclick="this.classList.toggle('active')"><path class="line top" d="m 70,33 h -40 c 0,0 -8.5,-0.149796 -8.5,8.5 0,8.649796 8.5,8.5 8.5,8.5 h 20 v -20" /><path class="line middle" d="m 70,50 h -40" /><path class="line bottom" d="m 30,67 h 40 c 0,0 8.5,0.149796 8.5,-8.5 0,-8.649796 -8.5,-8.5 -8.5,-8.5 h -20 v 20" /></svg>
            </button>
            <!-- mobile-nav control button -->
            
            <div class="collapse navbar-collapse" id="navlinks">
                <ul class="navbar-nav mx-auto">

                    <li class="nav-item dropdown @@company">
                        <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-1">{{trans('messages.header.our_company')}}</span>
                            <svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 1.06L7.94 0L4.5 3.44L1.06 0L0 1.06L4.5 5.56L9 1.06Z" fill="currentColor"/></svg>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item @@companyOne" href="{{ url('about_us') }}">{{trans('messages.about_us.about_us')}}</a></li>
                            <li><a class="dropdown-item @@companyTwo" href="{{ url('signup_rider') }}">{{trans('messages.footer.ride')}}</a></li>
                            <li><a class="dropdown-item @@companyThree" href="{{ url('drive') }}">{{trans('messages.footer.drive')}}</a></li>
                            <li><a class="dropdown-item @@companyFour" href="{{ url('services') }}">{{trans('messages.about_us.services')}}</a></li>
                            <!--<li><a class="dropdown-item @@companyFive" href="{{ url('our_team') }}">{{trans('messages.about_us.our_team')}}</a></li>-->
                            <li><a class="dropdown-item @@howItWorks" href="{{ url('how_it_works') }}">{{trans('messages.header.how_it_works')}}</a></li>
                            <!--<li><a class="dropdown-item @@testimonials" href="{{ url('testimonials') }}">{{trans('messages.about_us.testimonials')}}</a></li>-->
                        </ul>
                    </li>
                   
               
                    <li class="nav-item dropdown @@platforms">
                        <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-1">{{trans('messages.header.platforms')}}</span>
                            <svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 1.06L7.94 0L4.5 3.44L1.06 0L0 1.06L4.5 5.56L9 1.06Z" fill="currentColor"/></svg>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item @@platformsOne" href="{{ url('rider') }}">{{trans('messages.header.rider')}}</a></li>
                            <li><a class="dropdown-item @@platformsTwo" href="{{ url('driver') }}">{{trans('messages.header.driver')}}</a></li>
                            <li><a class="dropdown-item @@platformsTwo" href="{{ url('company_page') }}">{{trans('messages.header.company')}}</a></li>
                            <li><a class="dropdown-item @@platformsTwo" href="{{ url('money') }}">{{trans('messages.header.money')}}</a></li>
                        </ul>
                    </li>
                    <li class="nav-item @@contact">
                        <a class="nav-link" href="{{ url('safety') }}">{{trans('messages.footer.safety')}}</a>
                    </li>
                     <li class="nav-item @@contact">
                        <a class="nav-link" href="{{ url('/') }}/help">{{trans('messages.header.support_center')}}</a>
                    </li>
                   
                    <li class="nav-item dropdown @@pages">
                        <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-1">{{trans('messages.header.signin')}}</span>
                            <svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 1.06L7.94 0L4.5 3.44L1.06 0L0 1.06L4.5 5.56L9 1.06Z" fill="currentColor"/></svg>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item @@howItWorks" href="/signin_rider">{{trans('messages.header.signinrider')}}</a></li>
                            <li><a class="dropdown-item @@testimonials" href="/signin_driver">{{trans('messages.header.signindriver')}}</a></li>
                         
                            <li><a class="dropdown-item @@terms" href="/signin_company">{{trans('messages.header.signincompany')}}</a></li>
                            
                        </ul>
                    </li>
                    
                     <li class="nav-item dropdown @@joinus">
                        <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-1">{{trans('messages.header.joinus')}}</span>
                            <svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 1.06L7.94 0L4.5 3.44L1.06 0L0 1.06L4.5 5.56L9 1.06Z" fill="currentColor"/></svg>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item @@riderjoin" href="{{ url('signup_rider') }}">{{trans('messages.profile.rider_signup')}}</a></li>
                            <li><a class="dropdown-item @@driverjoin" href="{{ url('signup_driver') }}">{{trans('messages.profile.driver_signup')}}</a></li>
                         
                            <li><a class="dropdown-item @@company" href="{{ url('signup_company') }}">{{trans('messages.header.company_signup')}}</a></li>
                            
                        </ul>
                    </li>
                </ul>

                <div class="navbar-button">
                    <a href="{{ url('signup_driver') }}"><button class="btn btn-sm btn-outline-primary" >{{trans('messages.footer.driver')}}</button></a>
                    <!--<button class="btn btn-sm btn-link pr-xl-0" data-toggle="modal" data-target="#signin-modal">Log in<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/></svg></button>-->
                </div>
            </div>
            <!-- nav links -->
        </nav>
    </div>
</header>