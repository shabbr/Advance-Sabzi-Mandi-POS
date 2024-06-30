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
                            <h5 class="mb-4 ">Profit</h5>

                            <form action="{{ route('totalProfit') }}" method="post" class="row g-3">
                                @csrf
                                <input type="hidden" name="date" value="{{$profit_date}}">
                                <input type="hidden" name="profit_of_today" value="{{$earning}}">


                                <div class="col-12 col-md-12">
                                    <div class="p-4 rounded bg-light">
                                        <h6 class="mb-4">Today Profit</h6>
                                        <div class="mb-3 form-floating">
                                            <input type="text" name="profit_of_today" value={{$earning}} disabled  class="form-control" id="floatingInput" placeholder="name">
                                            <label for="floatingInput">Amount</label>
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                           {{-- <div class="invalid-feedback">{{$message}}</div> --}}
                                            @enderror
                                        </div>

                                        {{-- <h6 class="mb-4">Previous Cash </h6>
                                        <div class="mb-3 form-floating">
                                            <input type="text" name="" value= ""   class="form-control" id="floatingInput" placeholder="name">
                                            <label for="floatingInput">Amount</label>
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div> --}}
@php
    $total_profit =$earning + $previousDayProfit;
@endphp


{{-- <h6 class="mb-4">Total Profit </h6>
<div class="mb-3 form-floating">
    <input type="text" name="" value={{$total_profit}} disabled  class="form-control" id="floatingInput" placeholder="name">
    <label for="floatingInput">Amount</label>
    @error('name')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div> --}}

                                    </div>
                                </div>


                                <input type="hidden" name="total_profit" value="{{$total_profit}}">

                                <div class="col-12">
                                    <input type="submit" value="Confirm" class="btn btn-primary w-100">
                                </div>
                            </form>







                        </div>
                    </div>




                </div>
            </div>
            <!-- Form End -->

