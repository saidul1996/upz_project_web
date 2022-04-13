@extends('admin.layouts.dashboard')
@section('title')
{{__('Admin')}}
@endsection
@section('adminmenu')
active show-sub
@endsection
@section('adminlist')
active
@endsection
@section('css')
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{__(App\Models\SiteSetting::first()->value('name')??'')}}</a>
    <span class="breadcrumb-item active">{{__('Admin')}}</span>
</nav>

<div class="sl-pagebody">

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">{{__('Edit Data')}}</h6>
                <p class="mg-b-20 mg-sm-b-30">{{__('You may edit data with all required field')}}</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.admin.index') }}">{{__('View All')}}</a>
            </div>
        </div>
        @include('partials.message')
        <form action="{{route('admin.admin.update',$admin->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Admin Name') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name')?? $admin->name }}" placeholder="{{__('Enter Name')}}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Email') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="email" value="{{ old('email')?? $admin->email }}" placeholder="{{__('Enter Email')}}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Password') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="password" name="password" value="" placeholder="{{__('Enter Updated Password')}}">
                        </div>
                    </div><!-- col-6 -->
                </div><!-- row -->

                <div class="form-layout-footer">
                    <button class="btn btn-info mg-r-5" type="submit">{{ __('Submit') }}</button>
                    <a href="{{ route('admin.admin.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
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


