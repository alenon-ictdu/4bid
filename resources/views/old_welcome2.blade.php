<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>4Bid</title>
        <link rel="shortcut icon" href="{{ asset('admin/images/4bidlogo-mini.png') }}" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('landing/vendors/linericon/style.css') }}">
        <link rel="stylesheet" href="{{ asset('landing/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('landing/vendors/owl-carousel/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('landing/vendors/lightbox/simpleLightbox.css') }}">
        <link rel="stylesheet" href="{{ asset('landing/vendors/nice-select/css/nice-select.css') }}">
        <link rel="stylesheet" href="{{ asset('landing/vendors/animate-css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('landing/vendors/jquery-ui/jquery-ui.css') }}"> 
        <!-- main css -->
        <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">
        <style>
            .header_area.navbar_fixed .main_menu {
                position: fixed;
                width: 100%;
                top: -70px;
                left: 0;
                right: 0;
                /*background: black;*/
                background: linear-gradient(to right, white 50%, #cf1c46 50%);
            }

            .navbar-toggler {
                padding: 0.25rem 0.75rem;
                font-size: 1.25rem;
                line-height: 1;
                background: white;
                border: 1px solid transparent;
                border-radius: 0.25rem;
            }

            .header_area .navbar .nav .nav-item .nav-link {
                text-transform: uppercase;
                color: rgb(255, 255, 255);
                display: inline-block;
                font: 500 12px/80px Roboto, sans-serif;
                padding: 0px;
            }

            .header_area .navbar .nav .nav-item:hover .nav-link, .header_area .navbar .nav .nav-item.active .nav-link {
                color: #000000;
            }

            .hot_p_item .product_text a {
                position: absolute;
                left: 26px;
                bottom: 28px;
                text-transform: uppercase;
                font-size: 14px;
                font-weight: 500;
                color: #000000;
                -webkit-transition: all 300ms linear 0s;
                -o-transition: all 300ms linear 0s;
                transition: all 300ms linear 0s;
            }

            .hot_p_item .product_text a:hover {
                color: white;
            }

            .hot_p_item .product_text h4 {
                margin-top: 26px;
                margin-left: 26px;
                color: #f3b345;
                font-family: "Roboto", sans-serif;
                font-weight: 500;
                font-size: 30px;
            }

        </style>
    </head>
    <body>
        
        <!--================Header Menu Area =================-->
        <header class="header_area">
            <div class="top_menu row m0" style="margin-bottom: 20px;">
                <div class="container">
                    <div class="float-left">
                        {{-- <a href="mailto:support@colorlib.com">support@colorlib.com</a>
                        <a href="#">Welcome to Catalouge</a> --}}
                    </div>
                    <div class="float-right">
                        <ul class="header_social">
                            {{-- <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li> --}}
                        </ul>
                    </div>
                </div>  
            </div>  
            <div class="main_menu">
                <nav class="navbar navbar-expand-lg navbar-light main_box" style="background: linear-gradient(120deg, white 25%, #eab307 , #cf1c46);">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <a class="navbar-brand logo_h" href="/"><img src="{{ asset('landing/img/newlogo.png') }}" alt=""></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                            <ul class="nav navbar-nav menu_nav ml-auto">
                                <li class="nav-item active"><a class="nav-link" href="/"><i class="lnr lnr lnr-home"></i> Home</a></li> 
                                @guest
                                <li class="nav-item "><a class="nav-link" href="{{ route('login') }}"><i class="lnr lnr lnr-user"></i> Login</a></li> 
                                <li class="nav-item "><a class="nav-link" href="{{ route('register') }}"><i class="lnr lnr lnr-list"></i> Register</a></li>
                                @else
                                <li class="nav-item "><a class="nav-link" href="{{ route('home') }}"><i class="lnr lnr lnr-list"></i> Cars</a></li> 
                                @endguest
                            </ul>
                        </div> 
                    </div>
                </nav>
            </div>
        </header>
        <!--================Header Menu Area =================-->
        
        <!--================Home Banner Area =================-->
        <section class="home_banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="container">
                    <div class="banner_content row">
                        <div class="col-lg-5">
                            <h3><span style="color: #dc1536;">A B O U T</span> <span style="color: #000000;"> U S</span></h3>
                            {{-- <p>Thank you for visiting our online showroom!</p> --}}
                            <p>Cars 4Bid: An Online Auction System is defined as an “integrated system used to gather, store and analyze information regarding an organization’s bidding information comprising of databases, computer applications, hardware and software necessary to collect, record, store, manage, present and manipulate data for auction transactions.</p>
                            <a class="white_bg_btn" href="{{ route('register') }}">Be A Member</a>
                        </div>
                        <div class="col-lg-7">
                            <div class="halemet_img">
                                <img src="{{ asset('admin/images/test.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <!--================Feature Product Area =================-->
        <section class="feature_product_area">
            <div class="main_box">
                <div class="container">
                    <div class="main_title">
                            <h2 style="background: linear-gradient(to right, #eeac3e 0%, #d22e3e 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">Hot Cars</h2>
                            {{-- <p>Who are in extremely love with eco friendly system.</p> --}}
                        </div>
                    <div class="row hot_product_inner">
                        @if($high != '' && $highThumb != '')
                        <div class="col-lg-6">
                            <div class="hot_p_item">
                                <img class="img-fluid" style="width: 600px;" src="{{ asset('uploads/images/'.$highThumb->image) }}" alt="">
                                <div class="product_text">
                                    <h4 style="color: #d22e3e;">{{ $high->product->brand. ' ' .$high->product->name }}</h4>
                                    @if($today > $high->product->duration)
                                    <a class="white_bg_btn">Not Available</a>
                                    @else
                                    <a href="{{ route('item.details', $high->product->id) }}" class="white_bg_btn">Bid Now</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($second != '' && $secondThumb != '')
                        <div class="col-lg-6">
                            <div class="hot_p_item">
                                <img class="img-fluid" style="width: 600px;" src="{{ asset('uploads/images/'.$secondThumb->image) }}" alt="">
                                <div class="product_text">
                                    <h4 style="color: #d22e3e;">{{ $second->product->brand. ' ' .$second->product->name }}</h4>
                                    @if($today > $second->product->duration)
                                    <a class="white_bg_btn">Not Available</a>
                                    @else
                                    <a href="{{ route('item.details', $second->product->id) }}" class="white_bg_btn">Bid Now</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="feature_product_inner">
                        <div class="main_title">
                            <h2>Newly Added</h2>
                            {{-- <p>Who are in extremely love with eco friendly system.</p> --}}
                        </div>
                        <div class="feature_p_slider owl-carousel">

                            @foreach($products as $row)
                            <div class="item">
                                <div class="f_p_item">
                                    <div class="f_p_img">
                                        <img class="img-fluid" src="{{ asset('uploads/images/'.$row->thumbnail) }}" alt="">
                                        @if($today < $row->duration2)
                                        <div class="p_icon">
                                            <a href="{{ route('item.details', $row->id) }}">Bid</a>
                                        </div>
                                        @endif
                                    </div>
                                    <a @if($today < $row->duration2) href="{{ route('item.details', $row->id) }}" @endif><h4>{{ $row->brand. ' ' .$row->name. ' ' .$row->color}}</h4></a>
                                    @if($today > $row->duration2)
                                    <h5>Not Available</h5>
                                    @else
                                    <h5>{{ $row->h_bid == 'none' ? 'None':'₱ '.$row->h_bid }}</h5>
                                    <p class="text-muted">Highest Bid</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Feature Product Area =================-->
        
        @if($currentHotThumbnail != 'None' && $currentHot != 'None')
        <!--================Deal Timer Area =================-->
        <section class="timer_area">
            <div class="container">
                <div class="main_title">
                    <img src="{{ asset('uploads/images/'.$currentHotThumbnail->image) }}" style="margin-bottom: 20px; width: 500px;">
                    <h2>Exclusive Hot Deal Ends Soon!</h2>
                    <p class="text-capitalize">{{ $currentHot->brand. ' ' .$currentHot->name. ' ' .$currentHot->color }}</p>
                    <a class="main_btn" href="{{ route('item.details', $currentHot->id) }}">Bid Now</a>
                </div>
                <div class="timer_inner">
                    <div id="timer" class="timer">
                        <div class="timer__section days">
                            <div class="timer__number"></div>
                            <div class="timer__label">days</div>
                        </div>
                        <div class="timer__section hours">
                            <div class="timer__number"></div>
                            <div class="timer__label">hours</div>
                        </div>
                        <div class="timer__section minutes">
                            <div class="timer__number"></div>
                            <div class="timer__label">Minutes</div>
                        </div>
                        <div class="timer__section seconds">
                            <div class="timer__number"></div>
                            <div class="timer__label">seconds</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!--================End Deal Timer Area =================-->
        
        <!--================Latest Product Area =================-->
        <section class="feature_product_area latest_product_area">
            <div class="main_box">
                <div class="container">
                    <div class="feature_product_inner">
                        <div class="main_title">
                            <h2>Cheapest Cars</h2>
                            {{-- <p>Who are in extremely love with eco friendly system.</p> --}}
                        </div>
                        <div class="latest_product_inner row">
                            @foreach($cheapestFirst as $row)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="f_p_item">
                                    <div class="f_p_img">
                                        <img class="img-fluid" src="{{ asset('uploads/images/'.$row->thumbnail) }}" alt="">
                                        @if($today < $row->duration2)
                                        <div class="p_icon">
                                            <a href="{{ route('item.details', $row->id) }}">Bid</a>
                                        </div>
                                        @endif
                                    </div>
                                    <a class="text-capitalize" @if($today < $row->duration2) href="{{ route('item.details', $row->id) }} @endif"><h4>{{ $row->brand. ' ' .$row->name. ' ' .$row->color }}</h4></a>
                                    @if($today > $row->duration2)
                                    <h5>Not Available</h5>
                                    @else
                                    <h5>{{ '₱ '.$row->price }}</h5>
                                    <p>Floor Price</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Latest Product Area =================-->
        
        <!--================Clients Logo Area =================-->
        {{-- <section class="clients_logo_area">
            <div class="container">
                <div class="main_title">
                    <h2>Top Brands of this Month</h2>
                    <p>Who are in extremely love with eco friendly system.</p>
                </div>
                <div class="clients_slider owl-carousel">
                    <div class="item">
                        <img src="{{ asset('landing/img/clients-logo/c-logo-1.png') }}" alt="">
                    </div>
                    <div class="item">
                        <img src="{{ asset('landing/img/clients-logo/c-logo-2.png') }}" alt="">
                    </div>
                    <div class="item">
                        <img src="{{ asset('landing/img/clients-logo/c-logo-3.png') }}" alt="">
                    </div>
                    <div class="item">
                        <img src="{{ asset('landing/img/clients-logo/c-logo-4.png') }}" alt="">
                    </div>
                    <div class="item">
                        <img src="{{ asset('landing/img/clients-logo/c-logo-5.png') }}" alt="">
                    </div>
                </div>
            </div>
        </section> --}}
        <!--================End Clients Logo Area =================-->
        
        <!--================Most Product Area =================-->
        <section class="most_product_area">
            <div class="main_box">
                <div class="container">
                    <div class="main_title">
                        <h2>See Also</h2>
                        {{-- <p>Who are in extremely love with eco friendly system.</p> --}}
                    </div>
                    <div class="row most_product_inner">
                        @foreach($seeAlso as $row)
                        <div class="col-lg-3 col-sm-6">
                            <div class="most_p_list">
                                <div class="media">
                                    <div class="d-flex">
                                        <img style="width: 70px; height: 70px;" src="{{ asset('uploads/images/'.$row->thumbnail) }}" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a class="text-capitalize" @if($today < $row->duration2) href="{{ route('item.details', $row->id) }}" @endif><h4>{{ $row->brand. ' ' .$row->name. ' ' .$row->color }}</h4></a>
                                        @if($today < $row->duration2)
                                        <h3>{{ '₱ '.$row->price }} <small class="text-muted">Floor price</small></h3>
                                        @else
                                        <h3>Not Available</h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!--================End Most Product Area =================-->
        
        <!--================ start footer Area  =================-->    
        <footer class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3  col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6 class="footer_title">Thank you for visiting our online showroom!</h6>
                            <p></p>
                        </div>
                    </div>
                        
                </div>
                <div class="row footer-bottom d-flex justify-content-between align-items-center">
                    <p class="col-lg-12 footer-text text-center"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>

                {{-- <div class="row footer-bottom d-flex justify-content-between align-items-center">
                    <p class="col-lg-12 footer-text text-center"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div> --}}
            </div>
        </footer>
        <!--================ End footer Area  =================-->
        
        
        
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('landing/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('landing/js/popper.js') }}"></script>
        <script src="{{ asset('landing/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('landing/js/stellar.js') }}"></script>
        <script src="{{ asset('landing/vendors/lightbox/simpleLightbox.min.js') }}"></script>
        <script src="{{ asset('landing/vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('landing/vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('landing/vendors/isotope/isotope-min.js') }}"></script>
        <script src="{{ asset('landing/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('landing/js/jquery.ajaxchimp.min.js') }}"></script>
        <script src="{{ asset('landing/vendors/counter-up/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('landing/vendors/flipclock/timer.js') }}"></script>
        <script src="{{ asset('landing/vendors/counter-up/jquery.counterup.js') }}"></script>
        <script src="{{ asset('landing/js/mail-script.js') }}"></script>
        <script src="{{ asset('landing/js/theme.js') }}"></script>
        <script>
            var today = new Date();

            var timer = function() {};
            timer.countdownDate = new Date();

            // set date to 10 days in the future for testing purposes
            timer.countdownDate.setDate( timer.countdownDate.getDate() + {{ $days }} );

            /*
            * Get thing started
            */
            timer.init = function() {
              timer.getReferences();
              
              
              timer.getTimes();
              setInterval(function() { timer.update() }, 1000);
            }

            /*
            * Save references of timer section
            */
            timer.getReferences = function() {
              timer.timer = document.getElementById("timer");
              timer.days = timer.timer.querySelectorAll(".days .timer__number")[0];
              timer.hours = timer.timer.querySelectorAll(".hours .timer__number")[0];
              timer.minutes = timer.timer.querySelectorAll(".minutes .timer__number")[0];
              timer.seconds = timer.timer.querySelectorAll(".seconds .timer__number")[0];
            }

            /*
            * remember time units for later use
            */
            timer.getTimes = function() {
              timer.times = {};
              timer.times.second = 1000;
              timer.times.minute = timer.times.second * 60;
              timer.times.hour = timer.times.minute * 60;
              timer.times.day = timer.times.hour * 24;
            }

            /*
            * Update the countdown
            */
            timer.update = function() {
              if ( timer.timer.style.opacity !== 1 ) {
                timer.timer.style.opacity = 1;
              }
              
              timer.currentDate = new Date();
              timer.difference = timer.countdownDate - timer.currentDate;
              
              timer.days.innerHTML = timer.getTimeRemaining(timer.times.day, 1);
              timer.hours.innerHTML = timer.getTimeRemaining(timer.times.hour, 24);
              timer.minutes.innerHTML = timer.getTimeRemaining(timer.times.minute, 60);
              timer.seconds.innerHTML = timer.getTimeRemaining(timer.times.second, 60);
            }

            /*
            * calculate remaining time based on a unit of time
            */
            timer.getTimeRemaining = function( timeUnit, divisor ) {
              var n;
              if ( divisor == 1 ) {
                n = Math.floor(timer.difference / timeUnit );
              }
              else {
                n = Math.floor((timer.difference / timeUnit) % divisor );
              }
              
              if ( String(n).length < 2 ) {
                n = "0" + n;
              }
              
              return n;
            }

            window.addEventListener("load", function() {
              timer.init();
            });

        </script>
    </body>
</html>