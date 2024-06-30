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
                               </div>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h5 class="mb-4">Payments Details</h5>
                @foreach ($payments as $payment)
                <strong>Customer Name</strong>  : {{$payment->customer->name}} <br>
              <strong>  Customer Area </strong>  :{{$payment->customer->area}} <br>
                <strong>Customer Phone </strong>  :{{$payment->customer->phone}} <br>
                @break
                @endforeach
                <strong>Previous Bill:</strong> {{$previousAmount}} <br>
                 <strong> Bill:</strong> {{$totalPrice}} <br>
                 <strong> Total Bill:</strong> {{$overall_price}} <br>

                 <strong>Remaining Amount:</strong> {{$remainingAmount}}

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Received Amount</th>
                                <th scope="col">Date</th>

                                {{-- <th scope="col">Date</th> --}}

                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($payments))
                            @php
                                $grandTotal=0;
                            @endphp
                            @foreach ($payments as $payment)
                            <tr>

                                <td> {{$payment->id}} </td>
                                        <td> {{$payment->recieved_payment}} </td>
                                <td> {{$payment->created_at->format('d-m-Y')}} </td>

                                {{-- <td> {{$payment->created_at->format('d-m-Y')}} </td> --}}

                                @php
                                    $grandTotal=$grandTotal+$payment->recieved_payment;
                                @endphp
{{-- <td class=" btn bg-primary btn-primary"> <a href="">Edit </a></td> --}}

{{-- <td class=" btn bg-danger btn-danger"> delete</td> --}}

                                {{-- <td> {{$payment->payment_status}} </td> --}}
                        <td > <a href="{{route('editpayment',['id'=>$payment->id])}}"  class="btn btn-primary bg-primary">Edit</a> </td>
                                <td > <a href="{{route('deletepayment',['id'=>$payment->id])}}" class="btn btn-danger bg-danger">Delete</a> </td>
                            </tr>

                            @endforeach
                            @endif

                        </tbody>
                        <tr>

                            <td colspan="2"> <h5>  Total Received Amount : {{$grandTotal}} </h5></td>
                        </tr>
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

            <!-- Footer Start -->
            @include('layouts.footer')

