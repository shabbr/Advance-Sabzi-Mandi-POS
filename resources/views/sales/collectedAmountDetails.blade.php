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
                                    <h5 class="mb-0">Collected Payment Records</h5>
                                   {{-- <a href="{{ route('saleForm') }}" class="btn btn-primary">Add Sale </a> --}}
                                      </div>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4">Collected Payment List</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th scope="col">Payment </th>
                                <th scope="col">Date</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($payments))
                            <tr>
                                @foreach ($payments as $payment)
                                <td> {{$payment->customer->name}} </td>
                                <td> {{$payment->recieved_payment}} </td>
                                <td> {{$payment->created_at->format('d-m-Y')}} </td>
<td>
    <a href="{{route('editCollectedAmount',['id'=>$payment->id])}}" class="btn btn-primary">Edit</a>
    {{-- <a href="{{route('collectedAmountDetails',['date'=>$payment->id])}}" class="btn btn-primary">Edit</a> --}}


</td>                            </tr>
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


