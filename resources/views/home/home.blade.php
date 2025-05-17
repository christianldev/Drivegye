@extends('webtemplate')
@section('main')
<!-- start of banner -->
<section class="banner bg-cover-bottom has-shapes bg-light-gray has-bg-brash bg-brash-bottom" style="background-image: url(theme/images/brushes/banner.svg)" data-aos="fade-in" data-aos-delay="150">
    <div class="container h-100">
        <div class="d-block d-lg-flex no-gutters align-items-center h-100">
            <div class="col-12 col-xl-8 col-lg-8 order-lg-1">
                <div class="banner-image has-video-popup has-shapes mb-4 mb-md-5 mb-lg-0">
                    <button type="button" class="video-play-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/wCh-OviwZiY" data-target="#videoModal"><svg width="1.8em" height="1.8em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M11.596 8.697l-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/></svg></button>

                    <img class="img-fluid" src="theme/images/screenshots/banner.jpg" alt="">

                    <div class="shape-lg bg-tertiary rounded-circle"></div>
                    <div class="shape-md bg-primary rounded-circle"></div>
                    <div class="shape-sm bg-secondary rounded-circle"></div>
                </div>
            </div>
            
            <div class="col-xl-5 col-lg-6 order-lg-0">
                <h2 class="h1 mb-20">{{trans('messages.home.title')}}</h2>
                <p>{{trans('messages.home.desc')}}</p>
                @if (!empty($app_links) && isset($app_links[0]) && $app_links[0]->value != "")
                <a href="{{$app_links[0]->value}}" class="btn btn-primary d-flex align-items-center justify-content-center bg-app"target="_blank">
                <img class="mr-2" src="images/new/app.png"  alt="app"></a>
                  @endif
                <div class="divider-text mt-25 mb-25"><span class="bg-light-gray">OR</span></div>
                @if (!empty($app_links) && isset($app_links[0]) && $app_links[0]->value != "")
                <a href="{{$app_links[2]->value}}" class="btn btn-primary d-flex align-items-center justify-content-center bg-app"target="_blank">
                <img class="mr-2" src="{{ url('images/new/google.png') }}" alt="Get it on Googleplay"></a>
                @endif
                
            </div>
        </div>
    </div>
    
    <div class="shape-1 shape-sm bg-secondary rounded-circle"></div>
    <div class="shape-3 shape-sm-2 bg-primary rounded-circle"></div>
    <div class="shape-4 shape-sm-2 bg-primary rounded-circle"></div>
    <div class="shape-5 shape-xs bg-secondary rounded-circle"></div>
    <div class="shape-6 shape-xs bg-tertiary rounded-circle"></div>
    <div class="shape-7 shape-xs-2 bg-tertiary rounded-circle"></div>
    <div class="shape-8 shape-xs-2 bg-primary rounded-circle"></div>
</section>



<!-- end of banner -->
<section id="join-team" class="section-padding pb-50 join-team-section has-shapes">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 text-center mb-40" data-aos="fade-in">
                <h2 class="section-title"><strong>{{trans('messages.home.home_title')}}</strong></h2>
                <p>{{trans('messages.home.home_title_content')}}</p>
            </div>
        </div>
        @if(Auth::user()==null)
        <div class="row justify-content-center mt-30">
            <div class="col-lg-12">
                	<form method="POST" action="driver_register" class="">
    <!-- Form fields and content go here -->
					@if(Auth::user()==null)
                <div class="row">
                    <div class="col-md-4" data-aos="fade-up">
                        <div class="bg-white text-center shadow rounded p-30 mb-30">
                            <h3 class="mb-2 font-weight-bold">{{trans('messages.user.ride_with')}} {{$site_name}}</h3>
                            
                            <a href="{{ url('signup_rider') }}" class="btn btn-link text-primary p-0 font-weight-bold">{{trans('messages.home.siginup')}}<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/></svg></a>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="bg-white text-center shadow rounded p-30 mb-30">
                            <h3 class="mb-2 font-weight-bold">{{trans('messages.home.siginup_drive')}}</h3>
                           
                            <a href="{{ url('signup_driver') }}" class="btn btn-link text-primary p-0 font-weight-bold">{{trans('messages.home.siginup')}} <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/></svg></a>
                        </div>
                    </div>
                    	@endif
					@if(Auth::guard('company')->user()==null && Auth::user()==null)
					@endif
					@if(Auth::guard('company')->user()==null)
                    <div class="col-md-4" data-aos="fade-up">
                        <div class="bg-white text-center shadow rounded p-30 mb-30">
                            <h3 class="mb-2 font-weight-bold">{{trans('messages.home.siginup_company')}}</h3>
                          
                            <a href="{{ url('signup_company') }}" class="btn btn-link text-primary p-0 font-weight-bold">{{trans('messages.home.siginup')}}<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/></svg></a>
                        </div>
                    </div>
                 	@endif
					
				</form>
                
                </div>
            </div>
        </div>
        	@endif
    </div>
    
    <div class="shape-1 shape-xs bg-secondary rounded-circle d-none d-sm-block"></div>
    <div class="shape-2 shape-xs-2 bg-primary rounded-circle d-none d-sm-block"></div>
    <div class="shape-3 shape-sm bg-tertiary rounded-circle d-none d-sm-block"></div>
    <div class="shape-4 shape-xs bg-secondary rounded-circle d-none d-sm-block"></div>
    <div class="shape-5 shape-xs bg-tertiary rounded-circle d-none d-sm-block"></div>
    <div class="shape-6 shape-sm bg-primary rounded-circle d-none d-sm-block"></div>
    <div class="shape-7 shape-xs-2 bg-secondary rounded-circle d-none d-sm-block"></div>
    <div class="shape-8 shape-xs-2 bg-primary rounded-circle d-none d-sm-block"></div>
</section>

<section class="section-padding pb-50">
    <div class="container">
       
        <div class="has-colored-text row">
            <div class="col-lg-4 col-md-6">
                <div class="text-center p-0 p-md-2 mb-30" data-aos="fade-up">
                    <div class="has-text-color h2">
                        <i class="ti-car"></i>
                    </div>
                    <h5 class="font-weight-600 mt-20 mb-15 text-capitalize">{{trans('messages.home.easy_way')}}</h5>
                    <p>{{trans('messages.home.easy_content')}} </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="text-center p-0 p-md-2 mb-30" data-aos="fade-up" data-aos-delay="100">
                    <div class="has-text-color h2">
                        <i class="ti-time"></i>
                    </div>
                    <h5 class="font-weight-600 mt-20 mb-15 text-capitalize">{{trans('messages.home.anywhere')}}</h5>
                    <p></p>{{trans('messages.home.anywhere_content')}} </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="text-center p-0 p-md-2 mb-30" data-aos="fade-up" data-aos-delay="150">
                    <div class="has-text-color h2">
                        <i class="ti-money"></i>
                    </div>
                    <h5 class="font-weight-600 mt-20 mb-15 text-capitalize"{{trans('messages.home.lowcost')}}</h5>
                    <p>{{trans('messages.home.lowcost_content')}}</p>
                </div>
            </div>
           
           
        </div>
         <div class="text-center pb-60">
                  
                    <a href="{{ url('ride') }}" class="btn btn-primary has-icon">{{trans('messages.home.reason')}}
                        <span class="icon"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5522 6.66669L20.5522 14.6667C21.0329 15.1473 21.0699 15.9036 20.6632 16.4267L20.5522 16.5523L12.5522 24.5523L10.6666 22.6667L17.7228 15.6095L10.6666 8.55231L12.5522 6.66669Z" fill="currentColor"/></svg></span>
                    </a>
                </div>
    </div>
</section>

<!-- start of how-it-works tab -->
<section class="section-padding how-it-works-tab pt-0 overflow-hidden">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 text-center mb-40">
                <h2 class="section-title"><strong>{{trans('messages.home.home_title2')}}</strong></h2>
                <p>{{trans('messages.home.home_title2_content')}}</p>
            </div>
            <div class="col-lg-11">
                <ul class="nav nav-pills justify-content-center mb-20" id="pills-tab" role="tablist">
                    <li class="nav-item mb-20" role="presentation">
                        <a class="nav-link active" id="pill-management-tab" data-toggle="pill" href="#management-tab" role="tab" aria-controls="management-tab" aria-selected="true">
                            <i class="circle-shape"></i>{{trans('messages.home.rider_app')}}
                        </a>
                    </li>
                    <li class="nav-item mb-20" role="presentation">
                        <a class="nav-link" id="pill-chat-tab" data-toggle="pill" href="#chat-tab" role="tab" aria-controls="chat-tab" aria-selected="false">
                            <i class="circle-shape"></i>{{trans('messages.home.driver_app')}}
                        </a>
                    </li>
                    <li class="nav-item mb-20" role="presentation">
                        <a class="nav-link" id="pill-analytics-tab" data-toggle="pill" href="#analytics-tab" role="tab" aria-controls="analytics-tab" aria-selected="false">
                            <i class="circle-shape"></i>{{trans('messages.home.company_dashboard')}}
                        </a>
                    </li>
                    <li class="nav-item mb-20" role="presentation">
                        <a class="nav-link" id="pill-collaboration-tab" data-toggle="pill" href="#collaboration-tab" role="tab" aria-controls="collaboration-tab" aria-selected="false">
                            <i class="circle-shape"></i>{{trans('messages.home.administrator_dashboard')}}
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content" id="pills-tabContent" data-aos="fade-in">
                    <div class="tab-pane fade show active" id="management-tab" role="tabpanel" aria-labelledby="pill-management-tab">
                        <div class="row align-items-center">
                            <div class="col-lg-8 anim-to-top">
                                <img class="img-fluid rounded-lg shadow" src="theme/images/screenshots/newtaxi prime rider.png" alt="NewTaxi Prime Rider">
                            </div>
                            <div class="col-lg-4 mt-4 mt-lg-0 anim-to-bottom">
                                <h2 class="section-title"><strong>{{trans('messages.home.booking_app')}}</strong></h2>
                                <p class="mb-30">{{trans('messages.home.booking_app_content')}}</p>
                                <a href="{{'/rider'}}" class="btn btn-primary has-icon">View More
                                    <span class="icon"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5522 6.66669L20.5522 14.6667C21.0329 15.1473 21.0699 15.9036 20.6632 16.4267L20.5522 16.5523L12.5522 24.5523L10.6666 22.6667L17.7228 15.6095L10.6666 8.55231L12.5522 6.66669Z" fill="currentColor"/></svg></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="chat-tab" role="tabpanel" aria-labelledby="pill-chat-tab">
                        <div class="row align-items-center">
                            <div class="col-lg-8 anim-to-top">
                                <img class="img-fluid rounded-lg shadow" src="theme/images/screenshots/driver app.png" alt="NewTaxi Prime Driver">
                            </div>
                            <div class="col-lg-4 mt-4 mt-lg-0 anim-to-bottom">
                                <h2 class="section-title"><strong>{{trans('messages.home.drive_with_newtaxi_prime')}}</strong></h2>
                                <p class="mb-30">{{trans('messages.home.drive_with_newtaxi_prime_content')}}</p>
                                <a href="{{'/driver'}}" class="btn btn-primary has-icon">View More
                                    <span class="icon"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5522 6.66669L20.5522 14.6667C21.0329 15.1473 21.0699 15.9036 20.6632 16.4267L20.5522 16.5523L12.5522 24.5523L10.6666 22.6667L17.7228 15.6095L10.6666 8.55231L12.5522 6.66669Z" fill="currentColor"/></svg></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="analytics-tab" role="tabpanel" aria-labelledby="pill-analytics-tab">
                        <div class="row align-items-center">
                            <div class="col-lg-8 anim-to-top">
                                <img class="img-fluid rounded-lg shadow" src="theme/images/screenshots/company_dash.png" alt="">
                            </div>
                            <div class="col-lg-4 mt-4 mt-lg-0 anim-to-bottom">
                                <h2 class="section-title"><strong>{{trans('messages.home.manage')}}</strong></h2>
                                <p class="mb-30">{{trans('messages.home.manage_content')}}</p>
                                <a href="{{'/company_page'}}" class="btn btn-primary has-icon">View More
                                    <span class="icon"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5522 6.66669L20.5522 14.6667C21.0329 15.1473 21.0699 15.9036 20.6632 16.4267L20.5522 16.5523L12.5522 24.5523L10.6666 22.6667L17.7228 15.6095L10.6666 8.55231L12.5522 6.66669Z" fill="currentColor"/></svg></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="collaboration-tab" role="tabpanel" aria-labelledby="pill-collaboration-tab">
                        <div class="row align-items-center">
                            <div class="col-lg-8 anim-to-top">
                                <img class="img-fluid rounded-lg shadow" src="theme/images/screenshots/admin.png" alt="">
                            </div>
                            <div class="col-lg-4 mt-4 mt-lg-0 anim-to-bottom">
                                <h2 class="section-title"><strong>{{trans('messages.home.admin_dash')}}</strong></h2>
                                <p class="mb-30">{{trans('messages.home.admin_dash_content')}}</p>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of how-it-works tab -->


<!-- start of growth-rate -->
<section class="section-padding pb-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h2 class="section-title"><strong>{{trans('messages.about_us.ratetitle')}}</strong></h2>
                        <p class="border-bottom pb-30 mr-0 mr-lg-5">{{trans('messages.about_us.ratesubtitle')}}</p>
                        <div class="has-colored-text growth-rate-counter">
                            <div class="d-inline-block block-sm mr-30 mt-30">
                                <h2 class="has-text-color font-weight-bold">
                                <span class="jsCounter" data-count="{{trans('messages.about_us.years')}}">0</span>+</h2>
                                <p class="mt-10">{{trans('messages.about_us.years_title')}}</p>
                            </div>
                            <div class="d-inline-block block mr-30 mt-30">
                                <h2 class="has-text-color font-weight-bold">
                                <span class="jsCounter" data-count="{{trans('messages.about_us.users')}}">0</span>M+</h2>
                                <p class="mt-10">{{trans('messages.about_us.users_title')}}</p>
                            </div>
                            <div class="d-inline-block block mt-30">
                                <h2 class="has-text-color font-weight-bold">
                                <span class="jsCounter" data-count="{{trans('messages.about_us.employees')}}">0</span>+</h2>
                                <p class="mt-10">{{trans('messages.about_us.employees_title')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5 mt-lg-0">
                        <div class="row colored-icon-box">
                            <div class="col-sm-6" data-aos="fade-up">
                                <div class="icon-box text-center shadow px-3 px-md-5 px-lg-2 py-5 mb-30">
                                    <i class="ti-thumb-up icon"></i>
                                    <h4 class="font-weight-bold text-black-200">{{trans('messages.about_us.secure')}}</h4>
                                </div>
                            </div>
                            <div class="col-sm-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="icon-box text-center shadow px-3 px-md-5 px-lg-2 py-5 mb-30">
                                    <i class="ti-comments-smiley icon"></i>
                                    <h4 class="font-weight-bold text-black-200">{{trans('messages.about_us.support')}}</h4>
                                </div>
                            </div>
                            <div class="col-sm-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="icon-box text-center shadow px-3 px-md-5 px-lg-2 py-5 mb-30">
                                    <i class="ti-video-clapper icon"></i>
                                    <h4 class="font-weight-bold text-black-200">{{trans('messages.about_us.time_balancing')}}</h4>
                                </div>
                            </div>
                            <div class="col-sm-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box text-center shadow px-3 px-md-5 px-lg-2 py-5 mb-30">
                                    <i class="ti-shield icon"></i>
                                    <h4 class="font-weight-bold text-black-200">{{trans('messages.about_us.safe_condition')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of growth-rate -->

<!-- start of image-info -->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center justify-content-around">
             <div class="col-lg-5 col-md-8 col-sm-10">
                <div class="d-inline-block has-shadow shadow-right has-shapes">
                    <img class="img-fluid rounded-sm" src="theme/images/about/drive.jpg" alt="">
    
                    <div class="shape-1 shape-md bg-secondary rounded-circle"></div>
                    <div class="shape-2 shape-xl bg-tertiary rounded-circle"></div>
                    <div class="shape-3 shape-lg bg-primary rounded-circle"></div>
                </div>
            </div>
            <div class="col-lg-5 col-md-8 col-sm-10 mb-5">
            
                <h2 class="section-title"><strong>{{trans('messages.home.drive_you')}} {{trans('messages.home.you_need')}}</strong></h2>
                <p class="pb-20 border-bottom mb-20">{{trans('messages.home.drive_with')}} {{$site_name}}{{trans('messages.home.goals')}}</p>
               
            </div>
           
        </div>
    </div>
</section>
<!-- end of image-info -->

<!-- start section -->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center justify-content-around">
            <div class="col-lg-5 col-md-8 col-sm-10 mb-5">
            
                <h2 class="section-title"><strong>{{trans('messages.home.drive_you1')}}</strong></h2>
                <p class="pb-20 border-bottom mb-20">{{trans('messages.home.goals1')}}</p>
               
            </div>
            <div class="col-lg-5 col-md-8 col-sm-10">
                <div class="d-inline-block has-shadow shadow-right has-shapes">
                    <img class="img-fluid rounded-sm" src="theme/images/about/book.jpg" alt="">
    
                    <div class="shape-1 shape-md bg-secondary rounded-circle"></div>
                    <div class="shape-2 shape-xl bg-tertiary rounded-circle"></div>
                    <div class="shape-3 shape-lg bg-primary rounded-circle"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->

<!-- start footer -->

<!-- end footer -->

<!-- start of videoModal -->
<div class="modal fade rounded" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0 bg-transparent">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="#" id="showVideo"  allowscriptaccess="always" allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of videoModal -->

@stop