@extends('layouts.frontend')
@section('title')
Stock Receive
@endsection
@section('stockmenu')
active show-sub
@endsection
@section('stocklist')
active
@endsection
@section('stockcreate')

@endsection
@section('css')

@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('dashboard') }}">STORE</a>
    <span class="breadcrumb-item active">Stock Receive</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
        <h5>Stock Show</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">This is the stock selected item show details</h6>
                <p class="mg-b-20 mg-sm-b-30">You may show selected item.</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('user.stock.index') }}">View All</a>
            </div>
        </div>

        <div class="form-layout">
            <div class="row mg-b-25 bg-light">
                <div class="col-12 py-3">
                    <h5 class="text-center border py-3">STOCK RECEIVE DETAILS</h5>
                </div>
                <div class="col-12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="col"><h6>Date</h6></th>
                                <th scope="col"><h6>:</h6></th>
                                <td scope="col"><h6>{{ Carbon\Carbon::parse($stock_details->created_at)->format('d/m/Y') }}</h6></td>
                            </tr>
                            <tr>
                                <th scope="col"><h6>Costomer Name</h6></th>
                                <th scope="col"><h6>:</h6></th>
                                <td scope="col"><h6>{{ $stock_details->user->name??'' }}</h6></td>
                            </tr>
                            <tr>
                                <th scope="col"><h6>Email Address</h6></th>
                                <th scope="col"><h6>:</h6></th>
                                <td scope="col"><h6>{{ $stock_details->user->email??'' }}</h6></td>
                            </tr>
                            <tr>
                                <th scope="col"><h6>Phone No.</h6></th>
                                <th scope="col"><h6>:</h6></th>
                                <td scope="col"><h6>{{ $stock_details->user->phone??'' }}</h6></td>
                            </tr>
                            <tr>
                                <th scope="col"><h6>Designation</h6></th>
                                <th scope="col"><h6>:</h6></th>
                                <td scope="col"><h6>{{ $stock_details->user->designation??'' }}</h6></td>
                            </tr>
                            <tr>
                                <th scope="col"><h6>Address</h6></th>
                                <th scope="col"><h6>:</h6></th>
                                <td scope="col"><h6>{{ $stock_details->user->address??'' }}</h6></td>
                            </tr>
                            <tr>
                                <th scope="col"><h6>Status</h6></th>
                                <th scope="col"><h6>:</h6></th>
                                <td scope="col"><h6> @php
                                    if($stock_details->status==2){ echo "<span class='text-success'>Received</span>"; }
                                    elseif($stock_details->status==1){ echo "<span class='text-danger'>Pending</span>"; }
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
                    <h5 class="text-center border py-3">STOCKOUT PRODUCT DETAILS</h5>
                </div>
                <div class="col-12">
                    <div class="table-wrapper">
                        <table id="example" class="table display responsive nowrap">
                            <thead>
                              <tr>
                                <th class="wd-10p">SI</th>
                                <th class="wd-30p">Product Name</th>
                                <th class="wd-20p text-center">Quantity</th>
                                <th class="wd-20p text-center">Proccess By</th>
                              </tr>
                            </thead>
                            <tbody>
                              @php
                                  $i=1;
                              @endphp
                              @foreach ($stock_details->stockoutProduct as $stockProduct)
                              <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ App\Models\Product::where('id',$stockProduct->product_id)->first()->product_name??'' }}</td>
                                <td class="text-center">{{ $stockProduct->quantity??'' }}</td>
                                <td class="text-center">@if($stockProduct->status==2) Customer @else Admin @endif</td>
                              </tr>

                              @endforeach
                            </tbody>
                        </table>

                      </div>
                </div>
            </div>

            <div class="form-layout-footer">
                <a href="{{ route('user.stockout.invoice', $stock_details->id) }}" class="btn btn-primary mr-3">Make Invoice</a>
                <a href="{{ route('user.stock.index') }}" class="btn btn-secondary">Back</a>
            </div><!-- form-layout-footer -->

        </div><!-- form-layout -->

    </div><!-- card -->




  </div><!-- sl-pagebody -->

@endsection

@section('js')

@endsection


