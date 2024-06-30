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
                                    <h5 class="mb-0">Received Products Records</h5>
                                   {{-- <a href="{{ route('productForm') }}" class="btn btn-primary">Add product </a> --}}
                                   <a href="{{ route('buyedProductForm') }}" class="btn btn-primary">Add Received Products</a>

                                </div>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4">Received Products List</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Seller Name</th>
                                <th scope="col">Vehicle</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Expenses</th>
                                <th scope="col">Pure Amount</th>
                                <th scope="col">Date</th>

                                {{-- <th scope="col">Received Amount</th> --}}
                                <th scope="col"> Expenses</th>
                                <th scope="col"> Bill</th>
                                <th>Edit Amount</th>
                                <th scope="col"> Sended Payment</th>
                                <th>Update Payment</th>

                                {{-- <th>Delete</th> --}}
                                <th scope="col">Products </th>
                                <th>Sale Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($buyedProducts))
                            @foreach ($buyedProducts as $product)
                            <tr>

                                <td> {{$product->seller->name}} </td>
                                <td> {{$product->vehicle}} </td>
                                {{-- <td> {{$product->total_quantity}} </td> --}}
                                @php
                                    $sellerIds = $amounts->pluck('seller_id')->toArray();

                                    $selIds=$saleAmounts->pluck('seller_id')->toArray();

                            @endphp



{{-- @foreach ($saleAmounts as $saleAmount)
@if ($product->seller->id==$saleAmount->seller_id && $product->vehicle == $saleAmount->vehicle )
<td> {{$saleAmount->total_price}} </td>
@endif
@endforeach--}}
@php
// dd($product->id);
// $ids[]=$product->id;
// foreach ($saleAmounts as $saleAmount){
    $total_price = \App\Models\SaleAmount::select('seller_id','vehicle')
       ->where('seller_id',$product->seller_id)
       ->where('vehicle',$product->vehicle)
    ->whereDate('created_at', $date)
        ->groupBy('seller_id', 'vehicle')
        ->sum('price');
 if (!empty($total_price)) {
         echo '<td>'.$total_price.'</td>';
}else{
    echo '<td>0</td>';
    }



@endphp







                                       @php
                                           $data=DB::select("SELECT * FROM seller_amounts WHERE seller_id='$product->seller_id' AND vehicle= '$product->vehicle'");
                                           if(!empty($data)){
                                             foreach ($data as  $value) {
                                                echo '<td>'.$value->total_expenses.'</td>' ;
                                                echo '<td>'.$value->pure_amount.'</td>' ;
                                             }
                                        }else{
                                                echo '<td>0</td>
                                                 <td>0</td>';
                                            }

                                       @endphp

                                      <td>{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }} </td>
                                <td > <a href="{{route('payment',['sellerId'=>$product->seller_id,'vehicle'=>$product->vehicle,'date'=>$date])}}"  class="btn btn-success bg-success">Expenses</a> </td>
                                <td > <a href="{{route('amountDetails',['sellerId'=>$product->seller_id,'vehicle'=>$product->vehicle,'date'=>$date])}}"  class="btn btn-success bg-success">Bill</a> </td>
                                <td > <a href="{{route('editAmount',['sellerId'=>$product->seller_id,'vehicle'=>$product->vehicle,'date'=>$date])}}"  class="btn btn-success bg-success">Edit Expenses</a> </td>
                                <td > <a href="{{route('sendAmountForm',['sellerId'=>$product->seller_id,'vehicle'=>$product->vehicle,'date'=>$date])}}"  class="btn btn-success bg-success">Sended Payment</a> </td>
                                <td > <a href="{{route('updateAmountForm',['sellerId'=>$product->seller_id,'vehicle'=>$product->vehicle,'date'=>$date])}}"  class="btn btn-success bg-success">Update Payment</a> </td>

                                {{-- <td > <a href="{{route('deleteVehicle',['sellerId'=>$product->seller_id,'vehicle'=>$product->vehicle,'date'=>$date])}}"  class="btn btn-primary bg-primary">Delete</a> </td> --}}
                                <td > <a href="{{route('perSellerDetails',['sellerId'=>$product->seller_id,'vehicle'=>$product->vehicle,'date'=>$date])}}"  class="btn btn-primary bg-primary">Details</a> </td>
                                <td > <a href="{{route('sellerSaleDetails',['sellerId'=>$product->seller_id,'vehicle'=>$product->vehicle,'date'=>$date])}}"  class="btn btn-primary bg-primary">Sale Details</a> </td>

                            </tr>
                            @endforeach

                            @endif

                        </tbody>
                    </table>

                </div>
            </div>










        </div>
    </div>
</div>



                        </div>
                    </div>




                </div>
            </div>
            <!-- Form End -->



               <!-- Footer Start -->
               @include('layouts.footer')



