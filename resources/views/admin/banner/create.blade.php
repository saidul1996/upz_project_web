@extends('admin.layouts.dashboard')
@section('title')
{{__('Banner')}}
@endsection
@section('bannermenu')
active show-sub
@endsection
@section('bannercreate')
active
@endsection
@section('css')
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{__(App\Models\SiteSetting::first()->value('name')??'')}}</a>
    <span class="breadcrumb-item active">{{__('Banner')}}</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <!-- <h5>Product Create</h5>
      <p>Create product with required field.</p> -->
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">{{__('Create Data')}}</h6>
                <p class="mg-b-20 mg-sm-b-30">{{__('You may create date with required fields')}}.</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.banner.index') }}">View All</a>
            </div>
        </div>

        @include('partials.message')
        <form action="{{route('admin.banner.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-12 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{__('Banner Title')}}:</label>
                            <input class="form-control" type="text" name="banner_title" value="{{ old('banner_title') }}" placeholder="{{__('Enter Banner Title')}}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-12 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{__('Banner Image:')}} <span class="tx-danger">*</span></label>
                            <input class="form-control" type="file" name="image" placeholder="{{__('Enter Image')}}">
                        </div>
                    </div><!-- col-12 -->
                </div><!-- row -->

                <div class="form-layout-footer my-2">
                    <button class="btn btn-info mg-r-5" type="submit">{{__('Submit')}}</button>
                    <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">{{__('Cancel')}}</a>
                </div><!-- form-layout-footer -->

            </div><!-- form-layout -->
        </form>
    </div><!-- card -->
  </div><!-- sl-pagebody -->

@endsection

@section('js')

@endsection


