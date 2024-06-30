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
                                    <h5 class="mb-0">Sender</h5>
                                    {{-- <a href="{{ route('paymentsForm') }}" class="btn btn-primary">Add Sender</a> --}}
                                      </div>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4">Senders List</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Sender Name</th>
                                <th scope="col">Total Amount</th>
                                <th> Remaining Amount </th>
                                <th scope="col">Sended Payment</th>
                                <th scope="col">Send Payment</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($payments))
                            @foreach ($payments as $payment)
                            <tr>
                                <th scope="row">{{$payment->seller_id}}</th>
                                <td> {{$payment->seller->name}} </td>
                                @foreach ($amounts as $amount)
                                {{-- {{$amount->seller_id}} --}}
                                @if ($amount->seller_id==$payment->seller_id)
                                @php
                                    $total_amount=$amount->pure_amount - $payment->payment;
                            //   dd($payment->payment);
            //                 $cust = DB::table('previous_sende_amounts')
            // ->select('amount') // Specify the columns you want to select
            // ->where('seller_id', $amount->seller_id) // Add a condition to select a specific row by customer_id
            // ->first();
            $cust = DB::table('sellers')
            ->select('amount') // Specify the columns you want to select
            ->where('id', $amount->seller_id) // Add a condition to select a specific row by customer_id
            ->first();
            // dd( $cust);

            if (!is_null($cust)) {
               $total_amount=$total_amount + $cust->amount;
               $amount->pure_amount=$amount->pure_amount +  $cust->amount;
           }
                            // $total_amount=$total_amount + 4500;
                                    // $amount->pure_amount=$amount->pure_amount+ 4500
                                @endphp
                                <td>{{$amount->pure_amount}} </td>
                                <td>{{$total_amount }}</td>
                                @endif
                                @endforeach
                                <td> {{$payment->payment}} </td>

                                <td><a href="{{route('sendedPaymentForm',['id'=>$payment->seller_id])}}"class="btn btn-success">Send Payment</a></td>
                                <td><a href="{{route('sendedPaymentDetails',['id'=>$payment->seller_id])}}"class="btn btn-primary">Details</a></td>

                                 {{-- <td> <a href="{{route('editpayments',['id'=>$payments->id])}}" class="btn btn-primary">Edit</a> </td>
                                <td><a href="{{route('deletepayments',['id'=>$payments->id])}}"class="btn btn-danger">Delete</a></td> --}}
                                {{-- <td><a href="{{route('sendedPaymentForm',['id'=>$payments->id])}}"class="btn btn-danger">Sended Payment</a></td> --}}

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

