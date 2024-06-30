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
                                    <h5 class="mb-0">Amounts of Today</h5>
                                       {{-- <a href="{{ route('amountForm') }}" class="btn btn-primary">Add amount </a> --}}
                                      </div>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4">Amounts List</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Total Commission</th>
                                <th>Total Amount</th>
                                <th scope="col">Total Expenses</th>
                                <th scope="col">Total Pure Amount</th>
                                {{-- <th>Sender Name</th> --}}
                                <th scope="col">Date</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($amounts))
                            @foreach ($amounts as $amount)
                            <tr>
                                <td> {{$amount->commision}} </td>
                                <td> {{$amount->total_amount}} </td>
                                <td> {{$amount->total_expenses}} </td>
                                <td> {{$amount->pure_amount}} </td>
                                <td> {{$amount->created_at->format('d-m-Y')}} </td>
                                  {{-- <td > <a href="{{route('addPaymentForm',['customerId'=>$amount->customer_id,'gd'=>$amount->total_price])}}"  class="btn btn-success bg-success">Payment</a> </td>
                                <td > <a href="{{route('editTodayAmount',['customerId'=>$amount->customer_id])}}"  class="btn btn-success bg-success">Update Payment</a> </td>--}}
                                <td > <a href="{{route('perDayCommission',['date'=>$amount->created_at->format('Y-m-d')])}}"  class="btn btn-primary bg-primary">Details</a> </td>


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

