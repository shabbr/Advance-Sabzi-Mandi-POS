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

                                                <option value="{{$sale->product_id}}" disabled selected>{{$sale->product->name}}</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="mb-3 form-floating">
                                            <select name="sender_id" required class="form-control js-example-basic-single" id="productSelect">

                                              <option value="{{$sale->seller->id}}" disabled selected>{{$sale->seller->name}}</option>


                                                @foreach($sellers as $seller)
                                                    <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 form-floating">
                                            <select name="sack_id" required class="form-control js-example-basic-single" id="sackSelect">

                                              <option value="{{$sale->sack->id}}" disabled selected>{{$sale->sack->name}}</option>
                                                @foreach($sacks as $sack)
                                                    <option value="{{ $sack->id }}">{{ $sack->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('sack_details')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="vehicle" id='vehicle'  value="{{$sale->vehicle}}"  required class="form-control" id="floatingInput" placeholder="Cost">
                                            <label for="floatingInput">Vehicle</label>
                                        </div>

                                        <div class="mb-3 form-floating"  >
                                            <select name="customer_id" required class="form-control js-example-basic-single" id="customerSelect"  >
                                                <option value="{{$sale->customer->id}}" disabled selected>{{$sale->customer->name}}</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <input type="number" value="{{$sale->quantity}}" name="quantity" required class="form-control" id="quantity" placeholder="Quantity">
                                            <label for="quantity">Quantity</label>
                                        </div>
                                        <span id="message" class="text-danger"></span>


                                        <div class="mb-3 form-floating">

                                          <input type="number" name="price" value="{{$sale->price}}" required class="form-control" id="floatingInput" placeholder="Price of one Item">
                                            <label for="floatingTextarea">Price of one Item</label>
                                            @error('price')
                                            <div class="text-danger"> {{$message}} </div>
                                            @enderror
                                        </div>


                                        <div class="mb-3 form-floating">

                                          <input type="number" value="{{$sale->cost}}" name="cost" required class="form-control" id="floatingInput" placeholder="Cost">

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


    //     $('#quantity').on('keyup change', function(){
    // var quantity = $('#quantity').val();
    // var vehicle = $('#vehicle').val();
    // var product_id = $('select[name="product_id"]').val();
    // var sender_id = $('select[name="sender_id"]').val();
    // var sack_id = $('select[name="sack_id"]').val();

//     // AJAX request
//     $.ajax({
//         url: '/check-quantity', // Replace with your AJAX URL
//         method: 'POST',
//         data: {
//             '_token': '{{ csrf_token() }}',
//             'quantity': quantity,
//             'product_id': product_id,
//             'sender_id': sender_id,
//             'sack_id': sack_id,
//             'vehicle': vehicle
//         },
//         success: function(response){
//             if(response=='Quantity Not Available'){
//             $('#message').text(response);
//             $("#addBtn").prop('disabled', true);
//                          }else{
//                             $('#message').text(response);
//                             $("#addBtn").prop('disabled', false);
//                          }
//             console.log(response);
//         },
//         error: function(xhr, status, error){
//             console.error(error);
//         }
//     });
// });

    });
</script>
            <!-- Form End -->

