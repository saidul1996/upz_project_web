@extends('admin.layouts.dashboard')
@section('title')
{{__('Banner')}}
@endsection
@section('bannermenu')
active show-sub
@endsection
@section('bannerlist')
active
@endsection
@section('productcreate')

@endsection
@section('css')
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{__('NAGORIK SHEBA')}}</a>
    <span class="breadcrumb-item active">{{__('Banner')}}</span>
</nav>

<div class="sl-pagebody">

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">{{__('Edit Data')}}</h6>
                <p class="mg-b-20 mg-sm-b-30">{{__('You may edit this item with required fields')}}</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.banner.index') }}">{{__('View All')}}</a>
            </div>
        </div>
        @include('partials.message')
        <form action="{{route('admin.banner.update',$banner->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{__('Banner Title')}}:</label>
                            <input class="form-control" type="text" name="banner_title" value="{{ $banner->banner_title?? old('banner_title') }}" placeholder="{{__('Enter Banner Title')}}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{__('Status')}}:</label>
                            <select class="form-control form-select" aria-label="Default select example" name="status">
                                <option value="1" @php if($banner->status==1) echo 'selected'; @endphp>Active</option>
                                <option value="0"  @php if($banner->status==0) echo 'selected'; @endphp>Deactive</option>
                            </select>
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-12 my-2">
                        <div class="form-group">
                            <label class="form-control-label">{{__('Image')}}: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="file" name="image" placeholder="Enter Image">
                            <img height="100px" class="mt-3" src="{{ $banner->image }}" alt="Image">
                        </div>
                    </div><!-- col-12 -->
                </div><!-- row -->

                <div class="form-layout-footer">
                    <button class="btn btn-info mg-r-5" type="submit">Submit</button>
                    <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Cancel</a>
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


