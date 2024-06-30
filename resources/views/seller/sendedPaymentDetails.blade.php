@include('layouts.header')

<!-- Sidebar Start -->
@include('layouts.sidebar')
<!-- Sidebar End -->

<!-- Content Start -->
<div class="content">

    <!-- Navbar Start -->
    @include('layouts.navbar')
    <!-- Navbar End -->

    <!-- Form Start -->
    <div class="px-4 pt-4 container-fluid">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="p-4 rounded bg-light h-100 ">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        {{-- <h5 class="mb-0">Cash Details</h5> --}}
                        {{-- <a href="{{ route('expense') }}" class="btn btn-primary">Add payment </a> --}}
                    </div>

                    @foreach ($payments as $payment)
                    <strong> Sender's ID :</strong> {{$payment->seller->id}}<br>
                    <strong> Sender's Name :</strong> {{$payment->seller->name}}<br>

                   @php
        //                  $cust = DB::table('previous_sende_amounts')
        // ->select('amount') // Specify the columns$ you want to select
        // ->where('seller_id', $payment->seller_id) // Add a condition to select a specific row by customer_id
        // ->first();
        $cust = DB::table('sellers')
        ->select('amount') // Specify the columns$ you want to select
        ->where('id', $payment->seller_id) // Add a condition to select a specific row by customer_id
        ->first();
        // dd( $cust);
        if (!is_null($cust)) {
            echo '<strong> Previous Amount :'. $cust->amount.'</strong><br>';
            echo '<strong> Amount :'.$total_amount.'</strong><br>';
           $total_amount=$total_amount + $cust->amount;
           $remaining_amount= $total_amount -  $total_sended_payment;
        //    $amount->pure_amount=$amount->pure_amount +  $cust->amount;
       }else {
        $cust=0;
        // echo '<strong> Previous Amount :'.$cust.' </strong>                                                                                                            r>';

       }
                    @endphp
                    <strong class="mb-4">Total Sended Payment : </strong> {{$total_sended_payment}} <br>
<span style="color:rgb(39, 181, 39)">
    <strong class="mb-4">Total Amount :  {{$total_amount}} </strong><br>

</span>
<span style="color:rgb(249, 28, 28)">
                    <strong class="mb-4">Total Remaining Amount :  {{$remaining_amount}} </strong><br>
</span>

                    @break
                    @endforeach

                    <div class="flex-wrap mb-4 d-flex">
                        <!-- Download PDF Button -->
                        {{-- <button class="mr-2 btn btn-primary" onclick="downloadPDF()">Download PDF</button> --}}

                        <!-- Print Button -->
                    </div>

                    <div class="flex-wrap d-flex">
                        <!-- First Table: Sended Payment Details -->
                        <div class="flex-fill">
                            <h4 style="margin-top:3%; ">Total Amount Details</h4>
                            <div class="m-3 table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Total Amount</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($amounts))
                                        @foreach ($amounts as $amount)
                                        <tr>
                                            <td>{{$amount->total_amount}}</td>
                                            <td>{{$amount->created_at->format('d-m-Y')}}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <!-- Second Table: Another Payment Details -->
                        <div class="flex-fill">
                            <h4 style="margin-top:4%;">Sended Payment Details</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sended Amount</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($record_payments))
                                        @foreach ($record_payments as $payment)
                                        <tr>
                                            <td>{{$payment->payment}}</td>
                                            <td>{{$payment->created_at->format('d-m-Y')}}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <button class="mt-5 btn btn-primary col-12 " onclick="printPage()">Print</button>

                </div>

            </div>
        </div>
    </div>
    <!-- Form End -->

    <!-- Footer Start -->
    @include('layouts.footer')
</div>

<script src="{{asset('frontend/html2pdf/pdf.js')}}"></script>
<script>
 function downloadPDF() {
    // Target the content to be downloaded
    const content = document.querySelector('.content');

    // Options for PDF generation
    const opt = {
        margin:       1,
        filename:     'payment_details.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
    };

    // Call the html2pdf library
    html2pdf().from(content).set(opt).save();
}


    function printPage() {
        window.print();
    }
</script>
