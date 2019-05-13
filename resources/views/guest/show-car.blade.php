<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    {{-- <meta name="viewport" content="width=1280,initial-scale=1"> --}}
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

        .table .thead-light th {
            color: #000000;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .table tbody td {
            color: #000000;
        }

        @media only screen and (max-width: 980px) {
            .carImg {
                width: 690px !important;
                margin-bottom: 20px !important;
            }
        }

        @media only screen and (max-width: 770px) {
            .carImg {
                width: 515px !important;
                margin-bottom: 20px !important;
            }
        }

        @media only screen and (max-width: 540px) {
            .carImg {
                width: 400px !important;
                margin-bottom: 20px !important;
            }
        }

        @media only screen and (max-width: 420px) {
            .carImg {
                width: 350px !important;
                margin-bottom: 20px !important;
            }
        }

        @media only screen and (max-width: 370px) {
            .carImg {
                width: 315px !important;
                margin-bottom: 20px !important;
            }
        }

        @media only screen and (max-width: 330px) {
            .carImg {
                width: 300px !important;
                margin-bottom: 20px !important;
            }
        }

        @media only screen and (max-width: 315px) {
            .carImg {
                width: 290px !important;
                margin-bottom: 20px !important;
            }
        }

        /* .banner-area {
            height: 1400px;
            background: url('{{ asset('landing/img/banner/banner-bg.jpg') }}') center no-repeat;
            background-size: cover;
            position: relative;
        } */
    </style>

    <!-- #region Jssor Slider Begin -->
    <!-- Generator: Jssor Slider Maker -->
    <!-- Source: https://www.jssor.com -->
    <script src="{{ asset('slider/js/jquery-1.11.3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('slider/js/jssor.slider-27.5.0.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            var jssor_1_SlideshowTransitions = [
              {$Duration:1200,$Zoom:1,$Easing:{$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2},
              {$Duration:1000,$Zoom:11,$SlideOut:true,$Easing:{$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,$Zoom:1,$Rotate:1,$During:{$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:{$Zoom:$Jease$.$Swing,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$Swing},$Opacity:2,$Round:{$Rotate:0.5}},
              {$Duration:1000,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Zoom:$Jease$.$InQuint,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}},
              {$Duration:1200,x:0.5,$Cols:2,$Zoom:1,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:4,$Cols:2,$Zoom:11,$SlideOut:true,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Opacity:2,$Round:{$Rotate:0.5}},
              {$Duration:1000,x:-4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InQuint,$Zoom:$Jease$.$InQuart,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}},
              {$Duration:1200,x:-0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Opacity:2,$Round:{$Rotate:0.5}},
              {$Duration:1000,x:4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InQuint,$Zoom:$Jease$.$InQuart,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}},
              {$Duration:1200,x:0.5,y:0.3,$Cols:2,$Zoom:1,$Rotate:1,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}},
              {$Duration:1000,x:0.5,y:0.3,$Cols:2,$Zoom:1,$Rotate:1,$SlideOut:true,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.7}},
              {$Duration:1200,x:-4,y:2,$Rows:2,$Zoom:11,$Rotate:1,$Assembly:2049,$ChessMode:{$Row:28},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}},
              {$Duration:1200,x:1,y:2,$Cols:2,$Zoom:11,$Rotate:1,$Assembly:2049,$ChessMode:{$Column:19},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.8}}
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Rows: 2,
                $SpacingX: 14,
                $SpacingY: 12,
                $Orientation: 2,
                $Align: 156
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 960;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        });
    </script>
    <style>
        /*jssor slider loading skin spin css*/
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /*jssor slider arrow skin 093 css*/
        .jssora093 {display:block;position:absolute;cursor:pointer;}
        .jssora093 .c {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;}
        .jssora093 .a {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;}
        .jssora093:hover {opacity:.8;}
        .jssora093.jssora093dn {opacity:.6;}
        .jssora093.jssora093ds {opacity:.3;pointer-events:none;}

        /*jssor slider thumbnail skin 101 css*/
        .jssort101 .p {position: absolute;top:0;left:0;box-sizing:border-box;background:#000;}
        .jssort101 .p .cv {position:relative;top:0;left:0;width:100%;height:100%;border:2px solid #000;box-sizing:border-box;z-index:1;}
        .jssort101 .a {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;visibility:hidden;}
        .jssort101 .p:hover .cv, .jssort101 .p.pdn .cv {border:none;border-color:transparent;}
        .jssort101 .p:hover{padding:2px;}
        .jssort101 .p:hover .cv {background-color:rgba(0,0,0,6);opacity:.35;}
        .jssort101 .p:hover.pdn{padding:0;}
        .jssort101 .p:hover.pdn .cv {border:2px solid #fff;background:none;opacity:.35;}
        .jssort101 .pav .cv {border-color:#fff;opacity:.35;}
        .jssort101 .pav .a, .jssort101 .p:hover .a {visibility:visible;}
        .jssort101 .t {position:absolute;top:0;left:0;width:100%;height:100%;border:none;opacity:.6;}
        .jssort101 .pav .t, .jssort101 .p:hover .t{opacity:1;}
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
                            <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
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
    <section class="banner-area" style="height: 1400px;">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-start" >
                <div class="col-lg-12">

                        <div class="row" style="margin-top: 300px;">
                            <div class="col-lg-12">
                                <h1><i class="fas fa-car"></i> Vehicle Details</h1>
                            </div>
                        </div>

                        <hr>

                        <div class="row single-slide">
                            <div class="col-lg-8">
                                <div id="jssor_1" class="carImg" style="position:relative;margin:0 auto;top:0px;left:0px;width:960px;height:480px;overflow:hidden;visibility:hidden;background-color:#24262e;">
                                    <!-- Loading Screen -->
                                    <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                                        {{-- <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" /> --}}
                                    </div>
                                    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:240px;width:720px;height:480px;overflow:hidden;">

                                        @foreach($productImages as $row)
                                        <div>
                                            <img data-u="image" src="{{ asset('uploads/images/'.$row->image) }}" />
                                            <img data-u="thumb" src="{{ asset('uploads/images/'.$row->image) }}" />
                                        </div>
                                        @endforeach
                                        
                                    </div>
                                    <!-- Thumbnail Navigator -->
                                    <div data-u="thumbnavigator" class="jssort101" style="position:absolute;left:0px;top:0px;width:240px;height:480px;background-color:#000;" data-autocenter="2" data-scale-left="0.75">
                                        <div data-u="slides">
                                            <div data-u="prototype" class="p" style="width:99px;height:66px;">
                                                <div data-u="thumbnailtemplate" class="t"></div>
                                                <svg viewbox="0 0 16000 16000" class="cv">
                                                    <circle class="a" cx="8000" cy="8000" r="3238.1"></circle>
                                                    <line class="a" x1="6190.5" y1="8000" x2="9809.5" y2="8000"></line>
                                                    <line class="a" x1="8000" y1="9809.5" x2="8000" y2="6190.5"></line>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Arrow Navigator -->
                                    <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:270px;" data-autocenter="2">
                                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                            <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                            <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                                            <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
                                        </svg>
                                    </div>
                                    <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2">
                                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                            <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                            <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                                            <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4" style="padding-left: 20px;">
                                <div class="card">
                                  <div class="card-header">Vehicle Price</div>
                                  <div class="card-body">
                                    <label>
                                        <strong>Floor Price: <span style="color: orange;">₱ {{ $product->price }}</span></strong>
                                        <br>
                                        <strong>Date Posted:</strong> {{ date('F d, Y', strtotime($product->created_at)) }}
                                        <br>
                                        <br>
                                        To join the bidding, <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Signup now!</a>
                                    </label>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2">{{ $product->brand. ' ' .$product->name. ' ' .$product->color }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 50%; text-transform: capitalize;">Status: <strong> @if($t >= $product->duration) <span class="text-danger">Not Available</span> @else <span class="text-success">Available</span> @endif</strong></td>
                                            <td style="width: 50%; text-transform: capitalize;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%; text-transform: capitalize;">Car Model: <strong>{{ $product->name }}</strong></td>
                                            <td style="width: 50%; text-transform: capitalize;">Piston: <strong>{{ $product->piston }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%; text-transform: capitalize;">Brand: <strong>{{ $product->brand }}</strong></td>
                                            <td style="width: 50%; text-transform: capitalize;">Cylinder: <strong>{{ $product->cylinder }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%; text-transform: capitalize;">Color: <strong>{{ $product->color }}</strong></td>
                                            <td style="width: 50%; text-transform: capitalize;">Piston: <strong>{{ $product->piston }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%; text-transform: capitalize;">Style: <strong>{{ $product->style }}</strong></td>
                                            <td style="width: 50%; text-transform: capitalize;">Fuel: <strong>{{ $product->fuel }}</strong></td>
                                        </tr><tr>
                                            <td style="width: 50%; text-transform: capitalize;">Series: <strong>{{ $product->series }}</strong></td>
                                            <td style="width: 50%; text-transform: capitalize;">Mileage: <strong>{{ $product->milage }}</strong></td>
                                        </tr><tr>
                                            <td style="width: 50%; text-transform: capitalize;">Denomination: <strong>{{ $product->denomination }}</strong></td>
                                            <td style="width: 50%; text-transform: capitalize;">Year: <strong>{{ $product->year }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- start product Area -->
    {{-- <div class="container">
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
            
            
        </div>

    </div> --}}
    
    <!-- end product Area -->



    <!-- start footer Area -->
    <footer class="footer-area section_gap">
        <div class="container">
            
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
</body>

</html>