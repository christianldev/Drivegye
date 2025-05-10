@extends('webtemplate')
@section('main')
<!-- start of page-header -->
<section class="page-header bg-light-gray has-shapes has-bg-brash bg-brash-bottom" style="background-image:url(theme/images/brushes/banner.svg)">
    <div class="container h-100">
        <div class="row d-flex align-items-center h-100">
            <div class="col-md-12 text-center">
                <h2 class="h1 font-weight-bold">{{trans('messages.services.title')}}</h2>
                <nav class="mt-15" aria-label="breadcrumb">
                    <ol class="breadcrumb font-weight-bold bg-transparent p-0 justify-content-center">
                        <li class="breadcrumb-item"><a href="{{'/'}}" class="text-black-300">Home</a></li>
                        <li class="breadcrumb-item text-primary" aria-current="page">Service</li>
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

<!-- start of services-section -->
<section class="section-padding" data-aos="fade-in" data-aos-delay="150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 text-center mb-40">
                <h2 class="section-title"><strong>{{trans('messages.services.subtitle')}}</strong></h2>
                <p>{{trans('messages.services.subtitle_description')}}</p>
            </div>
        </div>
       
								
        <div class="row no-gutters">
             @foreach($car_type as $car_type)
            <div class="col-lg-4 col-md-6 service-box shadow">
                <div class="block p-4 p-xl-5 text-center">
                     <div class="team-image has-shapes d-inline-block mb-25">
                        <img class="img-fluid rounded-circle" src="{{$car_type->vehicle_image}}" alt="">

                        <div class="team-shapes">
                            <div class="shape-1 shape-xs bg-tertiary rounded-circle"></div>
                            <div class="shape-2 shape-sm bg-secondary rounded-circle"></div>
                            <div class="shape-3 shape-sm-2 bg-primary rounded-circle"></div>
                        </div>
                    </div>
                    <h3 class="font-weight-600 mt-20 mb-20">{{$car_type->car_name}}</h3>
                    <p>{{$car_type->description}} </p>
                </div>
            </div>
            @endforeach
           
            <div class="col-12"><div class="border-bottom border-md-0"></div></div>
        </div>
    </div>
</section>
<!-- end of services-section -->

@stop