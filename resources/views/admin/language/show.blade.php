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

@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{__(App\Models\SiteSetting::first()->value('name')??'')}}</a>
    <span class="breadcrumb-item active">{{__('Language')}}</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
        <!-- <h5>{{ __('Data Show') }}</h5> -->
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">{{ __('Data Show') }}</h6>
                <p class="mg-b-20 mg-sm-b-30">{{ __('You are showing selected item') }}</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.language.create') }}">{{ __('Create New') }}</a>
            </div>
        </div>

        <div class="form-layout">
            <div class="row mg-b-25">
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">{{ __('Language Key:') }} </label>
                    <input class="form-control" type="text" name="key" value="{{ $language->key??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label d-block">{{ __('Language Name:') }} </label>
                    <input class="form-control" type="text" name="name" value="{{ $language->name??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
            </div><!-- row -->

            <div class="form-layout-footer">
                <a href="{{ route('admin.language.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
            </div><!-- form-layout-footer -->

        </div><!-- form-layout -->

    </div><!-- card -->
</div><!-- sl-pagebody -->

@endsection

@section('js')

@endsection


