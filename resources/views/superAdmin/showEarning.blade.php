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
                                    <h5>Chodri Anees</h5>
                                    {{-- <a href="{{ route('receivePaymentForm') }}" class="btn btn-secondary">Receive Payment </a> --}}
                                    {{-- <a href="{{ route('receivePaymentForm') }}" class="btn btn-primary">Show Receive Payment </a> --}}
                                   {{-- <a href="{{ route('showExpenseForm') }}" class="btn btn-primary">Daily Expenses </a> --}}
                                   <div class="dropdown show">
                                    <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     Actions
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" data-bs-auto-close="outside">
                                        <a class="dropdown-item" href="{{ route('showExpenseForm') }}">Add Daily Expenses</a>
                                        <a class="dropdown-item" href="{{ route('showExpense') }}"> Expenses Records</a>
                                        <a class="dropdown-item" href="{{ route('receivePaymentForm') }}">Add Received Payment</a>
                                      <a class="dropdown-item" href="{{ route('showReceivedPayment') }}">Payment Records</a>
                                    </div>
                                  </div>

                                      </div>


<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h5 class="mb-4"> Current Balance : {{$current_balance}} </h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Total Profit Amount</th>
                                <th scope="col">Date</th>
                                {{-- <th>Expenses</th> --}}
                                {{-- <th>Received Amount</th> --}}
                                {{-- <th>Pure Amount</th> --}}
                                {{-- <th scope="col">Details</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($payments))
                            @foreach ($payments as $payment)
                            <tr>
                                <td> {{$total_payment}} </td>


                                @php
  $date = \Carbon\Carbon::parse($payment->created_at)->format('Y-m-d');

  $formattedDate = \Carbon\Carbon::parse($payment->created_at)->format('d-m-Y');
//   $payment->created_date = \Carbon\Carbon::parse($payment->created_date);
  echo '<td>'.$formattedDate .'</td>';
//   echo '<td>'. '33' .'</td>';
                                //     foreach ($expenses as  $expense) {
                                //  if ($expense->created_date == $date) {
                                //     $pureAmount=$payment->profit - $expense->amount;
                                //     // echo '<td>'.$expense->amount.'</td>';
                                //      $pure_expense=$expense->amount;
                                //     // echo '<td>'.$pureAmount.'</td>';
                                //  }
                                //     }
                                //     foreach ($received_a_day as  $received) {
                                //  if ($received->created_date == $date) {

                                //     // echo '<td>'.$received->amount.'</td>';
                                //     $pure_receive=$received->amount;
                                //     // echo '<td>'.$pureAmount.'</td>';
                                //  }
                                //     }

                                    // if(isset($pure_expense && $pure_receive )){
                                    //     echo '<td>'.$pureAmount.'</td>';
                                    // }

                                @endphp

                                {{-- @if (isset($received))

                                @endif --}}
                                {{-- <td> {{$}} </td> --}}




                            {{-- <td > <a href="{{route('receivedCashDetails',['date'=>$payment->created_date])}}"  class="btn btn-primary bg-primary">Details</a> </td> --}}


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

