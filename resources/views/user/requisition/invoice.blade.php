@extends('layouts.frontend')
@section('title')
Requisition Invoice
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
<style>
    @media print {
        .printable {
            position: absolute;
            top: -60px;
            height: 100%;
            width: 100%;
        }
        .table th, .table td {
            padding: 5px 10px !important;
        }
    }
</style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb d-print-none">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">STORE</a>
    <span class="breadcrumb-item active">Invoice</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title d-print-none">
        <h5>Requisition Invoice</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40 printable">
        <div class="row d-print-none">
            <div class="col-7">
                <h6 class="card-body-title">This is the requisition invoice selected item show details</h6>
                <p class="mg-b-20 mg-sm-b-30">You may show selected item.</p>
            </div>
        </div>

        <div class="table-wrapper mt-3" id="DivIdToPrint">

            <div class="row">
                <div class="col-8">
                    <h1 style="font-size: 60px;" class="m-0 p-0">REQUISION</h1>
                </div>
                <div class="col-4">
                    <h6 class="text-right mt-2"><strong>Ref: </strong> {{ $requisition_details->ref_code??'' }}</h6>
                    <h6 class="text-right"><strong>Date: </strong> {{ \Carbon\Carbon::parse($requisition_details->created_at??'')->format('j F, Y') }}</h6>

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <h5 class="mb-3"><u>Requisition By:</u> </h5>
                    <p class="mb-1"><strong>Name:</strong> {{ $requisition_details->user->name??'' }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $requisition_details->user->email??'' }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $requisition_details->user->phone??'' }}</p>
                    <p class="mb-1"><strong>Address:</strong> {{ $requisition_details->user->address??'' }}</p>
                    <p class="mb-1"><strong>Designation:</strong> {{ $requisition_details->user->designation??'' }}</p>
                    <p class="mb-1"><strong>Requisition Status:</strong> @if($requisition_details->status==1) Pending @elseif($requisition_details->status==2) Viewed @elseif($requisition_details->status==3) Approved @else Cancel @endif</p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h5 class="mb-2 text-center">Product Details</h5>
                </div>
                <div class="col-12 mt-2">
                    <div class="table-wrapper">
                        <table id="example" class="table display responsive nowrap table-striped">
                            <thead>
                              <tr class="">
                                <th class="wd-10p border">SI</th>
                                <th class="wd-50p border">Product Name</th>
                                <th class="wd-40p border">Quantity</th>
                              </tr>
                            </thead>
                            <tbody>
                              @php
                                  $i=1;
                                  $total_price = 0;
                              @endphp
                              @foreach ($requisition_details->requisitionProduct as $requisitionProduct)
                              @php $total_price = $total_price + $requisitionProduct->total_price; @endphp
                              <tr class="">
                                <td class="border">{{ $i++ }}</td>
                                <td class="border">{{ App\Models\Product::where('id',$requisitionProduct->product_id)->first()->product_name??'' }}</td>
                                <td class="border">{{ $requisitionProduct->quantity??'' }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        <div class="mt-5 d-print-none">
            <button style="padding: 5px 20px; cursor: pointer; font-size:18px;" onclick="window.print()">Print Invoice</button>
            {{-- <input style="padding: 5px 20px; cursor: pointer; font-size:18px;" type='button' id='btn' value='Print' onclick='printDiv();'> --}}
        </div>


    </div><!-- card -->




  </div><!-- sl-pagebody -->

@endsection

@section('js')
<script>
    // function printDiv() {
    //     var divToPrint = document.getElementById('DivIdToPrint');
    //     var newWin=window.open('','Print-Window');
    //     newWin.document.open();
    //     newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
    //     newWin.document.close();
    //     // setTimeout(function(){newWin.close();},10);
    // }
</script>
@endsection




