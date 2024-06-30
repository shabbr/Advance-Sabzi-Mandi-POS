<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellerRequest;
use App\Models\BuyedProduct;
use App\Models\PreviousSendeAmount;
use App\Models\Seller;
use App\Models\SellerAmount;
use App\Models\SellerPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showSeller()
    {
        $sellers=Seller::where('status','active')->get();
        $count=Seller::where('status','active')->count();
        $deleted=Seller::where('status','deleted')->count();
        $payments=SellerPayment::select('seller_id',
        DB::raw('SUM(payment) as payment'))
        ->groupBy('seller_id')
        ->get();

    // return $payments;
        return view('seller.showSellers',compact(['sellers','count','deleted','payments']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function sellerForm()
    {
        return view('seller.sellerForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addSeller(SellerRequest $request){

        $customer=new Seller();
        $customer->name=$request->name;
        $customer->phone=$request->phone;
        $customer->account=$request->account;
        $customer->area=$request->area;
        $customer->save();
            return redirect()->route('showSellers');

    }

    /**
     * Display the specified resource.
     */
    public function showDeletedSellers(Seller $seller)
    {
        $sellers=Seller::where('status','deleted')->get();
        $deleted=Seller::where('status','deleted')->count();
    //  return $deleted;
        return view('seller.showDeletedSellers',compact(['sellers','deleted']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editSeller(Request $request,$id)
    {
        $seller=Seller::find($id);
        return view('seller/editSeller',compact('seller'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSeller(Request $request,$id)
    {
        $rules=[
            'name'=> 'required|string',
            'phone'=>'required|numeric|digits:11',
            'account' => 'required',
            'area' => 'required|string'
        ];
        $validator=Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $seller=Seller::find($id);
        $seller->name=$request->name;
        $seller->phone=$request->phone;
        $seller->account=$request->account;
        $seller->area=$request->area;
        $seller->save();
        return redirect()->route('showSellers');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteSeller($id)
    {
        $seller=Seller::find($id);
        $seller->status='deleted';
        $seller->save();
        return redirect()->back();
    }

    public function restoreSeller($id){
        $seller=Seller::find($id);
        $seller->status='active';
        $seller->save();
        return redirect()->route('showSellers');
    }

    public function permanentDeleteSeller($id){
        $seller=Seller::find($id)->delete();
        return redirect()->route('showSellers');

    }

    public function sendedPaymentForm($id)
    {

        $seller=Seller::find($id);
        return view('seller.sendedPaymentForm',compact(['seller']));
    }

    public function sendedPayment(Request $request)
    {
        // return $request;
        $seller=new SellerPayment();
        $seller->seller_id=$request->seller_id;
        $seller->payment=$request->payment;
        $seller->save();
      return redirect()->route('sendPayments');
    }





    public function sendPayments()
    {
    //     $sellers=Seller::where('status','active')->get();
    //     $count=Seller::where('status','active')->count();
    //     $deleted=Seller::where('status','deleted')->count();

        $payments=SellerPayment::with('seller')->select('seller_id',
        DB::raw('SUM(payment) as payment'))
        ->groupBy('seller_id')
        ->get();

        $amounts=SellerAmount::select('seller_id',
        DB::raw('SUM(pure_amount) as pure_amount'))
        ->groupBy('seller_id')
        ->get();

    // return $payments->toArray();
        return view('seller.sendPayments',compact(['payments','amounts']));
    }

    public function sendedPaymentDetails($id)
    {

        $payments=SellerPayment::with('seller')
        ->where('seller_id',$id)
        ->get();

      $record_payments = SellerPayment::selectRaw('DATE(created_at) as created_at, SUM(payment) as payment')
      ->where('seller_id', $id)
      ->groupBy(DB::raw('DATE(created_at)'))
      ->get();


        $total_sended_payment=SellerPayment::select('payment' )
        ->where('seller_id', $id)
    ->sum('payment');

        // $payments=SellerPayment::with('seller')->select('seller_id',
        // DB::raw('SUM(payment) as payment'))
        // ->groupBy('seller_id')
        // ->get();
        // $amounts=SellerAmount::select('pure_amount')
        // ->where('seller_id',$id)
        // ->sum('pure_amount');

        $total_amount=SellerAmount::select('pure_amount')
        ->where('seller_id',$id)
        ->sum('pure_amount');
        $remaining_amount=$total_amount - $total_sended_payment;


        $amounts = SellerAmount::select(
            DB::raw('SUM(pure_amount) as total_amount'),
            DB::raw('DATE(created_at) as created_at')
        )
        ->where('seller_id', $id)
        ->groupBy(DB::raw('DATE(created_at)'))
        ->get();
// return $amounts;
// dd($payments);
        return view('seller.sendedPaymentDetails',compact(['payments','total_amount','total_sended_payment','remaining_amount','record_payments','amounts']));
    }




}
