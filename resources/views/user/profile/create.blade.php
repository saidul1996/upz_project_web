@extends('admin.layouts.dashboard')
@section('title')
User Create
@endsection
@section('usermenu')
active show-sub
@endsection
@section('userlist')

@endsection
@section('usercreate')
active
@endsection
@section('css')
    <link href="{{ asset('backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">STORE</a>
    <span class="breadcrumb-item active">User</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>User Create</h5>
      <p>Create user with required field.</p>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">This is the user create form</h6>
                <p class="mg-b-20 mg-sm-b-30">You may create unique user with all required field.</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.user.index') }}">View All</a>
            </div>
        </div>

        @include('partials.message')
        <form action="{{route('admin.user.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">User Name: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Enter User Name">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">Email: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Enter User Email">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">Phone: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter User Phone">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">Password: <span class="tx-danger"></span></label>
                            <input class="form-control" type="password" name="password" value="{{ old('password') }}" placeholder="Enter User Password">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">Designation: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="designation" value="{{ old('designation') }}" placeholder="Enter Designation Name">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">Depertment: <span class="tx-danger"></span></label>
                            <input class="form-control" type="text" name="depertment" value="{{ old('depertment') }}" placeholder="Enter Depertment Name">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" rows="2" name="address">{{ old('address') }}</textarea>
                        </div>
                    </div><!-- col-6 -->
                </div><!-- row -->

                <div class="form-layout-footer my-2">
                    <button class="btn btn-info mg-r-5" type="submit">Submit</button>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Cancel</a>
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


