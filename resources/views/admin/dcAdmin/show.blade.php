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

@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{__(App\Models\SiteSetting::first()->value('name')??'')}}</a>
    <span class="breadcrumb-item active">{{__('DC Admin')}}</span>
</nav>

<div class="sl-pagebody">

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">{{ __('Data Show') }}</h6>
                <p class="mg-b-20 mg-sm-b-30">{{ __('You are showing selected item') }}</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.dcAdmin.index') }}">{{ __('View All') }}</a>
            </div>
        </div>

        <div class="form-layout">
            <div class="row mg-b-25">
                <div class="col-lg-4">
                    <div class="form-group">
                    <label class="form-control-label">{{ __('District') }}: </label>
                    <input class="form-control" type="text" value="{{ $data->district->name??'' }}" readonly>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                    <label class="form-control-label">{{ __('Name') }}: </label>
                    <input class="form-control" type="text" value="{{ $data->name??'' }}" readonly>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                    <label class="form-control-label">{{ __('Email') }}: </label>
                    <input class="form-control" type="text" value="{{ $data->email??'' }}" readonly>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                    <label class="form-control-label">{{ __('Phone') }}: </label>
                    <input class="form-control" type="text" value="{{ $data->phone??'' }}" readonly>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                    <label class="form-control-label">{{ __('NID No.') }}: </label>
                    <input class="form-control" type="text" value="{{ $data->nid_no??'' }}" readonly>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                    <label class="form-control-label">{{ __('Date Of Birth') }}: </label>
                    <input class="form-control" type="text" value="{{ $data->date_of_birth??'' }}" readonly>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-12">
                    <div class="form-group">
                    <label class="form-control-label">{{ __('Address') }}: </label>
                    <input class="form-control" type="text" value="{{ $data->address??'' }}" readonly>
                    </div>
                </div><!-- col-12 -->
                <div class="col-lg-4">
                    <div class="form-group">
                    <label class="form-control-label">{{ __('Gender') }}: </label>
                    <input class="form-control" type="text" value="{{ $data->gender??'' }}" readonly>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                    <label class="form-control-label">{{ __('Status') }}: </label>
                    <input class="form-control" type="text" value="@if($data->status==1) Active @else Pending @endif" readonly>
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->

            <div class="form-layout-footer">
                <a href="{{ route('admin.dcAdmin.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
            </div><!-- form-layout-footer -->

        </div><!-- form-layout -->

    </div><!-- card -->




  </div><!-- sl-pagebody -->

@endsection

@section('js')

@endsection


