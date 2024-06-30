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
                                    <h5 class="mb-0">Payment Records</h5>
     <a href="{{route('collectedAmount')}}" class="btn btn-primary">وصولی</a>

                                   {{-- <a href="{{ route('saleForm') }}" class="btn btn-primary">Add Sale </a> --}}
                                </div>

                                <h6> کل ادھار : <span style="color: red;">{{$remainingAmount}}</span> </h6>
                                @php
                                    $totalCollection=0;
                                @endphp
                             @foreach ($collectedAmounts as $amount)
                             @if ($amount->payment_status == 'borrow')
                             <h6> آج کی وصولی : <span style="color: rgb(37, 212, 37);"> {{$amount->recieved_payment}}</span></h6>
                             @elseif ($amount->payment_status == 'cash')
                             <h6 > <span style="border-bottom: 1px solid black"> آج کی نقد رقم : {{$amount->recieved_payment}}</span></h6>

                             @endif
                             @php
                                 $totalCollection=$totalCollection + $amount->recieved_payment;
                             @endphp

                                @endforeach
                                <h6>کل رقم  :{{$totalCollection}}</h6>
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
                                {{-- <th scope="col">Customer Phone</th> --}}
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Received Amount</th>
                                <th scope="col"> Remaining</th>
                                <th scope="col"> Payment</th>
                                <th scope="col"> Payment Details</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($sales))
                            @foreach ($sales as $sale)
                            <tr>
                                <td> {{$sale->customer->name}} </td>
                                <td> {{$sale->customer->area}} </td>

                                {{-- <td> {{$sale->customer->phone}} </td> --}}
                                <td> {{$sale->total_quantity}} </td>
                                <td> {{$sale->total_price}} </td>
                                @php
                                $TotalPayment=0;
                            @endphp
                                @foreach ($payments as $payment)
                                @if ($payment->customer_id==$sale->customer_id)
                                    @php
                                        $TotalPayment=$TotalPayment+$payment->recieved_payment;
                                    @endphp
                                @endif

                                @endforeach
                                <td> {{$TotalPayment}} </td>

                                @php
                                    $remainingAmount=$sale->total_price-$TotalPayment;
                                @endphp
                                <td>{{$remainingAmount}}</td>
                                 <td > <a href="{{route('paymentForm',['customerId'=>$sale->customer->id,'gd'=>$sale->total_price])}}"  class="btn btn-success bg-success">Payment</a> </td>
                           <td>
                            <form action="{{route('paymentDetails')}}" method="post">
                            @csrf
                            <input type="hidden" name="customerId" value="{{$sale->customer->id}}">
                            <input type="hidden" name="totalPrice" value="{{$sale->total_price}}">
                            <input type="hidden" name="remainingAmount" value="{{$remainingAmount}}">

                            <input type="submit" value="PayDetails"  class="btn btn-success bg-success"> </form> </td>
                                 {{-- <td > <a href="{{route('paymentDetails',['customerId'=>$sale->customer->id,'totalPrice'=>$sale->total_price])}}" >Payment Details</a> </td> --}}
                                 <td > <a href="{{route('paymentRecord',['customerId'=>$sale->customer->id])}}"  class="btn btn-primary bg-primary">Details</a> </td>


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
