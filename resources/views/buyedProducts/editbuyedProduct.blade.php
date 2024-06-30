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

                            <form action="{{route('updateBuyedProduct')}}" method="POST" class="row g-3">
                                @csrf
                                <input type="hidden" name='id' value="{{$id}}">
                                <div class="col-12 col-md-12">
                                    <div class="mb-4 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-4"> Enter Buyed Product Details</h6>
                                        {{-- <a href="{{route('showSales')}}" class="btn btn-primary">Show Sales</a> --}}

                                    </div>


                                    <div class="p-4 rounded bg-light">






                                        <div class="mb-3 form-floating">
                                            <select name="product_id" required class="form-control js-example-basic-single" id="productSelect">
                                                <option value="{{$product->id}}" selected >{{$product->product->name}}</option>


                                                @foreach($products_list as $produst_list)
                                                    <option value="{{ $produst_list->id }}">{{ $produst_list->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 form-floating">
                                            <select name="sack_id" required class="form-control js-example-basic-single" id="sackSelect">

                                                <option value="{{$product->sack->id}}" disabled >{{$product->sack->name}}</option>

                                                @foreach($sacks as $sack)
                                                    <option value="{{ $sack->id }}">{{ $sack->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('sack_details')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <input type="number" name="vehicle" id='vehicle'  value="{{$product->vehicle}}"  required class="form-control" id="floatingInput" placeholder="Cost">
                                              <label for="floatingInput">Vehicle</label>
                                        </div>


                                        <div class="mb-3 form-floating">
                                            <input type="number" name="quantity" value="{{$product->quantity}}" required class="form-control" id="quantity" placeholder="Quantity">
                                            <label for="quantity">Quantity</label>
                                        </div>
                                        <span id="message" class="text-danger"></span>

                                        <div class="mb-3 form-floating">
                                            <input type="number" name="remaining" value="{{$product->remaining}}" required class="form-control" id="quantity" placeholder="Quantity">
                                            <label for="quantity">Remaining</label>
                                        </div>







                                        {{-- <div class="mt-3 form-check form-switch">
                                            <input class=" form-check-input" type="checkbox" name="remaining" role="switch"
                                                id="flexSwitchCheckDefault">
                                            <label class=" form-check-label" for="flexSwitchCheckDefault">Remaining Product
                                                </label>    q
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


            <!-- Form End -->

