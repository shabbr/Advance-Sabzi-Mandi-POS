<div class=" sidebar pe-0">
    <nav class="navbar bg-light navbar-light">
        <a href=" {{route('amount')}} " class="mx-4 mb-3 navbar-brand">
            <h3 class="text-primary"><i class="fa fa-hashtag me-0"></i>Chodri Anees</h3>
        </a>
        <div class="mb-4 d-flex align-items-center ms-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{asset('img/user3.webp')}}" alt="" style="width: 40px; height: 40px;">
                <div class="bottom-0 p-1 border border-2 border-white bg-success rounded-circle position-absolute end-0"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">  {{ auth()->user()->name }}</h6>
                {{-- <span>Admin</span>  --}}
            </div>
        </div>
        <div class="navbar-nav w-100">

            <div class="nav-item dropdown">
                {{-- <div class="bg-transparent border-0 dropdown-menu">
                    <a href="button" class="dropdown-item">Buttons</a>
                    <a href="typography" class="dropdown-item">Typography</a>
                    <a href="element" class="dropdown-item">Other Elements</a>
                </div> --}}
            </div>

                    {{-- <a href="{{route('daily')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Daily</a> --}}

                    {{-- <a href="{{route('totalProductQuantity')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Remaining </a> --}}

                    <a href="{{route('sendPayments')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Sender's Payment</a>
                    <a href="{{route('showBuyedProducts')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Receive Products</a>
                    <a href="{{route('dailyCommission')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Daily Commission</a>
                    <a href="{{route('showRozNamcha')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Roz Namcha</a>




                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Senders</a>
                        <div class="bg-transparent border-0 dropdown-menu">
                            <a href="{{route('sendPayments')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Sender's Payment</a>
                            <a href="{{route('showBuyedProducts')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Receive Products</a>

                        </div>
                    </div> --}}

          <hr>

                    {{-- <a href="{{route('showSales')}}" class="nav-item nav-link">
                        <img class="rounded-circle" src="{{asset('img/sale3.webp')}}" alt="" style="width: 25px; height: 25px;">

                        </i>Today Sales</a>
                    <a href="{{route('showYesterdaySales')}}" class="nav-item nav-link">
                        <img class="rounded-circle" src="{{asset('img/sale6.webp')}}" alt="" style="width: 25px; height: 25px;">

                        YesterdaySales</a>
                    <a href="{{route('showSalesRecords')}}" class="nav-item nav-link">

                        <img class="rounded-circle" src="{{asset('img/sale7.webp')}}" alt="" style="width: 25px; height: 25px;">
                        Sales Records</a> --}}


                        <a href="{{route('showSales')}}" class="nav-item nav-link">
                            <img class="rounded-circle" src="{{asset('img/sale3.webp')}}" alt="" style="width: 25px; height: 25px;">
                            </i>Today Sales</a>


                            <a href="{{route('allSales')}}" class="nav-item nav-link">
                                <img class="rounded-circle" src="{{asset('img/sale3.webp')}}" alt="" style="width: 25px; height: 25px;">

                                </i>All Sales</a>


                        {{-- <a href="{{route('showYesterdaySales')}}" class="nav-item nav-link">
                            <img class="rounded-circle" src="{{asset('img/sale6.webp')}}" alt="" style="width: 25px; height: 25px;">

                            YesterdaySales</a> --}}
                        <a href="{{route('showSalesRecords')}}" class="nav-item nav-link">

                            <img class="rounded-circle" src="{{asset('img/sale7.webp')}}" alt="" style="width: 25px; height: 25px;">
                            Sales Records</a>


                            {{-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Sales</a>
                                <div class="bg-transparent border-0 dropdown-menu">
                                    <a href="{{route('showSales')}}" class="nav-item nav-link">
                                        <img class="rounded-circle" src="{{asset('img/sale3.webp')}}" alt="" style="width: 25px; height: 25px;">

                                        </i>Today Sales</a>
                                    <a href="{{route('showYesterdaySales')}}" class="nav-item nav-link">
                                        <img class="rounded-circle" src="{{asset('img/sale6.webp')}}" alt="" style="width: 25px; height: 25px;">

                                        YesterdaySales</a>
                                    <a href="{{route('showSalesRecords')}}" class="nav-item nav-link">

                                        <img class="rounded-circle" src="{{asset('img/sale7.webp')}}" alt="" style="width: 25px; height: 25px;">
                                        Sales Records</a>
                                </div>
                            </div> --}}
            <hr>

            {{-- <a href="{{route('showSales')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Sales</a>
            <a href="{{route('showYesterdaySales')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>YesterdaySales</a>
            <a href="{{route('showSalesRecords')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Sales Records</a> --}}
            <a href="{{route('showPaymentRecords')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Payment </a>
<hr>
<a href="{{route('addAdmin')}}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Admins</a>
<a href="{{route('showSellers')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Senders</a>
<a href="{{route('showCustomers')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Customers</a>
<a href="{{route('showProduct')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>My Products</a>

<a href="{{route('showSack')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Custom Sack</a>

{{-- <div class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Add Data</a>
    <div class="bg-transparent border-0 dropdown-menu">
        <a href="{{route('addAdmin')}}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Admins</a>
        <a href="{{route('showSellers')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Senders</a>
        <a href="{{route('showCustomers')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Customers</a>
        <a href="{{route('showProduct')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>My Products</a>

        <a href="{{route('showSack')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Custom Sack</a>

    </div>
</div> --}}
</div>
        </div>
    </nav>
</div>
