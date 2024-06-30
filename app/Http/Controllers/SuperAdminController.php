<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Profit;
use App\Models\ReceiveAmount;
use App\Models\SellerAmount;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function amount()
    {
        // $payments=SellerAmount::select(DB::raw('GROUP_CONCAT(DISTINCT id) as id'),
        //     DB::raw('DATE(created_at) as created_date'),
        //     DB::raw('SUM(commision) as commission'))
        //     ->groupBy(DB::raw('DATE(created_at)'))
        //     ->orderBy('created_at','DESC')
        //     ->get();


            $expenses=SuperAdmin::select( DB::raw('DATE(created_at) as created_date'),
                DB::raw('SUM(amount) as amount'))
                ->groupBy(DB::raw('DATE(created_at)'))
                ->get();

                $received_a_day=ReceiveAmount::select( DB::raw('DATE(created_at) as created_date'),
                DB::raw('SUM(received) as amount'))
                ->groupBy(DB::raw('DATE(created_at)'))
                ->get();


                $total_expense=SuperAdmin::sum('amount');
                // return $expenses;
            $received_amount=ReceiveAmount::sum('received');
// return $received_amount;
            $payments=Profit::get();
            $total_payment=Profit::sum('profit_of_today');
            // return $total_payment;
            $current_balance=$total_payment - ($received_amount + $total_expense) ;
            // return $current_balance;

            return view('superAdmin.showEarning',compact(['payments','expenses','current_balance','total_payment','received_amount','received_a_day']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function receivedCashDetails($date)
    {
        $payment=SellerAmount::select(DB::raw('GROUP_CONCAT(DISTINCT id) as id'),
        DB::raw('DATE(created_at) as created_date'),
        DB::raw('SUM(commision) as pure_amount'))
        ->groupBy(DB::raw('DATE(created_at)'))
        ->whereDate('created_at',$date)
        ->orderBy('created_at','DESC')
        ->get();
        $total_payment=$payment[0]['pure_amount'];
        $received = ReceiveAmount::select(
            DB::raw('SUM(received) as received_amount'), // Removed 'as received_amount'
            DB::raw('DATE(created_at) as created_date')
        )
        ->groupBy('created_date')
        ->whereDate('created_at', $date)
        ->orderBy('created_at', 'DESC')
        ->get();
        if(count($received)==0){
        $received_amount=0;
        }else{
            $received_amount=$received[0]['received_amount'];
        }

        $expense=SuperAdmin::select(DB::raw('SUM(amount) as amount'),
        DB::raw('DATE(created_at) as created_date'))
        ->groupBy('created_date')
        ->whereDate('created_at',$date)
        ->get();
        if(count($expense)==0){
            $total_expense=0;
        }else{
            $total_expense=$expense[0]['amount'];
        }
        // return $total_expense;
        $pure_amount=$total_payment - $total_expense;




        $amounts=SellerAmount::select(
            'seller_id',
            DB::raw('SUM(total_amount) as total_amount'),
            DB::raw('SUM(pure_amount) as pure_amount'),
            DB::raw('SUM(commision) as commision'))
            ->groupBy('seller_id')
            ->whereDate('created_at',$date)
            ->get();
            $date = \Carbon\Carbon::parse($date);

 return view('superAdmin.earningDetails',compact(['total_payment','pure_amount','received_amount','total_expense','amounts','date']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function showExpenseForm()
    {
        return view('superAdmin.addExpense');
    }

    public function showExpense()
    {
        $expenses=SuperAdmin::select(
            DB::raw('DATE(created_at) as created_date'),
            DB::raw('SUM(amount) as amount'),
        )
        ->groupBy('created_date')
        ->orderBy('created_at','DESC')
        ->get();
// return $expenses;
        return view('superAdmin.showExpense',compact(['expenses']));
    }
    public function expenseDetails($date)
    {
        $expenses=SuperAdmin::whereDate('created_at',$date)->get();
        return view('superAdmin.expenseDetails',compact(['expenses']));

    }


    public function addExpense(Request $request)
    {
        $data= new SuperAdmin();
        $data->expense=$request->expense;
        $data->amount=$request->amount;
        $data->save();
return redirect()->route('amount');
    }

    public function receivePaymentForm()
    {
        return view('superAdmin.receivePaymentForm');
    }

    public function receivePayment(Request $request)
    {
        $data= new ReceiveAmount();
        $data->received=$request->amount;
        $data->save();
return redirect()->route('amount');
    }

    public function showReceivedPayment()
    {
        $payments=ReceiveAmount::orderBy('created_at','DESC')->get();
        return view('superAdmin.showReceivedPayment',compact(['payments']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
