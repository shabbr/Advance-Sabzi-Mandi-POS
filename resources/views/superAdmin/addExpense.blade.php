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


                            <form action="{{'addExpense'}} " method="post" class="row g-3">
                                @csrf
                                <div class="col-12 col-md-12">
                                    <div class="mb-4 d-flex justify-content-between align-items-center">
                                        {{-- <h6 class="mb-4"> Enter Sale Details</h6> --}}
                                        {{-- <a href="{{route('showSales')}}" class="btn btn-primary">Show Sales</a> --}}

                                    </div>
                                    <div class="p-4 rounded bg-light">










                                        <div class="mb-3 form-floating">
                                            <input type="text" name="expense" required class="form-control" id="floatingInput" placeholder="Price of one Item">
                                            <label for="floatingTextarea">Expense</label>

                                        </div>
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="amount" required class="form-control" id="floatingInput" placeholder="Quantity">
                                            <label for="floatingInput">Amount</label>
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
            <script src="{{asset('frontend/selectBlade/jquery.js')}}"></script>

            <!-- Include Select2 JavaScript -->
            <script src="{{asset('frontend/selectBlade/select.js')}}"></script>

