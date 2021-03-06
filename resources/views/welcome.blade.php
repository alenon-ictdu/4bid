<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>4Bid</title>
    <link rel="shortcut icon" href="{{ asset('admin/images/4bidlogo-mini.png') }}" />
    <!--
        CSS
        ============================================= -->
    <link rel="stylesheet" href="{{ asset('karma/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('karma/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('karma/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('karma/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('karma/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('karma/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('karma/css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('karma/css/ion.rangeSlider.css') }}" />
    <link rel="stylesheet" href="{{ asset('karma/css/ion.rangeSlider.skinFlat.css') }}" />
    <link rel="stylesheet" href="{{ asset('karma/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('karma/css/main.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style>
        .page-link { position: relative; display: block; padding: .5rem .75rem; margin-left: -1px; line-height: 1.25; color: #007bff; background-color: #fff; border: 1px solid #dee2e6; }
        .pagination a {
            width: 40px;
            line-height: 17px;
            text-align: center;
            display: inline-block;
            background: #fff;
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            /*background-color: #007bff;*/
            background: linear-gradient(90deg, #ffba00 0%, #ff6c00 100%);
            border-color: white;
        }

        #imageDiv {
           width: 100%;
           height: 170px;
           background-color: #222222;
           margin-bottom: 10px;
        }

        #imageDiv img {
           max-width: 100%;
           max-height: 100%;
           object-fit: cover;
        }
    </style>
</head>

<body>

    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="/"><img src="{{ asset('landing/img/newlogo.png') }}" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                     aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            @guest
                            <li class="nav-item active"><a class="nav-link" href="/">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Sign in</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Sign up</a></li>
                            @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Cars</a></li>
                            @endguest
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item">
                                <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container">
                <form action="{{ route('search.car') }}" method="GET" class="d-flex justify-content-between">
                    <input type="text" name="quary" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

    <!-- start banner Area -->
    <section class="banner-area">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-start">
                <div class="col-lg-12">

                        <div class="row single-slide">
                            <div class="col-lg-5">
                                <div class="banner-content">
                                    <h1>About Us</h1>
                                    <p>Cars 4Bid: An Online Auction System is defined as an “integrated system used to gather, store and analyze information regarding an organization’s bidding information comprising of databases, computer applications, hardware and software necessary to collect, record, store, manage, present and manipulate data for auction transactions.</p>
                                    @guest
                                    <div class="add-bag d-flex align-items-center">
                                        <a class="add-btn" href="{{ route('register') }}"><span class="lnr lnr-cross"></span></a>
                                        <span class="add-text text-uppercase">Sign up Now!</span>
                                    </div>
                                    @endguest
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <img class="img-fluid" src="{{ asset('karma/img/banner/banner.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- start features Area -->
    <!-- <section class="features-area section_gap">
        <div class="container">
            <div class="row features-inner">
                single features
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/features/f-icon1.png" alt="">
                        </div>
                        <h6>Free Delivery</h6>
                        <p>Free Shipping on all order</p>
                    </div>
                </div>
                single features
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/features/f-icon2.png" alt="">
                        </div>
                        <h6>Return Policy</h6>
                        <p>Free Shipping on all order</p>
                    </div>
                </div>
                single features
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/features/f-icon3.png" alt="">
                        </div>
                        <h6>24/7 Support</h6>
                        <p>Free Shipping on all order</p>
                    </div>
                </div>
                single features
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/features/f-icon4.png" alt="">
                        </div>
                        <h6>Secure Payment</h6>
                        <p>Free Shipping on all order</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- end features Area -->


    <!-- start product Area -->
    <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            @guest
                            <h1 style="margin-top: 40px;">Sign in now to bid</h1>
                            @endguest
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($products as $row)
                    @if(!($lToday >= $row->duration2)) 
                    @if(!in_array($row->id, $reportArr))
                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <div id="imageDiv" {{-- style="width: 100%;height: 180px; background-color: red;" --}}>
                               <img class="" src="{{ asset('uploads/images/'. $row->thumbnail) }}" alt=""> 
                            </div>
                            
                            <div class="product-details">
                                <h6>{{ $row->name. ' ' .$row->brand. ' ' .$row->color }}</h6>
                                <div class="price">
                                    <h6>₱ {{ number_format($row->price) }}</h6>
                                    <h6 class="text-muted">Floor Price</h6>
                                </div>
                                <div class="prd-bottom">

                                    <a href="{{ route('show.car', $row->product_id) }}" class="social-info">
                                        <span class="lnr lnr-list"></span>
                                        <p class="hover-text">View More</p>
                                    </a>
                                    <a href="{{ route('item.details', $row->id) }}" class="social-info">
                                        <span class="ti-bag"></span>
                                        <p class="hover-text">Bid</p>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single product -->
                    @endif
                    @endif
                    @endforeach
                    
                </div>

                <div style="display: table;margin: 0 auto; margin-bottom: 50px">{{ $products->links("pagination::bootstrap-4") }}</div>

                {{-- <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            {{ $products->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div> --}}

            </div>
    
    <!-- end product Area -->



    <!-- start footer Area -->
    <footer class="footer-area section_gap">
        <div class="container">
            <!-- <div class="row">
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
                            magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Newsletter</h6>
                        <p>Stay update with our latest</p>
                        <div class="" id="mc_embed_signup">
            
                            <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                             method="get" class="form-inline">
            
                                <div class="d-flex flex-row">
            
                                    <input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
                                     required="" type="email">
            
            
                                    <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                    <div style="position: absolute; left: -5000px;">
                                        <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                    </div>
            
                                    <div class="col-lg-4 col-md-4">
                                                <button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
                                            </div>
                                </div>
                                <div class="info"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget mail-chimp">
                        <h6 class="mb-20">Instragram Feed</h6>
                        <ul class="instafeed d-flex flex-wrap">
                            <li><img src="img/i1.jpg" alt=""></li>
                            <li><img src="img/i2.jpg" alt=""></li>
                            <li><img src="img/i3.jpg" alt=""></li>
                            <li><img src="img/i4.jpg" alt=""></li>
                            <li><img src="img/i5.jpg" alt=""></li>
                            <li><img src="img/i6.jpg" alt=""></li>
                            <li><img src="img/i7.jpg" alt=""></li>
                            <li><img src="img/i8.jpg" alt=""></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Follow Us</h6>
                        <p>Let us be social</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
                <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->

    <script src="{{ asset('karma/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
     crossorigin="anonymous"></script>
    <script src="{{ asset('karma/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('karma/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('karma/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('karma/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('karma/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('karma/js/countdown.js') }}"></script>
    <script src="{{ asset('karma/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('karma/js/owl.carousel.min.js') }}"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="{{ asset('karma/js/gmaps.min.js') }}"></script>
    <script src="{{ asset('karma/js/main.js') }}"></script>
    <!-- <script>
        (function() {
    
        var img = document.getElementById('imageDiv').firstChild;
        img.onload = function() {
            if(img.height > img.width) {
                img.height = '100%';
                img.width = 'auto';
            }
        };
    
        }());
    </script> -->
</body>

</html>