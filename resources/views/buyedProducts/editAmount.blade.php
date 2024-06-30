@include('layouts.header')

<!-- Sidebar Start -->
@include('layouts.sidebar')
<!-- Sidebar End -->



        <!-- Content Start -->
        <div class="content">




            <!-- Form Start -->
            <div class="px-4 pt-4 container-fluid">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="p-4 rounded bg-light h-100">
                            {{-- <a href="{{ route('showSales') }}" class="btn btn-primary">List of today sales</a> --}}


                            <form action="{{route('updateAmount')}} " method="post" class="row g-3">
                                @csrf
                                @foreach ($amounts as $amount)

                                <input type="hidden" name="sellerId" value="{{$sellerId}}">
                                <input type="hidden" name="amountDate" value="{{$date}}">
                                <input type="hidden" name="vehicle" value="{{$vehicle}}">

                                <div class="col-12 col-md-12">
                                    <div class="mb-4 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-4"> Enter Amount Details</h6>

                                    </div>
                                    <div class="rounded bg-light">
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="total_amount" value="{{$total_amount}}" required class="form-control" id="floatingInput" placeholder="Received Payment">
                                            <label for="floatingInput">Total Amount</label>
                                        </div>
                                    </div>

                                    <div class="rounded bg-light">
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="fare" value="{{$amount->fare}}" required class="form-control" id="floatingInput" placeholder="Received Payment">
                                            <label for="floatingInput">Fare</label>
                                        </div>
                                    </div>
                                    <div class="rounded bg-light">
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="commission"  required class="form-control" id="floatingInput" placeholder="Received Payment">
                                            <label for="floatingInput">Commission Percentage </label>
                                        </div>
                                    </div>
                                <div class="rounded bg-light">
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="labour_charges" value="{{$amount->labour_charges}}" required class="form-control" id="floatingInput" placeholder="Received Payment">
                                            <label for="floatingInput">Labour Amount</label>
                                        </div>
                                    </div>
                                    <div class="rounded bg-light">
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="market_fee" value="{{$amount->market_fee}}" required class="form-control" id="floatingInput" placeholder="Received Payment">
                                            <label for="floatingInput">Market Fee</label>
                                        </div>
                                    </div>
                                    <div class="rounded bg-light">
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="clerky" value="{{$amount->clerkly}}" required class="form-control" id="floatingInput" placeholder="Received Payment">
                                            <label for="floatingInput">Clerky</label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <div class="col-12">
                                    <input type="submit" value="Update" class="btn btn-primary w-100">
                                </div>
                            </form>







                        </div>
                    </div>




                </div>
            </div>
            <!-- Form End -->

