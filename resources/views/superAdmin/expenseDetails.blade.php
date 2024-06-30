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
                                    {{-- <h5 class="mb-0">Cash Details</h5> --}}
                                   {{-- <a href="{{ route('expense') }}" class="btn btn-primary">Add payment </a> --}}
                                      </div>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Expense</th>
                                <th scope="col">Amount</th>
                                {{-- <th scope="col">Details</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($expenses))
                            @php
                                $total_expense=0;
                            @endphp
                            @foreach ($expenses as $expense)
                            <tr>
                                <td> {{$expense->expense}} </td>
                                <td> {{$expense->amount}} </td>
                                @php
                                    $total_expense= $total_expense+$expense->amount;
                                @endphp
                            {{-- <td > <a href="{{route('receivedCashDetails',['date'=>$payment->created_date])}}"  class="btn btn-primary bg-primary">Details</a> </td> --}}


                            </tr>
                            @endforeach
                            <tr> <td> <h5> Total Expenses = {{ $total_expense}}</h5></td> </tr>
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

