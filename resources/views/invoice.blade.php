@extends('layouts.app')
@section('title', 'Invoice #' . $invoice->id)
@section('content')
    <style>
        body {
            background-color: #eee;
        }

        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: 1rem;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-15">Invoice #{{ $invoice->id }} <span
                                    class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                            <div class="mb-4">
                                <h2 class="mb-1 text-muted">SmartPhones Store</h2>
                            </div>
                            <div class="text-muted">
                                <p class="mb-1">Riyadh</p>
                                <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i>examp@hotmail.com</p>
                                <p><i class="uil uil-phone me-1"></i>9665555555</p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <h5 class="font-size-16 mb-3">Billed To:</h5>
                                    <h5 class="font-size-15 mb-2">{{ $invoice->Name }}</h5>
                                    <p class="mb-1">{{ $invoice->Address }}</p>
                                    <p class="mb-1">{{ $invoice->Email }}</p>
                                    <p>{{ $invoice->Phone }}</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="text-muted text-sm-end">
                                    <div>
                                        <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                        <p>#{{ $invoice->id }}</p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                        <p>{{ date('d,M,Y', strtotime($invoice->created_at)) }}</p>
                                    </div>

                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="py-2">
                            <h5 class="font-size-15">Order Summary</h5>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th class="text-end" style="width: 120px;">Total</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @php $total = 0; $no =1; @endphp
                                      @foreach ($invoice->product as $key => $product)
                                      <tr>
                                        <th scope="row">{{ $no }}</th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14 mb-1">
                                                    {{ $product->Name }}</h5>
                                                <p class="text-muted mb-0">{{ $product->Color }}</p>
                                            </div>
                                        </td>
                                        <td>{{ $product->Price }} SAR</td>
                                        <td>{{ $invoice->orderitems[$key]->quantity }}</td>
                                        <td class="text-end">{{ $product->Price }} SAR</td>
                                    </tr>
                                    <!-- end tr -->

                                    
                                    @php $total += $product->Price * $invoice->orderitems[$key]->quantity;  $no++; @endphp
                                  
                                      @endforeach
                                      
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                        <td class="border-0 text-end"><h4 class="m-0 fw-semibold">{{$total}} SAR</h4></td>
                                    </tr>
                                    <!-- end tr -->
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i
                                            class="fa fa-print"></i></a>
                                    <a href="#" class="btn btn-primary w-md">Send</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
    </div>


@endsection
