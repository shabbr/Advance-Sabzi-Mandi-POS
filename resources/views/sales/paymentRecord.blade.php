@include('layouts.header')

<!-- Sidebar Start -->
@include('layouts.sidebar')
<!-- Sidebar End -->



        <!-- Content Start -->
        <div class="content">
 <!-- Navbar Start -->
 @include('layouts.navbar')
 <!-- Navbar End -->



            <!-- Form Start -->
            <div class="px-4 pt-4 container-fluid">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="p-4 rounded bg-light h-100 ">

                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                    {{-- <h5 class="mb-0">Payment Records</h5> --}}
                                   {{-- <a href="{{ route('saleForm') }}" class="btn btn-primary">Add Sale </a> --}}


<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4">Sales List</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Area</th>
                                <th scope="col">Customer Phone</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Total Price</th>
                                {{-- <th scope="col">Received Amount</th> --}}
                                <th scope="col">Date</th>

                                 {{-- <th scope="col">Received Amount</th> --}}
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($sales))
                            @php
                                $overall=0;
                            @endphp
                            @foreach ($sales as $sale)

                            <tr>
                                <td> {{$sale->customer->name}} </td>
                                <td> {{$sale->customer->area}} </td>

                                <td> {{$sale->customer->phone}} </td>
                                <td> {{$sale->total_quantity}} </td>
                                <td> {{$sale->total_price}} </td>
                                {{-- @if(is_null($sale->recieved_payment))
                                <td>0</td>
                                @else
                                <td> {{$sale->recieved_payment}} </td>
                                @endif --}}
                                @php
                                    $overall=$overall + $sale->total_price;
                                @endphp
                                <td>{{ \Carbon\Carbon::parse($sale->created_date)->format('d-m-Y') }}</td>


                                 {{--<td > <a href="{{route('addYesterdayPaymentForm',['id'=>$sale->id,'gd'=>$sale->total_price])}}"  class="btn btn-success bg-success">Payment</a> </td> --}}
                                <td > <a href="{{route('paymentRecordDetails',['customerId'=>$sale->customer->id,'date'=>$sale->created_date])}}"  class="btn btn-primary bg-primary">Details</a> </td>


                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                    @php

                    if (isset($sales)){
                    foreach ($sales as $sale){
                    //  $cust = DB::table('previous_customer_amounts')
                    // ->select('amount') // Specify the columns you want to select
                    // ->where('customer_id', $sale->customer_id) // Add a condition to select a specific row by customer_id
                    // ->first();
                    $cust = DB::table('customers')
                    ->select('amount') // Specify the columns you want to select
                    ->where('id', $sale->customer_id) // Add a condition to select a specific row by customer_id
                    ->first();
                    // dd($sale->customer_id);
                      }
                    }
                    // dd($cust);
                    if(!is_null($cust)){
                    $gd=$cust->amount + $overall;
                     echo '<h4>Previous Amount:'.$cust->amount .'</h4>';
                       }
                          @endphp

                    <h4 > <span style="border-bottom: 2px solid black; ">
                        Total Amount : {{$overall}}
                    </span> </h4>
                    @if(isset($gd))
                    <h4 style="color:rgb(43, 181, 43)"> Grand Total : {{$gd}} </h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



                        </div>
                    </div>




                </div>
            </div>
            <!-- Form End -->


            <!-- Footer Start -->
            @include('layouts.footer')


