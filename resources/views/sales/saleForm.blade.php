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


                            <form action="{{'addSale'}} " method="post" class="row g-3">
                                @csrf
                                <div class="col-12 col-md-12">
                                    <div class="mb-4 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-4"> Enter Sale Details</h6>
                                        <a href="{{route('showSales')}}" class="btn btn-primary">Show Sales</a>

                                    </div>


                                    <div class="p-4 rounded bg-light">




                                        <div class="mb-3 form-floating">
                                            <select name="product_id" required class="form-control js-example-basic-single">
                                         @if(isset($session_product))
                                            <option value="{{$session_product_id}}" disabled >{{$session_product}}</option>
                                          @else
                                                <option value="" disabled selected>Select Product</option>
                                            @endif
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="mb-3 form-floating">
                                            <select name="sender_id" required class="form-control js-example-basic-single" id="productSelect">
                                                  @if(isset($session_sender))
                                                <option value="{{$session_sender_id}}" selected >{{$session_sender}}</option>
                                                @else
                                              <option value="" disabled selected>Select Sender</option>

                                                @endif

                                                @foreach($sellers as $seller)
                                                    <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 form-floating">
                                            <select name="sack_id" required class="form-control js-example-basic-single" id="sackSelect">
                                                @if(isset($session_sack))
                                                <option value="{{$session_sack_id}}" disabled >{{$session_sack}}</option>
                                              @else
                                              <option value="" disabled selected>Select Sack Type</option>
                                                @endif
                                                @foreach($sacks as $sack)
                                                    <option value="{{ $sack->id }}">{{ $sack->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('sack_details')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-floating">
                                            @if(isset($session_vehicle))
                                            <input type="number" name="vehicle" id='vehicle'  value="{{$session_vehicle}}"  required class="form-control" id="floatingInput" placeholder="Cost">
                                          @else
                                          <input type="number" name="vehicle" value="1" id='vehicle' required class="form-control" id="floatingInput" placeholder="Vehicle">                                            @endif
                                            <label for="floatingInput">Vehicle</label>
                                        </div>

                                        <div class="mb-3 form-floating"  >
                                            <select name="customer_id" required class="form-control js-example-basic-single" id="customerSelect"  >
                                                @if(isset($session_customer))
                                                <option value="{{$session_customer_id}}" selected >{{$session_customer}}</option>
                                                @else
                                                <option value="" disabled selected>Select Customer</option>

                                              @endif
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 form-floating">
                                            @if(isset($session_date))
                                            <input type="date" name="created_at" id="date" value="{{$session_date}}"  class="form-control" id="floatingInput" placeholder="Date">

                                          @else
                                          <input type="date" name="created_at" value="{{$currentDate}}"  id="date" class="form-control" id="floatingInput" placeholder="Date">
                                            @endif
                                            <label for="floatingInput">Date</label>
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="quantity" required class="form-control"  placeholder="Quantity">
                                            <label for="quantity">Quantity</label>
                                        </div>
                                        <span id="message" class="text-danger"></span>


                                        <div class="mb-3 form-floating">
                                            @if(isset($session_price))
                                            <input type="number" name="price" value="{{$session_price}}"  required class="form-control" id="floatingInput" placeholder="Cost">
                                          @else
                                          <input type="number" name="price" required class="form-control" id="floatingInput" placeholder="Price of one Item">
                                            @endif
                                            <label for="floatingTextarea">Price of one Item</label>
                                            @error('price')
                                            <div class="text-danger"> {{$message}} </div>
                                            @enderror
                                        </div>


                                        <div class="mb-3 form-floating">
                                            @if(isset($session_cost))
                                            <input type="number" name="cost" value="{{$session_cost}}"  required class="form-control" id="floatingInput" placeholder="Cost">
                                          @else
                                          <input type="number" name="cost" required class="form-control" id="floatingInput" placeholder="Cost">

                                            @endif
                                            <label for="floatingInput">Cost</label>
                                        </div>



                                        {{-- <div class="mt-3 form-check form-switch">
                                            <input class=" form-check-input" type="checkbox" name="remaining" role="switch"
                                                id="flexSwitchCheckDefault">
                                            <label class=" form-check-label" for="flexSwitchCheckDefault">Remaining Product
                                                </label>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="submit" value="Add" id="addBtn" class="btn btn-primary w-100">
                                </div>
                            </form>







                        </div>
                    </div>




                </div>
            </div>
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
    var date = $('#date').val();
// console.log(vehicle);
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
            'vehicle': vehicle,
            'date':date
        },
        success: function(response){
            if(response=='Quantity Not Available'){
            $('#message').text(response);
            $("#addBtn").prop('disabled', true);
                         }else{
                            $('#message').text(response);
                            $("#addBtn").prop('disabled', false);
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

