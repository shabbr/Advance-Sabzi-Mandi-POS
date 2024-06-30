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
                            <h5 class="mb-4 ">Payment</h5>

                            <form action="{{ route('sendedPayment') }}" method="post" class="row g-3">
                                @csrf
                                <input type="hidden" name='seller_id' value='{{$seller->id}}' >
                                <div class="col-12 col-md-12">
                                    <div class="p-4 rounded bg-light">
                                        <h6 class="mb-4">Sender's Details</h6>
                                        <div class="mb-3 form-floating">
                                            <input type="text" name="name" value="{{$seller->name}}" class="form-control" id="floatingInput" placeholder="name" disabled>
                                            <label for="floatingInput">Name</label>
                                           
                                        </div>

                                        <div class="mb-3 form-floating">
                                            <input type="text" name="payment"  class="form-control" id="floatingPassword" placeholder="phone">
                                            <label for="floatingPassword">Payment</label>
                                          
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

