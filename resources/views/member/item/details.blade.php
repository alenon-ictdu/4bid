<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@if(isset($pageTitle)) {{ $pageTitle }} @else Page Title @endif</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.addons.css') }}">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('admin/images/4bidlogo-mini.png') }}" />
  <style>
  .sidebar .nav .nav-item.active > .nav-link {
    color: #cf1c46;
  }

  .navbar.default-layout {
    font-family: "Poppins", sans-serif;
    background: linear-gradient(120deg, #eab307, #cf1c46);
    transition: background 0.25s ease;
    -webkit-transition: background 0.25s ease;
    -moz-transition: background 0.25s ease;
    -ms-transition: background 0.25s ease;
  }

  .form-control {
    border: 1px solid #91979a;
    font-family: "Poppins", sans-serif;
    font-size: 0.75rem;
    padding: 0.56rem 0.75rem;
    line-height: 14px;
    font-weight: 300;
  }

  .required-field {
    color: red;
  }

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
	padding: 10px;
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

@media (max-width: 600px) {
  .profile-text {
    display: none;
  }
}

@media (max-width: 375px) {
    .navbar.default-layout .navbar-brand-wrapper {
      width: 75px;
      display: none !important;
    } 

    .profile-text {
      display: none;
    }
  }

@media (max-width: 1350px) {
  #clockdiv > div {
    padding: 5px;
    border-radius: 3px;
    background: #dc6826;
    /* background: #308ee0; */
    display: inline-block;
  }
}

@media (max-width: 1240px) {
  #clockdiv > div {
    padding: 0px;
    border-radius: 3px;
    background: #dc6826;
    /* background: #308ee0; */
    display: inline-block;
    font-size: 20px;
  }
}

@media (max-width: 1170px) {
  #clockdiv div > span {
    padding: 7px;
    border-radius: 3px;
    background: #d74436;
    /* background: #007bff; */
    display: inline-block;
  }
}

@media screen and (max-width: 1020px) {
  .modal-lg {
   width: 100%;
  }
}

@media (max-width: 875px) {
  #clockdiv > div {
    padding: 2px;
    border-radius: 3px;
    background: #dc6826;
    /* background: #308ee0; */
    display: inline-block;
    font-size: 20px;
  }
}


  </style>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('home') }}">
          <img src="{{ asset('admin/images/4bidlogo.png') }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}">
          <img src="{{ asset('admin/images/4bidlogo-mini.png') }}" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">Schedule
              <span class="badge badge-primary ml-1">New</span>
            </a>
          </li> -->

          @if(Auth::user()->user_type == 1)
          <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link blink">
              <i class="fa fa-users"></i>{{ $onlineUsers->count() - 1 }} Online {{ ($onlineUsers->count() - 1) == 1 ? 'User':'Users' }}</a>
          </li>
          @endif
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          @if(Auth::user()->user_type == 2)
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell"></i>
              @if($sCarsCount > 0 || count($winnerNotif) > 0)
              <span class="count">{{ count($winnerNotif) + $sCarsCount }}</span>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown" style="height: 300px; overflow-y: scroll;">
              <a class="dropdown-item" href="{{ route('notification.index') }}">
                <p class="mb-0 font-weight-normal float-left">You have {{ count($winnerNotif) + $sCarsCount }} unread notification
                </p>
                <span style="cursor: pointer;" class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              @foreach($winnerNotif as $row)
                <div class="dropdown-divider"></div>
                <a data-id="{{ $row->id }}" id="viewNotif" data-token="{{ csrf_token() }}" href="#" style="cursor: pointer;" class="dropdown-item preview-item">
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-medium text-dark text-capitalize">{{ substr($row->description, 0, 35) .'...' }}</h6>
                    <p class="font-weight-light small-text">
                      Tap to view
                    </p>
                  </div>
                </a>
              @endforeach

              @foreach($sellerCars as $row)
                @if(strtotime($row->duration) <= strtotime($pToday))
                <div class="dropdown-divider"></div>
                <a data-id="{{ $row->product_id }}" id="viewNotif2" data-token="{{ csrf_token() }}" href="#" style="cursor: pointer;" class="dropdown-item preview-item">
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-medium text-dark">Your <span class="text-capitalize">{{ $row->brand. ' ' .$row->name. ' ' .$row->color }}</span> is finished! </h6>
                    <p class="font-weight-light small-text">
                      Tap to view
                    </p>
                  </div>
                </a>
                @endif
              @endforeach
              <div class="mx-auto"></div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator" href="{{ route('user.view.chat') }}" >
              <i class="mdi mdi-message"></i>
              @if($chatniAdmin->count() > 0)<span class="count">{{ $chatniAdmin->count() }}</span>@endif
            </a>
          </li>
          @endif
          @if(Auth::user()->user_type == 1)
          <li class="nav-item dropdown" >
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-message"></i>
              @if(count($unseenUserArr) > 0)<span class="count">{{ count($unseenUserArr) }}</span>@endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown" style="height: 300px; overflow-y: scroll;">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have {{ count($unseenUserArr) }} unread message
                </p>
                {{-- <span class="badge badge-info badge-pill float-right">View all</span> --}}
              </div>

              @foreach($unseenUserArr as $row)
              
              <div class="dropdown-divider"></div>
              <a href="{{ route('user.show', $row->id) }}" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="{{ $row->image == '' ? asset('admin/images/faces/default_image.png'):asset('uploads/user/'. $row->image) }}" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark text-capitalize">{{ $row->name }}
                    {{-- <span class="float-right font-weight-light small-text">1 Minutes ago</span> --}}
                  </h6>
                </div>
              </a>

              @endforeach
              
            </div>
          </li>
          @endif
          @if(Auth::user()->user_type == 1)
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell"></i>
              @if($pendingProducts->count() > 0)<span class="count">{{ $pendingProducts->count() }}</span>@endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown" style="height: 300px; overflow-y: scroll;">
              <a class="dropdown-item" href="{{ route('pending.product.index') }}">
                <p class="mb-0 font-weight-normal float-left">You have {{ $pendingProducts->count() }} pending {{ $pendingProducts->count() > 1 ? 'cars':'car' }}
                </p>
                <span style="cursor: pointer;" class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              @foreach($pendingProducts as $row)
              <div class="dropdown-divider"></div>
              <a href="{{ route('product.show', $row->product_id) }}" style="cursor: pointer;" class="dropdown-item preview-item">
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark text-capitalize">{{ $row->user->firstname. ' ' .$row->user->middlename. ' ' .$row->user->lastname }}</h6>
                  <p class="font-weight-light small-text">
                    {{ $row->brand. ' ' .$row->name. ' ' .$row->color. ' ' .$row->style }}
                  </p>
                </div>
              </a>
              @endforeach
              <div class="mx-auto"></div>
            </div>
          </li>
          @endif
          <li class="nav-item dropdown d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text" style="text-transform: capitalize;" >Hello, {{ Auth::user()->firstname. ' ' .Auth::user()->middlename. ' ' .Auth::user()->lastname }} !</span>
              <img class="img-xs rounded-circle" src="{{ Auth::user()->image == '' ? asset('admin/images/faces/default_image.png'):asset('uploads/user/'.Auth::user()->image) }}" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <a href="{{ route('account-information.show') }}" class="dropdown-item mt-2">
                Manage Account
              </a>
              <a href="{{ route('account.password') }}" class="dropdown-item">
                Change Password
              </a>
              <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Sign Out
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="{{ Auth::user()->image == '' ? asset('admin/images/faces/default_image.png'):asset('uploads/user/'.Auth::user()->image) }}" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name" style="text-transform: capitalize;">{{ Auth::user()->user_type == 1 ? Auth::user()->firstname. ' ' .Auth::user()->middlename. ' ' .Auth::user()->lastname : Auth::user()->user_id }}</p>
                  <div>
                    <small class="designation text-muted">{{ Auth::user()->user_type == 1 ? 'Admin':'Member' }}</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
              @if(Auth::user()->user_type == 2)
              <a href="{{ route('item.create') }}" class="btn btn-success btn-block">New Item
                <i class="mdi mdi-plus"></i>
              </a>
              @endif
            </div>
          </li>
          @if(Auth::user()->user_type == 2)
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
              <i class="menu-icon mdi mdi-home"></i>
              <span class="menu-title">Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('item.index') }}">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">My Account</span>
            </a>
          </li>
          {{-- <li class="nav-item @if(Request::is('inbox')) active @endif">
            <a class="nav-link" href="{{ route('inbox.index') }}">
              <i class="menu-icon mdi mdi-email"></i>
              <span class="menu-title">Inbox @if($inboxNotif->count() > 0)<span class="badge badge-danger ml-1"> {{ $inboxNotif->count() }} </span></span>@endif </span>
            </a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-email"></i>
              <span class="menu-title">Inbox @if($inboxNotif->count() > 0)<span class="badge badge-danger ml-1"> {{ $inboxNotif->count() }} </span></span>@endif </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('inbox.compose') }}">Compose</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('inbox.index') }}">Received @if($inboxNotif->count() > 0)<span class="badge badge-danger ml-1"> {{ $inboxNotif->count() }} </span></span>@endif</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('inbox.sent') }}">Sent</a>
                </li>
              </ul>
            </div>
          </li>
          @endif
          
          @if(Auth::user()->user_type == 1)
          <li class="nav-item @if(Request::is('admin/payment*')) active @endif">
            <a class="nav-link" href="{{ route('payment.index') }}">
              <i class="menu-icon mdi mdi-elevation-rise"></i>
              <span class="menu-title">Payments</span>
            </a>
          </li>
          <li class="nav-item @if(Request::is('admin/product*')) active @endif">
            <a class="nav-link" href="{{ route('product.index') }}">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">Cars</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('pending.product.index') }}">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">Pending Cars @if($pendingProducts->count() > 0)<span class="badge badge-danger ml-1">{{ $pendingProducts->count() }}</span>@endif</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('declined.product.index') }}">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">Declined Cars</span>
            </a>
          </li>
          <li class="nav-item @if(Request::is('admin/user*')) active @endif">
            <a class="nav-link" href="{{ route('user.index') }}">
              <i class="menu-icon fa fa-users"></i>
              <span class="menu-title">Members/Auctioneers</span>
            </a>
          </li>
          @endif
          
        </ul>
      </nav>

      {{-- winnernotif modal --}}
      @if(Auth::user()->user_type == 2)
      @if(count($winnerNotif) > 0)
        @foreach($winnerNotif as $row)
        <div class="modal fade" id="winnerNotifModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="card-body">
                  <h4 class="card-title"><span class="font-weight-bold">Congratulations!</span></h4>
                  <p class="card-description">
                    {{ $row->description }}
                  </p>

                  <p>You can now send email to the owner <span class="text-capitalize" >{{ $row->owner }}</span> <span style="font-size: 11px;">{{ $row->owner_id }}</span></p>

                  <form class="forms-sample" method="POST" action="{{ route('inbox.store') }}" id="storeMessageForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="highestbidder" value="{{ $row->owner_index }}">
                    <div class="form-group">
                      <label for="exampleInputEmail1">To</label>
                      <input type="text" class="form-control text-capitalize" value="{{ $row->owner }}" disabled required>
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
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="storeMessageForm">Send</button>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      @endif
      @endif{{-- winnernotif modal --}}
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <button type="button" class="btn btn-primary btn-xs" onclick="history.back();">Back</button>

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

    <!-- #endregion Jssor Slider End -->
	<div class="row" style="margin-top: 20px;">
		<div class="col-md-9 grid-margin stretch-card">
	      	<div class="card">
	        	<div class="card-body">
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
	      		</div>
	      	</div>
	    </div>
	    <div class="col-md-3">
	    	<div class="card">
	        	<div class="card-body">
              {{-- @if(Auth::user()->id == $product->user_id) --}}
              <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#biddersModal">View Bidders</button>
              <hr>
              {{-- @endif --}}
	        		  <p class="card-description">
			            Status 
                  @if($pToday >= $product->duration) 
                    <span class="badge badge-dark ml-1">Not Available</span> 
                  @else 
                    @if($product->status == 1) 
                      <span class="badge badge-success ml-1"> Available </span> 
                    @endif 
                    @if($product->status == 3) 
                      <span class="badge badge-danger ml-1"> Sold </span> 
                    @endif
                  @endif  
			          </p>
			          <p>
			            Car Model
			            <span class="font-weight-bold">{{ $product->name }}</span> 
			          </p>
			          <p>
			            Floor Price
			            <span class="font-weight-bold" id="floorpriceE">₱ {{ number_format($product->price) }}</span> 
			          </p>
			          <p>
			            Color
			            <span class="font-weight-bold">{{ $product->color }}</span> 
			          </p>
			          <p>
			            Style
			            <span class="font-weight-bold">{{ $product->style }}</span> 
			          </p>
			          <p>
			            Brand
			            <span class="font-weight-bold">{{ $product->brand }}</span> 
			          </p>
			          <p>
			            Series
			            <span class="font-weight-bold">{{ $product->series }}</span> 
			          </p>
			          <p>
			            Denomination
			            <span class="font-weight-bold">{{ $product->denomination }}</span> 
			          </p>
			          <p>
			            Piston
			            <span class="font-weight-bold">{{ $product->piston }}</span> 
			          </p>
			          <p>
			            Cylinder
			            <span class="font-weight-bold">{{ $product->cylinder }}</span> 
			          </p>
			          <p>
			            Fuel
			            <span class="font-weight-bold">{{ $product->fuel }}</span> 
			          </p>
			          <p>
			            Mileage
			            <span class="font-weight-bold">{{ $product->milage }}</span> 
			          </p>
			          <p>
			            Year
			            <span class="font-weight-bold">{{ $product->year }}</span> 
			          </p>
			          <p>
			            Due Date
			            <span class="font-weight-bold">{{ date('M d, Y', strtotime($product->duration)) }}</span> 
			          </p>
	        	</div>
	        </div>
	    </div>
	    <div class="col-md-9">
	    	<div class="card">
	        	<div class="card-body">

					<div class="row" id="highbidDiv">
						<div class="col-sm-6">
							<blockquote class="blockquote blockquote-primary">
							
								<div class="row" style="color: white;">
									<div class="col-sm-6">
										<p>Highest Bid</p>
										<h5 id="testBid">
											{{-- @if($highestBidder != 'None') 
												{{ '₱ '.$highestBidder->bid }} 
												@if($highestBidder->user_id == Auth::user()->id)
													<small>(you)</small>
												@endif 
											@else 
												None 
											@endif --}}
										</h5>
									</div>
									<div class="col-sm-6">
										<p>Floor Price</p>
										<h5>₱ {{ number_format($product->price) }}</h5>
									</div>
								</div>

							</blockquote>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
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
					        @if($pToday >= $product->duration)
					        @if($highestBidder != 'None')
							@if($highestBidder->user_id == Auth::user()->id)
							@if(!in_array($product->user_id, $reportArr))
					        <br>
					    	<a data-id="{{ $product->user_id }}" id="reportUser" data-token="{{ csrf_token() }}" href="#" class="btn btn-xs btn-warning" style="margin-top: 10px;" data-toggle="tooltip" title="Report"><i class="fas fa-flag"></i></a>
					    	@endif
					    	@endif
					    	@endif
					    	@endif
						</div>
					</div>
					<hr>
					@if($pToday >= $product->duration)
						<p>Closed</p>
					@else
						@if($product->user_id == Auth::user()->id)
							<div class="col-md-12"><label>You can't bid on your own car</label></div>
						@else
						<form method="POST" action="{{ route('store.bid', $product->id) }}" id="bidForm" {{-- onsubmit="return Confirm()" --}}>
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-12"><label>Enter your bid here</label></div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="number" name="bid" id="bidInput" class="form-control" required>
										{{-- <input type="number" id="bidInput" class="form-control" name="bid" required @if($highestBidder != 'None') @if($highestBidder->bid > $product->price) min="{{ $highestBidder->bid + 1 }}" @else min="{{ $product->price + 1 }}" @endif @else min="{{ $product->price + 1 }}" @endif> --}}
				                        <!-- <div class="input-group">
				                          <div class="input-group-prepend bg-primary border-primary">
				                            <span class="input-group-text bg-transparent text-white">₱</span>
				                          </div>
				                          <input type="number" class="form-control" name="bid" required>
				                          <div class="input-group-append bg-primary border-primary">
				                            <span class="input-group-text bg-transparent text-white">.00</span>
				                          </div>
				                        </div> -->
				                    </div>
								</div>
								<div class="col-md-6">
									<button class="btn btn-success">Bid Now</button>
								</div>
							</div>
						</form>
						@endif
					@endif
	        	</div>
	        </div>
	    </div>
	 </div>

</div>

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
        <div class="table-responsive">
          <table class="table" id="biddersTable">
            <thead>
              <tr>
                <th>ID</th>
                {{-- <th>Name</th> --}}
                <th>Bid</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($productBidders as $row)
              <tr title="{{ $row->user->type == 'ftb' ? 'First Time Bidder':'Regular Bidder' }}">
                <td>{{ $row->user->user_id }} @if($row->user->user_id == Auth::user()->user_id) <span class="text-warning">(You)</span> @endif</td>
                {{-- <td>{{ $row->user->firstname. ' ' .$row->user->middlename. ' ' .$row->user->lastname  }}</td> --}}
                <td>{{ '₱ '.number_format($row->bid) }}</td>
                <td>{{ date('M d, Y h:i:s', strtotime($row->created_at)) }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <!-- <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
              <a href="#">4Bid</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
              <i class="mdi mdi-heart text-danger"></i>
            </span>
          </div>
        </footer> -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
  {{-- <script src="{{ asset('admin/js/misc.js') }}"></script> --}}
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/plug-ins/1.10.19/sorting/currency.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
  {{-- load bid --}}
    $(document).ready(function(e){
        $.ajaxSetup({
            cache: false
        });
        setInterval( function(){ 
          $('#testBid').load('/item/'+'{{ $product->id }}'+'/bid'); 
          /*var elem = document.getElementById('chatDiv');
          elem.scrollTop = elem.scrollHeight;*/
        }, 1000 );
    });

    /*view notif*/
  $(document).on('click', '#viewNotif', function(e) {
    var id = $(this).data('id');
    var token = $(this).data("token");
    $.ajax(
        {
            url: "/notification/update/"+id,
            type: 'DELETE',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
            success: function ()
            {
              $('#winnerNotifModal'+id).modal('show');
              // console.log(id);
                // $('#members_table #'+id).remove();
            }
        });

  });/*view notif*/

  // view notif 2
  $(document).on('click', '#viewNotif2', function(e) {
    var id = $(this).data('id');
    var token = $(this).data("token");
    $.ajax(
        {
            url: "/notification2/update/"+id,
            type: 'DELETE',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
            success: function ()
            {
              location.href = "{{ URL::to('/item') }}/"+id;
              // $('#winnerNotifModal'+id).modal('show');
              // console.log(id);
                // $('#members_table #'+id).remove();
            }
        });

  });
  // view notif 2


  // report user
	  $(document).on('click', '#reportUser', function(e) {
	    var id = $(this).data('id');
	    var token = $(this).data("token");
	    var x = confirm("Are you sure you want to report the owner of this car?");
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
	  });
	  // report user
	

	// coundown js
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
	@if($pToday >= $product->duration)
	@else
	initializeClock('clockdiv', deadline);
	@endif

	$('#bidForm').submit(function(e) {
		e.preventDefault(); 
		var min = {{ $product->price }};
		var bid = $('#bidInput').val();

		@if($highestBidder != 'None') 
			@if($highestBidder->bid > $product->price) 
				min = {{ $highestBidder->bid }};
			@else 
				min = {{ $product->price }};
			@endif
		@endif

		if(bid <= min) {
			alert('Bid must be greater than '+ min)
		} else {
			var x = confirm("Confirm bid");
		    if (x) {
            var data = $(this).serialize();
            var url = $(this).attr('action');

            console.log(data);
            $.post(url, data, function(data) {

                // alert('Your bid has been submit!');
              $('#bidInput').val('');
              toastr.options.closeButton = true
              toastr.options.timeOut = 3000;
              toastr.options.positionClass = 'toast-top-center';
              toastr.success('Your bid has been submit!');

            });
        }
		    	// document.forms["bidForm"].submit();
		      /*$('#bidForm').on('submit', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');

            console.log(data);
            $.post(url, data, function(data) {

                alert('Your bid has been submit!');

            });
          });*/
		    else {
		     	return false;
        }
		}
	});


	function Confirm()
    {
    var x = confirm("Confirm bid");
    if (x)
      return true;
    else
      return false;
    }

    @if(Session::has('success'))
    	alert('Your bid has been submit!');
    @endif

    $(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip(); 
	});

    $('#biddersTable').DataTable({
          "pageLength": 25,
          "order": [],
        });
  </script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>