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

                <div class="mb-4 d-flex justify-content-between align-items-center">
                 <div >
        <div style="border-bottom: 2px solid black;">        <strong class="mb-4"> Udhar : </strong>  {{$borrow_amount}} <br>
                 <strong class="mb-4"> Shop Expense : </strong>  {{$shop_expense_amount}} <br>
               <strong class="mb-4">Sended Payment To Sender : </strong>  {{$total_pay_to_sender}} <br>
               <strong class="mb-4">Other Sended Amount : </strong>  {{$total_other_sended_payment}} <br>

            </div>
            <h5 class="mb-4">
               <span style="color: #28a745">
                Total Expense : {{$total_expense}}
            </span>
        </h5>



        </div>
        <div>
            <h4>
                Previous Amount : {{$previousDayProfit}} <br>
            <span style="border-bottom: 2px solid black ; ">
                Profit of Today: {{$earning}} <br>
            </h4>

            <h4>
                <span style="color: #28a745 ; padding-top:2px;"> Total Profit : {{$total_income}}</span>

            </h4>
        </div>
<div>

    <div style="border-bottom: 2px solid black;">
                <strong class="mb-4">Total Wasooli : </strong>  {{$total_wasooli}} <br>
                <strong class="mb-4">Total Commission : </strong>  {{$total_commission}} <br>
                <strong class="mb-4"> Received Amount : </strong>  {{$total_daily_recieved}} <br>
               </div>
            <h5 class="mb-4">
                <span style="color: #28a745">
                    Today Income : {{$today_income}}
                </span>
            </h5>

                </div>

            </div>
            {{-- <strong class="mb-4">Total Udhar : </strong>  {{$total_wasooli}} <br> --}}

                 {{-- ['borrow_amount','shop_expense_amount','total_daily_recieved','total_pay_to_sender','total_wasooli','pure_commission',
                 'pay_to_sender','shop_expense','daily_recieved_payment'])); --}}


    <div class="" style=" border-bottom:1px solid black;">

                <div class="table-responsive ">
                <h3 style="margin-top:4%;">
               {{-- <span style="color: #007bff"> --}}

                    Shop Expense Details
                {{-- </span> --}}
                </h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Expense</th>
                                <th scope="col">Amount</th>
                                {{-- <th scope="col">Details</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($shop_expense))
                            @foreach ($shop_expense as $shop)
                            <tr>
                                <td> {{$shop->expense}} </td>
                                <td> {{$shop->amount}} </td>
                            </tr>
                            @endforeach
                            <tr> <td> <h6> Total Shop Expense = {{$shop_expense_amount}}</h6></td> </tr>
                            @endif

                        </tbody>
                    </table>
                </div>






                <div class="table-responsive ">
                    <h3 style="margin-top:4%;">Sended Payment to Senders</h3>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Expense</th>
                                <th scope="col">Vehicle</th>
                                <th scope="col">Amount</th>
                                {{-- <th scope="col">Details</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($pay_to_sender))
                            @foreach ($pay_to_sender as $payment)
                            <tr>
                                <td> {{$payment->seller->name}} </td>
                                <td> {{$payment->vehicle}} </td>
                                <td> {{$payment->payment}} </td>

                            </tr>
                            @endforeach
                            <tr> <td> <h6> Total Sended Payment = {{$total_pay_to_sender}}</h6></td> </tr>
                            @endif

                        </tbody>
                    </table>
                </div>



                <div class="table-responsive ">
                    <h3 style="margin-top:4%;">Other Sended Amount</h3>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Amount</th>
                                {{-- <th scope="col">Details</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($other_sended_payments))
                            @foreach ($other_sended_payments as $payment)
                            <tr>
                                <td> {{$payment->name}} </td>
                                <td> {{$payment->amount}} </td>

                            </tr>
                            @endforeach
                            <tr> <td> <h6> Total  Amount = {{$total_other_sended_payment}}</h6></td> </tr>
                            @endif

                        </tbody>
                    </table>
                </div>




                <div class="table-responsive ">
                    <h3 style="margin-top:4%;"> Received Payment Details</h3>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                {{-- <th scope="col">Vehicle</th> --}}
                                <th scope="col">Amount</th>
                                {{-- <th scope="col">Details</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($daily_recieved_payment))
                            @foreach ($daily_recieved_payment as $payment)
                            <tr>
                                <td> {{$payment->name}} </td>
                                <td> {{$payment->amount}} </td>

                            </tr>
                            @endforeach
                            <tr> <td> <h6> Total Received Amout = {{$total_daily_recieved}}</h6></td> </tr>
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
            <!-- Form End -->


            <!-- Footer Start -->
          @include('layouts.footer')

