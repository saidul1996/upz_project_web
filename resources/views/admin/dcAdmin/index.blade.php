@extends('admin.layouts.dashboard')
@section('title')
{{__('DC Admin')}}
@endsection
@section('dcadminmenu')
active show-sub
@endsection
@section('dcadminlist')
active
@endsection
@section('css')
    <link href="{{ asset('backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{__(App\Models\SiteSetting::first()->value('name')??'')}}</a>
    <span class="breadcrumb-item active">{{__('DC')}}</span>
</nav>

<div class="sl-pagebody">

    <div class="card pd-20 pd-sm-40">
      <div class="row">
        <div class="col-7">
            <h6 class="card-body-title">{{ __('Data Table') }}</h6>
            <p class="mg-b-20 mg-sm-b-30">{{ __('You may select and view details') }}</p>
        </div>
        {{--<div class="col-5 text-right">
            <a class="btn btn-info" href="{{ route('admin.dcAdmin.create') }}">{{ __('Create New') }}</a>
        </div>--}}
      </div>
      @include('partials.message')
      <div class="table-wrapper">
        <table id="example" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-5p">{{ __('SI') }}</th>
                <th class="wd-15p">{{ __('Name') }}</th>
                <th class="wd-15p">{{ __('Phone') }}</th>
                <th class="wd-15p">{{ __('District') }}</th>
                <th class="wd-10p">{{ __('Status') }}</th>
                <th class="wd-15p">{{ __('Action') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($all_data as $data)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name??'' }}</td>
                <td>{{ $data->phone??'' }}</td>
                <td>{{ $data->district->name??'' }}</td>
                <td>@if($data->status==1) <span class='text-success'> {{__('Active')}} </span>@elseif($data->status==0) <span class='text-warning'> {{__('Pending')}} </span> @else<span class='text-danger'>{{ __('Deactivated') }}</span>@endif</td>
                <td>
                    <a title="Show Item" class="mr-2" href="{{route('admin.dcAdmin.show',$data->id)}}"><i class="text-info menu-item-icon icon icon ion-ios-eye tx-24"></i></a>
                    @if(App\Models\Admin::where([['email', $data->email],['name', $data->name]])->count())
                    <a title="Update Item" class="mr-2" href="{{route('admin.dcAdmin.edit',$data->id)}}"><i class="text-success menu-item-icon icon ion-compose tx-24"></i></a>
                    <a title="Delete Item" class="mr-2" href="#deleteModal{{$data->id}}" data-toggle="modal"><i class="text-danger menu-item-icon icon ion-android-delete tx-24"></i></a>
                    @else
                        <a title="Approved" class="mr-2" href="{{route('admin.admin.approve',$data->id)}}" onClick="return confirm('Are you sure want to approve?')"><i class="text-success fa fa-check-square-o tx-24"></i></a>
                        <a title="Reject" class="mr-2" href="{{route('admin.admin.reject',$data->id)}}" onClick="return confirm('Are you sure want to reject?')"><i class="text-danger fa fa-times tx-24"></i></a>
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
                                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Are you sure you want to delete ?') }}</h5>
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('admin.dcAdmin.destroy',$data->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-info mg-r-5" type="submit">{{ __('Submit') }}</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
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


