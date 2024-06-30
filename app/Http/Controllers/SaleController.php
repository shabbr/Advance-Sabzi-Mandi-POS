<?php

namespace App\Http\Controllers;

use App\Exports\BillExport;
use App\Models\BuyedProduct;
use App\Models\Customer;
use App\Models\CustomSack;
use App\Models\Payment;
use App\Models\PreviousCustomerAmount;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleAmount;
use App\Models\Seller;
use App\Models\TodayAmount;
use App\Models\YesterdayAmount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use function Laravel\Prompts\alert;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showSales()
    {
        $currentDate=Carbon::now()->toDateString();
        $sales = Sale::select( DB::raw('GROUP_CONCAT(DISTINCT id) as id'),
        DB::raw('GROUP_CONCAT(DISTINCT seller_id) as seller_id'),
        'customer_id',DB::raw('SUM(quantity) as total_quantity'),
         DB::raw('SUM(total_price) as total_price'))
    ->groupBy('customer_id')
    ->whereDate('created_at',$currentDate)
    ->get();
    $payments=Payment::select( DB::raw('GROUP_CONCAT(DISTINCT id) as id'),
        'customer_id','payment_status',
        DB::raw('SUM(recieved_payment) as recieved_payment'))
        ->where('payment_status','cash')
    ->groupBy('customer_id','payment_status')
    ->whereDate('created_at',$currentDate)->get();
    // return $payments;
    return view('sales.showSale',compact(['sales','payments']));
    }


 public function editTodayAmount($customerId){
    $currentDate=Carbon::now()->toDateString();
    $payments=Payment::select( DB::raw('GROUP_CONCAT(DISTINCT id) as id'),
    'customer_id','payment_status',
    DB::raw('SUM(recieved_payment) as recieved_payment'))
    ->where('payment_status','cash')
    ->where('customer_id',$customerId)
->groupBy('customer_id','payment_status')
->whereDate('created_at',$currentDate)->first();


$id=$payments->id;
$recieved_payment=$payments->recieved_payment;

return view('sales.editTodayAmount',compact('recieved_payment','id'));
 }

 public function updateTodayPayment(Request $request){
    $payment=Payment::find($request->id);
    $payment->recieved_payment=$request->recieved_payment;
    $payment->save();
      return redirect()->route('showSales');
   }
    /**
     * Show the form for creating a new resource.
     */
    public function saleForm()
    {
        // for($i=1 ; $i<293 ; $i++){
        // $sale=Sale::find($i);
        // $sale->created_at='2024-05-18 05:33:47';
        // $sale->save();
        // }
        // return 'done';
        //         for($i=439; $i<476 ;$i++){

// //  echo $i."<br>";

//                         $sale=new Sale();
//                         $sale->customer_id=$i;
//                         $sale->product_id=0;
//                         $sale->seller_id=0;
//                         $sale->vehicle=0;
//                         $sale->sack_id=0;
//                         $sale->quantity=0;
//                         $sale->total_product_price= 0;
//                         $sale->price=0;
//                         $sale->cost=0;
//                         $sale->total_price=0;
//                         $sale->save();
//          }
//          return 'done';
        $customers=Customer::where('status','active')->get();
        $products=Product::get();
        $sacks=CustomSack::get();
        $sellers=Seller::get();
        $currentDate=Carbon::now()->toDateString();

        return view('sales.saleForm',compact(['customers','products','sacks','sellers','currentDate']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addSale(Request $request)
    {



//         for($i=1; $i<359 ;$i++){

// //  echo $i."<br>";

//                         $sale=new Sale();
//                         $sale->customer_id=$i;
//                         $sale->product_id=0;
//                         $sale->seller_id=0;
//                         $sale->vehicle=0;
//                         $sale->sack_id=0;
//                         $sale->quantity=0;
//                         $sale->total_product_price= 0;
//                         $sale->price=0;
//                         $sale->cost=0;
//                         $sale->total_price=0;
//                         $sale->save();
//          }
//          return 'done';

// for($i=1; $i<359 ;$i++){

// }













        // return $request;
        $date=Carbon::now()->format('Y-m-d');


        if(isset($request->remaining)){
            $date=Carbon::now();
            // return $date;
            $yesterdayDate=Carbon::now()->subDay()->toDateString();
            $buyedProduct=BuyedProduct::where('seller_id',$request->sender_id)
                          ->where('product_id',$request->product_id)
                          ->where('sack_id',$request->sack_id)
                          ->where('vehicle',$request->vehicle)
                          ->whereDate('created_at',$yesterdayDate)->first();
            if(empty($buyedProduct)){
                return 'This Sender never sends this Product Yesterday';
            }else{

                   $remainingQuantity= $buyedProduct->remaining - $request->quantity;
                   $buyedProduct->remaining=$remainingQuantity;
                   $buyedProduct->save();

                    $sale=new Sale();
                    $sale->customer_id=$request->customer_id;
                    $sale->product_id=$request->product_id;
                    $sale->seller_id=$request->sender_id;
                    $sale->vehicle=$request->vehicle;
                    $sale->sack_id=$request->sack_id;
                    $sale->quantity=$request->quantity;
                    $sale->price=$request->price;
                    $sale->cost=$request->cost;
                    $sale->total_product_price= $request->price * $request->quantity;
                    $sale->total_price= ( $request->price * $request->quantity) + ( $request->cost * $request->quantity);
                    $sale->remaining_product='1';
                    $sale->save();


                    $price=new SaleAmount();
                    $price->seller_id=$request->sender_id;
                    $price->vehicle=$request->vehicle;
                    $price->price= $request->price * $request->quantity;
                    $price->save();
                    return redirect()->route('saleForm');

               }
        }else{
            //if product of today not from remaining

            // $buyedProduct=BuyedProduct::select('remaining')
            // ->where('seller_id',$request->sender_id)
            // ->whereDate('created_at',$date)->get();
            // return $buyedProduct;
// return $request;
            $currentDate=Carbon::now()->toDateString();
            $buyedProduct=BuyedProduct::where('seller_id',$request->sender_id)
                          ->where('product_id',$request->product_id)
                          ->where('sack_id',$request->sack_id)
                          ->where('vehicle',$request->vehicle)
                          ->whereDate('created_at',$request->created_at)->first();
            // return $buyedProduct;
            if(empty($buyedProduct)){
                return 'This Sender never sends this Product today';
            }else{

                if($buyedProduct->remaining<$request->quantity){
                    return 'Product Quantity is not available';
                }


                   $remainingQuantity= $buyedProduct->remaining-$request->quantity;
                   $buyedProduct->remaining=$remainingQuantity;

                   $buyedProduct->save();
                    $sale=new Sale();
                    $sale->customer_id=$request->customer_id;
                    $sale->product_id=$request->product_id;
                    $sale->seller_id=$request->sender_id;
                    $sale->vehicle=$request->vehicle;
                    $sale->sack_id=$request->sack_id;
                    $sale->quantity=$request->quantity;
                    $sale->total_product_price= $request->price * $request->quantity;
                    $sale->price=$request->price;
                    $sale->cost=$request->cost;
                    $sale->total_price= ( $request->price * $request->quantity) + ( $request->cost * $request->quantity);
                   $sale->created_at=$request->created_at;
                    $sale->save();
                     $last_sale=Sale::latest()->first();
                    //  return $last_sale;

                    $price=new SaleAmount();
                    $price->sale_id=$last_sale->id;
                    $price->seller_id=$request->sender_id;
                    $price->vehicle=$request->vehicle;
                    $price->price= $request->price * $request->quantity;
                    $price->created_at=$request->created_at;

                    $price->save();

 $session_sender = Seller::select('name')->where('id', $request->sender_id)->first()->name;
$session_sender_id =  $request->sender_id;
// return $session_sender;
$session_customer = Customer::select('name')->where('id', $request->customer_id)->first()->name;
$session_customer_id =  $request->customer_id;

$session_product = Product::select('name')->where('id', $request->product_id)->first()->name;
$session_product_id =$request->product_id;

$session_sack = CustomSack::select('name')->where('id', $request->sack_id)->first()->name;
$session_sack_id =$request->sack_id;

$session_cost = $request->cost;
$session_vehicle = $request->vehicle;
$session_price=$request->price;
$session_date=$request->created_at;

$customers=Customer::where('status','active')->get();
$products=Product::get();
$sacks=CustomSack::get();
$sellers=Seller::get();
return view('sales.saleForm',
compact(['customers','products','sacks','sellers',
'session_product','session_sender','session_sender_id','session_customer','session_customer_id','session_product_id','session_sack','session_sack_id','session_cost',
'session_vehicle','session_price','session_date']));
               }
        }

        }


        public function checkQuantity(Request $request)
{
// return 'yes';
    $currentDate=Carbon::now()->toDateString();
    $remaining=BuyedProduct::where('seller_id',$request->sender_id)
    ->where('product_id',$request->product_id)
    ->where('sack_id',$request->sack_id)
    ->where('vehicle',$request->vehicle)
    ->whereDate('created_at',$request->date)->sum('remaining');
    $quantity = $request->input('quantity');
    // return $buyedProduct;

    // Your logic to check quantity
    // For example, check if quantity is greater than 10
   if($remaining<$request->quantity){
                    return 'Quantity Not Available';
                } else {
        return '';
    }
}


    /**
     * Display the specified resource.
     */
    public function saleDetails( $customerId)
    {
        $currentDate=Carbon::now()->toDateString();
        $sales=Sale::whereDate('created_at',$currentDate)
                     ->where('customer_id',$customerId)
                     ->get();
           return view('sales.saleDetails',compact(['sales']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editSale( $id)
    {
        $customers=Customer::where('status','active')->get();
        $products=Product::get();
        $sacks=CustomSack::get();
        $sellers=Seller::get();
        $saleData=Sale::find($id);

       $vehicle= $saleData->vehicle;
        // return $saleData->cost;
        return view('sales.editSale',compact(['saleData','customers','products','sacks','sellers','vehicle']));

    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSale(Request $request, string $id)
    {


        // return $request;
        $sale=Sale::find($id);
        $previous_sale_quantity=$sale->quantity;
        // return $sale;
        $cost=$request->cost*$request->quantity;
        $customerId=$sale->customer_id;

        $sale->customer_id=$request->customer_id;
        $sale->product_id=$request->product_id;
        $sale->sack_id=$request->sack_id;
        $sale->quantity=$request->quantity;
        $sale->cost=$request->cost;
        $sale->price=$request->price;
        $sale->total_price=($request->price * $request->quantity)+$cost;
        $sale->total_product_price=$request->price * $request->quantity;

        // if($request->paymentStatus=='on'){
        // $sale->payment_status='paid';
        // }
        $sale->save();


        $update_sale_amount=SaleAmount::where('sale_id',$id)->first();
        $update_sale_amount->price= $request->price * $request->quantity;
        $update_sale_amount->save();

        // return $update_sale_amount->created_at->format('Y-m-d');
        // return $request->customer_id;


        $buyedProduct=BuyedProduct::where('seller_id',$request->sender_id)
        ->where('product_id',$request->product_id)
        ->where('sack_id',$request->sack_id)
        ->where('vehicle',$request->vehicle)
        ->whereDate('created_at',$update_sale_amount->created_at->format('Y-m-d'))->first();
// return $buyedProduct;
  if($previous_sale_quantity > $request->quantity ){
             $buyedProduct->remaining=$buyedProduct->remaining +  $request->quantity;
  }elseif($previous_sale_quantity < $request->quantity){
    $quantity_remaining=$previous_sale_quantity - $request->quantity;
    $buyedProduct->remaining=$buyedProduct->remaining + $quantity_remaining;

  }
$buyedProduct->save();

        return redirect('saleDetails/'.$customerId);






    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteSale( $id)
    {
        $sale=Sale::find($id);
        //restore deleted quantity
      $saleDate=  $sale->created_at->format('Y-m-d');
         $product=BuyedProduct::where('seller_id',$sale->seller_id)
         ->where('vehicle',$sale->vehicle)
         ->where('product_id',$sale->product_id)
         ->where('sack_id',$sale->sack_id)
         ->whereDate('created_at',$saleDate)
         ->first();
         $product->remaining=$product->remaining + $sale->quantity;
         $product->save();
        $customerId=$sale->customer_id;

        $saleAmount=SaleAmount::where('created_at',$sale->created_at)->first();
        $saleAmount->delete();
        $sale->delete();
        return redirect('saleDetails/'.$customerId);


    }

    public function addPaymentForm( $customerId,$gd)
    {
      return view('sales.addPayment',compact(['customerId','gd']));
    }

    public function addPayment(Request $request)
    {
        $currentDate=Carbon::now()->toDateString();
        $payments=Payment::select( DB::raw('GROUP_CONCAT(DISTINCT id) as id'),
        'customer_id','payment_status',
        DB::raw('SUM(recieved_payment) as recieved_payment'))
        ->where('payment_status','cash')
        ->where('customer_id',$request->customerId)
    ->groupBy('customer_id','payment_status')
    ->whereDate('created_at',$currentDate)->first();

 if(empty($payments)){
    $payment=new Payment();
    $payment->customer_id=$request->customerId;
    $payment->recieved_payment=$request->received_payment;
    $payment->payment_status=$request->payment_status;
    $payment->save();
    return redirect()->route('showSales');
 }else {
    return 'You already added payment';
 }
// return $payments;

        // $todayPayment=new TodayAmount();
        // $todayPayment->customer_id=$request->customerId;
        // $todayPayment->recieved_amount=$request->received_payment;
        // $todayPayment->save();
        // return redirect()->route('showSales');
    }





    //yesterday

    public function showYesterdaySales()
    {
        $currentDate=Carbon::now();
        $yesterday=$currentDate->subDay();
        $formatedYesterday=$yesterday->toDateString();
        $sales = Sale::select( DB::raw('GROUP_CONCAT(DISTINCT id) as id'),'customer_id',DB::raw('SUM(quantity) as total_quantity'),
         DB::raw('SUM(total_price) as total_price'))
    ->groupBy('customer_id')
    ->whereDate('created_at',$formatedYesterday)
    ->get();
    $payments=YesterdayAmount::select(
        'customer_id',
        DB::raw('SUM(recieved_amount) as recieved_payment'))
    ->groupBy('customer_id')
    ->whereDate('yesterday',$formatedYesterday)->get();
    // return $payments;
    return view('sales.showYesterdaySales',compact(['sales','payments']));
    }

    public function addYesterdayPaymentForm( $id,$gd)
    {
      return view('sales.addYesterdayPaymentForm',compact(['id','gd']));
    }

    public function addYesterdayPayment(Request $request)
    {
       $payment=new Payment();
      $payment->customer_id=$request->customerId;
      $payment->recieved_payment=$request->received_payment;
        $payment->save();

        $currentDate=Carbon::now();
        $yesterday=$currentDate->subDay();
        $formatedYesterday=$yesterday->toDateString();
        $yesterdayPayment=new YesterdayAmount();
        $yesterdayPayment->customer_id=$request->customerId;
        $yesterdayPayment->recieved_amount=$request->received_payment;
        $yesterdayPayment->yesterday=$formatedYesterday;
          $yesterdayPayment->save();
      return redirect()->route('showYesterdaySales');
    }



    public function yesterdaySaleDetails( $customerId)
    {
        $currentDate=Carbon::now();
        $yesterday=$currentDate->subDay();
        $formatedYesterday=$yesterday->toDateString();
        $sales=Sale::whereDate('created_at',$formatedYesterday)
                     ->where('customer_id',$customerId)
                     ->get();
           return view('sales.yesterdaySaleDetails',compact(['sales']));
    }




// overall sales record
public function showSalesRecords()
{
   $sales=Sale::select(
    DB::raw('DATE(created_at) as created_date'),
        DB::raw('SUM(quantity) as total_quantity'),
        DB::raw('SUM(total_price) as total_price'))
   ->groupBy(DB::raw('DATE(created_at)'))
   ->orderBy('created_at','DESC')
   ->get();
    return view('sales.showSalesRecords',compact(['sales']));
}



public function saleRecordsDetails( $date)
    {
// return $date;
        $sales = Sale::select( DB::raw('GROUP_CONCAT(DISTINCT id) as id'),'customer_id',DB::raw('SUM(quantity) as total_quantity'),
        DB::raw('SUM(total_price) as total_price'))
   ->groupBy('customer_id')
   ->whereDate('created_at',$date)
   ->get();
//    return $sales->toArray();
           return view('sales.salesRecordsDetails',compact(['sales','date']));
    }


    public function allSales(){
        $sales=Sale::with('product')->with('sack')->with('seller')->with('customer')->get();
       $payments=Payment::where('payment_status','!=','borrow')->get();
        return view('sales.allSales',compact(['sales','payments']));
    }
    public function oldSaleEdit($id,$date){
        $sale=Sale::with('product')->with('sack')->with('seller')->with('customer')->find($id);

        $customers=Customer::where('status','active')->get();
        $products=Product::get();
        $sacks=CustomSack::get();
        $sellers=Seller::get();

        return view('sales.oldSaleEdit',compact(['customers','products','sacks','sellers','sale']));
    }

    public function addOldPaymentForm( $customerId,$gd,$created_at)
    {
      return view('sales.addOldPaymentForm',compact(['customerId','gd','created_at']));
    }


    public function addOldPayment(Request $request)
    {
        $payment=new Payment();
    $payment->customer_id=$request->customerId;
    $payment->recieved_payment=$request->received_payment;
    $payment->payment_status=$request->payment_status;
    $payment->created_at=$request->created_at;
    $payment->save();
    session()->flash('success', 'Payment added successfully!');
    return redirect()->route('allSales');
    }


public function recordDetails( $customerId,$date)
    {
        $sales=Sale::where('customer_id',$customerId)
                     ->whereDate('created_at',$date)
                     ->get();


      $totalPayments=Sale::select(DB::raw('SUM(total_price) as total_price'))
      ->whereDate('created_at','<',$date)
      ->where('customer_id',$customerId)
      ->get();

    //   $previousAmount=PreviousCustomerAmount::select('amount')->where('customer_id',$customerId)->first();
    $previousAmount=Customer::select('amount')->where('id',$customerId)->first();

    //   return $previousAmount;
      $received=Payment::select(DB::raw('SUM(recieved_payment) as recieved_payment'))
      ->whereDate('created_at','<',$date)
      ->where('customer_id',$customerId)
      ->get();
    //   return $totalPayments;
    if(!is_null($previousAmount)){
    $totalAmount= $totalPayments[0]['total_price'] + $previousAmount->amount;
    $remainingAmount=$totalAmount - $received[0]['recieved_payment'];

    }else{
        $remainingAmount=$totalPayments[0]['total_price'] - $received[0]['recieved_payment'];

    }
    // return $remainingAmount;

           return view('sales.recordDetails',compact(['sales','remainingAmount']));
    }



    public function excelExport(){
$currentDate=Carbon::now()->toDateString();
 $formatedDate=Carbon::now()->format('d-m-Y');
        // Fetch total payments grouped by customer_id from the Sale table
        $totalPayments = Sale::select('customer_id',
            DB::raw('SUM(total_price) as total_price'))
            ->whereDate('created_at', '<', $currentDate)
            ->groupBy('customer_id')
            ->with('customer')
            ->get();
            // return $totalPayments->total_price;
$previousAmount=Customer::get();

        // Fetch received payments grouped by customer_id from the Payment table
        $received = Payment::select('customer_id',
            DB::raw('SUM(recieved_payment) as recieved_payment'))
            ->whereDate('created_at', '<', $currentDate)
            ->groupBy('customer_id')
            ->get();

        // Fetch today's payments grouped by customer_id from the Sale table
        $todayPayments = Sale::select('customer_id',
            DB::raw('SUM(total_price) as total_price'))
            ->whereDate('created_at', $currentDate)
            ->groupBy('customer_id')
            ->get();

        // Fetch today's payments grouped by customer_id from the Payment table
        $amountPaidToday = Payment::select('customer_id',
            DB::raw('SUM(recieved_payment) as recieved_payment'))
            ->whereDate('created_at', $currentDate)
            ->groupBy('customer_id')
            ->get();

            // Merge the results based on customer_id
        $mergedData = [];
        foreach ($totalPayments as $totalPayment) {
            $customerId = $totalPayment->customer_id;
            $totalPrice = $totalPayment->total_price;
            $customer_name=$totalPayment->customer->name;
            // Initialize recieved_payment, today_payment, and paid_today as 0
            $recievedPayment = 0;
            $todayPayment = 0;
            $paidToday = 0;
$oldAmount=0;
            foreach ($previousAmount as $previous) {
                if ($previous->id == $customerId) {
                    $oldAmount = $previous->amount;
                    break;
                }
            }

            // Find the corresponding recieved_payment for the customer_id
            foreach ($received as $payment) {
                if ($payment->customer_id == $customerId) {
                    $recievedPayment = $payment->recieved_payment;
                    break;
                }
            }

            // Find the corresponding today_payment for the customer_id
            foreach ($todayPayments as $payment) {
                if ($payment->customer_id == $customerId) {
                    $todayPayment = $payment->total_price;
                    break;
                }
            }

            // Find the corresponding paid_today for the customer_id
            foreach ($amountPaidToday as $payment) {
                if ($payment->customer_id == $customerId) {
                    $paidToday = $payment->recieved_payment;
                    break;
                }
            }

            // Merge data for the customer_id
            $mergedData[] = [
                'date' => $formatedDate,
        //ab isnay ktnay or dainayy hain
        'grand_total' => ($oldAmount + $totalPrice - $recievedPayment) + ($todayPayment - $paidToday),
  //koi nakad ya wsoli ma rkam di customer na
  'paid_today' => $paidToday,
// aj ka bill ktna bna
'today_payment' => $todayPayment,
 //sabqa rakam
 'remaining_payment' =>$oldAmount + $totalPrice - $recievedPayment,
 'customer_name' => $customer_name,
//   'customer_id' => $customerId
                // 'total_price' => $totalPrice,
                // 'recieved_payment' => $recievedPayment,

                ];
        }
        $mergedData = collect($mergedData);
        return Excel::download(new BillExport($mergedData), 'Bill Amounts.xlsx');

       }




    //payment records
    public function showPaymentRecords(){

       $totalPayments=Sale::select(DB::raw('SUM(total_price) as total_price'))->get();
       $received=Payment::select(DB::raw('SUM(recieved_payment) as recieved_payment'))->get();
    // $previousAmount=  PreviousCustomerAmount::sum('amount');
    $previousAmount=  Customer::sum('amount');



// return $previousAmount;
    // return $previousAmount;
       $total= $totalPayments[0]['total_price']+ $previousAmount;
       $remainingAmount=$total - $received[0]['recieved_payment'];
// return $received[0]['recieved_payment'];
// return $received;
        $sales=Sale::select(
            'customer_id',
            DB::raw('MIN(id) as id'),
            DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('SUM(total_price) as total_price'),
                DB::raw('SUM(recieved_payment) as recieved_payment'))
           ->groupBy('customer_id')
           ->get();

//    return $sales->toArray();
$currentDate=Carbon::now()->toDateString();
$collectedAmounts=Payment::select( DB::raw('SUM(recieved_payment) as recieved_payment'),
DB::raw('DATE(created_at) as created_at'),'payment_status')
->whereDate('created_at',$currentDate)
->groupBy('payment_status',DB::raw('DATE(created_at)'))
->get();


       $payments=Payment::get();

           return view('sales.PaymentRecordsList',compact(['sales','payments','remainingAmount','collectedAmounts']));
    }


    public function paymentRecord($customerId){

                $sales = Sale::select(
                    'customer_id',
                    DB::raw('DATE(created_at) as created_date'),
                    DB::raw('SUM(quantity) as total_quantity'),
                    DB::raw('SUM(total_price) as total_price'),
                    DB::raw('SUM(recieved_payment) as recieved_payment')
                )
                ->where('customer_id', $customerId)
                ->groupBy('customer_id', 'created_date')
                ->orderBy('created_at','DESC')
                ->get();
           return view('sales.paymentRecord',compact(['sales']));
    }

    public function paymentRecordDetails($customerId,$date){
        $sales = Sale::where('customer_id',$customerId)
                       ->whereDate('created_at',$date)
                       ->get();

//    return $sales->toArray();
           return view('sales.paymentRecordDetails',compact(['sales']));

    }

    public function paymentForm($customerId,$gd){

        $totalPayments=Sale::select(DB::raw('SUM(total_price) as total_price'))
        ->where('customer_id',$customerId)
        ->get();
        $previousAmount=Customer::select('amount')->where('id',$customerId)->first();
        // return $previousAmount;
    if(!is_null($previousAmount->amount)){
          $grandTotal= $totalPayments[0]['total_price'] + $previousAmount->amount;
    }else{
        $grandTotal= $totalPayments[0]['total_price'];
    }
        $received=Payment::select(DB::raw('SUM(recieved_payment) as recieved_payment'))
        ->where('customer_id',$customerId)
        ->get();
     $remainingAmount=$grandTotal - $received[0]['recieved_payment'];
        return view('sales.paymentForm',compact(['customerId','gd','remainingAmount']));
    }

    public function paymentDetails(Request $request){
            $customerId=$request->customerId;
        $totalPrice=$request->totalPrice;
        $overall_price=$request->overall_price;
        // return $overall_price;
        $previousAmount=$overall_price - $totalPrice;

        $remainingAmount=$request->remainingAmount;



        $payments=Payment::where('customer_id',$customerId)->get();
        return view('sales.paymentDetails',compact(['payments','overall_price','previousAmount','totalPrice','remainingAmount']));
    }
    public function paymentData(Request $request)
    {

    $payment=new Payment();
    $payment->customer_id=$request->customerId;
    $payment->recieved_payment=$request->received_payment;
    $payment->payment_status=$request->payment_status;
    $payment->created_at=$request->created_at;
    $payment->save();
      return redirect()->route('showPaymentRecords');
    }

    public function totalProductQuantity(){
//         $currentDate=Carbon::now()->toDateString();

//         $eachProductQuantity = BuyedProduct::select('product_id','seller_id' ,DB::raw('GROUP_CONCAT(DISTINCT quantity) as quantity'))
//         ->groupBy('product_id','seller_id')->with('product')
//         ->whereDate('created_at',$currentDate)
//         ->get();

// // dd($eachProductQuantity);
//         $eachProductSaleQuantity = Sale::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
//         ->groupBy('product_id')
//         ->whereDate('created_at',$currentDate)
//         ->get();

//         // return $eachProductSaleQuantity;
//     return view('sales.showRemainingProducts',compact(['eachProductQuantity','eachProductSaleQuantity']));
    }

    public function editpayment($id){
        $payment=Payment::find($id);
        return view('sales.editPayment',compact('payment'));

    }
    public function updatepayment(Request $request,$id){
        $payment=Payment::find($id);
        $payment->recieved_payment=$request->received_payment;
        $payment->save();
        return redirect()->route('showPaymentRecords');

    }

    public function deletepayment($id){
        $payment=Payment::find($id)->delete();
        return redirect()->route('showPaymentRecords');
    }

    public function collectedAmount(){
        $payments=Payment::select( DB::raw('SUM(recieved_payment) as recieved_payment'),
        DB::raw('DATE(created_at) as created_at'),'payment_status')
        ->where('payment_status','borrow')
        ->groupBy('payment_status',DB::raw('DATE(created_at)'))
        ->orderBy('created_at','DESC')
        ->get();
        return view('sales.collectedAmount',compact('payments'));
    }

    public function collectedAmountDetails($date){
        $payments=Payment::with('customer')
        ->where('payment_status','borrow')
        ->whereDate('created_at',$date)
        ->get();
        // dd($payments);
        return view('sales.collectedAmountDetails',compact('payments'));
    }

    public function editCollectedAmount($id){
        $payment=Payment::find($id);
        // dd($payments);
        return view('sales.editCollectedAmount',compact('payment'));
    }


    public function updateCollectedAmount(Request $request){
        $payment=Payment::find($request->id);
        // dd($payments);
        $payment->recieved_payment=$request->received_payment;
        $payment->save();
        return redirect()->route('showPaymentRecords');
    }



    // public function oldSales(){
    //     for($i=1 ; $i<201 ; $i++ ){
    //         $sale=new Sale();
    //         $sale->customer_id=$i;
    //         $sale->product_id=1;
    //         $sale->seller_id=1;
    //         $sale->vehicle=1;
    //         $sale->sack_id=1;
    //         $sale->quantity=0;
    //         $sale->price=0;
    //         $sale->cost=0;
    //         $sale->total_product_price=0;
    //         $sale->total_price=0;
    //         $sale->save();
    //     }
        // return 'done';
    }

// }
