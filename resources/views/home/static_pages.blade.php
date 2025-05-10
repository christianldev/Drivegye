@extends('webtemplate')
   
@section('main')
<main role="main" id="site-content">
    
    <!-- start of page-header -->
<section class="page-header bg-light-gray has-shapes has-bg-brash bg-brash-bottom" style="background-image:url(images/brushes/banner.svg)">
    <div class="container h-100">
        <div class="row d-flex align-items-center h-100">
            <div class="col-md-12 text-center">
                <h2 class="h1 font-weight-bold">{!! $title !!}</h2>
                <nav class="mt-15" aria-label="breadcrumb">
                    <ol class="breadcrumb font-weight-bold bg-transparent p-0 justify-content-center">
                        <li class="breadcrumb-item"><a href="{{'/'}}" class="text-black-300">Home</a></li>
                        <li class="breadcrumb-item text-primary" aria-current="page">{!! $title !!}</li>
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

<!-- start of terms-&-condition-section -->
<section class="section-padding" data-aos="fade-in" data-aos-delay="150">
    <div class="container">
     
        <div class="row no-gutters">
            <div class="col-lg-3 col-md-4 mt-2 mt-lg-0 d-none d-md-block">
                <ul id="navbar-spy" class="nav flex-column tabs-navbar position-sticky">
                    @foreach($company_pages as $company_page)
                    <li class="nav-item">
                        <a class="nav-link h5 font-weight-600 px-0 py-4 border-bottom smooth-scroll" href="{{ url($company_page->url) }}">	{{ $company_page->name }}</a>
                    </li>
                    @endforeach
                   
                </ul>
            </div>
            <div class="col-lg-8 col-md-8 border-left border-lg-0">
                <div class="pl-0 pl-md-4 ml-0 ml-md-2">
                    <div id="one" class="pt-30">
                        <p> {!! $content !!}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
    
</main>
@push('scripts')
<script type="text/javascript">
$( document ).ready(function() {
 
 var base_url = "{!! url('/') !!}";
 var user_token = '{!! Session::get('get_token') !!}';

	if(user_token!='')
	{
	  	$('a[href*="'+base_url+'"]').attr('href' , 'javascript:void(0)');
	 }

});

</script>
@endpush
@stop