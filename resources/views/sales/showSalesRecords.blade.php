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
                                    <h5 class="mb-0">Sales Records</h5>
                                   {{-- <a href="{{ route('excelExport') }}" class="btn btn-primary">Dowenload Records</a> --}}
                                      </div>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4">Sales List</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Total Saled Quantity</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Date</th>
                                {{-- <th scope="col"> Payment</th> --}}
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($sales))
                            @foreach ($sales as $sale)
                            <tr>
                                <td> {{$sale->total_quantity}} </td>
                                <td> {{$sale->total_price}} </td>
                                <td> {{ \Carbon\Carbon::parse($sale->created_date)->format('d-m-Y') }} </td>
                                <td > <a href="{{route('SaleRecordsDetails',['date'=>$sale->created_date])}}"  class="btn btn-primary bg-primary">Details</a> </td>

                                {{-- <td > <a href="{{route('addYesterdayPaymentForm',['id'=>$sale->id,'gd'=>$sale->total_price])}}"  class="btn btn-success bg-success">Payment</a> </td> --}}
                                {{-- <td > <a href="{{route('SaleRecordsDetails',['customerId'=>$sale->created_at])}}"  class="btn btn-primary bg-primary">Details</a> </td> --}}


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


