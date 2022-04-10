@extends('layouts.frontend')
@section('title')
User Profile
@endsection
@section('usermenu')
active show-sub
@endsection
@section('userlist')
active
@endsection
@section('usercreate')

@endsection
@section('css')

@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('dashboard') }}">STORE</a>
    <span class="breadcrumb-item active">User</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
        <h5>User Profile</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">This is the user selected item show details</h6>
                <p class="mg-b-20 mg-sm-b-30">You may show selected item.</p>
            </div>
        </div>

        <div class="form-layout">
            <div class="row mg-b-25">
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">User Name: <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" value="{{ $user->name??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">Email: <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" value="{{ $user->email??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">Phone: <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" value="{{ $user->phone??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">Designation: <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" value="{{ $user->designation??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">Depertment: <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" value="{{ $user->depertment??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">Address: <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" value="{{ $user->address??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
            </div><!-- row -->

        </div><!-- form-layout -->

    </div><!-- card -->




  </div><!-- sl-pagebody -->

@endsection

@section('js')

@endsection


