@extends('admin.layouts.dashboard')
@section('title')
Product Show
@endsection
@section('productmenu')
active show-sub
@endsection
@section('productlist')
active
@endsection
@section('productcreate')

@endsection
@section('css')

@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">STORE</a>
    <span class="breadcrumb-item active">Product</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
        <h5>Product Show</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">This is the product selected item show details</h6>
                <p class="mg-b-20 mg-sm-b-30">You may show selected item.</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.product.create') }}">Create New</a>
            </div>
        </div>

        <div class="form-layout">
            <div class="row mg-b-25">
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">Category Name: <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" value="{{ App\Models\Category::where('id',$product->category_id)->first()->category_name??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">Brand Name: <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" value="{{ App\Models\Brand::where('id',$product->brand_id)->first()->brand_name??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">Product Name: <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" value="{{ $product->product_name??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">price: <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" value="&#2547; {{ $product->price??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">Unit: <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" value="{{ App\Models\Unit::where('id',$product->unit_id)->first()->unit_name??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">Available Quantity In Store: <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" value="{{ $product->quantity??'0' }} {{ App\Models\Unit::where('id',$product->unit_id)->first()->unit_name??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">Alert Quantity (Minimum): <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" value="{{ $product->alert_quantity??'0' }} {{ App\Models\Unit::where('id',$product->unit_id)->first()->unit_name??'' }}" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="form-control-label">Vat: <span class="tx-danger"></span></label>
                    <input class="form-control" type="text" value="{{ $product->vat??'' }}%" readonly>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-12">
                    <div class="form-group">
                    <label class="form-control-label d-block">Product Image: <span class="tx-danger"></span></label>
                    <img height="100px" src="{{ $product->image }}" alt="Image">
                    </div>
                </div><!-- col-12 -->
                <div class="col-lg-12">
                    <div class="form-group">
                    <label class="form-control-label d-block">Product Descriptoin: <span class="tx-danger"></span></label>
                    <textarea class="form-control" name="desc" id="desc" cols="30" rows="10" readonly>{{ $product->description??'N/A' }}</textarea>
                    </div>
                </div><!-- col-12 -->
            </div><!-- row -->

            <div class="form-layout-footer">
                <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Back</a>
            </div><!-- form-layout-footer -->

        </div><!-- form-layout -->

    </div><!-- card -->




  </div><!-- sl-pagebody -->

@endsection

@section('js')

@endsection


