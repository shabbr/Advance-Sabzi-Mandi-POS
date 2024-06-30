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


                                    <a href="{{route('shopExpensesForm')}}" class="btn btn-primary">Daily Shop Expenses </a>
                                    <a href="{{route('dailySendedPaymentForm')}}" class="btn btn-primary"> Sended Amount</a>
                                    <a href="{{route('showDailySendedPayment')}}" class="btn btn-primary">Show Daily Sended </a>

                                    <a href="{{route('dailyReceivedPaymentForm')}}" class="btn btn-primary">Received Amount </a>
                                    <a href="{{route('showDailyReceivedPayment')}}" class="btn btn-primary">Show Daily Received </a>

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
                                <th class="col-2">ID</th>
                                <th class="">Roz Namcha</th>
                                <th  class="col-3">Date</th>
                                <th  class="">Add Profit</th>
                                <th  class="">Details</th>
                            </tr>
                        </thead>
                        @php
                            $count=1;
                        @endphp
                        <tbody>
                            @if (isset($sales))
                            @foreach ($sales as $sale)
                            <tr>
                                <td> {{$count}} </td>
                                <td>Roz Namcha</td>
                                <td> {{$sale->created_at->format('Y-m-d')}} </td>
                                  {{-- <td > <a href="{{route('addPaymentForm',['customerId'=>$amount->customer_id,'gd'=>$amount->total_price])}}"  class="btn btn-success bg-success">Payment</a> </td> --}}
                                <td > <a href="{{route('totalProfitForm',['date'=>$sale->created_at->format('Y-m-d')])}}"  class="btn btn-success bg-success">Add Total Profit</a> </td>
                                <td > <a href="{{route('rozNamchaDetails',['date'=>$sale->created_at->format('Y-m-d')])}}"  class="btn btn-primary bg-primary">Details</a> </td>


                            </tr>
                            @php
                                $count++;
                            @endphp
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

