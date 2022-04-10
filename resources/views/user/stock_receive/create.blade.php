@extends('admin.layouts.dashboard')
@section('title')
Stock Out
@endsection
@section('stockoutmenu')
active show-sub
@endsection
@section('stockoutcreate')
active
@endsection
@section('css')
    <link href="{{ asset('backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('dashboard') }}">STORE</a>
    <span class="breadcrumb-item active">Stockout</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Stockout Now</h5>
      <p>Create stockout with required field.</p>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">This is the stockout create form</h6>
                <p class="mg-b-20 mg-sm-b-30">You may create stockout with all required field.</p>
            </div>
            {{-- <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('user.requisitoin.index') }}">View All</a>
            </div> --}}
        </div>

        @include('partials.message')
        <form action="{{route('admin.stockout.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6 my-1">
                        <div class="form-group">
                            <label class="form-control-label">User: <span class="tx-danger">*</span></label>
                            <select class="form-control form-select search-select" aria-label="Default select example" name="user_id" required>
                                <option value="">--Select User--</option>
                                @foreach ($all_user as $user)
                                <option value="{{ $user->id }}" @php if($user->id==old('user_id')) echo 'selected'; @endphp>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mg-b-25">
                    <div class="col-lg-4 my-1">
                        <div class="form-group">
                            <label class="form-control-label">Product: <span class="tx-danger">*</span></label>
                            <select class="form-control form-select search-select" aria-label="Default select example" name="proid" id="productInput">
                                <option value="">--Select Product--</option>
                                @foreach ($all_product as $product)
                                <option value="{{ $product->id }}" data-unit="{{ $product->unit_id }}" data-name="{{ $product->product_name }}" @php if($product->id==old('product_id')) echo 'selected'; @endphp>{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 my-1">
                        <div class="form-group">
                            <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                            <input class="form-control" id="quantityInput" type="number" name="qty" value="{{ old('qty') }}" placeholder="Enter Product Quantity" min="1">
                        </div>
                    </div>
                    <div class="col-lg-4 my-2">
                        <div class="form-group text-right ">
                            <button id="addRowBtn" class="btn btn-primary mt-4 w-100">Add Products</button>
                        </div>
                    </div>
                </div><!-- row -->
                <div class="row mt-4 b-2" id="headRow">
                    <div class="col-6"><h6>Product Name:</h6></div>
                    <div class="col-6"><h6>Quantity:</h6></div>
                </div>
                <div class="row" id="insertRow"></div>

                <div class="row mg-b-25 row mg-t-25">
                    <div class="col-lg-12 my-1">
                        <div class="form-group">
                            <label class="form-control-label">Short Description <span class="tx-danger">*</span></label>
                            <textarea class="form-control" name="description" id="" cols="20" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-layout-footer my-2">
                    <button class="btn btn-info mg-r-5 submitBtn" type="submit">Submit</button>
                    <a href="{{ route('admin.stockout.index') }}" class="btn btn-secondary">Cancel</a>
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

    $('.submitBtn').click(function(){
        if($('#insertRow').html()){

        }
        else{
            event.preventDefault();
        }
    });

    $('#addRowBtn').click(function(){
        event.preventDefault();
        var productName = $('#productInput').find(":selected").attr("data-name");
        var productId = $('#productInput').find(":selected").val();
        var productQuantity = $('#quantityInput').val();

        if(productId && productQuantity){
            $('#insertRow').append(`<div class="col-12 border my-1">
                    <div class="row">
                        <div class="col-lg-6 my-1">
                            <div class="">
                                <input class="form-control productid" id="productid" type="hidden" name="product_id[]" value="`+productId+`" placeholder="Enter Unit Price" required>
                                <input class="form-control productid" style="border:0px" id="productid" type="text" name="" value="`+productName+`" placeholder="Enter Unit Price" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 my-1">
                            <div class="">
                                <input class="form-control quantity" style="border:0px" id="quantity" type="number" name="quantity[]" value="`+productQuantity+`" placeholder="Enter Product Quantity" min="1" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                `);
        }

        $('#quantityInput').val("");

    });

</script>

@endsection


