@extends('layouts.app2')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<style>
.clock-countdown-title {
  color: #dd6826;
  font-weight: 100;
  font-size: 40px;
  margin: 40px 0px 20px;
}
  #clockdiv{
  font-family: sans-serif;
  color: #fff;
  display: inline-block;
  font-weight: 100;
  text-align: center;
  font-size: 30px;
}

#clockdiv > div{
  padding: 5px;
  border-radius: 3px;
  background: #dc6826;
  /*background: #308ee0;*/
  display: inline-block;
}

#clockdiv div > span{
  padding: 15px;
  border-radius: 3px;
  background: #d74436;
  /*background: #007bff;*/
  display: inline-block;
}

.smalltext{
  padding-top: 5px;
  font-size: 16px;
}

.blockquote {
    padding: 1.9rem;
    border: 1px solid #e59414;
    background: linear-gradient(120deg, #eab307, #cf1c46);
}
.blockquote-primary .blockquote-footer {
    color: white;
}

.modal-lg {
  width: 50%;
}

@media screen and (max-width: 1020px) {
  .modal-lg {
   width: 100%;
  }
}
</style>
@stop

@section('content')
<button type="button" class="btn btn-primary btn-xs" style="margin-bottom: 10px;" onclick="history.back();">Back</button>
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

        jQuery(document).ready(function ($) {

            var jssor_2_SlideshowTransitions = [
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

            var jssor_2_options = {
              $AutoPlay: 1,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_2_SlideshowTransitions,
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

            var jssor_2_slider = new $JssorSlider$("jssor_2", jssor_2_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 960;

            function ScaleSlider() {
                var containerElement = jssor_2_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_2_slider.$ScaleWidth(expectedWidth);
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


<div class="row">
  <div class="col-md-7">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Car Images</h4>

          <div class="container" style="padding-left: 0;">
            <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:960px;height:480px;overflow:hidden;visibility:hidden;background-color:#24262e;">
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

          <hr>
          
          <h4 class="card-title">Driver's License,OR/CR & Deed of Sale</h4>

          <div class="container" style="padding-left: 0;">
            <div id="jssor_2" style="position:relative;margin:0 auto;top:0px;left:0px;width:960px;height:480px;overflow:hidden;visibility:hidden;background-color:#24262e;">
                <!-- Loading Screen -->
                <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                    {{-- <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" /> --}}
                </div>
                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:240px;width:720px;height:480px;overflow:hidden;">

                    @foreach($productDOD as $dod)
                    <div>
                        <img data-u="image" src="{{ asset('uploads/dod/'.$dod->image) }}" />
                        <img data-u="thumb" src="{{ asset('uploads/dod/'.$dod->image) }}" />
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
          
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          @if($highestBidder == 'None')
            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#biddersModal">View Bidders</button>
          @else
          <h4 class="card-title">Highest Bidder <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#biddersModal">View Bidders</button></h4>
          <div class="media">
            <img style="width: 100px;height: 100px; border-radius: 100%; margin-right: 10px;" src="{{ $highestBidder->user->image == '' ? asset('admin/images/faces/default_image.png'): asset('uploads/user/'.$highestBidder->user->image) }}">
            {{-- <i class="mdi mdi-earth icon-md text-info d-flex align-self-end mr-3"></i> --}}
            <div class="media-body">
              <p class="card-text text-capitalize">{{ $highestBidder != 'None' ? $highestBidder->user->firstname.' '.$highestBidder->user->middlename.' '.$highestBidder->user->lastname:'' }} <small><i>{{ $highestBidder != 'None' ? date('M d, Y h:i:s A', strtotime($highestBidder->created_at)):'' }}</i></small></p>
              @if($highestBidder != 'None')<p>{{ $highestBidder->user->type == 'ftb' ? 'First Time Bidder':'Regular Bidder' }}</p>@endif
              <p class="card-text">Bid <span class="font-weight-bold">{{ $highestBidder != 'None' ? '₱ '.number_format($highestBidder->bid):'' }}</span></p>
              @if($today >= $product->duration) 
                <p class="card-text"><a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#messageModal">Compose Message</a> 
                  @if(!in_array($highestBidder->user_id, $reportArr))
                    {{-- <a data-id="{{ $highestBidder->user_id }}" id="reportUser" data-token="{{ csrf_token() }}" href="#" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Report"><i class="fas fa-flag"></i></a>  --}}
                    <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#reportModal" ><i class="fas fa-flag"></i></button>
                  @endif
                </p> 
              @else 
                <small>The message button will automatically appear when the auction is done.</small> 
              @endif
            </div>
          </div>
          @endif
          <hr>
          <h1 class="clock-countdown-title">Countdown</h1>
          <div id="clockdiv">
            <div>
              <span class="days">00</span>
              <div class="smalltext">Days</div>
            </div>
            <div>
              <span class="hours">00</span>
              <div class="smalltext">Hours</div>
            </div>
            <div>
              <span class="minutes">00</span>
              <div class="smalltext">Minutes</div>
            </div>
            <div>
              <span class="seconds">00</span>
              <div class="smalltext">Seconds</div>
            </div>
          </div>

          <hr>

          <h5>Car Details</h5>
          
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="2">{{ $product->brand. ' ' .$product->name. ' ' .$product->color }}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="width: 50%;">ID: <strong>{{ $product->product_id }}</strong></td>
                  <td style="width: 50%;">Status
                    @if($today >= $product->duration) 
                      <span class="badge badge-dark ml-1">Not Available</span> 
                    @else 
                      @if($product->status == 0) 
                        <span class="badge badge-default ml-1">Pending</span>
                      @endif 
                      @if($product->status == 1) 
                        <span class="badge badge-success ml-1">Approved</span>
                      @endif 
                      @if($product->status == 2) 
                        <span class="badge badge-danger ml-1">Declined</span>
                      @endif 
                    @endif
                  </td>
                </tr>
                <tr>
                  <td style="width: 50%;">Car Model: <strong class="text-capitalize">{{ $product->name }}</strong></td>
                  <td style="width: 50%;">Floor Price: <strong class="text-capitalize">{{ '₱ '. number_format($product->price) }}</strong></td>
                </tr>
                <tr>
                  <td style="width: 50%;">Brand: <strong class="text-capitalize">{{ $product->brand }}</strong></td>
                  <td style="width: 50%;">Color: <strong class="text-capitalize">{{ $product->color }}</strong></td>
                </tr>
                <tr>
                  <td style="width: 50%;">Style: <strong class="text-capitalize">{{ $product->style }}</strong></td>
                  <td style="width: 50%;">Series: <strong class="text-capitalize">{{ $product->series }}</strong></td>
                </tr>
                <tr>
                  <td style="width: 50%;">Denomination: <strong class="text-capitalize">{{ $product->denomination }}</strong></td>
                  <td style="width: 50%;">Piston: <strong class="text-capitalize">{{ $product->piston }}</strong></td>
                </tr>
                <tr>
                  <td style="width: 50%;">Cylinder: <strong class="text-capitalize">{{ $product->cylinder }}</strong></td>
                  <td style="width: 50%;">Fuel: <strong class="text-capitalize">{{ $product->fuel }}</strong></td>
                </tr>
                <tr>
                  <td style="width: 50%;">Mileage: <strong class="text-capitalize">{{ $product->milage }}</strong></td>
                  <td style="width: 50%;">Year: <strong class="text-capitalize">{{ $product->year }}</strong></td>
                </tr>
                <tr>
                  <td style="width: 50%;">Date Posted: <strong class="text-capitalize">{{ date('M d, Y', strtotime($product->created_at)) }}</strong></td>
                  <td style="width: 50%;">Due Date: <strong class="text-capitalize">{{ date('M d, Y', strtotime($product->duration)) }}</strong></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>

@if($highestBidder != 'None' && !in_array($highestBidder->user_id, $reportArr))
<!-- Report Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error(s):</strong> 
             <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
             </ul>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <form method="POST" action="{{ route('report.store') }}" id="reportForm">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
          {{-- <input type="hidden" name="reported" class="form-control" id="recipient-name"> --}}
          <input type="hidden" name="reported" class="form-control" value="{{ $highestBidder->user_id }}">
          <div class="form-group">
            <label>Select offense</label>
            <select class="form-control" name="offense" required>
              <option value="none"></option>
              <option value="Report as Fraud">Report as Fraud</option>
              <option value="Report as Scam">Report as Scam</option>
              <option value="Others">Others</option>
            </select>
          </div>
          <div class="form-group">
            <label>Please specify in the description</label>
            <textarea rows="7" class="form-control" name="description" required></textarea>
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="reportForm">Submit</button>
      </div>
    </div>
  </div>
</div>
@endif

<!-- Bidders Modal -->
<div class="modal fade" id="biddersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bidders</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table" id="biddersTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Bid</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach($productBidders as $row)
            <tr title="{{ $row->user->type == 'ftb' ? 'First Time Bidder':'Regular Bidder' }}">
              <td>{{ $row->user->user_id }}</td>
              <td>{{ $row->user->firstname. ' ' .$row->user->middlename. ' ' .$row->user->lastname  }}</td>
              <td>{{ '₱ '. number_format($row->bid) }}</td>
              <td>{{ date('M d, Y h:i:s', strtotime($row->created_at)) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="forms-sample" method="POST" action="{{ route('inbox.store') }}" id="storeMessageForm">
          {{ csrf_field() }}
          <input type="hidden" name="highestbidder" value="{{ $highestBidder != 'None' ? $highestBidder->user_id:'' }}">
          <div class="form-group">
            <label for="exampleInputEmail1">To</label>
            <input type="text" class="form-control text-capitalize" value="{{ $highestBidder != 'None' ? $highestBidder->user->firstname. ' ' .$highestBidder->user->middlename. ' ' .$highestBidder->user->lastname:'' }}" disabled required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Subject</label>
            <input type="text" class="form-control" name="subject" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Message</label>
            <textarea class="form-control" name="message" required rows="6"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="storeMessageForm">Send</button>
      </div>
    </div>
  </div>
</div>

@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
 <script>
   @if(Session::has('success'))
      toastr.success(
      '',
      '{{ Session::get('success') }}',
      {
          timeOut: 3000,
          fadeOut: 1000,
          closeButton: true
        }
      );
   @endif

   function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
      'total': t,
      'days': days,
      'hours': hours,
      'minutes': minutes,
      'seconds': seconds
    };
  }


function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
  var daysSpan = clock.querySelector('.days');
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    var t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

var deadline = new Date('{{ date('M d, Y h:i:s', strtotime($product->duration)) }}');
deadline.setHours(deadline.getHours() - 12);

@if($today >= $product->duration)
@else
  @if($product->status == 1)
    initializeClock('clockdiv', deadline);
  @endif
@endif

@if(count($errors) > 0)
  $('#reportModal').modal('show');
@endif



$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
  });

/*$('#reportModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  // modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})*/

// report user
    /*$(document).on('click', '#reportUser', function(e) {
      var id = $(this).data('id');
      var token = $(this).data("token");
      var x = confirm("Are you sure you want to report the owner of this user?");
        if (x)
          $.ajax(
            {
                url: "/report/"+id,
                type: 'DELETE',
                dataType: "JSON",
                data: {
                    "id": id,
                    "_method": 'DELETE',
                    "_token": token,
                },
                success: function ()
                {
                  alert('User has been reported!');
                }
            });
        else
          return false;
    });*/
    // report user

    $('#biddersTable').DataTable({
          "pageLength": 25,
          "order": [],
        });
 </script>
@stop