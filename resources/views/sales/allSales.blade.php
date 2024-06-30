@include('layouts.header')

<!-- Sidebar Start -->
@include('layouts.sidebar')
<!-- Sidebar End -->



        <!-- Content Start -->
        <div class="content">

   <!-- Navbar Start -->
   @include('layouts.navbar')
   <!-- Navbar End -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <script type="text/javascript">
       $(document).ready(function() {
           @if(session('success'))
               alert('{{ session('success') }}');
           @endif
       });
   </script>

            <!-- Form Start -->
            <div class="px-4 pt-4 container-fluid">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="p-4 rounded bg-light h-100 ">
                                <div class="mb-4 d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">All Sales</h5>
                                   <a href="{{ route('saleForm') }}" class="btn btn-primary">Add Sale </a>
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
                                {{-- <th>Sender Name</th> --}}
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Total Price</th>
                                {{-- <th scope="col">Received Amount</th> --}}
                                <th>Date</th>

                                <th scope="col"> Payment</th>
                                {{-- <th scope="col"> Update Payment</th> --}}
                                <th scope="col">Details</th>
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
                                {{-- <td> {{$sale->seller->name}}    </td> --}}
                                <td> {{$sale->quantity}} </td>
                                <td> {{$sale->total_price}} </td>
                                {{-- @if(count($payments) == 0)
     <td>0</td>
                                @else
                                @php
    $customerIds = $payments->pluck('customer_id')->toArray();
@endphp
                                   @if (!in_array($sale->customer_id,$customerIds))
                                       <td> {{"0"}} </td>
                                   @endif
                                   @endif

                                @foreach ($payments as $payment)
                                   @if ($payment->customer_id==$sale->customer_id )
                                       <td> {{$payment->recieved_payment}} </td>
                                   @endif
                               @endforeach --}}

                               <td> {{$sale->created_at->format('d-m-Y')}} </td>

                                <td > <a href="{{route('addOldPaymentForm',['customerId'=>$sale->customer_id,'gd'=>$sale->total_price,'created_at'=>$sale->created_at])}}"  class="btn btn-success bg-success">Payment</a> </td>
                                {{-- <td > <a href="{{route('editTodayAmount',['customerId'=>$sale->customer_id])}}"  class="btn btn-success bg-success">Update Payment</a> </td> --}}
                                <td > <a href="{{route('saleDetails',['customerId'=>$sale->customer_id])}}"  class="btn btn-primary bg-primary">Details</a> </td>


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

