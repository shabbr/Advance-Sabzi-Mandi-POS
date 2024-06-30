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
                                    <h5 class="mb-0">Received Product Records</h5>
                               </div>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h5 class="mb-4">Received Product Details</h5>
                @foreach ($sales as $sale)
                <strong>Seller Name</strong>  : {{$sale->seller->name}} <br>
              <strong>  Seller Area </strong>  :{{$sale->seller->area}} <br>
                <strong>Seller Phone </strong>  :{{$sale->seller->phone}} <br>

                @break
                @endforeach
                <strong>Vehicle</strong>  :{{$vehicle}} <br>

                @if (isset($sales))
                @foreach ($sales as $sale)
                <strong>Bill Date</strong> : {{$sale->created_at->format('d-m-Y')}}
                @break
                @endforeach
               @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Sack Type</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Cost</th>
                                <th>Total Price</th>

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
                                        <td> {{$sale->product->name}} </td>
                                <td> {{$sale->sack->name}} </td>
                                <td> {{$sale->quantity}} </td>
                                <td> {{$sale->price}} </td>
                                <td> {{$sale->cost}} </td>
                                <td> {{$sale->total_price }} </td>

                                {{-- <td> {{$sale->created_at->format('d-m-Y')}} </td> --}}



                                {{-- <td> {{$sale->payment_status}} </td> --}}
                                {{-- <td > <a href="{{route('editsale',['id'=>$sale->id])}}"  class="btn btn-primary bg-primary">Edit</a> </td>
                                <td > <a href="{{route('deletesale',['id'=>$sale->id])}}" class="btn btn-danger bg-danger">Delete</a> </td> --}}
                            </tr>

                            @endforeach
                            @endif

                        </tbody>
                        <tr>

                        </tr>
                    </table>
                    <h3>Grand Total Price:  {{$totalPrice}} </h3>

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

