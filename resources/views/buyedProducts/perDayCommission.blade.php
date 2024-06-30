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
                                    <h5 class="mb-0"> Records</h5>
                                       {{-- <a href="{{ route('amountForm') }}" class="btn btn-primary">Add amount </a> --}}
                                      </div>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4">Amounts List</h6>
                @php
                    $total_pureAmount=0;
                    $total_commission=0;
                    $total_labour_charges=0;
                    $total_fare=0;
                    $total_market_fee=0;
                    $total_clerky=0;

                @endphp
                @if (isset($amounts))
                            @foreach ($amounts as $amount)
                <div class="mt-5 table-responsive" >
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Seller</th>
                                <th>Vehicle</th>
                                <th>Fare</th>
                                <th>Labour Charges</th>
                                <th>Market Fee</th>
                                <th>Clerky</th>
                                <th scope="col"> Commission</th>
                                <th scope="col"> Expenses</th>
                                <th> Product Quantity</th>
                                <th scope="col"> Pure Amount</th>
                                {{-- <th>Sender Name</th> --}}
                                <th scope="col">Date</th>
                                {{-- <th scope="col">Details</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td> {{$amount->seller->name}} </td>
                                <td> {{$amount->vehicle}} </td>
                                <td> {{$amount->fare}} </td>
                                <td> {{$amount->labour_charges}} </td>
                                <td> {{$amount->market_fee}} </td>
                                <td> {{$amount->clerkly}} </td>
                                <td> {{$amount->commision}} </td>
                                <td> {{$amount->total_expenses}} </td>

                                @php
                                $total_commission=$total_commission + $amount->commision;
                                $total_labour_charges=  $total_labour_charges+$amount->labour_charges;
                                $total_fare=$total_fare +  $amount->fare;
                                $total_market_fee =   $total_market_fee + $amount->market_fee;
                                $total_clerky =  $total_clerky + $amount->clerkly;
                       @endphp
                                @foreach ($sales as $sale)
                                @if ($sale->seller_id == $amount->seller_id && $sale->vehicle == $amount->vehicle)
                                <td> {{$sale->quantity}} </td>
                                @endif
                                @endforeach
                                <td> {{$amount->pure_amount}} </td>
                                <td> {{$amount->created_at->format('d-m-Y')}} </td>
                                @php
                                    $total_pureAmount=$total_pureAmount + $amount->pure_amount;

                            @endphp

                            </tr>


                        </tbody>

                    </table>

                </div>
                @endforeach
                @endif
                <h4 class="mt-4">Total Fare : {{$total_fare}} </h4>
                <h4 >Total Market Fee : {{$total_market_fee}} </h4>
                <h4  >Total Labour Charges : {{$total_labour_charges}} </h4>
                <h4>Total Clerky : {{$total_clerky}} </h4>
                <h4  >Total Commission: {{$total_commission}} </h4>

                {{-- <h4 class="mt-4">Total Pure Amount: {{$total_pureAmount}} </h4> --}}

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

