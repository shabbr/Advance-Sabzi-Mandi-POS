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
                                    <h5 class="mb-0">Sales of Yesterday</h5>
                               </div>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h5 class="mb-4">Sales Details</h5>
                @foreach ($sales as $sale)
                <strong>Customer Name</strong>  : {{$sale->customer->name}} <br>
              <strong>  Customer Area </strong>  :{{$sale->customer->area}} <br>
                <strong>Customer Phone </strong>  :{{$sale->customer->phone}} <br>
                @break
                @endforeach
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Sack Type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Date</th>

                                {{-- <th scope="col">Edit</th>
                                <th scope="col">Delete</th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($sales))
                            @php
                                $grandTotal=0;
                            @endphp
                            @foreach ($sales as $sale)
                            <tr>
                                <td> {{$sale->id}} </td>
                                        <td> {{$sale->product->name}} </td>
                                <td> {{$sale->sack->name}} </td>
                                <td> {{$sale->price}} </td>
                                <td> {{$sale->quantity}} </td>
                                <td> {{$sale->total_price}} </td>
                                <td> {{$sale->created_at->format('d-m-Y')}} </td>

                                @php
                                    $grandTotal=$grandTotal+$sale->total_price;
                                @endphp

                                {{-- <td> {{$sale->payment_status}} </td> --}}
                                {{-- <td > <a href="{{route('editSale',['id'=>$sale->id])}}"  class="btn btn-primary bg-primary">Edit</a> </td>
                                <td > <a href="{{route('deleteSale',['id'=>$sale->id])}}" class="btn btn-danger bg-danger">Delete</a> </td> --}}
                            </tr>

                            @endforeach
                            @endif

                        </tbody>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2"> <h5> Grand Total: {{$grandTotal}} </h5></td>
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

            @include('layouts.footer')

