@extends('admin.layouts.dashboard')
@section('title')
{{__('Language')}}
@endsection
@section('languagemenu')
active show-sub
@endsection
@section('languageselect')
active
@endsection
@section('css')
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{__(App\Models\SiteSetting::first()->value('name')??'')}}</a>
    <span class="breadcrumb-item active">{{__('Language')}}</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <!-- <h5>Language Select</h5>
      <p>Choose language with required field.</p> -->
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">{{ __('Language Select') }}</h6>
                <p class="mg-b-20 mg-sm-b-30">{{ __('You may change language with all required field') }}</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.language.create') }}">{{ __('Create New') }}</a>
            </div>
        </div>
        @include('partials.message')
        <form action="{{route('admin.language.select')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Select Language: <span class="tx-danger">*</span></label>
                            <select class="form-control form-select search-select" aria-label="Default select example" name="locale">
                                <option value="en">{{ __('English') }}</option>
                                @foreach($languages as $language)
                                <option value="{{ $language->key }}" @if($language->key==app()->getLocale()) selected @endif >{{ __($language->name??'') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- col-6 -->
                </div><!-- row -->

                <div class="form-layout-footer">
                    <button class="btn btn-info mg-r-5" type="submit">{{ __('Submit') }}</button>
                    <a href="{{ route('admin.language.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
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


