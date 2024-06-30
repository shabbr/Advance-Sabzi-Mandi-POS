<?php

namespace App\Http\Controllers;

use App\Models\BuyedProduct;
use App\Models\CustomSack;
use App\Models\Product;
use App\Models\ReceivedProductCart;
use App\Models\Sale;
use App\Models\SaleAmount;
use App\Models\Seller;
use App\Models\SellerAmount;
use App\Models\SellerPayment;
use Carbon\Carbon;
// use App\Models\ReceivedProductCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class BuyedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showBuyedProducts()
    {
        $products=BuyedProduct::get();
        // $buyedProducts=BuyedProduct::with('product')->with('seller')->with('sack')->get();
        // return view('buyedProducts.showBuyedProducts',compact(['products','buyedProducts']));
        $buyedProducts=BuyedProduct::select(
            DB::raw('DATE(created_at) as created_date'),
                DB::raw('SUM(quantity) as total_quantity'))
           ->groupBy(DB::raw('DATE(created_at)'))
           ->orderBy('created_at','DESC')
           ->get();
           return view('buyedProducts.showBuyedProducts',compact(['products','buyedProducts']));


    }

    public function dayDetails($date){
        $buyedProducts = BuyedProduct::select( DB::raw('GROUP_CONCAT(DISTINCT id) as id'),'seller_id','vehicle',
                                    DB::raw('SUM(quantity) as total_quantity'))
                                     ->groupBy('seller_id','vehicle')
                                     ->whereDate('created_at',$date)
                                     ->get();

   $amounts=  SellerAmount::select(
                          DB::raw('GROUP_CONCAT(DISTINCT id) as id'),'seller_id','vehicle',
                          DB::raw('SUM(total_amount) as total_amount'),
                          DB::raw('SUM(total_expenses) as total_expenses'),
                          DB::raw('SUM(pure_amount) as pure_amount'))
                         ->whereDate('payment_of_date',$date)
                         ->groupBy('seller_id','vehicle')
                         ->get();

   $saleAmounts=SaleAmount::select('seller_id','vehicle',DB::raw('SUM(price) as total_price'))
                          ->whereDate('created_at',$date)->groupBy('seller_id','vehicle')->get();

   $testAmount=SaleAmount::select('seller_id','vehicle')
                          ->groupBy('seller_id','vehicle')->get();

   return view('buyedProducts.dayDetails',compact('buyedProducts','testAmount',
                                            'date','amounts','saleAmounts'));
    }



    public function perSellerDetails($sellerId,$vehicle,$date){
        $buyedProducts=BuyedProduct::where('seller_id',$sellerId)
        ->where('vehicle',$vehicle)
        ->whereDate('created_at',$date)
        ->get();
        return view('buyedProducts.perSellerDetails',compact(['buyedProducts']));

    }
    public function sellerSaleDetails($sellerId,$vehicle,$date){
        $sales=Sale::where('seller_id',$sellerId)
        ->where('vehicle',$vehicle)
        ->whereDate('created_at',$date)
        ->get();
        $totalPrice = $sales->sum('total_price');
        return view('buyedProducts.sellerSaleDetails',compact(['sales','totalPrice','vehicle']));

    }

    public function payment($sellerId,$vehicle,$date){
        $products=Product::get();
           return view('buyedProducts.payment',compact(['sellerId','date','products','vehicle']));
    }
    public function addAmount(Request $request){
        $total_amount=Sale::where('seller_id',$request->sellerId)
        ->where('vehicle',$request->vehicle)
        ->whereDate('created_at',$request->amountDate)
        ->sum('total_product_price');
        // return $total_amount;


        $commission=$request->commission;
        $date=$request->amountDate;
        $total_commission=ceil(($total_amount * $commission )/100);
        $expenses=$total_commission+$request->fare+$request->labour_charges+$request->market_fee+$request->clerky;
        $pureAmount=$total_amount - $expenses;
 $alreadySave=SellerAmount::where('seller_id',$request->sellerId)->where('payment_of_date',$request->amountDate)->where('vehicle',$request->vehicle)->count();
 if($alreadySave==0){
            $amount= new SellerAmount();
            $amount->seller_id=$request->sellerId;
            $amount->vehicle=$request->vehicle;
            // $amount->product_id=$request->product_id;
            $amount->payment_of_date=$request->amountDate ;
            $amount->total_amount=$total_amount;
            $amount->commision=$total_commission;
            $amount->fare=$request->fare;
            $amount->labour_charges=$request->labour_charges;
            $amount->market_fee=$request->market_fee;
            $amount->clerkly=$request->clerky;
            $amount->total_expenses=$expenses;
            $amount->pure_amount=$pureAmount;
            $amount->created_at=$date;
            $amount->save();
            return redirect()->route('dayDetails',compact('date'));
 }else{
    return 'You Already added';
 }

    }

    public function amountDetails($sellerId,$vehicle,$date){
        // $amount=SellerAmount::where('seller_id',$sellerId)
        //         ->where('payment_of_date',$date)
        //         ->get();


        $sales = Sale::select( DB::raw('GROUP_CONCAT(DISTINCT id) as id'),
        DB::raw('GROUP_CONCAT(DISTINCT seller_id) as seller_id'),'product_id',
        DB::raw('SUM(quantity) as total_quantity'),
        DB::raw('SUM(total_product_price) as total_price'))
   ->groupBy('product_id')
   ->where('seller_id',$sellerId)
   ->whereDate('created_at',$date)
   ->with('seller')
   ->with('product')
   ->get();
//    return $sale;

        $buyedProducts=BuyedProduct::select( DB::raw('GROUP_CONCAT(DISTINCT quantity) as quantity'),
        DB::raw('GROUP_CONCAT(DISTINCT remaining) as remaining'),
        'product_id','seller_id','created_at')
        ->where('seller_id',$sellerId)
        ->where('vehicle',$vehicle)
        ->whereDate('created_at',$date)
        ->groupBy('product_id','seller_id','created_at')
        ->with('product')
        ->get();
        // return $buyedProducts;

        $sales=Sale::select(
        DB::raw('GROUP_CONCAT(DISTINCT id) as id'),
        DB::raw('GROUP_CONCAT(DISTINCT customer_id) as customer_id'),
        DB::raw('GROUP_CONCAT(DISTINCT seller_id) as seller_id'),

        'sack_id','price','product_id',
        DB::raw('SUM(quantity) as quantity'),
        DB::raw('SUM( total_product_price) as total_product_price'),
        )->where('seller_id',$sellerId)
        ->whereDate('created_at',$date)
        ->where('vehicle',$vehicle)
        ->groupBy('sack_id','price','product_id')
        ->get();
        // return $sales;



         $amounts=SellerAmount::where('seller_id',$sellerId)
         ->where('vehicle',$vehicle)
         ->whereDate('payment_of_date',$date)
         ->get();
        //  return $amounts;
        //  dd($amounts->product_id);
        //  return $buyedProducts->toArray();

        return view('buyedProducts.amountDetails',compact(['buyedProducts','sales','amounts']));
     }
     public function editAmount($sellerId,$vehicle,$date){
        $amounts=SellerAmount::where('seller_id',$sellerId)
                ->where('vehicle',$vehicle)
                ->where('payment_of_date',$date)
                ->get();
     $total_amount=Sale::where('seller_id',$sellerId)
                ->where('vehicle',$vehicle)
                ->whereDate('created_at',$date)
                ->sum('total_product_price');
        return view('buyedProducts.editAmount',compact(['amounts','total_amount','sellerId','date','vehicle']));
     }

     public function updateAmount(Request $request){
        $total_amount=$request->total_amount;
        $commission=$request->commission;
        $date=$request->amountDate;
        $total_commission = ceil(($total_amount * $commission) / 100);

        $expenses=$total_commission+$request->fare+$request->labour_charges+$request->market_fee+$request->clerky;
// return $expenses;
        $pureAmount=$total_amount - $expenses;
// return $pureAmount;
            $amount=  SellerAmount::where('seller_id',$request->sellerId)
                     ->where('vehicle',$request->vehicle)
                     ->where('payment_of_date',$request->amountDate )->first();
            $amount->seller_id=$request->sellerId;
            $amount->payment_of_date=$request->amountDate ;
            $amount->total_amount=$request->total_amount;
            $amount->commision=$total_commission;
            $amount->fare=$request->fare;
            $amount->labour_charges=$request->labour_charges;
            $amount->market_fee=$request->market_fee;
            $amount->clerkly=$request->clerky;
            $amount->total_expenses=$expenses;
            $amount->pure_amount=$pureAmount;
            $amount->created_at=$date;
            $amount->update();
            return redirect()->route('dayDetails',compact('date'));


    }


    /**
     * Show the form for creating a new resource.
     */
    public function buyedProductForm()
    {
        $products=Product::get();
        $sellers=Seller::get();
        $sacks=CustomSack::get();
        $carts=ReceivedProductCart::with('product')->with('sack')->get();
        $currentDate=Carbon::now()->toDateString();
        return view('buyedProducts.productForm',compact(['products','sellers','sacks','carts','currentDate']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addBuyedProduct(Request $request)
    {
        // $product=new BuyedProduct();
        // $product->seller_id=$request->seller_id;
        // $product->product_id=$request->product_id;
        // $product->sack_id=$request->sack_id;
        // $product->quantity=$request->quantity;
        // $product->remaining=$request->quantity;
        // $product->save();
        // return redirect()->route('showBuyedProducts');
        $alreadyAdded=ReceivedProductCart::where('product_id',$request->product_id)->where('sack_id',$request->sack_id)->first();
        // return $alreadyAdded;
        if (!empty($alreadyAdded)) {
            $alreadyAdded->quantity= $alreadyAdded->quantity + $request->quantity;
            $alreadyAdded->save();
            return redirect()->back();

        } else {

        $product=new ReceivedProductCart();
        // $product->seller_id=$request->seller_id;
        $product->product_id=$request->product_id;
        $product->sack_id=$request->sack_id;
        $product->quantity=$request->quantity;
        $product->remaining=$request->quantity;
        $product->save();
        return redirect()->back();
    }

    }

    /**
     * Display the specified resource.
     */
    public function removeProductCart( $id)
    {
        $cart=ReceivedProductCart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function addReceivedProduct(Request $request)
    {
        $carts=ReceivedProductCart::get();
        foreach($carts as $cart){
            $product=new BuyedProduct();
            $product->seller_id=$request->seller_id;
            $product->vehicle=$request->vehicle;
            $product->product_id=$cart->product_id;
            $product->sack_id=$cart->sack_id;
            $product->quantity=$cart->quantity;
            $product->remaining=$cart->quantity;
            $product->created_at=$request->created_at;
            $product->save();
        }
        ReceivedProductCart::truncate();

        return redirect()->route('showBuyedProducts');

    }

    /**
     * Update the specified resource in storage.
     */
    public function sendAmountForm($sellerId,$vehicle,$date)
    {
            $total_amount=SellerAmount::select( 'pure_amount')
            ->where('seller_id',$sellerId)
            ->where('vehicle',$vehicle)
            ->whereDate('created_at',$date)->value('pure_amount');
        // return $total_amount;
          $sended=SellerPayment::where('seller_id',$sellerId)
                ->where('vehicle',$vehicle)
                ->whereDate('created_at',$date)
                ->first();
                if(!empty($sended)){
                    return 'You Already Added Payment of this sender of this date';
                }
     return view('buyedProducts.sendAmountForm',compact('total_amount','sellerId','date','vehicle'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function sendAmount(Request $request)
    {
        $payment=new SellerPayment();
        $payment->seller_id=$request->seller_id;
        $payment->vehicle=$request->vehicle;
        $payment->payment=$request->payment;
        $payment->created_at=$request->date;
        $payment->save();

        $date=$request->date;
        return redirect()->route('dayDetails',compact('date'));
    }


        public function updatePaymentSender(Request $request)
    {

        $sellerId=$request->seller_id;
        $vehicle=$request->vehicle;
        $date=$request->date;
       $sended=SellerPayment::where('seller_id',$sellerId)
       ->where('vehicle',$vehicle)
       ->whereDate('created_at',$date)
       ->first();

        $sended->payment=$request->payment;
        $sended->created_at=$date;

        $sended->save();
        return redirect()->route('dayDetails',compact('date'));
    }



    public function updateAmountForm($sellerId,$vehicle,$date)
    {
            $total_amount=SellerAmount::select( 'pure_amount')
            ->where('seller_id',$sellerId)
            ->where('vehicle',$vehicle)
            ->whereDate('created_at',$date)->value('pure_amount');
        // return $total_amount;
          $sended_payment=SellerPayment::select('payment')
          ->where('seller_id',$sellerId)
                ->where('vehicle',$vehicle)
                ->whereDate('created_at',$date)
                ->value('payment');
                if(empty($sended_payment)){
                    return 'Please first send payment';
                }else{
     return view('buyedProducts.updateAmountForm',compact('total_amount','sended_payment','sellerId','date','vehicle'));
    }


           }
           public function dailyCommission(){
            $amounts=SellerAmount::select(
                DB::raw('GROUP_CONCAT(DISTINCT id) as id'),
                DB::raw('DATE(created_at) as created_at'),
                DB::raw('SUM(total_amount) as total_amount'),
                DB::raw('SUM(commision) as commision'),
                DB::raw('SUM(total_expenses) as total_expenses'),
                DB::raw('SUM(pure_amount) as pure_amount'))
               ->groupBy(DB::raw('DATE(created_at)'))
               ->orderBy('created_at', 'desc')
               ->get();
               return view('buyedProducts.dailyCommssion',compact('amounts'));
           }



           public function perDayCommission($date){
            $amounts=SellerAmount::with('seller')->whereDate('created_at',$date)->get();
            // dd($amounts);
            $sales=Sale::select('seller_id','vehicle',
            DB::raw('SUM(quantity) as quantity'))
            ->whereDate('created_at',$date)
            ->groupBy('seller_id','vehicle')->get();
// return $sales;
            return view('buyedProducts.perDayCommission',compact(['amounts','sales']));
           }

        public function editbuyedProduct($id){


            $product=BuyedProduct::with('product')->with('sack')->find($id);
            $sacks=CustomSack::get();
            $products_list=Product::get();
            return view('buyedProducts.editBuyedProduct',compact(['product', 'products_list','sacks','id']));
        }

        public function updatebuyedProduct(Request $request){
            // return $request;
 $product=BuyedProduct::find($request->id);
 $product->vehicle=$request->vehicle;
//  $product->product_id=$request->product_id;
 $product->sack_id=$request->sack_id;
 $product->quantity=$request->quantity;
 $product->remaining=$request->remaining;
$product->save();
 return redirect()->back();
        }







}
