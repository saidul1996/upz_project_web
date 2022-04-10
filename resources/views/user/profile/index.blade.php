@extends('admin.layouts.dashboard')
@section('title')
User
@endsection
@section('usermenu')
active show-sub
@endsection
@section('userlist')
active
@endsection
@section('usercreate')

@endsection
@section('css')
    <link href="{{ asset('backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">STORE</a>
    <span class="breadcrumb-item active">User</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>User Table</h5>
      <p>Show all data from user table.</p>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <div class="row">
        <div class="col-7">
            <h6 class="card-body-title">This is the user table</h6>
            <p class="mg-b-20 mg-sm-b-30">You may search any entries from user list and see details.</p>
        </div>
        <div class="col-5 text-right">
            <a class="btn btn-info" href="{{ route('admin.user.create') }}">Create New</a>
        </div>
      </div>
      @include('partials.message')
      <div class="table-wrapper">
        <table id="example" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-5p">SI</th>
                <th class="wd-15p">Name</th>
                <th class="wd-15p">Email</th>
                <th class="wd-15p">Phone</th>
                <th class="wd-15p">Designation</th>
                <th class="wd-10p">Status</th>
                <th class="wd-10p">Process By</th>
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
                <td>{{ $data->name??'' }}</td>
                <td>{{ $data->email??'' }}</td>
                <td>{{ $data->phone??'' }}</td>
                <td>{{ $data->designation??'' }}</td>
                <td>@php if($data->status==0){ echo "<span class='text-success'>Active</span>"; }else{ echo "<span class='text-warning'>Deactivated</span>"; } @endphp</td>
                <td>{{ App\Models\Admin::where('id',$data->added_by)->first()->name??'' }}</td>
                <td>
                    <a title="Show Item" class="mr-2" href="{{route('admin.user.show',$data->id)}}"><i class="text-info menu-item-icon icon icon ion-ios-eye tx-24"></i></a>
                    <a title="Update Item" class="mr-2" href="{{route('admin.user.edit',$data->id)}}"><i class="text-success menu-item-icon icon ion-compose tx-24"></i></a>
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
                                <form action="{{route('admin.user.destroy',$data->id)}}" method="POST">
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
    </div><!-- card -->




  </div><!-- sl-pagebody -->

@endsection

@section('js')
<script src="{{ asset('backend/lib/datatables/jquery.dataTables.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

@endsection


