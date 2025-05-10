@extends('webtemplate')
@section('main')

<!-- start of page-header -->
<section class="page-header bg-light-gray has-shapes has-bg-brash bg-brash-bottom" style="background-image:url(theme/images/brushes/banner.svg)">
    <div class="container h-100">
        <div class="row d-flex align-items-center h-100">
            <div class="col-md-12 text-center">
                <h2 class="h1 font-weight-bold">{{trans('messages.about_us.about_us')}}</h2>
                <nav class="mt-15" aria-label="breadcrumb">
                    <ol class="breadcrumb font-weight-bold bg-transparent p-0 justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-black-300">Home</a></li>
                        <li class="breadcrumb-item text-primary" aria-current="page">{{trans('messages.about_us.about')}} {{$site_name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="shape-1 bg-secondary shape-xs rounded-circle"></div>
    <div class="shape-2 bg-primary shape-xs-2 rounded-circle"></div>
    <div class="shape-3 bg-primary shape-sm-2 rounded-circle"></div>
    <div class="shape-4 bg-tertiary shape-xs rounded-circle"></div>
    <div class="shape-5 bg-tertiary shape-xs rounded-circle"></div>
    <div class="shape-6 bg-primary shape-sm rounded-circle"></div>
    <div class="shape-7 bg-primary shape-xs-2 rounded-circle"></div>
    <div class="shape-8 bg-secondary shape-xs rounded-circle"></div>
</section>
<!-- end of page-header -->

<!-- start section -->
<section class="section-padding" data-aos="fade-in" data-aos-delay="150">
    <div class="container">
        <div class="row align-items-center justify-content-around">
            <div class="col-lg-5 col-md-8 col-sm-10 mb-5">
                <h2 class="section-title">{{trans('messages.about_us.title')}}</strong></h2>
                <p class="pb-20 border-bottom mb-20">{{trans('messages.about_us.subtitle1')}}</p>
               
            </div>
            <div class="col-lg-5 col-md-8 col-sm-10">
                <div class="d-inline-block has-shadow shadow-right has-shapes">
                    <img class="img-fluid rounded-sm" src="theme/images/about/02.jpg" alt="">
    
                    <div class="shape-1 shape-md bg-secondary rounded-circle"></div>
                    <div class="shape-2 shape-xl bg-tertiary rounded-circle"></div>
                    <div class="shape-3 shape-lg bg-primary rounded-circle"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->

<!-- start section -->
<section class="section-padding pt-0">
    <div class="container">
        <div class="shadow px-4 pt-30">
            <div class="has-colored-text row no-gutters overflow-hidden">
                <div class="col-lg-3 col-sm-6 text-center border-right border-md-0 mb-30" data-aos="fade-up">
                    <p class="has-text-color mb-10 text-capitalize">{{trans('messages.about_us.card_title1')}}</p>
                    <h2 class="text-black-200 font-weight-bold">
                    <span class="jsCounter-2" data-count="{{trans('messages.about_us.card_subtitle1')}}">0</span></h2>
                </div>
                <div class="col-lg-3 col-sm-6 text-center border-right border-lg-0 mb-30" data-aos="fade-up" data-aos-delay="100">
                    <p class="has-text-color mb-10 text-capitalize">{{trans('messages.about_us.card_title2')}}</p>
                    <h2 class="text-black-200 font-weight-bold">
                    <span class="jsCounter-2" data-count="{{trans('messages.about_us.card_subtitle2')}}">0</span>+</h2>
                </div>
                <div class="col-lg-3 col-sm-6 text-center border-right border-md-0 mb-30" data-aos="fade-up" data-aos-delay="200">
                    <p class="has-text-color mb-10 text-capitalize">{{trans('messages.about_us.card_title3')}}</p>
                    <h2 class="text-black-200 font-weight-bold">
                    <span class="jsCounter-2" data-count="{{trans('messages.about_us.card_subtitle3')}}">0</span>M+</h2>
                </div>
                <div class="col-lg-3 col-sm-6 text-center mb-30" data-aos="fade-up" data-aos-delay="300">
                    <p class="has-text-color mb-10 text-capitalize">{{trans('messages.about_us.card_title4')}}</p>
                    <h2 class="text-black-200 font-weight-bold">
                    <span class="jsCounter-2" data-count="{{trans('messages.about_us.card_subtitle4')}}">0</span></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->

<!-- start section -->
<section class="pt-120 pb-120 image-info-section has-shapes bg-light-gray has-bg-brash bg-brash-y overflow-hidden" style="background-image: url(theme/images/brushes/section-top.svg), url(theme/images/brushes/section-bottom.svg);">
    <div class="container">
        <div class="row align-items-center justify-content-around">
            <div class="col-lg-5 col-md-8 col-sm-10">
                <div class="d-inline-block has-shadow shadow-left has-shapes">
                    <img class="img-fluid rounded-sm" src="theme/images/about/03.jpg" alt="">
    
                    <div class="shape-1 shape-md bg-secondary rounded-circle"></div>
                    <div class="shape-2 shape-xl bg-tertiary rounded-circle"></div>
                    <div class="shape-3 shape-lg bg-primary rounded-circle"></div>
                </div>
            </div>
            <div class="col-lg-5 col-md-8 col-sm-10 mt-5 mt-lg-0">
                <h2 class="section-title"><strong>{{trans('messages.about_us.title2')}}</strong></h2>
                <p class="pb-20">{{trans('messages.about_us.subtitle2')}}</p>
            </div>
        </div>
    </div>
    
    <div class="shape-3 shape-xs-2 bg-secondary rounded-circle"></div>
    <div class="shape-4 shape-sm-2 bg-tertiary rounded-circle"></div>
    <div class="shape-5 shape-sm bg-primary rounded-circle"></div>
    <div class="shape-6 shape-xs bg-secondary rounded-circle"></div>
    <div class="shape-7 shape-xs-2 bg-tertiary rounded-circle"></div>
</section>
<!-- end section -->

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

<!-- start of video-testimonials -->
<section class="pt-100 has-shapes bg-light-gray has-bg-brash bg-brash-top" style="background-image: url(theme/images/brushes/section-top.svg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="has-video-popup">
                    <button type="button" class="video-play-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/wCh-OviwZiY" data-target="#videoModal"><svg width="1.8em" height="1.8em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M11.596 8.697l-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/></svg></button>
                    <img class="rounded img-fluid" src="theme/images/testimonials/01.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="pl-0 pl-lg-4">
                    <h5 class="border-bottom pb-20 mb-20">“{{trans('messages.about_us.ceo_statement')}}”</h5>
                    <p class="text-black-900">
                        <span class="border-right pr-2 mr-2">Gordon Johnson</span>
                        <span>CEO, {{$site_name}}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of video-testimonials -->

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

<!-- strat scroll to top -->
<a href="#top" class="btn btn-primary scroll-to-top-btn smooth-scroll position-fixed"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32"><path id="Layer" fill="currentColor" d="M7.2 19.2L15.2 11.2C15.68 10.71 16.43 10.68 16.96 11.08L17.08 11.2L25.08 19.2L23.2 21.08L16.14 14.02L9.08 21.08L7.2 19.2Z"/></svg></a>
<!-- end scroll to top -->

<!-- Plugins Needed for the Project -->
<script src="plugins/jQuery/jquery.min.js"></script>
<script src="{{ asset('theme/plugins/jQuery/jquery.min.js') }}"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="{{ asset('theme/plugins/bootstrap/bootstrap.min.js') }}"></script>
<script src="plugins/slick/slick.min.js"></script>
<script src="{{ asset('theme/plugins/slick/slick.min.js') }}"></script>
<script src="plugins/shuffle/shuffle.min.js"></script>
<script src="{{ asset('theme/plugins/shuffle/shuffle.min.js') }}"></script>
<script src="plugins/aos/aos.js"></script>
<script src="{{ asset('theme/plugins/aos/aos.js') }}"></script>

<!-- Main Script -->
<script src="{{ asset('theme/js/script.js') }}"></script>

</body>

</html>
@stop