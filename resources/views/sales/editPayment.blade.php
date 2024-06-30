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


                            <form action="{{route('updatePayment',['id'=>$payment->id])}} " method="post" class="row g-3">
                                @csrf
                                <div class="col-12 col-md-12">

                                    <div class="p-4 rounded bg-light">
                               <div class="mb-3 form-floating">
                                            <input type="number"  disabled required value="{{$payment->recieved_payment}}" class="form-control" id="floatingInput" placeholder="">
                                            <label for="floatingTextarea">Total Price</label>
                                            @error('price')
                                            <div class="text-danger"> {{$message}} </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="received_payment" required class="form-control" id="floatingInput" placeholder="Received Payment">
                                            <label for="floatingInput">New Received Payment</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="submit" value="Add" class="btn btn-primary w-100">
                                </div>
                            </form>







                        </div>
                    </div>




                </div>
            </div>
            <!-- Form End -->

