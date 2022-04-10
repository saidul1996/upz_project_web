@extends('layouts.frontend')
@section('title')
Stock Receive
@endsection
@section('stockmenu')
active show-sub
@endsection
@section('stocklist')
active
@endsection
@section('stockcreate')

@endsection
@section('css')
    <link href="{{ asset('backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } .fa-check-square-o{ font-size: 22px; }</style>
@endsection
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('dashboard') }}">STORE</a>
    <span class="breadcrumb-item active">Stock Receive</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Stock Receive Table</h5>
      <p>Show all data from stock table.</p>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <div class="row">
        <div class="col-7">
            <h6 class="card-body-title">This is the stock table</h6>
            <p class="mg-b-20 mg-sm-b-30">You may search any entries from stock list and see details.</p>
        </div>
      </div>
      @include('partials.message')
      @if(count($all_data)>0)
      <div class="table-wrapper">
        <table id="example" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-10p">SI</th>
                <th class="wd-20p">User Name</th>
                <th class="wd-15p text-center">Status</th>
                <th class="wd-10p">Process By</th>
                <th class="wd-15p text-center">Date</th>
                <th class="wd-15p">Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $i=1;
              @endphp
              @foreach ($all_data as $data)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ App\Models\User::where('id',$data->user_id)->first()->name??'' }}</td>
                <td class="text-center">@php
                    if($data->status==2){ echo "<span class='text-warning'>Accepted</span>"; }
                    elseif($data->status==1){ echo "<span class='text-danger'>Pending</span>"; }
                    else{ echo "<span class='text-dark'>Canceled</span>"; } @endphp</td>
                <td class="text-center">@if($data->status==2) Customer @else Admin @endif</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y')??'' }}</td>
                <td>
                    <a data-id="{{ $data->id }}" title="Show Item" class="mr-2" href="{{route('user.stock.show',$data->id)}}"><i class="text-info menu-item-icon icon icon ion-ios-eye tx-24"></i></a>
                    <a title="Accept Stock" class="mr-2" href="#statusModal{{$data->id}}" data-toggle="modal"><i class="text-warning fa fa-check-square-o" aria-hidden="true"></i></a>
                </td>
              </tr>

                <!-- Update Status -->
                <div class="modal fade" id="statusModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header state modal-primary">

                            </div>
                            <div class="modal-body m-auto">
                                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to accept this stock ?</h5>
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('user.stock.accept',$data->id)}}" method="get">
                                    @csrf

                                    <button class="btn btn-info mg-r-5" type="submit">Submit</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

              @endforeach
            </tbody>
        </table>

      </div>
      @endif

      @if(count($accept_stockout)>0)
      <div class="table-wrapper">
        <h4 class="text-center mt-5 pt-3 mb-2">Received Stock List</h4>
        <table id="exampletwo" class="table display responsive nowrap">
            <thead>
                <tr>
                    <th class="wd-10p">SI</th>
                    <th class="wd-20p">User Name</th>
                    <th class="wd-15p text-center">Status</th>
                    <th class="wd-10p">Process By</th>
                    <th class="wd-15p text-center">Date</th>
                    <th class="wd-15p text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @php
                  $i=1;
              @endphp
              @foreach ($accept_stockout as $data)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ App\Models\User::where('id',$data->user_id)->first()->name??'' }}</td>
                <td class="text-center">@php
                    if($data->status==2){ echo "<span class='text-success'>Accepted</span>"; }
                    elseif($data->status==1){ echo "<span class='text-danger'>Pending</span>"; }
                    else{ echo "<span class='text-dark'>Canceled</span>"; } @endphp</td>
                <td class="text-center">@if($data->status==2) Customer @else Admin @endif</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y')??'' }}</td>
                <td class="text-center">
                    <a data-id="{{ $data->id }}" title="Show Item" class="mr-2" href="{{route('user.stock.show',$data->id)}}"><i class="text-info menu-item-icon icon icon ion-ios-eye tx-24"></i></a>
                </td>
              </tr>

              @endforeach
            </tbody>
        </table>

      </div>
      @endif

    </div><!-- card -->

  </div><!-- sl-pagebody -->

@endsection

@section('js')
<script src="{{ asset('backend/lib/datatables/jquery.dataTables.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    $(document).ready(function() {
        $('#exampletwo').DataTable();
    });
    $(document).ready(function() {
        $('#examplethree').DataTable();
    });


</script>

@endsection


