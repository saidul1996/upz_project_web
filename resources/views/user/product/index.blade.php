@extends('layouts.frontend')
@section('title')
Product
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
    <a class="breadcrumb-item" href="{{ route('dashboard') }}">STORE</a>
    <span class="breadcrumb-item active">Product</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Product Table</h5>
      <p>Show all data from product table.</p>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <div class="row">
        <div class="col-7">
            <h6 class="card-body-title">This is the product table</h6>
            <p class="mg-b-20 mg-sm-b-30">You may search any entries from product list and see details.</p>
        </div>
      </div>
      @include('partials.message')
      <div class="table-wrapper">
        <table id="example" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-5p">SI</th>
                <th class="wd-10p">Category</th>
                <th class="wd-10p">Brand</th>
                <th class="wd-15p">Product Name</th>
                <th class="wd-8p">price</th>
                <th class="wd-10p">Image</th>
                <th class="wd-7p">Quantity</th>
                <th class="wd-10p">Status</th>
                <th class="wd-10p">Process By</th>
                <th class="wd-15p text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $i=1;
              @endphp
              @foreach ($all_data as $data)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ App\Models\Category::where('id',$data->category_id)->first()->category_name??'' }}</td>
                <td>{{ App\Models\Brand::where('id',$data->brand_id)->first()->brand_name??'' }}</td>
                <td>{{ $data->product_name??'' }}</td>
                <td>&#2547; {{ $data->price??'' }}</td>
                <td class="text-center"><img height="40px" width="40px" src="{{ $data->image }}" alt="Image"></td>
                <td class="text-center">{{ $data->quantity??'' }}</td>
                <td class="text-center">@php if($data->status==0){ echo "<span class='text-success'>Active</span>"; }else{ echo "<span class='text-warning'>Deactivated</span>"; } @endphp</td>
                <td class="text-center">{{ App\Models\Admin::where('id',$data->added_by)->first()->name??'' }}</td>
                <td class="text-center">
                    <a title="Show Item" class="mr-2" href="{{route('product.show',$data->id)}}"><i class="text-info menu-item-icon icon icon ion-ios-eye tx-24"></i></a>
                </td>
              </tr>

                <!-- Delete -->
                <div class="modal fade" id="deleteModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header state modal-primary">

                            </div>
                            <div class="modal-body m-auto">
                                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete ?</h5>
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('admin.product.destroy',$data->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-info mg-r-5" type="submit">Submit</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

              @endforeach
            </tbody>
        </table>

      </div>
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


