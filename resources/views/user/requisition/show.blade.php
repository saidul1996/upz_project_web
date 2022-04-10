@extends('layouts.frontend')
@section('title')
Requisition Show
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

@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('dashboard') }}">STORE</a>
    <span class="breadcrumb-item active">Requisition</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
        <h5>Requisition Show</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">This is the requisition selected item show details</h6>
                <p class="mg-b-20 mg-sm-b-30">You may show selected item.</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('user.requisition.index') }}">View All</a>
            </div>
        </div>

        <div class="form-layout">
            <div class="row mg-b-25 bg-light">
                <div class="col-12 py-3">
                    <h5 class="text-center border py-3">REQUISITION DETAILS</h5>
                </div>
                <div class="col-12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="col"><h6>Requisition Date</h6></th>
                                <th scope="col"><h6>:</h6></th>
                                <td scope="col"><h6>{{ $requisition_details->created_at??'' }}</h6></td>
                            </tr>
                            <tr>
                                <th scope="col"><h6>Costomer Name</h6></th>
                                <th scope="col"><h6>:</h6></th>
                                <td scope="col"><h6>{{ $requisition_details->user->name??'' }}</h6></td>
                            </tr>
                            <tr>
                                <th scope="col"><h6>Email Address</h6></th>
                                <th scope="col"><h6>:</h6></th>
                                <td scope="col"><h6>{{ $requisition_details->user->email??'' }}</h6></td>
                            </tr>
                            <tr>
                                <th scope="col"><h6>Phone No.</h6></th>
                                <th scope="col"><h6>:</h6></th>
                                <td scope="col"><h6>{{ $requisition_details->user->phone??'' }}</h6></td>
                            </tr>
                            <tr>
                                <th scope="col"><h6>Designation</h6></th>
                                <th scope="col"><h6>:</h6></th>
                                <td scope="col"><h6>{{ $requisition_details->user->designation??'' }}</h6></td>
                            </tr>
                            <tr>
                                <th scope="col"><h6>Address</h6></th>
                                <th scope="col"><h6>:</h6></th>
                                <td scope="col"><h6>{{ $requisition_details->user->address??'' }}</h6></td>
                            </tr>
                            <tr>
                                <th scope="col"><h6>Status</h6></th>
                                <th scope="col"><h6>:</h6></th>
                                <td scope="col"><h6> @php
                                    if($requisition_details->status==3){ echo "<span class='text-success'>Approved</span>"; }
                                    elseif($requisition_details->status==2){ echo "<span class='text-warning'>Viewed</span>"; }
                                    elseif($requisition_details->status==1){ echo "<span class='text-danger'>Pending</span>"; }
                                    else{ echo "<span class='text-dark'>Canceled</span>"; } @endphp</h6>
                                </td>
                            </tr>
                        </tbody>
                      </table>
                </div><!-- col-6 -->
            </div><!-- row -->
            @include('partials.message')
            <div class="row mt-5 mg-b-25 bg-light">
                <div class="col-12 py-3">
                    <h5 class="text-center border py-3">REQUISITION PRODUCT DETAILS</h5>
                </div>
                <div class="col-12">
                    <div class="table-wrapper">
                        <table id="example" class="table display responsive nowrap">
                            <thead>
                              <tr>
                                <th class="wd-10p">SI</th>
                                <th class="wd-20p">Product Name</th>
                                <th class="wd-10p">Image</th>
                                <th class="wd-20p">Quantity</th>
                                <th class="wd-20p">Status</th>
                                <th class="wd-20p">Proccess By</th>
                              </tr>
                            </thead>
                            <tbody>
                              @php
                                  $i=1;
                              @endphp
                              @foreach ($requisition_details->requisitionProduct as $requisitionProduct)
                              <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ App\Models\Product::where('id',$requisitionProduct->product_id)->first()->product_name??'' }}</td>
                                <td><img height="50px" width="50px" src="{{ App\Models\Product::where('id',$requisitionProduct->product_id)->first()->image??'' }}" alt=""></td>
                                <td>{{ $requisitionProduct->quantity??'' }}</td>
                                <td> @php
                                    if($requisition_details->status==3){ echo "<span class='text-success'>Approved</span>"; }
                                    elseif($requisition_details->status==2){ echo "<span class='text-warning'>Viewed</span>"; }
                                    elseif($requisition_details->status==1){ echo "<span class='text-danger'>Pending</span>"; }
                                    else{ echo "<span class='text-dark'>Canceled</span>"; } @endphp
                                </td>
                                <td>@php if($requisition_details->status==1) echo 'Customer'; else echo 'Admin';@endphp</td>
                              </tr>

                              <!-- Delete -->
                              <div class="modal fade" id="deleteModal{{$requisitionProduct->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header state modal-primary">

                                          </div>
                                          <div class="modal-body m-auto">
                                              <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete ?</h5>
                                          </div>
                                          <div class="modal-footer">
                                              <form action="{{route('admin.requisitionProduct.destroy',$requisitionProduct->id)}}" method="POST">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button class="btn btn-info mg-r-5" type="submit">Submit</button>
                                              </form>
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <!-- Update -->
                              <div class="modal fade" id="updateModal{{$requisitionProduct->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header state modal-primary">

                                          </div>
                                          <div class="modal-body m-auto">
                                              <h5 class="modal-title" id="exampleModalLongTitle">Update Product</h5>
                                          </div>
                                          <div class="modal-footer">
                                              <form action="{{route('admin.requisitionProduct.edit',$requisitionProduct->id)}}" method="POST">
                                                  @csrf
                                                  @method('PUT')




                                                  <div class="form-layout">
                                                    <div class="row mg-b-25">
                                                        <div class="col-lg-6 my-2">
                                                            <div class="form-group">
                                                            <label class="form-control-label">Quantity: <span class="tx-danger"></span></label>
                                                            <input class="form-control" type="text" value="{{ $requisitionProduct->quantity }}">
                                                            </div>
                                                        </div><!-- col-6 -->
                                                        <div class="col-lg-6 my-2">
                                                            <div class="form-group">
                                                            <label class="form-control-label">Status: <span class="tx-danger"></span></label>
                                                            <input class="form-control" type="text" name="amount" value="" readonly>
                                                            </div>
                                                        </div><!-- col-6 -->

                                                    </div><!-- row -->

                                                </div><!-- form-layout -->

                                                  {{-- <button class="btn btn-info mg-r-5" type="submit">Submit</button> --}}
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
                </div>
            </div>

            <div class="form-layout-footer">
                <a href="{{ route('user.requisition.invoice',$requisition_details->id) }}" class="btn btn-primary mr-3">Make Invoice</a>
                <a href="{{ route('user.requisition.index') }}" class="btn btn-secondary">Back</a>
            </div><!-- form-layout-footer -->

        </div><!-- form-layout -->

    </div><!-- card -->




  </div><!-- sl-pagebody -->

@endsection

@section('js')

@endsection


