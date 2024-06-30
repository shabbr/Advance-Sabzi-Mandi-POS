<?php

namespace App\Http\Controllers;

use App\Models\DailyReceivedPayment;
use App\Models\DailyReceivedPaymentCart;
use App\Models\DailySendedPayment;
use App\Models\DailySendedPaymentCart;
use App\Models\Payment;
use App\Models\Profit;
use App\Models\Sale;
use App\Models\SellerAmount;
use App\Models\SellerPayment;
use App\Models\ShopExpense;
use App\Models\ShopExpenseCart;
use App\Models\SuperAdmin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoznamchaController extends Controller
{
    public function showRozNamcha(){

        $sales=Sale::select( DB::raw('DATE(created_at) as created_at'))
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('created_at','desc')
        ->get();
// return $sales

            return view('roznamcha.showRoznamcha',compact('sales'));
           }

           public function shopExpensesForm(){
            $expenses=ShopExpenseCart::get();
            return view('roznamcha.shopExpensesForm',compact(['expenses']));
           }

            public function addShopExpense(Request $request){
                $expense=new ShopExpenseCart();
                $expense->expense=$request->expense;
                $expense->amount=$request->amount;
                $expense->save();
                return redirect()->route('shopExpensesForm');
            }

            public function shopExpense(Request $request){
                // return $request;
                $expenses=ShopExpenseCart::get();
                foreach($expenses as $expense){
                $shopExpense=new ShopExpense();
                    $shopExpense->expense=$expense->expense;
                    $shopExpense->amount=$expense->amount;
                $shopExpense->created_at=$request->created_at;
                    $shopExpense->save();
                    $expense->delete();
                }
                    return redirect()->route('showRozNamcha');


                // $expense=new ShopExpenseCart();
                // $expense->expense=$request->expense;
                // $expense->amount=$request->amount;
                // $expense->save();
                // return redirect
            }

            public function removeShopExpense($id){
                ShopExpenseCart::find($id)->delete();
                return redirect()->back();
            }







            //daily sended payment
            public function dailySendedPaymentForm(){
                $expenses=DailySendedPaymentCart::get();
                // return $expenses;
                return view('roznamcha.dailySendedPaymentForm',compact(['expenses']));
               }

               public function addDailySendedPayment(Request $request){
                $expense=new DailySendedPaymentCart();
                $expense->name=$request->expense;
                $expense->amount=$request->amount;

                $expense->save();
                return redirect()->route('dailySendedPaymentForm');
            }

            public function sendedAmount(Request $request){
                $expenses=DailySendedPaymentCart::get();
                foreach($expenses as $expense){
                $sended=new DailySendedPayment();
                    $sended->name=$expense->name;
                    $sended->amount=$expense->amount;
                    $sended->created_at=$request->created_at;
                    $sended->save();
                    $expense->delete();
                }
                return redirect()->route('showRozNamcha');

}
public function removeSendedAmount($id){
    DailySendedPaymentCart::find($id)->delete();
    return redirect()->back();
}




public function showDailySendedPayment(){
    $payments=DailySendedPayment::get();
    return view('roznamcha.showDailySendedPayment',compact(['payments']));
}






//daily received amount
    public function dailyReceivedPaymentForm(){
    $expenses=DailyReceivedPaymentCart::get();
    // return $expenses;
    return view('roznamcha.dailyReceivedPaymentForm',compact(['expenses']));
   }

   public function addDailyReceivedPayment(Request $request){
    $expense=new DailyReceivedPaymentCart();
    $expense->name=$request->expense;
    $expense->amount=$request->amount;
    $expense->save();
    return redirect()->route('dailyReceivedPaymentForm');
}

public function receivedAmount(Request $request){
    $expenses=DailyReceivedPaymentCart::get();
    foreach($expenses as $expense){
    $sended=new DailyReceivedPayment();
        $sended->name=$expense->name;
        $sended->amount=$expense->amount;
        $sended->created_at=$request->created_at;
        $sended->save();
        $expense->delete();
    }
    return redirect()->route('showRozNamcha');

}




public function showDailyReceivedPayment(){
    $payments=DailyReceivedPayment::get();
    // return $payments;
    return view('roznamcha.showDailyReceivedPayment',compact(['payments']));
}



public function removeReceivedAmount($id){
    DailyReceivedPaymentCart::find($id)->delete();
    return redirect()->back();
}
public function rozNamchaDetails($date){
    $profit_date=$date;
    $date = Carbon::parse($date)->subDay();
    $previousDate = $date->format('Y-m-d');
    $previousDay=Profit::whereDate('created_at',$previousDate)->first();
    // return $previousDayProfit->profit;
 if(!empty($previousDay)){
    $previousDayProfit=$previousDay->profit_of_today;
 }else{
    $previousDayProfit=0;
 }

    $total_wasooli=Payment::whereDate('created_at',$profit_date)
    ->where('payment_status','borrow')
    ->sum('recieved_payment');

    $total_recieved_cash=Payment::whereDate('created_at',$profit_date)
    ->where('payment_status','cash')
    ->sum('recieved_payment');
    $sale_amount=Sale::whereDate('created_at',$profit_date)
    ->sum('total_price');
    $borrow_amount=$sale_amount - $total_recieved_cash;
    // ->get();
    $shop_expense_amount=ShopExpense::whereDate('created_at',$profit_date)
    ->sum('amount');
    $shop_expense=ShopExpense::whereDate('created_at',$profit_date)
    ->get();
    $total_commission=SellerAmount::whereDate('created_at',$profit_date)
    ->sum('commision');
    // $pure_commission=$total_commission - $shop_expense_amount;

    $total_daily_recieved=DailyReceivedPayment::whereDate('created_at',$profit_date)
    ->sum('amount');
    $daily_recieved_payment=DailyReceivedPayment::whereDate('created_at',$profit_date)
    ->get();



    $total_pay_to_sender=SellerPayment::whereDate('created_at',$profit_date)
    ->sum('payment');
    $pay_to_sender=SellerPayment::with('seller')->whereDate('created_at',$profit_date)
    ->get();

    //hmnay jo udhar wapsi wghiara ki
    $other_sended_payments=DailySendedPayment::whereDate('created_at',$profit_date)->get();
    $total_other_sended_payment=DailySendedPayment::whereDate('created_at',$profit_date)->sum('amount');
    // $total_owner_expenses=SuperAdmin::whereDate('created_at',$profit_date)->sum();


// return $previousDayProfit;
    // $previousDayProfit=105;
 $total_expense=$borrow_amount + $shop_expense_amount + $total_pay_to_sender + $total_other_sended_payment;
 $today_income=$total_wasooli + $total_commission + $total_daily_recieved ;
 $earning=$today_income - $total_expense;
 $total_income=$earning + $previousDayProfit;

//  return $today_profit;
    return view('roznamcha.rozNamchaDetails',compact(['borrow_amount','shop_expense_amount','total_pay_to_sender','other_sended_payments','total_other_sended_payment','total_expense',
    'earning','total_daily_recieved','total_wasooli','total_commission','today_income','total_income','previousDayProfit',
      'pay_to_sender','shop_expense','daily_recieved_payment']));

}










public function totalProfitForm($date){
    $profit_date=$date;
    $date = Carbon::parse($date)->subDay();
    $previousDate = $date->format('Y-m-d');
    $previousDay=Profit::whereDate('created_at',$previousDate)->first();
    // return $previousDayProfit->profit;
 if(!empty($previousDay)){
    $previousDayProfit=$previousDay->profit_of_today;
 }else{
    $previousDayProfit=0;
 }


    $total_pay_to_sender=SellerPayment::whereDate('created_at',$profit_date)
    ->sum('payment');

    $total_wasooli=Payment::whereDate('created_at',$profit_date)
    ->where('payment_status','borrow')
    ->sum('recieved_payment');


    $total_commission=SellerAmount::whereDate('created_at',$profit_date)
    ->sum('commision');
    // $pure_commission=$total_commission - $shop_expense_amount;

    $total_daily_recieved=DailyReceivedPayment::whereDate('created_at',$profit_date)
    ->sum('amount');

 $today_income=$total_wasooli + $total_commission + $total_daily_recieved ;
 $total_other_sended_payment=DailySendedPayment::whereDate('created_at',$profit_date)->sum('amount');

 $total_recieved_cash=Payment::whereDate('created_at',$profit_date)
 ->where('payment_status','cash')
 ->sum('recieved_payment');

 $sale_amount=Sale::whereDate('created_at',$profit_date)
 ->sum('total_price');

 $borrow_amount=$sale_amount - $total_recieved_cash;
 // ->get();
 $shop_expense_amount=ShopExpense::whereDate('created_at',$profit_date)
 ->sum('amount');


 $total_expense=$borrow_amount + $shop_expense_amount + $total_pay_to_sender + $total_other_sended_payment;
 $today_income=$total_wasooli + $total_commission + $total_daily_recieved ;
 $earning=$today_income - $total_expense;

    return view('roznamcha.totalProfitForm',compact(['earning','profit_date','previousDayProfit']));

}


       public function totalProfit(Request $request){

        // $currentDate = Carbon::now()->toDateString();
        $already=Profit::whereDate('created_at',$request->date)->count();
        // return $request;
         if($already == 0){
            $profit=new Profit();
            // $profit->profit=$request->total_profit;
            $profit->profit=$request->profit_of_today;
            $profit->profit_of_today=$request->profit_of_today;
            $profit->save();
         }else{
        $update=Profit::whereDate('created_at',$request->date)->first();
         $update->profit_of_today=$request->profit_of_today;
        $update->save();
        //  return 'You already added Profit';
         }
    return redirect()->route('showRozNamcha');


       }




}
