@extends('admin.layouts.dashboard')
@section('title')
Requisition Edit
@endsection
@section('requisitionmenu')
active show-sub
@endsection
@section('requisitionlist')
active
@endsection
@section('requisitioncreate')

@endsection
@section('css')
    <link href="{{ asset('backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">STORE</a>
    <span class="breadcrumb-item active">Requisition</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Requisition Edit</h5>
      <p>Edit requisition with required field.</p>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">This is the requisition edit form</h6>
                <p class="mg-b-20 mg-sm-b-30">You may edit requisition with all required field.</p>
            </div>
            {{-- <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.requisition.create') }}">Create New</a>
            </div> --}}
        </div>
        @include('partials.message')
        <form action="{{route('admin.requisition.update',$requisition->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                        <label class="form-control-label">User Name: <span class="tx-danger"></span></label>
                        <input class="form-control" type="text" value="{{ App\Models\User::where('id',$requisition->user_id)->first()->name??'' }}" readonly>
                        <input type="hidden" name="user_id" value="{{ $requisition->user_id }}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                        <label class="form-control-label">Payable Amount: <span class="tx-danger"></span></label>
                        <input class="form-control" type="text" name="amount" value="{{ $requisition->payable_amount??'' }}" readonly>
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">Status: <span class="tx-danger"></span></label>
                            <select class="form-control form-select" aria-label="Default select example" name="status">
                                <option value="2"  @php if($requisition->status==2) echo 'selected'; @endphp>Viewed</option>
                                <option value="3"  @php if($requisition->status==3) echo 'selected'; @endphp>Approved</option>
                                <option value="4"  @php if($requisition->status==4) echo 'selected'; @endphp>Cancel</option>
                            </select>
                        </div>
                    </div><!-- col-6 -->
                </div><!-- row -->

                <div class="form-layout-footer">
                    <button class="btn btn-info mg-r-5" type="submit">Submit</button>
                    <a href="{{ route('admin.requisition.index') }}" class="btn btn-secondary">Cancel</a>
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


