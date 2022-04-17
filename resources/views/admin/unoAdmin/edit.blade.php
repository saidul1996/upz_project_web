@extends('admin.layouts.dashboard')
@section('title')
{{__('UNO Admin')}}
@endsection
@section('unoadminmenu')
active show-sub
@endsection
@section('unoadminlist')
active
@endsection
@section('css')
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{__(App\Models\SiteSetting::first()->value('name')??'')}}</a>
    <span class="breadcrumb-item active">{{__('UNO')}}</span>
</nav>

<div class="sl-pagebody">

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">{{__('Edit Data')}}</h6>
                <p class="mg-b-20 mg-sm-b-30">{{__('You may edit data with all required field')}}</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.unoAdmin.index') }}">{{__('View All')}}</a>
            </div>
        </div>
        @include('partials.message')
        <form action="{{route('admin.unoAdmin.update',$data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('District') }}: </label>
                            <input class="form-control" type="text" value="{{ $data->upazilla->district->name??'' }}" readonly>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Upazilla') }}: </label>
                            <input class="form-control" type="text" value="{{ $data->upazilla->name??'' }}" readonly>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Name') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="name" value="{{ $data->name ?? old('name') }}" placeholder="{{__('Enter Name')}}">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Email') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="email" value="{{ $data->email ?? old('email') }}" placeholder="{{__('Enter Email')}}">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Phone') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="phone" value="{{ $data->phone ?? old('phone') }}" placeholder="{{__('Enter Phone')}}">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('NID No.') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="nid_no" value="{{ $data->nid_no ?? old('nid_no') }}" placeholder="{{__('Enter NID No.')}}">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Date Of Birth') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="date" name="date_of_birth" value="{{ $data->date_of_birth ?? old('date_of_birth') }}" placeholder="{{__('Enter Date Of Birth')}}">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Address') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="address" value="{{ $data->address ?? old('address') }}" placeholder="{{__('Enter Address')}}">
                        </div>
                    </div><!-- col-8 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Gender') }}: <span class="tx-danger"></span></label>
                            <select class="form-control" name="gender" id="">
                                <option value="Male" @if($data->gender=='Male') selected @endif>Male</option>
                                <option value="Female" @if($data->gender=='Female') selected @endif>Female</option>
                                <option value="Other" @if($data->gender=='Other') selected @endif>Other</option>
                            </select>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Password') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="password" name="password" value="" placeholder="{{__('Enter Updated Password')}}">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Status') }}: <span class="tx-danger"></span></label>
                            <select class="form-control" name="status" id="">
                                <option value="1" @if($data->status==1) selected @endif>Active</option>
                                <option value="0" @if($data->status==0) selected @endif>Pending</option>
                                <option value="2" @if($data->status==2) selected @endif>Deactivated</option>
                            </select>
                        </div>
                    </div><!-- col-4 -->
                </div><!-- row -->

                <div class="form-layout-footer">
                    <button class="btn btn-info mg-r-5" type="submit">{{ __('Submit') }}</button>
                    <a href="{{ route('admin.unoAdmin.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
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


