

























@include('layouts.header')

<!-- Sidebar Start -->
@include('layouts.sidebar')
<!-- Sidebar End -->



        <!-- Content Start -->
        <div class="content">




            <!-- Form Start -->
            <div class="px-4 pt-4 container-fluid">

                <div class="row g-4">

                    <!-- Form Column -->
                    <div class="col-sm-12 col-xl-6">
                        <div class="p-4 rounded bg-light h-100">

                            <form action="{{ 'addShopExpense' }}" method="post" class="row g-3">
                                @csrf
                                <div class="col-12">
                                    <div class="mb-4 d-flex justify-content-between align-items-center">
                                        {{-- Your heading or other content --}}
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="mb-3 form-floating">
                                        <input type="text" name="expense" required class="form-control" id="floatingInput" placeholder="Price of one Item">
                                        <label for="floatingTextarea">Expense</label>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <div class="mb-3 form-floating">
                                        <input type="number" name="amount" required class="form-control" id="floatingInput" placeholder="Quantity">
                                        <label for="floatingInput">Amount</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="submit" value="Add" class="btn btn-primary w-100">
                                </div>
                            </form>

                        </div>
                    </div>

                    <!-- Table Column -->
                    <div class="col-sm-12 col-xl-6">
                        <div class="p-4 rounded bg-light h-100">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Expense</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($expenses))
                                        @foreach ($expenses as $expense)
                                        <tr>
                                            <td> {{$expense->expense}} </td>
                                            <td> {{$expense->amount}} </td>
                                            <td> <a href="{{route('removeShopExpense',['id'=>$expense->id])}}" class="btn btn-danger ">Remove</a> </td>
                                        </tr>
                                        @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="px-4 pt-4 container-fluid">

                        <div class="row g-4">

                            <!-- Form Column -->
                            <div class="col-sm-12 col-xl-12">
                                <div class="p-4 rounded bg-light h-100">

                                    <form action="{{ 'shopExpense' }}" method="post" class="row g-3">
                                        @csrf
                                        <div class="col-12">
                                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                                {{-- Your heading or other content --}}
                                            </div>
                                        </div>
                                        <div class="mb-3 form-floating">

                                          <input type="date" name="created_at" required id="date" class="form-control" id="floatingInput" placeholder="Date">
                                            <label for="floatingInput">Date</label>
                                        </div>

                                        <div class="col-12">
                                            <input type="submit" value="Confirm" class="btn btn-primary w-100">
                                        </div>
                                    </form>

                                </div>
                            </div>

                </div>
            </div>


            <script src="{{asset('frontend/selectBlade/jquery.js')}}"></script>

            <!-- Include Select2 JavaScript -->
            <script src="{{asset('frontend/selectBlade/select.js')}}"></script>


