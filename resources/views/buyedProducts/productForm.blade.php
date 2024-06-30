@include('layouts.header')

<!-- Sidebar Start -->
@include('layouts.sidebar')
<!-- Sidebar End -->

<!-- Content Start -->
<div class="content">
    <!-- Form Start -->
    <div class="px-4 pt-4 container-fluid">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="p-4 rounded bg-light h-100">
                    <h5 class="mb-4 ">Add Product</h5>

                    <form action="{{ route('addBuyedProduct') }}" method="post" class="row g-3">
                        @csrf
                        <div class="col-12 col-sm-6 col-xl-12 col-md-12">
                            <div class="p-4 rounded bg-light">
                                <h6 class="mb-4">Product Details</h6>

                                <div class="mb-3 form-floating">
                                    <select name="product_id" required class="form-control js-example-basic-single" style="width: 100%;" id="productSelect">
                                        <option value="" disabled selected>Select a Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>



                                <div class="mb-3 form-floating">
                                    <select name="sack_id" required class="form-control js-example-basic-single" style="width: 100%;" id="sackSelect">
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach($sacks as $sack)
                                            <option value="{{ $sack->id }}">{{ $sack->name }}</option>
                                        @endforeach
                                    </select>
                                    <!-- ... -->
                                </div>

                                <div class="mb-3 form-floating">
                                    <input type="text" name="quantity" required value="{{ old('quantity') }}" class="form-control" id="floatingInput" placeholder="Quantity">
                                    <label for="floatingInput">Quantity</label>
                                    @error('quantity')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" value="Add" class="btn btn-success w-100">
                        </div>
                    </form>


                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="p-4 rounded bg-light h-100">
                    <h5 class="mb-4">Product Table</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Sack</th>
                                <th>Delete</th>

                                <!-- Add more columns as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through your products and display them -->
                            @foreach($carts as $cart)
                                <tr>
                                    <td>{{ $cart->product->name }}</td>
                                    <td> {{$cart->quantity}} </td>
                                    <td>{{ $cart->sack->name }}</td>
                                    <td> <a href="{{route('removeProductCart',['id'=>$cart->id])}}" class="btn btn-danger">Remove</a> </td>

                                    <!-- Add more columns as needed -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form action="{{ route('addReceivedProduct') }}" method="post" class="mt-5 row g-3">
            @csrf
            <div class="col-12 col-sm-6 col-xl-12 col-md-12">
                <div class="p-4 rounded bg-light">
                    <div class="mb-3 form-floating">
                        <select name="seller_id" required class="form-control js-example-basic-single" style="width: 100%;" id="sellerSelect">
                            <option value="" disabled selected>Select Sender</option>
                            @foreach($sellers as $seller)
                                <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                            @endforeach
                        </select>
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                        <div class="mb-3 form-floating">
                        <input type="text" name="vehicle" value="1" class="form-control" id="floatingInput" placeholder="Quantity">
                        <label for="floatingInput">Vehicle</label>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="date" name="created_at" value="{{$currentDate}}"   class="form-control" id="floatingInput" placeholder="Date">
                        <label for="floatingInput">Date</label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <input type="submit" value="Confirm" class="btn btn-primary w-100">
            </div>
    </div>
</div>


        </div>

    </div>
    <!-- Form End -->
</div>
<!-- Include jQuery -->
<script src="{{asset('frontend/selectBlade/jquery.js')}}"></script>

<!-- Include Select2 JavaScript -->
<script src="{{asset('frontend/selectBlade/select.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
