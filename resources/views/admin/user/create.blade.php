@extends('admin.layouts.dashboard')
@section('title')
{{__('User')}}
@endsection
@section('usermenu')
active show-sub
@endsection
@section('usercreate')
active
@endsection
@section('css')
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{__(App\Models\SiteSetting::first()->value('name')??'')}}</a>
    <span class="breadcrumb-item active">{{__('User')}}</span>
</nav>

<div class="sl-pagebody">

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">{{__('Create Data')}}</h6>
                <p class="mg-b-20 mg-sm-b-30">{{__('You may create data with all required field')}}</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.user.index') }}">{{ __('View All') }}</a>
            </div>
        </div>

        @include('partials.message')
        <form action="{{route('admin.user.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('User Name') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Enter User Name">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Email') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Enter User Email">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Phone') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter User Phone">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Password') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="password" name="password" value="{{ old('password') }}" placeholder="Enter User Password">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Designation') }}: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="designation" value="{{ old('designation') }}" placeholder="Enter Designation Name">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Depertment') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="depertment" value="{{ old('depertment') }}" placeholder="Enter Depertment Name">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label for="address">{{ __('Address') }}:</label>
                            <textarea class="form-control" id="address" rows="2" name="address">{{ old('address') }}</textarea>
                        </div>
                    </div><!-- col-6 -->
                </div><!-- row -->

                <div class="form-layout-footer my-2">
                    <button class="btn btn-info mg-r-5" type="submit">{{ __('Submit') }}</button>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
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


