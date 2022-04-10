@extends('admin.layouts.dashboard')
@section('title')
Product Edit
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
    <link href="{{ asset('backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">STORE</a>
    <span class="breadcrumb-item active">Product</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Product Edit</h5>
      <p>Edit product with required field.</p>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">This is the product edit form</h6>
                <p class="mg-b-20 mg-sm-b-30">You may edit product with all required field.</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.product.create') }}">Create New</a>
            </div>
        </div>
        @include('partials.message')
        <form action="{{route('admin.product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">Category: <span class="tx-danger"></span></label>
                            <select class="form-control form-select search-select" aria-label="Default select example" name="category_id">
                                @foreach ($all_category as $category)
                                <option value="{{ $category->id }}" @php if($category->id==$product->category_id) echo 'selected'; @endphp>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">Brand: <span class="tx-danger"></span></label>
                            <select class="form-control form-select search-select" aria-label="Default select example" name="brand_id">
                                @foreach ($all_brand as $brand)
                                <option value="{{ $brand->id }}" @php if($brand->id==$product->brand_id) echo 'selected'; @endphp>{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                        <label class="form-control-label">Product Name: <span class="tx-danger"></span></label>
                        <input class="form-control" type="text" name="product_name" value="{{ $product->product_name?? old('product_name') }}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                        <label class="form-control-label">Price: <span class="tx-danger"></span></label>
                        <input class="form-control" type="number" name="price" value="{{ $product->price?? old('price') }}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">Unit: <span class="tx-danger"></span></label>
                            <select class="form-control form-select search-select" aria-label="Default select example" name="unit_id">
                                @foreach ($all_unit as $unit)
                                <option value="{{ $unit->id }}" @php if($unit->id==$product->unit_id) echo 'selected'; @endphp>{{ $unit->unit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                        <label class="form-control-label">Quantity: <span class="tx-danger"></span></label>
                        <input class="form-control" type="number" name="quantity" value="{{ old('quantity')??$product->quantity  }}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                        <label class="form-control-label">Alert Quantity (Minimum): <span class="tx-danger"></span></label>
                        <input class="form-control" type="number" name="alert_quantity" value="{{ old('alert_quantity')??$product->alert_quantity  }}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                        <label class="form-control-label">Vat (%): <span class="tx-danger"></span></label>
                        <input class="form-control" type="number" name="vat" value="{{ old('vat')??$product->vat  }}">
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6 my-2">
                        <div class="form-group">
                            <label class="form-control-label">Status: <span class="tx-danger"></span></label>
                            <select class="form-control form-select" aria-label="Default select example" name="status">
                                <option value="0" @php if($product->status==0) echo 'selected'; @endphp>Active</option>
                                <option value="1"  @php if($product->status==1) echo 'selected'; @endphp>Deactive</option>
                            </select>
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-12 my-2">
                        <div class="form-group">
                            <label class="form-control-label">Product Image: <span class="tx-danger"></span></label>
                            <input class="form-control" type="file" name="image" placeholder="Enter Image">
                            <img height="100px" class="mt-3" src="{{ $product->image }}" alt="Image">
                        </div>
                    </div><!-- col-12 -->
                    <div class="col-lg-12 my-2">
                        <div class="form-group">
                            <label class="form-control-label">Description: <span class="tx-danger"></span></label>
                            <textarea class="form-control" name="description" id="Desc" cols="30" rows="10">{{ $product->description }}</textarea>
                        </div>
                    </div><!-- col-12 -->
                </div><!-- row -->

                <div class="form-layout-footer">
                    <button class="btn btn-info mg-r-5" type="submit">Submit</button>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Cancel</a>
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


