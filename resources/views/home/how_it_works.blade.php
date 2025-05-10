@extends('webtemplate')
@section('main')
<!-- start of page-header -->
<section class="page-header bg-light-gray has-shapes has-bg-brash bg-brash-bottom" style="background-image:url(theme/images/brushes/banner.svg)">
    <div class="container h-100">
        <div class="row d-flex align-items-center h-100">
            <div class="col-md-12 text-center">
                <h2 class="h1 font-weight-bold">{{trans('messages.how_it_works.title')}}</h2>
                <nav class="mt-15" aria-label="breadcrumb">
                    <ol class="breadcrumb font-weight-bold bg-transparent p-0 justify-content-center">
                        <li class="breadcrumb-item"><a href="{{'/'}}" class="text-black-300">Home</a></li>
                        <li class="breadcrumb-item text-primary" aria-current="page">{{trans('messages.header.how_it_works')}}</li>
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

<!-- start of section -->
<section class="section-padding pb-0">
    <div class="container">
        <div class="row align-items-center justify-content-around">
            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="150">
                <img class="img-fluid rounded-lg shadow" src="theme/images/screenshots/user4.png" alt="">
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-in">
                <h2 class="section-title"><strong>{{trans('messages.how_it_works.subtitle1')}}</strong></h2>
                <p>{{trans('messages.how_it_works.subtitle1_description')}}</p>
            </div>
        </div>
    </div>
</section>
<!-- end of section -->


<!-- start of image-info -->
<section class="section-padding image-info-section has-shapes bg-light-gray has-bg-brash bg-brash-y" style="background-image: url(theme/images/brushes/section-top.svg), url(theme/images/brushes/section-bottom.svg);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-5" data-aos="fade-in">
                <h2 class="section-title"><strong>{{trans('messages.how_it_works.subtitle2')}}</strong></h2>
                <p>{{trans('messages.how_it_works.subtitle2_description')}}</p>
            </div>
            <div class="col-lg-8 col-md-7" data-aos="fade-up" data-aos-delay="150">
                <div class="has-shapes">
                    <img class="img-fluid py-4 my-2" src="theme/images/screenshots/user13.png" alt="">

                    <div class="shape-1 shape-sm bg-secondary rounded-circle"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="shape-3 shape-xs-2 bg-secondary rounded-circle"></div>
    <div class="shape-4 shape-sm-2 bg-tertiary rounded-circle"></div>
    <div class="shape-5 shape-sm bg-primary rounded-circle"></div>
    <div class="shape-6 shape-xs bg-secondary rounded-circle"></div>
    <div class="shape-7 shape-xs-2 bg-tertiary rounded-circle"></div>
</section>
<!-- end of image-info -->

<!-- start of section -->
<section class="pt-50 pb-50">
    <div class="container">
        <div class="row align-items-center justify-content-around">
            <div class="col-lg-7" data-aos="fade-up">
                <img class="img-fluid" src="theme/images/screenshots/pickup.png" alt="">
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-in">
                <h2 class="section-title"><strong></strong>{{trans('messages.how_it_works.subtitle3')}}</strong></h2>
                <p class="mb-30">{{trans('messages.how_it_works.subtitle3_description')}}</p>
            </div>
        </div>
    </div>
</section>
<!-- end of section -->

<!-- start of image-info -->
<section class="section-padding image-info-section has-shapes bg-light-gray has-bg-brash bg-brash-y" style="background-image: url(theme/images/brushes/section-top.svg), url(theme/images/brushes/section-bottom.svg);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-5" data-aos="fade-in">
                <h2 class="section-title"><strong>{{trans('messages.how_it_works.subtitle4')}}</strong></h2>
                <p>{{trans('messages.how_it_works.subtitle4_description')}}</p>
            </div>
            <div class="col-lg-8 col-md-7" data-aos="fade-up" data-aos-delay="150">
                <div class="has-shapes">
                    <img class="img-fluid py-4 my-2" src="theme/images/screenshots/user11.png" alt="">

                    <div class="shape-1 shape-sm bg-secondary rounded-circle"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="shape-3 shape-xs-2 bg-secondary rounded-circle"></div>
    <div class="shape-4 shape-sm-2 bg-tertiary rounded-circle"></div>
    <div class="shape-5 shape-sm bg-primary rounded-circle"></div>
    <div class="shape-6 shape-xs bg-secondary rounded-circle"></div>
    <div class="shape-7 shape-xs-2 bg-tertiary rounded-circle"></div>
</section>
<!-- end of image-info -->


<!-- start of section -->
<section class="pt-50 pb-50">
    <div class="container">
        <div class="row align-items-center justify-content-around">
            <div class="col-lg-7" data-aos="fade-up">
                <img class="img-fluid" src="theme/images/screenshots/rating.png" alt="">
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-in">
                <h2 class="section-title"><strong></strong>{{trans('messages.how_it_works.subtitle5')}}</strong></h2>
                <p class="mb-30">{{trans('messages.how_it_works.subtitle5_description')}}</p>
            </div>
        </div>
    </div>
</section>
<!-- end of section -->
@stop