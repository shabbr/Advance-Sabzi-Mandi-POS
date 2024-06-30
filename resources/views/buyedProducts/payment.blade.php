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


                            <form action="{{route('addAmount')}} " method="post" class="row g-3">
                                @csrf
                                <input type="hidden" name="sellerId" value="{{$sellerId}}">
                                <input type="hidden" name="amountDate" value="{{$date}}">
                                <input type="hidden" name="vehicle" value="{{$vehicle}}">

                                <div class="col-12 col-md-12">
                                    <div class="mb-4 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-4"> Enter Amount Details</h6>
                                        <a href="{{route('showSales')}}" class="btn btn-primary">Show Sales</a>

                                    </div>

                                    {{-- <div class="mb-3 form-floating">
                                        <select name="product_id" required class="form-control js-example-basic-single" id="productSelect">
                                            <option value="" disabled selected>Select Product</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}

                                    <div class="rounded bg-light">
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="fare" required class="form-control" id="floatingInput" placeholder="Received Payment">
                                            <label for="floatingInput">Fare</label>
                                        </div>
                                    </div>
                                    <div class="rounded bg-light">
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="commission" required class="form-control" id="floatingInput" placeholder="Received Payment">
                                            <label for="floatingInput">Commission Percentage </label>
                                        </div>
                                    </div>
                                <div class="rounded bg-light">
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="labour_charges" required class="form-control" id="floatingInput" placeholder="Received Payment">
                                            <label for="floatingInput">Labour Amount</label>
                                        </div>
                                    </div>
                                    <div class="rounded bg-light">
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="market_fee" required class="form-control" id="floatingInput" placeholder="Received Payment">
                                            <label for="floatingInput">Market Fee</label>
                                        </div>
                                    </div>
                                    <div class="rounded bg-light">
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="clerky" required class="form-control" id="floatingInput" placeholder="Received Payment">
                                            <label for="floatingInput">Clerky</label>
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
            {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {

        $('.js-example-basic-single').select2();

    });
</script> --}}
            <!-- Form End -->

