@extends('layouts.app2')

@section('styles')
<style>
  table.cards {
        background-color: transparent;
    }

    /*--[  This does the job of making the table rows appear as cards ]----------------*/
    .cards tbody img {
        height: 100px;
    }
    .cards tbody tr {
        float: left;
        margin: 10px;
        border: 1px solid #aaa;
        box-shadow: 3px 3px 6px rgba(0,0,0,0.25);
        background-color: white;
    }
    .cards tbody td {
        display: block;
        width: 268px;
        overflow: hidden;
        text-align: left;
    }

    /*---[ The remaining is just more dressing to fit my preferances ]-----------------*/
    .table {
        background-color: #fff;
    }
    .table tbody label {
        display: none;
        margin-right: 5px;
        width: 50px;
    }   
    .table .glyphicon {
        font-size: 20px;
    }

    .cards .glyphicon {
        font-size: 75px;
    }

    .cards tbody label {
        display: inline;
        position: relative;
        font-size: 85%;
        font-weight: normal;
        top: -5px;
        left: -3px;
        float: left;
        color: #808080;
    }
    .cards tbody td:nth-child(1) {
        text-align: center;
    }

    .dataTables_filter {
     display: none;
    }

    .search-box {
      position: relative;
      text-align: center;
      color: white;
      margin-bottom: 20px;
    }

    .search-box img {
      width: 100%;
    }

    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .searchh {
      width: 600px;
    }

    .search-box-title {
        font-size: 40px;
        font-weight: 700;
    }

    .input-group-append .input-group-text, .input-group-prepend .input-group-text {
        background: transparent;
        border-color: #00ce68;
    }

    @media (max-width: 670px) {
      .searchDiv {
        width: 90% !important;
        margin: 0 auto;
      }
    }

    @media (max-width: 600px) {
      .searchDiv {
        width: 70% !important;
        margin: 0 auto;
      }
    }

    @media (max-width: 500px) {
      .searchDiv {
        width: 50% !important;
        margin: 0 auto;
      }
    }

    @media (max-width: 375px) {
      .searchDiv {
        width: 40% !important;
        margin: 0 auto;
      }
    }

</style>
@stop

@section('content')
<div class="row">
  <div class="search-box">
    <img src="{{ asset('home-banner.jpeg') }}">
    <div class="centered">
      <div class="row">
        <div class="col-lg-12">
            <div class="searchh">
              <p class="search-box-title">Find Vehicles</p>
              <div class="input-group mb-3 searchDiv">
                <input type="text" class="form-control" placeholder="Type keyword..." id="searchbox">
                <div class="input-group-append" style="background: #00ce68; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-color: black;">
                  <span style="color: white;" class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- Search Box : <input type="text" id="searchbox"> --}}
{{-- <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Newly Added <span class="badge badge-danger blink_me ml-1"> Hot! </span></h4>
              <div class="table-responsive">
                <table id="newlyAddedTable" class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Car Model</th>
                      <th>Description</th>
                      <th>Floor Price</th>
                      <th>Highest Bid</th>
                      <th>Due Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($newlyAddedProducts as $row)
                    @if($row->duration2 <= $today)
                    <tr>
                      <td><img style="width: 100px; height: 100px; border-radius: 5%;" src="{{ asset('uploads/images/'.$row->thumbnail) }}"></td>
                      <td><a href="{{ route('item.details', $row->id) }}" class="font-weight-bold">{{ $row->name }}</a> @if($row->user_id == Auth::user()->id) <span class="badge badge-primary ml-1"> Your Item </span> @endif </td>
                      <td>
                        <ul class="list-arrow">
                          <li>{{ $row->name }}</li>
                          <li>{{ $row->brand }}</li>
                          <li>{{ $row->color }}</li>
                          <li>{{ $row->series }}</li>
                          <li>{{ $row->year }}</li>
                        </ul>
                      </td>
                      <td>₱ {{ $row->price }}</td>
                      <td>{{ $row->h_bid != 'none' ? '₱ '.$row->h_bid:'' }}</td>
                      <td> Not Available </td>
                    </tr>
                    @else
                    <tr>
                      <td><img style="width: 100px; height: 100px; border-radius: 5%;" src="{{ asset('uploads/images/'.$row->thumbnail) }}"></td>
                      <td><a href="{{ route('item.details', $row->id) }}" class="font-weight-bold">{{ $row->name }}</a> @if($row->user_id == Auth::user()->id) <span class="badge badge-primary ml-1"> Your Item </span> @endif </td>
                      <td>
                        <ul class="list-arrow">
                          <li>{{ $row->name }}</li>
                          <li>{{ $row->brand }}</li>
                          <li>{{ $row->color }}</li>
                          <li>{{ $row->series }}</li>
                          <li>{{ $row->year }}</li>
                        </ul>
                      </td>
                      <td>₱ {{ $row->price }}</td>
                      <td>{{ $row->h_bid != 'none' ? '₱ '.$row->h_bid:'' }}</td>
                      <td>{{ $row->duration }}</td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
      </div>
    </div>
</div> --}}

<div class="row">
    <div class="card" style="width: 100%;">
      <div class="card-body" >
        <div class="col-lg-12">
          <div class="table-responsive">
                <table id="allProductsTable" class="table table-hover cards">
                  <thead style="display: none;">
                    <tr>
                      <th></th>
                      <th>Car Model</th>
                      <th>Description</th>
                      <th>Floor Price</th>
                      <th>Highest Bid</th>
                      <th>Date Posted</th>
                      <th>Due Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($allProducts as $row)
                    @if($row->duration2 <= $today)
                    <tr>
                      <td><img style="width: 100%; height: 100%; border-radius: 0%;" src="{{ asset('uploads/images/'.$row->thumbnail) }}"></td>
                      <td><a href="{{ route('item.details', $row->id) }}" class="font-weight-bold">{{ $row->name }}</a>  @if($row->user_id == Auth::user()->id) <span class="badge badge-primary ml-1"> Your Item </span> @endif</td>
                      <td>
                        Description: 
                        <ul class="list-arrow">
                          <li>{{ $row->name }}</li>
                          <li>{{ $row->brand }}</li>
                          <li>{{ $row->color }}</li>
                          <li>{{ $row->series }}</li>
                          <li>{{ $row->year }}</li>
                        </ul>
                      </td>
                      <td>Floor Price: ₱ {{ $row->price }}</td>
                      <td>Highest Bid: {{ $row->h_bid != 'none' ? '₱ '.$row->h_bid:'' }}</td>
                      <td>Date Posted: {{ date('M d, Y', strtotime($row->created_at)) }}</td>
                      <td>Not Available</td>
                    </tr>
                    @else
                    <tr>
                      <td><img style="width: 100%; height: 100%; border-radius: 0%;" src="{{ asset('uploads/images/'.$row->thumbnail) }}"></td>
                      <td><a href="{{ route('item.details', $row->id) }}" class="font-weight-bold">{{ $row->name }}</a>  @if($row->user_id == Auth::user()->id) <span class="badge badge-primary ml-1"> Your Item </span> @endif</td>
                      <td>
                        Description: 
                        <ul class="list-arrow">
                          <li>{{ $row->name }}</li>
                          <li>{{ $row->brand }}</li>
                          <li>{{ $row->color }}</li>
                          <li>{{ $row->series }}</li>
                          <li>{{ $row->year }}</li>
                        </ul>
                      </td>
                      <td>Floor Price: ₱ {{ $row->price }}</td>
                      <td>Highest Bid: {{ $row->h_bid != 'none' ? '₱ '.$row->h_bid:'' }}</td>
                      <td>Date Posted: {{ date('M d, Y', strtotime($row->created_at)) }}</td>
                      <td>Due Date: {{ date('M d, Y', strtotime($row->duration)) }}</td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
        </div>
      </div>
    </div>
</div>

@stop

@section('scripts')
  <script>
    window.setInterval(function(){
      blinker();
    }, 100);
    function blinker() {
            $('.blink_me').fadeOut(500);
            $('.blink_me').fadeIn(500);
        }

    $('#newlyAddedTable').DataTable({
     columnDefs: [
       { type: 'currency', targets: 3 }
     ]
    } );

    $('#allProductsTable').DataTable({
      // columns: colDefs,
     columnDefs: [
       { type: 'currency', targets: 3 }
     ]
    } );

    $('#btToggleDisplay').on('click', function () {
        $("#allProductsTable").toggleClass('cards')
        $("#allProductsTable thead").toggle()
    })

    var dataTable = $('#allProductsTable').dataTable();
    $("#searchbox").keyup(function() {
        dataTable.fnFilter(this.value);
    });    


  </script>
@stop