@extends('webtemplate')
@section('main')

<!-- start of page-header -->
<section class="page-header bg-light-gray has-shapes has-bg-brash bg-brash-bottom" style="background-image:url(theme/images/brushes/banner.svg)">
    <div class="container h-100">
        <div class="row d-flex align-items-center h-100">
            <div class="col-md-12 text-center">
                <h2 class="h1 font-weight-bold">Our Team</h2>
                <nav class="mt-15" aria-label="breadcrumb">
                    <ol class="breadcrumb font-weight-bold bg-transparent p-0 justify-content-center">
                        <li class="breadcrumb-item"><a href="index.html" class="text-black-300">Home</a></li>
                        <li class="breadcrumb-item text-primary" aria-current="page">Team</li>
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

<!-- start of team-section -->
<section class="section-padding pb-40" data-aos="fade-in" data-aos-delay="150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 text-center mb-40">
                <h2 class="section-title">Our <strong>Team members</strong></h2>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat sed.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 mb-25">
                <div class="team-filters text-uppercase text-center w-100" data-toggle="buttons">
                    <label class="btn active mb-3">
                        <input class="d-none" type="radio" name="shuffle-filter" value="all" checked="checked">
                        All Together
                    </label>
                    <label class="btn mb-3">
                        <input class="d-none" type="radio" name="shuffle-filter" value="designer">
                        Designers
                    </label>
                    <label class="btn mb-3">
                        <input class="d-none" type="radio" name="shuffle-filter" value="developers">
                        Developers
                    </label>
                    <label class="btn mb-3">
                        <input class="d-none" type="radio" name="shuffle-filter" value="marketrs">
                        Marketrs
                    </label>
                </div>
            </div>
        </div>
        <div id="masonry" class="row team-members">
            <div class="masonry-item team-item col-lg-4 col-sm-6 mt-4" data-groups="[&quot;developers&quot;]">
                <div class="text-center mb-30">
                    <div class="team-image has-shapes d-inline-block mb-25">
                        <img class="img-fluid rounded-circle" src="theme/images/team/01.jpg" alt="">

                        <div class="team-shapes">
                            <div class="shape-1 shape-xs bg-secondary rounded-circle"></div>
                            <div class="shape-2 shape-sm bg-primary rounded-circle"></div>
                            <div class="shape-3 shape-sm-2 bg-tertiary rounded-circle"></div>
                        </div>
                    </div>
                    <h4 class="font-weight-bold mb-10">Angelina Jolie</h4>
                    <p>UI/UX Designer</p>
                    <ul class="list-unstyled list-inline mt-2">
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-linkedin"></span></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-twitter-alt"></span></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-facebook"></span></a>
                        </li>
                    </ul>
                </div>
                <!-- team item -->
            </div>
            <div class="masonry-item team-item col-lg-4 col-sm-6 mt-4" data-groups="[&quot;designer&quot;]">
                <div class="text-center mb-30">
                    <div class="team-image has-shapes d-inline-block mb-25">
                        <img class="img-fluid rounded-circle" src="theme/images/team/02.jpg" alt="">

                        <div class="team-shapes">
                            <div class="shape-1 shape-xs bg-primary rounded-circle"></div>
                            <div class="shape-2 shape-sm bg-secondary rounded-circle"></div>
                            <div class="shape-3 shape-sm-2 bg-tertiary rounded-circle"></div>
                        </div>
                    </div>
                    <h4 class="font-weight-bold mb-10">Juley anle</h4>
                    <p>Founder & CEO</p>
                    <ul class="list-unstyled list-inline mt-2">
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-linkedin"></span></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-twitter-alt"></span></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-facebook"></span></a>
                        </li>
                    </ul>
                </div>
                <!-- team item -->
            </div>
            <div class="masonry-item team-item col-lg-4 col-sm-6 mt-4" data-groups="[&quot;marketrs&quot;]">
                <div class="text-center mb-30">
                    <div class="team-image has-shapes d-inline-block mb-25">
                        <img class="img-fluid rounded-circle" src="theme/images/team/03.jpg" alt="">

                        <div class="team-shapes">
                            <div class="shape-1 shape-xs bg-tertiary rounded-circle"></div>
                            <div class="shape-2 shape-sm bg-primary rounded-circle"></div>
                            <div class="shape-3 shape-sm-2 bg-secondary rounded-circle"></div>
                        </div>
                    </div>
                    <h4 class="font-weight-bold mb-10">Kim Domingo</h4>
                    <p>Software Engineer</p>
                    <ul class="list-unstyled list-inline mt-2">
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-linkedin"></span></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-twitter-alt"></span></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-facebook"></span></a>
                        </li>
                    </ul>
                </div>
                <!-- team item -->
            </div>
            <div class="masonry-item team-item col-lg-4 col-sm-6 mt-4" data-groups="[&quot;developers&quot;]">
                <div class="text-center mb-30">
                    <div class="team-image has-shapes d-inline-block mb-25">
                        <img class="img-fluid rounded-circle" src="theme/images/team/04.jpg" alt="">

                        <div class="team-shapes">
                            <div class="shape-1 shape-xs bg-secondary rounded-circle"></div>
                            <div class="shape-2 shape-sm bg-tertiary rounded-circle"></div>
                            <div class="shape-3 shape-sm-2 bg-primary rounded-circle"></div>
                        </div>
                    </div>
                    <h4 class="font-weight-bold mb-10">Angelina Jolie</h4>
                    <p>UI/UX Designer</p>
                    <ul class="list-unstyled list-inline mt-2">
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-linkedin"></span></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-twitter-alt"></span></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-facebook"></span></a>
                        </li>
                    </ul>
                </div>
                <!-- team item -->
            </div>
            <div class="masonry-item team-item col-lg-4 col-sm-6 mt-4" data-groups="[&quot;marketrs&quot;]">
                <div class="text-center mb-30">
                    <div class="team-image has-shapes d-inline-block mb-25">
                        <img class="img-fluid rounded-circle" src="theme/images/team/05.jpg" alt="">

                        <div class="team-shapes">
                            <div class="shape-1 shape-xs bg-tertiary rounded-circle"></div>
                            <div class="shape-2 shape-sm bg-secondary rounded-circle"></div>
                            <div class="shape-3 shape-sm-2 bg-primary rounded-circle"></div>
                        </div>
                    </div>
                    <h4 class="font-weight-bold mb-10">Steve anle</h4>
                    <p>Founder & CTO</p>
                    <ul class="list-unstyled list-inline mt-2">
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-linkedin"></span></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-twitter-alt"></span></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-facebook"></span></a>
                        </li>
                    </ul>
                </div>
                <!-- team item -->
            </div>
            <div class="masonry-item team-item col-lg-4 col-sm-6 mt-4" data-groups="[&quot;designer&quot;]">
                <div class="text-center mb-30">
                    <div class="team-image has-shapes d-inline-block mb-25">
                        <img class="img-fluid rounded-circle" src="theme/images/team/06.jpg" alt="">

                        <div class="team-shapes">
                            <div class="shape-1 shape-xs bg-secondary rounded-circle"></div>
                            <div class="shape-2 shape-sm bg-tertiary rounded-circle"></div>
                            <div class="shape-3 shape-sm-2 bg-primary rounded-circle"></div>
                        </div>
                    </div>
                    <h4 class="font-weight-bold mb-10">John Doelam</h4>
                    <p>Software Engineer</p>
                    <ul class="list-unstyled list-inline mt-2">
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-linkedin"></span></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-twitter-alt"></span></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" class="text-black-200 p-2 d-inline-block">
                            <span class="ti-facebook"></span></a>
                        </li>
                    </ul>
                </div>
                <!-- team item -->
            </div>
        </div>
    </div>
</section>
<!-- end of team-section -->
@stop