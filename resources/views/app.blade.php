<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Shofy - Multipurpose eCommerce HTML Template</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico in the root directory -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/favicon.png">

        <!-- CSS here -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-pro.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/flaticon_shofy.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        
        <!-- Sweet Alert css-->
        <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">

        <!-- dropzone css -->
        <link href="{{ asset('assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css">
        
        <!-- Layout config Js -->
        <script src="{{ asset('assets/js/layout.js') }}"></script>
        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
        <!-- custom Css-->
        <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">

        <!--begin::Vendor Stylesheets(used for this page only)-->
        <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <!--end::Vendor Stylesheets-->


        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <!--end::Global Stylesheets Bundle-->
        <meta name="csrf-token" value="{{ csrf_token() }}"/>
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
        {{-- @auth
        <!-- pre loader area start -->
        <div id="loading">
            <div id="loading-center">
            <div id="loading-center-absolute">
                <!-- loading content here -->
                <div class="tp-preloader-content">
                    <div class="tp-preloader-logo">
                        <div class="tp-preloader-circle">
                        <svg width="190" height="190" viewBox="0 0 380 380" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle stroke="#D9D9D9" cx="190" cy="190" r="180" stroke-width="6" stroke-linecap="round"></circle> 
                            <circle stroke="red" cx="190" cy="190" r="180" stroke-width="6" stroke-linecap="round"></circle> 
                        </svg>
                        </div>
                        <img src="assets/img/logo/preloader/preloader-icon.svg" alt="">
                    </div>
                    <h3 class="tp-preloader-title">VITEMART</h3>
                    <p class="tp-preloader-subtitle">Loading</p>
                </div>
            </div>
            </div>  
        </div>
        <!-- pre loader area end -->
        @endauth --}}

        @inertia
                
        <!-- footer area start -->
        <footer>
            <div class="tp-footer-area tp-footer-style-2 tp-footer-style-primary tp-footer-style-6" data-bg-color="#F4F7F9">
                <div class="tp-footer-top pt-95 pb-40">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6">
                            <div class="tp-footer-widget footer-col-1 mb-50">
                            <div class="tp-footer-widget-content">
                                <div class="tp-footer-logo">
                                    <a href="index-2.html">
                                        <img src="assets/img/logo/logo.svg" alt="logo">
                                    </a>
                                </div>
                                <p class="tp-footer-desc">We are a team of designers and developers that create high quality WordPress</p>
                                <div class="tp-footer-social">
                                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fa-brands fa-vimeo-v"></i></a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="tp-footer-widget footer-col-2 mb-50">
                            <h4 class="tp-footer-widget-title">My Account</h4>
                            <div class="tp-footer-widget-content">
                                <ul>
                                    <li><a href="#">Track Orders</a></li>
                                    <li><a href="#">Shipping</a></li>
                                    <li><a href="#">Wishlist</a></li>
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Order History</a></li>
                                    <li><a href="#">Returns</a></li>
                                </ul>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="tp-footer-widget footer-col-3 mb-50">
                            <h4 class="tp-footer-widget-title">Infomation</h4>
                            <div class="tp-footer-widget-content">
                                <ul>
                                    <li><a href="#">Our Story</a></li>
                                    <li><a href="#">Careers</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Latest News</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="tp-footer-widget footer-col-4 mb-50">
                            <h4 class="tp-footer-widget-title">Talk To Us</h4>
                            <div class="tp-footer-widget-content">
                                <div class="tp-footer-talk mb-20">
                                    <span>Got Questions? Call us</span>
                                    <h4><a href="tel:670-413-90-762">+670 413 90 762</a></h4>
                                </div>
                                <div class="tp-footer-contact">
                                    <div class="tp-footer-contact-item d-flex align-items-start">
                                        <div class="tp-footer-contact-icon">
                                        <span>
                                            <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 5C1 2.2 2.6 1 5 1H13C15.4 1 17 2.2 17 5V10.6C17 13.4 15.4 14.6 13 14.6H5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M13 5.40039L10.496 7.40039C9.672 8.05639 8.32 8.05639 7.496 7.40039L5 5.40039" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M1 11.4004H5.8" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M1 8.19922H3.4" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        </div>
                                        <div class="tp-footer-contact-content">
                                        <p><a href="https://template.wphix.com/cdn-cgi/l/email-protection#bac9d2d5dcc3fac9cfcacad5c8ce94d9d5d7"><span class="__cf_email__" data-cfemail="f98a91969f80b98a8c8989968b8dd79a9694">[email&#160;protected]</span></a></p>
                                        </div>
                                    </div>
                                    <div class="tp-footer-contact-item d-flex align-items-start">
                                        <div class="tp-footer-contact-icon">
                                        <span>
                                            <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.50001 10.9417C9.99877 10.9417 11.2138 9.72668 11.2138 8.22791C11.2138 6.72915 9.99877 5.51416 8.50001 5.51416C7.00124 5.51416 5.78625 6.72915 5.78625 8.22791C5.78625 9.72668 7.00124 10.9417 8.50001 10.9417Z" stroke="currentColor" stroke-width="1.5"/>
                                                <path d="M1.21115 6.64496C2.92464 -0.887449 14.0841 -0.878751 15.7889 6.65366C16.7891 11.0722 14.0406 14.8123 11.6313 17.126C9.88298 18.8134 7.11704 18.8134 5.36006 17.126C2.95943 14.8123 0.210885 11.0635 1.21115 6.64496Z" stroke="currentColor" stroke-width="1.5"/>
                                            </svg>
                                        </span>
                                        </div>
                                        <div class="tp-footer-contact-content">
                                        <p><a href="https://www.google.com/maps/place/Sleepy+Hollow+Rd,+Gouverneur,+NY+13642,+USA/@44.3304966,-75.4552367,17z/data=!3m1!4b1!4m6!3m5!1s0x4cccddac8972c5eb:0x56286024afff537a!8m2!3d44.3304928!4d-75.453048!16s%2Fg%2F1tdsjdj4" target="_blank">79 Sleepy Hollow St. <br> Jamaica, New York 1432</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="tp-footer-bottom">
                <div class="container">
                    <div class="tp-footer-bottom-wrapper">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                            <div class="tp-footer-copyright">
                                <p>© 2023 All Rights Reserved  |  HTML Template by <a href="index-2.html">Themepure</a>.</p>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="tp-footer-payment text-md-end">
                                <p>
                                    <img src="assets/img/footer/footer-pay.png" alt="">
                                </p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </footer>
        <!-- footer area end -->

        <!-- JS here -->
        <script src="{{ asset('assets/js/vendor/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/waypoints.js') }}"></script>
        <script src="{{ asset('assets/js/meanmenu.js') }}"></script>
        <script src="{{ asset('assets/js/swiper-bundle.js') }}"></script>
        <script src="{{ asset('assets/js/slick.js') }}"></script>
        <script src="{{ asset('assets/js/range-slider.js') }}"></script>
        <script src="{{ asset('assets/js/magnific-popup.js') }}"></script>
        <script src="{{ asset('assets/js/nice-select.js') }}"></script>
        <script src="{{ asset('assets/js/purecounter.js') }}"></script>
        <script src="{{ asset('assets/js/countdown.js') }}"></script>
        <script src="{{ asset('assets/js/wow.js') }}"></script>
        <script src="{{ asset('assets/js/isotope-pkgd.js') }}"></script>
        <script src="{{ asset('assets/js/imagesloaded-pkgd.js') }}"></script>
        <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        {{-- <script src="{{ asset('assets/js/plugins.js') }}"></script>

        <!-- list.js min js -->
        <script src="{{ asset('assets/libs/list.js/list.min.js') }}"></script>
        <script src="{{ asset('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>
        <!-- sweetalert2 js -->
        <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- dropzone js -->
        <script src="{{ asset('assets/libs/dropzone/dropzone-min.js') }}"></script>
        <!--Ecommerce Product List init js-->
        <script src="{{ asset('assets/js/pages/ecommerce-product-list.init.js') }}"></script> --}}

        
                    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
                    {{-- <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script> --}}
                    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
                <!--end::Global Javascript Bundle-->

            <!--begin::Vendors Javascript(used for this page only)-->
            <!--end::Vendors Javascript-->

                
                    <!--begin::Vendors Javascript(used for this page only)-->
                    <!--end::Vendors Javascript-->
                    
                    <!--begin::Custom Javascript(used for this page only)-->
                    {{-- <script src="../../../assets/plugins/custom/formrepeater/formrepeater.bundle.js"></script>
                    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
                    <script src="../../../assets/js/widgets.bundle.js"></script>
                    <script src="../../../assets/js/custom/widgets.js"></script>
                    <script src="../../../assets/js/custom/utilities/modals/create-app.js"></script>
                    <script src="../../../assets/js/custom/utilities/modals/users-search.js"></script> --}}

                    {{-- <script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/products.js') }}"></script> --}}
                <!--end::Custom Javascript-->
        <!--end::Javascript-->

        <!-- App js -->
        <script>

        </script>
        {{-- <script src="{{ asset('assets/js/app.js') }}"></script> --}}
    </body>
</html>
