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
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{__(App\Models\SiteSetting::first()->value('name')??'')}}</a>
    <span class="breadcrumb-item active">{{__('Site Setting')}}</span>
</nav>

<div class="sl-pagebody">

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">{{__('Edit Form')}}</h6>
                <p class="mg-b-20 mg-sm-b-30">{{__('Update this data with required fields')}}</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.siteSetting.index') }}">{{__('View')}}</a>
            </div>
        </div>
        @include('partials.message')
        <form action="{{route('admin.siteSetting.update',$siteSetting->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{__('Site Title')}}: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{{ $siteSetting->name?? old('name') }}" placeholder="{{__('Enter Website Name')}}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{__('Email')}}: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="email" value="{{ $siteSetting->email?? old('email') }}" placeholder="{{__('Enter Email')}}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{__('Phone')}}: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="number" name="phone" value="{{ $siteSetting->phone?? old('phone') }}" placeholder="{{__('Enter Phone No')}}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{__('Website')}}: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="website" value="{{ $siteSetting->website?? old('website') }}" placeholder="{{__('Enter Web Address')}}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-12 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{__('Address')}}: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="address" value="{{ $siteSetting->address?? old('address') }}" placeholder="{{__('Enter Location')}}">
                        </div>
                    </div><!-- col-12 -->
                    <div class="col-lg-12 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{__('Description')}}: </label>
                            <textarea class="form-control" id="" cols="30" rows="5">{{ $siteSetting->short_description??'' }}</textarea>
                        </div>
                    </div><!-- col-12 -->
                    <div class="col-lg-12 my-2">
                        <div class="form-group">
                        <label class="form-control-label">{{__('Logo')}}:</label>
                            <input class="form-control" type="file" name="logo" placeholder="Enter Image">
                            <img height="100px" class="mt-3" src="{{ $siteSetting->logo??'' }}" alt="Image">
                        </div>
                    </div><!-- col-6 -->
                </div><!-- row -->

                <div class="form-layout-footer">
                    <button class="btn btn-info mg-r-5" type="submit">{{__('Submit')}}</button>
                    <a href="{{ route('admin.siteSetting.index') }}" class="btn btn-secondary">{{__('Cancel')}}</a>
                </div><!-- form-layout-footer -->

            </div><!-- form-layout -->

        </form>

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


