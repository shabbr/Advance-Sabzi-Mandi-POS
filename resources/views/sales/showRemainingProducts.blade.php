@include('layouts.header')

<!-- Sidebar Start -->
@include('layouts.sidebar')
<!-- Sidebar End -->



        <!-- Content Start -->
        <div class="content">




            <!-- Form Start -->
            <div class="px-4 pt-4 container-fluid">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="p-4 rounded bg-light h-100 ">
                                <div class="mb-4 d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Remaining Products</h5>
                                   {{-- <a href="{{ route('saleForm') }}" class="btn btn-primary">Add Sale </a> --}}
                                      </div>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4">Remaining Product List</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th scope="col">Total Quantity</th>
                                <th scope="col">Total Saled Quantity</th>
                                <th scope="col">Remaining Quantity</th>
                                {{-- <th scope="col">Total Price</th> --}}
                                {{-- <th scope="col">Date</th> --}}
                                {{-- <th scope="col"> Payment</th> --}}
                                {{-- <th scope="col">Details</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($eachProductQuantity))
                            @foreach ($eachProductQuantity as $product)
                            <tr>
                                <td> {{$product->product_id}} </td>
                                <td> {{$product->product->name}} </td>
                                <td> {{$product->total_quantity}} </td>
                            @if (isset($eachProductQuantity))

                           @php
                            // $total={{$product->total_quantity}}
                                $remaining=0;
                            @endphp
                            @foreach ($eachProductSaleQuantity as $sale)
                              @if ($sale->product_id==$product->product_id)
                                <td>{{$sale->total_quantity}}</td>
                                @php
                                    $remaining =$product->total_quantity-$sale->total_quantity;
                                @endphp
                                <td> {{$remaining}} </td>


                              @endif
                            @endforeach
                         @if ($remaining==0)
                         <td>0</td>
                         <td>0</td>
                         @endif
                            @endif
                                {{-- <td> {{$sale->total_price}} </td>
                                <td> {{ \Carbon\Carbon::parse($sale->created_date)->format('d-m-Y') }} </td> --}}
                                {{-- <td > <a href="{{route('SaleRecordsDetails',['date'=>$sale->created_date])}}"  class="btn btn-primary bg-primary">Details</a> </td> --}}

                                {{-- <td > <a href="{{route('addYesterdayPaymentForm',['id'=>$sale->id,'gd'=>$sale->total_price])}}"  class="btn btn-success bg-success">Payment</a> </td> --}}
                                {{-- <td > <a href="{{route('SaleRecordsDetails',['customerId'=>$sale->created_at])}}"  class="btn btn-primary bg-primary">Details</a> </td> --}}


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


