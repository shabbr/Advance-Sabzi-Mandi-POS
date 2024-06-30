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

                            <form action="{{ route('updateSale', ['id' => $saleData->id]) }}" method="post" class="row g-3">
                                @csrf
                                <input type="hidden" id='vehicle' name="vehicle" value="{{$saleData->vehicle}}">

                                <div class="col-12 col-md-12">
                                    <div class="p-4 rounded bg-light">
                                        <h6 class="mb-4">Sale Details</h6>
                                        <div class="mb-3 form-floating">
                                            <select name="customer_id" required class="form-control" id="floatingInput">
                                                <option value="{{$saleData->customer->id}}"  selected>{{$saleData->customer->name}}</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                        <label>Select Customer</label>

                                            @error('customer_id')
                                            <span class="text-danger">{{$message}}</span>
                                           {{-- <div class="invalid-feedback">{{$message}}</div> --}}
                                            @enderror
                                        </div>

                                        <div class="mb-3 form-floating">
                                            <select name="sender_id" required class="form-control" id="floatingInput">
                                                <option value="{{$saleData->seller_id}}"   selected>{{$saleData->seller->name}}</option>
                                                @foreach($sellers as $seller)
                                                    <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                                @endforeach
                                            </select>
                                        <label>Select Sender</label>
                                            @error('sack_details')
                                            <span class="text-danger">{{$message}}</span>
                                           {{-- <div class="invalid-feedback">{{$message}}</div> --}}
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <select name="product_id" required class="form-control" id="floatingInput">
                                                <option value="{{$saleData->product->id}}"  selected>{{$saleData->product->name}}</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        <label>Select Product</label>

                                            @error('product_details')
                                            <span class="text-danger">{{$message}}</span>
                                           {{-- <div class="invalid-feedback">{{$message}}</div> --}}
                                            @enderror
                                        </div>



                                        <div class="mb-3 form-floating">
                                            <select name="sack_id" required class="form-control" id="floatingInput">
                                                <option value="{{$saleData->sack->id}}"   selected>{{$saleData->sack->name}}</option>
                                                @foreach($sacks as $sack)
                                                    <option value="{{ $sack->id }}">{{ $sack->name }}</option>
                                                @endforeach

                                            </select>
                                            <label>Select Sack</label>

                                            @error('sack_details')
                                            <span class="text-danger">{{$message}}</span>
                                           {{-- <div class="invalid-feedback">{{$message}}</div> --}}
                                            @enderror
                                        </div>

                                        <div class="mb-3 form-floating">
                                            <input type="number" name="quantity" required class="form-control" id="quantity" placeholder="Quantity">
                                            <label for="quantity">Quantity</label>
                                        </div>
                                        <span id="message" class="text-danger"></span>

                                          <div class="form-floating">
                                            <input type="number" name="price" value="{{$saleData->price}}" required class="form-control" id="floatingInput" placeholder="Price">
                                            <label for="floatingTextarea">Price</label>
                                            @error('price')
                                            <div class="text-danger"> {{$message}} </div>
                                            @enderror

                                            <div class="mt-3 mb-3 form-floating">
                                                <input type="number" name="cost" value="{{$saleData->cost}}" required class="form-control" id="cost" placeholder="Cost">
                                                <label for="quantity">Cost</label>
                                            </div>
                                            <span id="message" class="text-danger"></span>

                                            <div class="mt-3 mb-3 form-floating">
                                                <input type="number" name="vehicle" value="{{$saleData->vehicle}}" required class="form-control" id="cost" placeholder="Cost">
                                                <label for="quantity">Vehicle</label>
                                            </div>
                                        </div>


                                        {{-- <div class="mt-3 form-check form-switch">
                                            <input class=" form-check-input" type="checkbox" name="paymentStatus" role="switch"
                                                id="flexSwitchCheckDefault">
                                            <label class=" form-check-label" for="flexSwitchCheckDefault">Payment Status
                                                </label>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="col-12">
                                    <input type="submit" value="Update" id="updateBtn" class="btn btn-primary w-100">
                                </div>
                            </form>







                        </div>
                    </div>




                </div>
            </div>
            <!-- Form End -->

            <script src="{{asset('frontend/selectBlade/jquery.js')}}"></script>

            <!-- Include Select2 JavaScript -->
            <script src="{{asset('frontend/selectBlade/select.js')}}"></script>
            <script>
                $(document).ready(function() {
                    // $('#message').hide();

                    $('.js-example-basic-single').select2();


                    $('#quantity').on('keyup change', function(){
                var quantity = $('#quantity').val();
                var vehicle = $('#vehicle').val();
                var product_id = $('select[name="product_id"]').val();
                var sender_id = $('select[name="sender_id"]').val();
                var sack_id = $('select[name="sack_id"]').val();

                // AJAX request
                $.ajax({
                    url: '/check-quantity', // Replace with your AJAX URL
                    method: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'quantity': quantity,
                        'product_id': product_id,
                        'sender_id': sender_id,
                        'sack_id': sack_id,
                        'vehicle': vehicle
                    },
                    success: function(response){
                        if(response=='Quantity Not Available'){
                        $('#message').text(response);
                        $("#updateBtn").prop('disabled', true);
                                     }else{
                                        $('#message').text(response);
                                        $("#updateBtn").prop('disabled', false);
                                     }
                        console.log(response);
                    },
                    error: function(xhr, status, error){
                        console.error(error);
                    }
                });
            });

                });
            </script>
                        <!-- Form End -->

