@extends('webtemplate')
@section('main')

<!-- start of page-header -->
<section class="page-header bg-light-gray has-shapes has-bg-brash bg-brash-bottom" style="background-image:url(theme/images/brushes/banner.svg)">
    <div class="container h-100">
        <div class="row d-flex align-items-center h-100">
            <div class="col-md-12 text-center">
                <h2 class="h1 font-weight-bold">Testimonials</h2>
                <nav class="mt-15" aria-label="breadcrumb">
                    <ol class="breadcrumb font-weight-bold bg-transparent p-0 justify-content-center">
                        <li class="breadcrumb-item"><a href="index.html" class="text-black-300">Home</a></li>
                        <li class="breadcrumb-item text-primary" aria-current="page">Testimonials</li>
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

<!-- start of testimonials-section -->
<section class="section-padding testimonials-section pb-20" data-aos="fade-in" data-aos-delay="150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 text-center mb-30">
                <h2 class="font-weight-bold mb-20"><span class="font-weight-light">What Our</span> Client says</h2>
                <p>Lorem ipsum sadip dolor sit amet, consetetur sadip scing elitr, diam nonumy eirmod tempor invi duntut labore et dolore magna aliquyam erat, sed diam</p>
            </div>
        </div>
        <div class="testimonials-items row">
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="testimonials-item bg-white">
                    <div class="block border rounded bg-white">
                        <svg class="icon mb-15" width="25" height="20" viewBox="0 0 40 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.75001 35L13.75 35C15.8203 35 17.5 33.3203 17.5 31.25L17.5 21.25C17.5 19.1797 15.8203 17.5 13.75 17.5L7.50001 17.5L7.50001 12.5C7.50001 9.74219 9.74219 7.5 12.5 7.5L13.125 7.5C14.1641 7.5 15 6.66406 15 5.625L15 1.875C15 0.83594 14.1641 2.25865e-06 13.125 2.34949e-06L12.5 2.40413e-06C5.59375 3.00789e-06 5.05862e-06 5.59375 5.66238e-06 12.5L7.30156e-06 31.25C7.48255e-06 33.3203 1.6797 35 3.75001 35ZM26.25 35L36.25 35C38.3203 35 40 33.3203 40 31.25L40 21.25C40 19.1797 38.3203 17.5 36.25 17.5L30 17.5L30 12.5C30 9.74219 32.2422 7.5 35 7.5L35.625 7.5C36.6641 7.5 37.5 6.66406 37.5 5.625L37.5 1.875C37.5 0.835938 36.6641 2.91637e-07 35.625 3.82475e-07L35 4.37114e-07C28.0937 1.04088e-06 22.5 5.59375 22.5 12.5L22.5 31.25C22.5 33.3203 24.1797 35 26.25 35Z" fill="currentColor"/></svg>
                        <p class="h4 text-black-300 font-weight-light">Lorem ipsum dolor sit amet, kasd gubergren, seatakimata dolores et rebum stetclita</p>
                        <img src="theme/images/testimonials/arrow.png" alt="">
                    </div>
                    <div class="user-info d-flex align-items-center mt-30">
                        <img class="d-inline rounded-circle mr-3" src="theme/images/users/01.jpg" alt="">
                        <div class="pt-1">
                            <h5 class="font-weight-bold">Angela Markel</h5>
                            <p>CEO, Angular Corporation</p>
                        </div>
                    </div>
                </div>
                <!-- testimonials-item -->
            </div>
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="testimonials-item bg-white">
                    <div class="block border rounded bg-white">
                        <svg class="icon mb-15" width="25" height="20" viewBox="0 0 40 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.75001 35L13.75 35C15.8203 35 17.5 33.3203 17.5 31.25L17.5 21.25C17.5 19.1797 15.8203 17.5 13.75 17.5L7.50001 17.5L7.50001 12.5C7.50001 9.74219 9.74219 7.5 12.5 7.5L13.125 7.5C14.1641 7.5 15 6.66406 15 5.625L15 1.875C15 0.83594 14.1641 2.25865e-06 13.125 2.34949e-06L12.5 2.40413e-06C5.59375 3.00789e-06 5.05862e-06 5.59375 5.66238e-06 12.5L7.30156e-06 31.25C7.48255e-06 33.3203 1.6797 35 3.75001 35ZM26.25 35L36.25 35C38.3203 35 40 33.3203 40 31.25L40 21.25C40 19.1797 38.3203 17.5 36.25 17.5L30 17.5L30 12.5C30 9.74219 32.2422 7.5 35 7.5L35.625 7.5C36.6641 7.5 37.5 6.66406 37.5 5.625L37.5 1.875C37.5 0.835938 36.6641 2.91637e-07 35.625 3.82475e-07L35 4.37114e-07C28.0937 1.04088e-06 22.5 5.59375 22.5 12.5L22.5 31.25C22.5 33.3203 24.1797 35 26.25 35Z" fill="currentColor"/></svg>
                        <p class="h4 text-black-300 font-weight-light">Lorem ipsum dolor sit amet, kasd gubergren, seatakimata dolores et rebum stetclita</p>
                        <img src="theme/images/testimonials/arrow.png" alt="">
                    </div>
                    <div class="user-info d-flex align-items-center mt-30">
                        <img class="d-inline rounded-circle mr-3" src="theme/images/users/02.jpg" alt="">
                        <div class="pt-1">
                            <h5 class="font-weight-bold">Angela Markel</h5>
                            <p>CEO, Angular Corporation</p>
                        </div>
                    </div>
                </div>
                <!-- testimonials-item -->
            </div>
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="testimonials-item bg-white">
                    <div class="block border rounded bg-white">
                        <svg class="icon mb-15" width="25" height="20" viewBox="0 0 40 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.75001 35L13.75 35C15.8203 35 17.5 33.3203 17.5 31.25L17.5 21.25C17.5 19.1797 15.8203 17.5 13.75 17.5L7.50001 17.5L7.50001 12.5C7.50001 9.74219 9.74219 7.5 12.5 7.5L13.125 7.5C14.1641 7.5 15 6.66406 15 5.625L15 1.875C15 0.83594 14.1641 2.25865e-06 13.125 2.34949e-06L12.5 2.40413e-06C5.59375 3.00789e-06 5.05862e-06 5.59375 5.66238e-06 12.5L7.30156e-06 31.25C7.48255e-06 33.3203 1.6797 35 3.75001 35ZM26.25 35L36.25 35C38.3203 35 40 33.3203 40 31.25L40 21.25C40 19.1797 38.3203 17.5 36.25 17.5L30 17.5L30 12.5C30 9.74219 32.2422 7.5 35 7.5L35.625 7.5C36.6641 7.5 37.5 6.66406 37.5 5.625L37.5 1.875C37.5 0.835938 36.6641 2.91637e-07 35.625 3.82475e-07L35 4.37114e-07C28.0937 1.04088e-06 22.5 5.59375 22.5 12.5L22.5 31.25C22.5 33.3203 24.1797 35 26.25 35Z" fill="currentColor"/></svg>
                        <p class="h4 text-black-300 font-weight-light">Lorem ipsum dolor sit amet, kasd gubergren, seatakimata dolores et rebum stetclita</p>
                        <img src="theme/images/testimonials/arrow.png" alt="">
                    </div>
                    <div class="user-info d-flex align-items-center mt-30">
                        <img class="d-inline rounded-circle mr-3" src="theme/images/users/03.jpg" alt="">
                        <div class="pt-1">
                            <h5 class="font-weight-bold">Angela Markel</h5>
                            <p>CEO, Angular Corporation</p>
                        </div>
                    </div>
                </div>
                <!-- testimonials-item -->
            </div>
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="testimonials-item bg-white">
                    <div class="block border rounded bg-white">
                        <svg class="icon mb-15" width="25" height="20" viewBox="0 0 40 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.75001 35L13.75 35C15.8203 35 17.5 33.3203 17.5 31.25L17.5 21.25C17.5 19.1797 15.8203 17.5 13.75 17.5L7.50001 17.5L7.50001 12.5C7.50001 9.74219 9.74219 7.5 12.5 7.5L13.125 7.5C14.1641 7.5 15 6.66406 15 5.625L15 1.875C15 0.83594 14.1641 2.25865e-06 13.125 2.34949e-06L12.5 2.40413e-06C5.59375 3.00789e-06 5.05862e-06 5.59375 5.66238e-06 12.5L7.30156e-06 31.25C7.48255e-06 33.3203 1.6797 35 3.75001 35ZM26.25 35L36.25 35C38.3203 35 40 33.3203 40 31.25L40 21.25C40 19.1797 38.3203 17.5 36.25 17.5L30 17.5L30 12.5C30 9.74219 32.2422 7.5 35 7.5L35.625 7.5C36.6641 7.5 37.5 6.66406 37.5 5.625L37.5 1.875C37.5 0.835938 36.6641 2.91637e-07 35.625 3.82475e-07L35 4.37114e-07C28.0937 1.04088e-06 22.5 5.59375 22.5 12.5L22.5 31.25C22.5 33.3203 24.1797 35 26.25 35Z" fill="currentColor"/></svg>
                        <p class="h4 text-black-300 font-weight-light">Lorem ipsum dolor sit amet, kasd gubergren, seatakimata dolores et rebum stetclita</p>
                        <img src="theme/images/testimonials/arrow.png" alt="">
                    </div>
                    <div class="user-info d-flex align-items-center mt-30">
                        <img class="d-inline rounded-circle mr-3" src="theme/images/users/02.jpg" alt="">
                        <div class="pt-1">
                            <h5 class="font-weight-bold">Angela Markel</h5>
                            <p>CEO, Angular Corporation</p>
                        </div>
                    </div>
                </div>
                <!-- testimonials-item -->
            </div>
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="testimonials-item bg-white">
                    <div class="block border rounded bg-white">
                        <svg class="icon mb-15" width="25" height="20" viewBox="0 0 40 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.75001 35L13.75 35C15.8203 35 17.5 33.3203 17.5 31.25L17.5 21.25C17.5 19.1797 15.8203 17.5 13.75 17.5L7.50001 17.5L7.50001 12.5C7.50001 9.74219 9.74219 7.5 12.5 7.5L13.125 7.5C14.1641 7.5 15 6.66406 15 5.625L15 1.875C15 0.83594 14.1641 2.25865e-06 13.125 2.34949e-06L12.5 2.40413e-06C5.59375 3.00789e-06 5.05862e-06 5.59375 5.66238e-06 12.5L7.30156e-06 31.25C7.48255e-06 33.3203 1.6797 35 3.75001 35ZM26.25 35L36.25 35C38.3203 35 40 33.3203 40 31.25L40 21.25C40 19.1797 38.3203 17.5 36.25 17.5L30 17.5L30 12.5C30 9.74219 32.2422 7.5 35 7.5L35.625 7.5C36.6641 7.5 37.5 6.66406 37.5 5.625L37.5 1.875C37.5 0.835938 36.6641 2.91637e-07 35.625 3.82475e-07L35 4.37114e-07C28.0937 1.04088e-06 22.5 5.59375 22.5 12.5L22.5 31.25C22.5 33.3203 24.1797 35 26.25 35Z" fill="currentColor"/></svg>
                        <p class="h4 text-black-300 font-weight-light">Lorem ipsum dolor sit amet, kasd gubergren, seatakimata dolores et rebum stetclita</p>
                        <img src="theme/images/testimonials/arrow.png" alt="">
                    </div>
                    <div class="user-info d-flex align-items-center mt-30">
                        <img class="d-inline rounded-circle mr-3" src="theme/images/users/01.jpg" alt="">
                        <div class="pt-1">
                            <h5 class="font-weight-bold">Angela Markel</h5>
                            <p>CEO, Angular Corporation</p>
                        </div>
                    </div>
                </div>
                <!-- testimonials-item -->
            </div>
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="testimonials-item bg-white">
                    <div class="block border rounded bg-white">
                        <svg class="icon mb-15" width="25" height="20" viewBox="0 0 40 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.75001 35L13.75 35C15.8203 35 17.5 33.3203 17.5 31.25L17.5 21.25C17.5 19.1797 15.8203 17.5 13.75 17.5L7.50001 17.5L7.50001 12.5C7.50001 9.74219 9.74219 7.5 12.5 7.5L13.125 7.5C14.1641 7.5 15 6.66406 15 5.625L15 1.875C15 0.83594 14.1641 2.25865e-06 13.125 2.34949e-06L12.5 2.40413e-06C5.59375 3.00789e-06 5.05862e-06 5.59375 5.66238e-06 12.5L7.30156e-06 31.25C7.48255e-06 33.3203 1.6797 35 3.75001 35ZM26.25 35L36.25 35C38.3203 35 40 33.3203 40 31.25L40 21.25C40 19.1797 38.3203 17.5 36.25 17.5L30 17.5L30 12.5C30 9.74219 32.2422 7.5 35 7.5L35.625 7.5C36.6641 7.5 37.5 6.66406 37.5 5.625L37.5 1.875C37.5 0.835938 36.6641 2.91637e-07 35.625 3.82475e-07L35 4.37114e-07C28.0937 1.04088e-06 22.5 5.59375 22.5 12.5L22.5 31.25C22.5 33.3203 24.1797 35 26.25 35Z" fill="currentColor"/></svg>
                        <p class="h4 text-black-300 font-weight-light">Lorem ipsum dolor sit amet, kasd gubergren, seatakimata dolores et rebum stetclita</p>
                        <img src="theme/images/testimonials/arrow.png" alt="">
                    </div>
                    <div class="user-info d-flex align-items-center mt-30">
                        <img class="d-inline rounded-circle mr-3" src="theme/images/users/02.jpg" alt="">
                        <div class="pt-1">
                            <h5 class="font-weight-bold">Angela Markel</h5>
                            <p>CEO, Angular Corporation</p>
                        </div>
                    </div>
                </div>
                <!-- testimonials-item -->
            </div>
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="testimonials-item bg-white">
                    <div class="block border rounded bg-white">
                        <svg class="icon mb-15" width="25" height="20" viewBox="0 0 40 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.75001 35L13.75 35C15.8203 35 17.5 33.3203 17.5 31.25L17.5 21.25C17.5 19.1797 15.8203 17.5 13.75 17.5L7.50001 17.5L7.50001 12.5C7.50001 9.74219 9.74219 7.5 12.5 7.5L13.125 7.5C14.1641 7.5 15 6.66406 15 5.625L15 1.875C15 0.83594 14.1641 2.25865e-06 13.125 2.34949e-06L12.5 2.40413e-06C5.59375 3.00789e-06 5.05862e-06 5.59375 5.66238e-06 12.5L7.30156e-06 31.25C7.48255e-06 33.3203 1.6797 35 3.75001 35ZM26.25 35L36.25 35C38.3203 35 40 33.3203 40 31.25L40 21.25C40 19.1797 38.3203 17.5 36.25 17.5L30 17.5L30 12.5C30 9.74219 32.2422 7.5 35 7.5L35.625 7.5C36.6641 7.5 37.5 6.66406 37.5 5.625L37.5 1.875C37.5 0.835938 36.6641 2.91637e-07 35.625 3.82475e-07L35 4.37114e-07C28.0937 1.04088e-06 22.5 5.59375 22.5 12.5L22.5 31.25C22.5 33.3203 24.1797 35 26.25 35Z" fill="currentColor"/></svg>
                        <p class="h4 text-black-300 font-weight-light">Lorem ipsum dolor sit amet, kasd gubergren, seatakimata dolores et rebum stetclita</p>
                        <img src="theme/images/testimonials/arrow.png" alt="">
                    </div>
                    <div class="user-info d-flex align-items-center mt-30">
                        <img class="d-inline rounded-circle mr-3" src="theme/images/users/03.jpg" alt="">
                        <div class="pt-1">
                            <h5 class="font-weight-bold">Angela Markel</h5>
                            <p>CEO, Angular Corporation</p>
                        </div>
                    </div>
                </div>
                <!-- testimonials-item -->
            </div>
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="testimonials-item bg-white">
                    <div class="block border rounded bg-white">
                        <svg class="icon mb-15" width="25" height="20" viewBox="0 0 40 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.75001 35L13.75 35C15.8203 35 17.5 33.3203 17.5 31.25L17.5 21.25C17.5 19.1797 15.8203 17.5 13.75 17.5L7.50001 17.5L7.50001 12.5C7.50001 9.74219 9.74219 7.5 12.5 7.5L13.125 7.5C14.1641 7.5 15 6.66406 15 5.625L15 1.875C15 0.83594 14.1641 2.25865e-06 13.125 2.34949e-06L12.5 2.40413e-06C5.59375 3.00789e-06 5.05862e-06 5.59375 5.66238e-06 12.5L7.30156e-06 31.25C7.48255e-06 33.3203 1.6797 35 3.75001 35ZM26.25 35L36.25 35C38.3203 35 40 33.3203 40 31.25L40 21.25C40 19.1797 38.3203 17.5 36.25 17.5L30 17.5L30 12.5C30 9.74219 32.2422 7.5 35 7.5L35.625 7.5C36.6641 7.5 37.5 6.66406 37.5 5.625L37.5 1.875C37.5 0.835938 36.6641 2.91637e-07 35.625 3.82475e-07L35 4.37114e-07C28.0937 1.04088e-06 22.5 5.59375 22.5 12.5L22.5 31.25C22.5 33.3203 24.1797 35 26.25 35Z" fill="currentColor"/></svg>
                        <p class="h4 text-black-300 font-weight-light">Lorem ipsum dolor sit amet, kasd gubergren, seatakimata dolores et rebum stetclita</p>
                        <img src="theme/images/testimonials/arrow.png" alt="">
                    </div>
                    <div class="user-info d-flex align-items-center mt-30">
                        <img class="d-inline rounded-circle mr-3" src="theme/images/users/02.jpg" alt="">
                        <div class="pt-1">
                            <h5 class="font-weight-bold">Angela Markel</h5>
                            <p>CEO, Angular Corporation</p>
                        </div>
                    </div>
                </div>
                <!-- testimonials-item -->
            </div>
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="testimonials-item bg-white">
                    <div class="block border rounded bg-white">
                        <svg class="icon mb-15" width="25" height="20" viewBox="0 0 40 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.75001 35L13.75 35C15.8203 35 17.5 33.3203 17.5 31.25L17.5 21.25C17.5 19.1797 15.8203 17.5 13.75 17.5L7.50001 17.5L7.50001 12.5C7.50001 9.74219 9.74219 7.5 12.5 7.5L13.125 7.5C14.1641 7.5 15 6.66406 15 5.625L15 1.875C15 0.83594 14.1641 2.25865e-06 13.125 2.34949e-06L12.5 2.40413e-06C5.59375 3.00789e-06 5.05862e-06 5.59375 5.66238e-06 12.5L7.30156e-06 31.25C7.48255e-06 33.3203 1.6797 35 3.75001 35ZM26.25 35L36.25 35C38.3203 35 40 33.3203 40 31.25L40 21.25C40 19.1797 38.3203 17.5 36.25 17.5L30 17.5L30 12.5C30 9.74219 32.2422 7.5 35 7.5L35.625 7.5C36.6641 7.5 37.5 6.66406 37.5 5.625L37.5 1.875C37.5 0.835938 36.6641 2.91637e-07 35.625 3.82475e-07L35 4.37114e-07C28.0937 1.04088e-06 22.5 5.59375 22.5 12.5L22.5 31.25C22.5 33.3203 24.1797 35 26.25 35Z" fill="currentColor"/></svg>
                        <p class="h4 text-black-300 font-weight-light">Lorem ipsum dolor sit amet, kasd gubergren, seatakimata dolores et rebum stetclita</p>
                        <img src="theme/images/testimonials/arrow.png" alt="">
                    </div>
                    <div class="user-info d-flex align-items-center mt-30">
                        <img class="d-inline rounded-circle mr-3" src="theme/images/users/02.jpg" alt="">
                        <div class="pt-1">
                            <h5 class="font-weight-bold">Angela Markel</h5>
                            <p>CEO, Angular Corporation</p>
                        </div>
                    </div>
                </div>
                <!-- testimonials-item -->
            </div>
        </div>
    </div>
</section>
<!-- end of testimonials-section -->

<!-- start of video-testimonials -->
<section class="pt-100 has-shapes bg-light-gray has-bg-brash bg-brash-top" style="background-image: url(theme/images/brushes/section-top.svg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="has-video-popup">
                    <button type="button" class="video-play-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/dyZcRRWiuuw" data-target="#videoModal"><svg width="1.8em" height="1.8em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M11.596 8.697l-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/></svg></button>
                    <img class="rounded img-fluid" src="theme/images/testimonials/01.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="pl-0 pl-lg-4">
                    <h2 class="border-bottom pb-20 mb-20">“Copper gives us the ease to have people hop in where they need to, to get to a customer resolution really quickly.”</h2>
                    <p class="text-black-900">
                        <span class="border-right pr-2 mr-2">Marsh Angela Costa</span>
                        <span>CEO, Trello</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of video-testimonials -->
@stop