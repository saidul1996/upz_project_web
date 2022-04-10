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
      <!-- <h5>Language Edit</h5>
      <p>Edit language with required field.</p> -->
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">{{__('Edit Form')}}</h6>
                <p class="mg-b-20 mg-sm-b-30">{{__('Update this data with required fields')}}</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.language.create') }}">{{__('Create New')}}</a>
            </div>
        </div>
        @include('partials.message')
        <form action="{{route('admin.language.update',$language->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                        <label class="form-control-label">{{__('Language Key')}}: <span class="tx-danger"></span></label>
                        <input class="form-control" type="text" name="key" value="{{ $language->key?? old('key') }}" placeholder="{{__('Enter Language Key')}}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                        <label class="form-control-label">Language Name')}}: <span class="tx-danger"></span></label>
                        <input class="form-control" type="text" name="name" value="{{ $language->name?? old('name') }}" placeholder="{{__('Enter Language Name')}}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{__('Status')}}: <span class="tx-danger"></span></label>
                            <select class="form-control form-select" aria-label="Default select example" name="status">
                                <option value="1" @php if($language->status==1) echo 'selected'; @endphp>Active</option>
                                <option value="0"  @php if($language->status==0) echo 'selected'; @endphp>Deactive</option>
                            </select>
                        </div>
                    </div><!-- col-6 -->
                </div><!-- row -->

                <div class="form-layout-footer">
                    <button class="btn btn-info mg-r-5" type="submit">{{__('Submit')}}</button>
                    <a href="{{ route('admin.language.index') }}" class="btn btn-secondary">{{__('Cancel')}}</a>
                </div><!-- form-layout-footer -->

            </div><!-- form-layout -->

        </form>

    </div><!-- card -->




  </div><!-- sl-pagebody -->

@endsection

@section('js')

@endsection


