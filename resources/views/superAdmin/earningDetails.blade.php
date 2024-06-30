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
                 <strong class="mb-4">Total Amount : </strong>  {{$total_payment}} <br>



         <strong> Total Expense :</strong>   {{$total_expense}}<br>

<strong> Pure Amount : </strong> {{$pure_amount}}<br>

    <strong>Date :</strong> {{$date->format('d-m-Y')}}<br>

<h4  style="margin-top:4%;">Commission Details</h4>
                <div class="table-responsive">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sender</th>
                                <th scope="col">Sale Amount</th>
                                <th scope="col">Pure Payment</th>
                                <th scope="col">Commission</th>
                                {{-- <th scope="col">Details</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($amounts))
                            @php
                                $total_commission=0;
                            @endphp
                            @foreach ($amounts as $amount)
                            <tr>
                                <td> {{$amount->seller->name}} </td>
                                <td> {{$amount->total_amount}} </td>
                                <td> {{$amount->pure_amount}} </td>
                                <td> {{$amount->commision}} </td>

                                @php
                                    $total_commission=$total_commission+$amount->commision;
                                @endphp
                            {{-- <td > <a href="{{route('receivedCashDetails',['date'=>$payment->created_date])}}"  class="btn btn-primary bg-primary">Details</a> </td> --}}


                            </tr>
                            @endforeach
                            <tr> <td> <h4> Total Commission = {{$total_commission}}</h4></td> </tr>
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

