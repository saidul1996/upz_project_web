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
                <h6 class="card-body-title">{{ __('Data Show') }}</h6>
                <p class="mg-b-20 mg-sm-b-30">{{ __('You are showing selected item') }}</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.admin.create') }}">{{ __('Create New') }}</a>
            </div>
        </div>

        <div class="form-layout">
            <div class="row mg-b-25">
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">{{ __('Admin Name') }}: </label>
                    <input class="form-control" type="text" value="{{ $admin->name??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">{{ __('Email') }}: </label>
                    <input class="form-control" type="text" value="{{ $admin->email??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
            </div><!-- row -->

            <div class="form-layout-footer">
                <a href="{{ route('admin.admin.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
            </div><!-- form-layout-footer -->

        </div><!-- form-layout -->

    </div><!-- card -->




  </div><!-- sl-pagebody -->

@endsection

@section('js')

@endsection


