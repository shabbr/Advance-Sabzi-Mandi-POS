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
                            <h5 class="mb-4 ">Edit Customer</h5>

                            <form action="{{ route('updateCustomer',['id'=>$customer->id]) }}" method="post" class="row g-3">
                                @csrf
                                <div class="col-12 col-md-12">
                                    <div class="p-4 rounded bg-light">
                                        <h6 class="mb-4">Customer Details</h6>
                                        <div class="mb-3 form-floating">
                                            <input type="text" name="name" value="{{$customer->name}}" class="form-control" id="floatingInput" placeholder="name">
                                            <label for="floatingInput">Name</label>
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                           {{-- <div class="invalid-feedback">{{$message}}</div> --}}
                                            @enderror
                                        </div>

                                        <div class="mb-3 form-floating">
                                            <input type="text" name="phone" value="{{$customer->phone}}" class="form-control" id="floatingPassword" placeholder="phone">
                                            <label for="floatingPassword">Phone</label>
                                            @error('phone')
                                            <div class="text-danger"> {{$message}} </div>
                                            @enderror
                                        </div>
                                        <div class="form-floating">
                                            <textarea class="form-control" name="area"  placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px;">{{$customer->area}}</textarea>
                                            <label for="floatingTextarea">Area</label>
                                            @error('area')
                                            <div class="text-danger"> {{$message}} </div>
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

