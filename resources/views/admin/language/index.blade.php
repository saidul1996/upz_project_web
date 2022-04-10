@extends('admin.layouts.dashboard')
@section('title')
{{__('Language')}}
@endsection
@section('languagemenu')
active show-sub
@endsection
@section('languagelist')
active
@endsection
@section('css')
    <link href="{{ asset('backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
@endsection
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{__(App\Models\SiteSetting::first()->value('name')??'')}}</a>
    <span class="breadcrumb-item active">{{__('Language')}}</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <!-- <h5>{{ __('Language Data') }}</h5>
      <p>{{ __('Show all language from category table.') }}</p> -->
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <div class="row">
        <div class="col-7">
            <h6 class="card-body-title">{{ __('Data Table') }}</h6>
            <p class="mg-b-20 mg-sm-b-30">{{ __('You may select and view details') }}</p>
        </div>
        <div class="col-5 text-right">
            <a class="btn btn-info" href="{{ route('admin.language.create') }}">{{ __('Create New') }}</a>
        </div>
      </div>
      @include('partials.message')
      <div class="table-wrapper">
        <table id="example" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-10p">{{ __('S/N') }}</th>
                <th class="wd-20p text-center">{{ __('Language Key') }}</th>
                <th class="wd-40p text-center">{{ __('Language Name') }}</th>
                <th class="wd-20p text-center">{{ __('Status') }}</th>
                <th class="wd-20p text-center">{{ __('Process By') }}</th>
                <th class="wd-30p text-center">{{ __('Action') }}</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $i=1;
              @endphp
              @foreach ($all_data as $data)
              <tr>
                <td>{{ $i++ }}</td>
                <td class="text-center">{{ $data->key??'' }}</td>
                <td class="text-center">{{ $data->name??'' }}</td>
                <td class="text-center">@if($data->status==0) <span class='text-success'> {{__('Active')}} </span> @else<span class='text-warning'>{{ __('Deactivated') }}</span>@endif</td>
                <td class="text-center">{{  App\Models\Admin::where('id',$data->added_by)->first()->name??'' }}</td>
                <td class="text-center">
                    <a title="Show Item" class="mr-2" href="{{route('admin.language.show',$data->id)}}"><i class="text-info menu-item-icon icon icon ion-ios-eye tx-24"></i></a>
                    <a title="Update Item" class="mr-2" href="{{route('admin.language.edit',$data->id)}}"><i class="text-success menu-item-icon icon ion-compose tx-24"></i></a>
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
                                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Are you sure you want to delete ?') }}</h5>
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('admin.language.destroy',$data->id)}}" method="POST">
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


