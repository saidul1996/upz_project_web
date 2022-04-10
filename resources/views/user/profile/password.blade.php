@extends('layouts.frontend')
@section('title')
Password Change
@endsection
@section('usermenu')
active show-sub
@endsection
@section('userpass')
active
@endsection
@section('usercreate')

@endsection
@section('css')
    <link href="{{ asset('backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('dashboard') }}">STORE</a>
    <span class="breadcrumb-item active">User</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Change Password</h5>
      <p>Change Password with required field.</p>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">This is the password change form</h6>
                <p class="mg-b-20 mg-sm-b-30">You may edit password change with all required field.</p>
            </div>
        </div>
        @include('partials.message')
        <form action="{{route('user.password.update',Auth()->id())}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">Old Password: <span class="tx-danger"></span></label>
                            <input class="form-control" type="password" name="old_password">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">New Password: <span class="tx-danger"></span></label>
                            <input class="form-control" type="password" name="new_password">
                        </div>
                    </div><!-- col-6 -->
                </div><!-- row -->

                <div class="form-layout-footer">
                    <button class="btn btn-info mg-r-5" type="submit">Submit</button>
                    <a href="{{ route('user.profile') }}" class="btn btn-secondary">Cancel</a>
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


