 @include('layouts.header')

@include('layouts.sidebar')



        <div class="content">
            @include('layouts.navbar')





            <div class="px-4 pt-4 container-fluid">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="p-4 rounded bg-light h-100 ">
                                <div class="mb-4 d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Payment Records</h5>
                                    {{-- <a href="{{route('oldSales')}}" class="btn primary">Old Sales</a> --}}
     <a href="{{ route('excelExport') }}" class="btn btn-primary">Excel Amounts </a>
     <a href="{{route('collectedAmount')}}" class="btn btn-primary">وصولی</a>

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
                                <th>ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Area</th>
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
                            @php
                                // $count=1;
                            @endphp
                            @foreach ($sales as $sale)
                            <tr>
                                <td> {{$sale->customer->id}} </td>
                                <td> {{$sale->customer->name}} </td>
                                <td> {{$sale->customer->area}} </td>

                                <td> {{$sale->total_quantity}} </td>
                                @php
                                // isset()
                                $sale_total_price=$sale->total_price;
            //                     $cust = DB::table('previous_customer_amounts')
            // ->select('amount') // Specify the columns you want to select
            // ->where('customer_id', $sale->customer_id) // Add a condition to select a specific row by customer_id
            // ->first();

            $cust = DB::table('customers')
            ->select('amount') // Specify the columns you want to select
            ->where('id', $sale->customer_id) // Add a condition to select a specific row by customer_id
            ->first();
            // dd( $cust);

            if (!is_null($cust)) {
    // The query returned a result, so you can access its properties
    $overall_price=$sale_total_price + $cust->amount;

}else{
    // $cust->amount=0;
    $overall_price=$sale_total_price ;

}

                                @endphp
                                <td> {{$overall_price}} </td>
                                @php
                                $TotalPayment=0;
                                // $count++;
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
                                    $remainingAmount=$overall_price-$TotalPayment;
                                @endphp
                                <td>{{$remainingAmount}}</td>
                                 <td > <a href="{{route('paymentForm',['customerId'=>$sale->customer->id,'gd'=>$sale->total_price])}}"  class="btn btn-success bg-success">Payment</a> </td>
                           <td>
                            <form action="{{route('paymentDetails')}}" method="post">
                            @csrf
                            <input type="hidden" name="customerId" value="{{$sale->customer->id}}">
                            <input type="hidden" name="totalPrice" value="{{$sale->total_price}}">
                            <input type="hidden" name="remainingAmount" value="{{$remainingAmount}}">
                            <input type="hidden" name="overall_price" value="{{$overall_price}}">

                            <input type="submit" value="PayDetails"  class="btn btn-success bg-success"> </form> </td>
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


            @include('layouts.footer')


