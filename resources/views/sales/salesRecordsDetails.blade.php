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
                                    <h5 class="mb-0">Sales Records</h5>
                                   {{-- <a href="{{ route('saleForm') }}" class="btn btn-primary">Add Sale </a> --}}
                                      </div>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4">Sales List</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sale ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Area</th>
                                <th scope="col">Customer Phone</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Date</th>
                                <th>Edit</th>
                                {{-- <th scope="col">Received Amount</th>
                                <th scope="col"> Payment</th> --}}
                                <th scope="col">Bill</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($sales))
                            @foreach ($sales as $sale)
                            <tr>
                                <td> {{$sale->id}} </td>
                                <td> {{$sale->customer->name}} </td>
                                <td> {{$sale->customer->area}} </td>

                                <td> {{$sale->customer->phone}} </td>
                                <td> {{$sale->total_quantity}} </td>
                                <td> {{$sale->total_price}} </td>
                                <td>{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }} </td>
                                {{-- @if(is_null($sale->recieved_payment))
                                <td>0</td>
                                @else
                                <td> {{$sale->recieved_payment}} </td>
                                @endif
                                <td > <a href="{{route('addYesterdayPaymentForm',['id'=>$sale->id,'gd'=>$sale->total_price])}}"  class="btn btn-success bg-success">Payment</a> </td> --}}
                               {{-- <td> <a href="{{route('oldSaleEdit',['id'=>$sale->id,'date'=>$date])}}" class="btn-primary"> Edit </a> </td> --}}
                                <td > <a href="{{route('recordDetails',['customerId'=>$sale->customer_id,'date'=>$date])}}"  class="btn btn-primary bg-primary">Bill</a> </td>


                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>

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

