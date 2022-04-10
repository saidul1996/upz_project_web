@extends('admin.layouts.dashboard')
@section('title')
{{__('User')}}
@endsection
@section('usermenu')
active show-sub
@endsection
@section('userlist')
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
                <h6 class="card-body-title">{{__('Edit Data')}}</h6>
                <p class="mg-b-20 mg-sm-b-30">{{__('You may edit data with all required field')}}</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.user.index') }}">{{ __('View All') }}</a>
            </div>
        </div>
        @include('partials.message')
        <form action="{{route('admin.user.update',$user->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('User Name') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name')?? $user->name }}" placeholder="{{ __('Enter User Name') }}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Email') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="email" value="{{ old('email')?? $user->email }}" placeholder="{{ __('Enter Email') }}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Phone') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="phone" value="{{ old('phone')?? $user->phone }}" placeholder="{{ __('Enter Phone') }}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Password') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="password" name="password" value="" placeholder="Enter Updated Password">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Designation') }}: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="designation" value="{{ old('designation')?? $user->designation }}" placeholder="{{ __('Enter Designation') }}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Depertment') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="depertment" value="{{ old('depertment')?? $user->depertment }}" placeholder="{{ __('Enter Depertment') }}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Address') }}: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="address" value="{{ old('address')?? $user->address }}" placeholder="{{ __('Enter Address') }}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Status') }}: <span class="tx-danger"></span></label>
                            <select class="form-control form-select" aria-label="Default select example" name="status">
                                <option value="0" @php if($user->status==0) echo 'selected'; @endphp>{{ __('Active') }}</option>
                                <option value="1"  @php if($user->status==1) echo 'selected'; @endphp>{{ __('Deactive') }}</option>
                            </select>
                        </div>
                    </div><!-- col-6 -->
                </div><!-- row -->

                <div class="form-layout-footer">
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


