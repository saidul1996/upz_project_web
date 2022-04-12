@extends('admin.layouts.dashboard')
@section('title')
{{__('Banner')}}
@endsection
@section('bannermenu')
active show-sub
@endsection
@section('bannerlist')
active
@endsection
@section('css')

@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{__(App\Models\SiteSetting::first()->value('name')??'')}}</a>
    <span class="breadcrumb-item active">{{__('Banner')}}</span>
</nav>

<div class="sl-pagebody">
    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">{{__('Show Data')}}</h6>
                <p class="mg-b-20 mg-sm-b-30">{{__('You are showing seleced item')}}</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.banner.index') }}">{{__('View All')}}</a>
            </div>
        </div>

        <div class="form-layout">
            <div class="row mg-b-25">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label">{{__('Banner Title')}}:</label>
                        <input class="form-control" type="text" value="{{ $banner->banner_title??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label d-block">{{__('Image')}}: </label>
                        <img height="100px" src="{{ $banner->image }}" alt="Image">
                    </div>
                </div><!-- col-12 -->
            </div><!-- row -->

            <div class="form-layout-footer">
                <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Back</a>
            </div><!-- form-layout-footer -->

        </div><!-- form-layout -->
    </div><!-- card -->
  </div><!-- sl-pagebody -->

@endsection

@section('js')

@endsection


