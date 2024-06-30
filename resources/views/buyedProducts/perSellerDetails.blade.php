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
                @foreach ($buyedProducts as $buyedProduct)
                <strong>Seller Name</strong>  : {{$buyedProduct->seller->name}} <br>
              <strong>  Seller Area </strong>  :{{$buyedProduct->seller->area}} <br>
                <strong>Seller Phone </strong>  :{{$buyedProduct->seller->phone}} <br>
                <strong>Vehicle </strong>  :{{$buyedProduct->vehicle}} <br>

                @break
                @endforeach
                @if (isset($buyedProducts))
                @foreach ($buyedProducts as $buyedProduct)
                <strong> Date</strong> : {{$buyedProduct->created_at->format('d-m-Y')}}
                @break
                @endforeach
               @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Sack Type</th>
                                <th scope="col">Product Quantity</th>
                                <th>Remaining</th>
                                {{-- <th scope="col">Date</th> --}}

                              <th scope="col">Edit</th>
                                {{--   <th scope="col">Delete</th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($buyedProducts))
                            @php
                                $grandTotal=0;
                            @endphp
                            @foreach ($buyedProducts as $buyedProduct)
                            <tr>
                                <td> {{$buyedProduct->id}} </td>
                                        <td> {{$buyedProduct->product->name}} </td>
                                <td> {{$buyedProduct->sack->name}} </td>
                                <td> {{$buyedProduct->quantity}} </td>
                                <td> {{$buyedProduct->remaining}} </td>
{{-- <td class="btn btn-primary">Edit</td> --}}
                                {{-- <td> {{$buyedProduct->created_at->format('d-m-Y')}} </td> --}}



                                {{-- <td> {{$buyedProduct->payment_status}} </td> --}}
                               <td > <a href="{{route('editbuyedProduct',['id'=>$buyedProduct->id])}}"  class="btn btn-primary bg-primary">Edit</a> </td>
                                {{--  <td > <a href="{{route('deletebuyedProduct',['id'=>$buyedProduct->id])}}" class="btn btn-danger bg-danger">Delete</a> </td> --}}
                            </tr>

                            @endforeach
                            @endif

                        </tbody>
                        <tr>

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

