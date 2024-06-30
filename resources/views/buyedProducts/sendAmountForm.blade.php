@include('layouts.header')

<!-- Sidebar Start -->
@include('layouts.sidebar')
<!-- Sidebar End -->

<!-- Content Start -->
<div class="content">
    <!-- Form Start -->

        <form action="{{ route('sendAmount') }}" method="post" class="mt-5 row g-3">
            @csrf
            <div class="col-12 col-sm-6 col-xl-12 col-md-12">
                <div class="p-4 rounded bg-light">
                    <input type="hidden" name='seller_id' value="{{$sellerId}}">
                    <input type="hidden" name='date' value="{{$date}}">
                    <input type="hidden" name='vehicle' value="{{$vehicle}}">

                    <div class="mb-3 form-floating">
                        <input type="number" name="total_amount" value="{{$total_amount}}" class="form-control" disabled id="floatingInput" placeholder="Quantity">
                        <label for="floatingInput">Total Amount</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="number" name="payment"  class="form-control"   id="floatingInput" placeholder="Quantity">
                        <label for="floatingInput">Payment</label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <input type="submit" value="Sended" class="btn btn-primary w-100">
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
