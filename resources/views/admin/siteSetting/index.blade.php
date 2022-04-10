@extends('admin.layouts.dashboard')
@section('title')
{{__('General Setting')}}
@endsection
@section('setting')
active show-sub
@endsection
@section('siteSetting')
active
@endsection
@section('css')
    <link href="{{ asset('backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{__(App\Models\SiteSetting::first()->value('name')??'')}}</a>
    <span class="breadcrumb-item active">{{__('Site Setting')}}</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <!-- <h5></h5>
      <p></p> -->
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <div class="row">
        <div class="col-7">
            <h6 class="card-body-title">{{__('Site Setting Table')}}</h6>
            <p class="mg-b-20 mg-sm-b-30">{{__('You may update this data')}}</p>
        </div>
        <div class="col-5 text-right">
            <a class="btn btn-info" href="{{ route('admin.siteSetting.edit', $data->id) }}">{{__('Edit')}}</a>
        </div>
      </div>
      @include('partials.message')
      <div class="table-wrapper">
        
      <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label">{{__('Site Title')}}: </label>
                          <input class="form-control" type="text" value="{{ $data->name??'' }}" readonly>
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label">{{__('Email')}}: </label>
                          <input class="form-control" type="text" value="{{ $data->email??'' }}" readonly>
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label">{{__('Phone')}}: </label>
                          <input class="form-control" type="text" value="{{ $data->phone??'' }}" readonly>
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label">{{__('Website')}}:</label>
                          <input class="form-control" type="text" value="{{ $data->website??'' }}" readonly>
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-12">
                        <div class="form-group">
                          <label class="form-control-label">{{__('Address')}}: </label>
                          <input class="form-control" type="text" value="{{ $data->address??'' }}" readonly>
                        </div>
                    </div><!-- col-12 -->
                    <div class="col-lg-12">
                        <div class="form-group">
                          <label class="form-control-label">{{__('Description')}}: </label>
                          <textarea class="form-control" id="" cols="30" rows="5" readonly>{{ $data->short_description??'' }}</textarea>
                        </div>
                    </div><!-- col-12 -->
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label class="form-control-label d-block">{{__('Logo')}}: <span class="tx-danger"></span></label>
                        <img height="100px" src="{{ $data->logo??'' }}" alt="Logo">
                        </div>
                    </div><!-- col-6 -->
                </div><!-- row -->

                <div class="form-layout-footer">
                    <a href="{{ route('admin.siteSetting.edit', $data->id) }}" class="btn btn-secondary">{{__('Edit')}}</a>
                </div><!-- form-layout-footer -->

            </div><!-- form-layout -->
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


