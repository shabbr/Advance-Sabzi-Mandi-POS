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


                            <form action="{{route('updateCollectedAmount')}} " method="post" class="row g-3">
                                @csrf
                                <input type="hidden" name="id" value="{{$payment->id}}">

                                <div class="col-12 col-md-12">
                                    <div class="mb-4 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-4"> Enter Received Payment</h6>
                                        {{-- <a href="{{route('showSales')}}" class="btn btn-primary">Show Sales</a> --}}

                                    </div>
                                    <div class="p-4 rounded bg-light">
                               <div class="mb-3 form-floating">
                                            <input type="number"  disabled required value="{{$payment->recieved_payment}}" class="form-control" id="floatingInput" placeholder="Price of one Item">
                                            <label for="floatingTextarea">Received Payment</label>
                                            @error('price')
                                            <div class="text-danger"> {{$message}} </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="received_payment" required class="form-control" id="floatingInput" placeholder="Received Payment">
                                            <label for="floatingInput">Updated Received Payment</label>
                                            @error('quantity')
                                            <span class="text-danger">{{$message}}</span>
                                           {{-- <div class="invalid-feedback">{{$message}}</div> --}}
                                            @enderror
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

