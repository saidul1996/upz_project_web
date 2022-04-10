@extends('layouts.frontend')
@section('title')
Requisition
@endsection
@section('requisitionmenu')
active show-sub
@endsection
@section('requisitionlist')
active
@endsection
@section('requisitioncreate')

@endsection
@section('css')
    <link href="{{ asset('backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">STORE</a>
    <span class="breadcrumb-item active">Requisition</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Requisition Table</h5>
      <p>Show all data from requisition table.</p>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <div class="row">
        <div class="col-7">
            <h6 class="card-body-title">This is the requisition table</h6>
            <p class="mg-b-20 mg-sm-b-30">You may search any entries from requisition list and see details.</p>
        </div>
        {{-- <div class="col-5 text-right">
            <a class="btn btn-info" href="{{ route('admin.requisition.create') }}">Create New</a>
        </div> --}}
      </div>
      @include('partials.message')
      <div class="table-wrapper">
        <table id="example" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-10p">SI</th>
                <th class="wd-20p">User Name</th>
                <th class="wd-20p text-center">Status</th>
                <th class="wd-10p">Process By</th>
                <th class="wd-25p text-center">Requisition Date</th>
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
                    if($data->status==3){ echo "<span class='text-success'>Approved</span>"; }
                    elseif($data->status==2){ echo "<span class='text-warning'>Viewed</span>"; }
                    elseif($data->status==1){ echo "<span class='text-danger'>Pending</span>"; }
                    else{ echo "<span class='text-dark'>Canceled</span>"; } @endphp</td>
                <td class="text-center">@php if($data->status==1) echo 'Customer'; else echo 'Admin';@endphp</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y')??'' }}</td>
                <td>
                    <a data-id="{{ $data->id }}" title="Show Item" class="viewRequisition mr-2" href="{{route('user.requisition.details',$data->id)}}"><i class="text-info menu-item-icon icon icon ion-ios-eye tx-24"></i></a>
                    @if($data->status==1)
                    <a title="Delete Item" class="mr-2" href="#deleteModal{{$data->id}}" data-toggle="modal"><i class="text-danger menu-item-icon icon ion-android-delete tx-24"></i></a>
                    @endif
                </td>
              </tr>

                <!-- Delete -->
                <div class="modal fade" id="deleteModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header state modal-primary">

                            </div>
                            <div class="modal-body m-auto">
                                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete ?</h5>
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('user.requisition.delete',$data->id)}}" method="POST">
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

      @if($aproved_requisition->count() > 0)
      <div class="table-wrapper">
        <h4 class="text-center mt-5 pt-3 mb-2">Approved Requisition List</h4>
        <table id="exampletwo" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-10p">SI</th>
                <th class="wd-20p">User Name</th>
                <th class="wd-20p text-center">Status</th>
                <th class="wd-10p">Process By</th>
                <th class="wd-25p">Requisition Date</th>
                <th class="wd-15p">Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $i=1;
              @endphp
              @foreach ($aproved_requisition as $data)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ App\Models\User::where('id',$data->user_id)->first()->name??'' }}</td>
                <td class="text-center">@php
                    if($data->status==3){ echo "<span class='text-success'>Approved</span>"; }
                    elseif($data->status==2){ echo "<span class='text-warning'>Viewed</span>"; }
                    elseif($data->status==1){ echo "<span class='text-danger'>Pending</span>"; }
                    else{ echo "<span class='text-dark'>Canceled</span>"; } @endphp</td>
                <td class="text-center">@if(isset($data->added_by)) {{ App\Models\Admin::where('id',$data->added_by)->first()->name??'' }} @else {{ 'Customer' }} @endif</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y')??'' }}</td>
                <td>
                    <a data-id="{{ $data->id }}" title="Show Item" class="viewRequisition mr-2" href="{{route('user.requisition.details',$data->id)}}"><i class="text-info menu-item-icon icon icon ion-ios-eye tx-24"></i></a>
                    <a title="Update Item" class="mr-2" href="{{route('admin.requisition.edit',$data->id)}}"><i class="text-success menu-item-icon icon ion-compose tx-24"></i></a>
                    <a title="Delete Item" class="mr-2" href="#deleteModal{{$data->id}}" data-toggle="modal"><i class="text-danger menu-item-icon icon ion-android-delete tx-24"></i></a>
                </td>
              </tr>

                <!-- Delete -->
                <div class="modal fade" id="deleteModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header state modal-primary">

                            </div>
                            <div class="modal-body m-auto">
                                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete ?</h5>
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('admin.requisition.destroy',$data->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
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

      @if($canceled_requisition->count() > 0)
      <div class="table-wrapper">
        <h4 class="text-center mt-5 pt-3 mb-2">Canceled Requisition List</h4>
        <table id="examplethree" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-10p">SI</th>
                <th class="wd-20p">User Name</th>
                <th class="wd-20p text-center">Status</th>
                <th class="wd-10p">Process By</th>
                <th class="wd-25p">Requisition Date</th>
                <th class="wd-15p">Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $i=1;
              @endphp
              @foreach ($canceled_requisition as $data)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ App\Models\User::where('id',$data->user_id)->first()->name??'' }}</td>
                <td class="text-center">{{ $data->payable_amount??'' }}</td>
                <td>{{ App\Models\User::where('id',$data->user_id)->first()->store_name??'' }}</td>
                <td class="text-center">@php
                    if($data->status==3){ echo "<span class='text-success'>Approved</span>"; }
                    elseif($data->status==2){ echo "<span class='text-warning'>Viewed</span>"; }
                    elseif($data->status==1){ echo "<span class='text-danger'>Pending</span>"; }
                    else{ echo "<span class='text-dark'>Canceled</span>"; } @endphp</td>
                <td class="text-center">@if(isset($data->added_by)) {{ App\Models\Admin::where('id',$data->added_by)->first()->name??'' }} @else {{ 'Customer' }} @endif</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y')??'' }}</td>
                <td>
                    <a data-id="{{ $data->id }}" title="Show Item" class="viewRequisition mr-2" href="{{route('user.requisition.details',$data->id)}}"><i class="text-info menu-item-icon icon icon ion-ios-eye tx-24"></i></a>
                    <a title="Update Item" class="mr-2" href="{{route('admin.requisition.edit',$data->id)}}"><i class="text-success menu-item-icon icon ion-compose tx-24"></i></a>
                    <a title="Delete Item" class="mr-2" href="#deleteModal{{$data->id}}" data-toggle="modal"><i class="text-danger menu-item-icon icon ion-android-delete tx-24"></i></a>
                </td>
              </tr>

                <!-- Delete -->
                <div class="modal fade" id="deleteModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header state modal-primary">

                            </div>
                            <div class="modal-body m-auto">
                                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete ?</h5>
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('admin.requisition.destroy',$data->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
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

    $(".viewRequisition").click(function(){
        var requisitionId = $(this).attr("data-id");

        if(requisitionId){
            $.ajax({
            type:"GET",
            url:'/admin/changeRequisitionStatus/'+requisitionId,

            success:function(res){
                if(res){
                    console.log(res);
                }else{
                    console.log('error');
                }
            }
            });
        }
    });

</script>

@endsection


