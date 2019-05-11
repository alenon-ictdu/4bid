<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  {{-- <meta name="viewport" content="width=1280,initial-scale=1"> --}}
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@if(isset($pageTitle)) {{ $pageTitle }} @else Page Title @endif</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.addons.css') }}">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
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

  #notificationDropdown:hover > #notificationCount {
    position: absolute;
    left: 10%;
    width: 1rem;
    height: 1rem;
    border-radius: 100%;
    background: #FF0017;
    color: #ffffff;
    font-size: 11px;
    top: -1px;
    font-weight: 600;
    line-height: 1rem;
    border: none;
    text-align: center; 
  }

   #notificationDropdown:hover > #notifText::after {
    content: 'Notification';
  } 

  #messageDropdown:hover > #messageCount {
    position: absolute;
    left: 10%;
    width: 1rem;
    height: 1rem;
    border-radius: 100%;
    background: #FF0017;
    color: #ffffff;
    font-size: 11px;
    top: -1px;
    font-weight: 600;
    line-height: 1rem;
    border: none;
    text-align: center; 
  }

  #messageDropdown:hover > #msgText::after {
    content: 'Messages';
  } 

  @media (max-width: 600px) {
    /* .navbar.default-layout .navbar-brand-wrapper {
      width: 75px;
      display: none !important;
    } */

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

  </style>
  @yield('styles')
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
              <i class="mdi mdi-bell" id="notifIcon"></i><span id="notifText"></span>
              @if($sCarsCount > 0 || count($winnerNotif) > 0)
              <span id="notificationCount" class="count">{{ count($winnerNotif) + $sCarsCount }}</span>
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
            <a class="nav-link count-indicator" id="messageDropdown" href="{{ route('user.view.chat') }}" >
              <i class="mdi mdi-message"></i><span id="msgText"></span>
              @if($chatniAdmin->count() > 0)<span class="count" id="messageCount">{{ $chatniAdmin->count() }}</span>@endif
            </a>
          </li>
          @endif
          @if(Auth::user()->user_type == 1)
          <li class="nav-item dropdown" >
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-message"></i><span id="msgText"></span>
              @if(count($unseenUserArr) > 0)<span class="count" id="messageCount">{{ count($unseenUserArr) }}</span>@endif
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
              <i class="mdi mdi-bell"></i><span id="notifText"></span>
              @if($pendingProducts->count() > 0)<span class="count" id="notificationCount">{{ $pendingProducts->count() }}</span>@endif
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
          <li class="nav-item @if(Request::is('home')) active @endif">
            <a class="nav-link" href="{{ route('home') }}">
              <i class="menu-icon mdi mdi-home"></i>
              <span class="menu-title">Home</span>
            </a>
          </li>
          <li class="nav-item @if(Request::is('items')) active @endif">
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
          <li class="nav-item @if(Request::is('inbox*')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-email"></i>
              <span class="menu-title">Inbox @if($inboxNotif->count() > 0)<span class="badge badge-danger ml-1"> {{ $inboxNotif->count() }} </span></span>@endif </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if(Request::is('inbox*')) show @endif" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item @if(Request::is('inbox/compose')) active @endif">
                  <a class="nav-link" href="{{ route('inbox.compose') }}">Compose</a>
                </li>
                <li class="nav-item @if(Request::is('inbox')) active @endif">
                  <a class="nav-link" href="{{ route('inbox.index') }}">Received @if($inboxNotif->count() > 0)<span class="badge badge-danger ml-1"> {{ $inboxNotif->count() }} </span></span>@endif</a>
                </li>
                <li class="nav-item @if(Request::is('inbox/sent')) active @endif">
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
          <li class="nav-item @if(Request::is('admin/report*')) active @endif">
            <a class="nav-link" href="{{ route('report.index') }}">
              <i class="menu-icon fa fa-user-lock"></i>
              <span class="menu-title">Reported User</span>
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
          @yield('content')
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
  <script src="{{ asset('admin/js/misc.js') }}"></script>
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/plug-ins/1.10.19/sorting/currency.js"></script>
  <script>
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

  </script>
  @yield('scripts')
  
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>