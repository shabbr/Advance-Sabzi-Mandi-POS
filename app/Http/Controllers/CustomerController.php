<?php

namespace App\Http\Controllers;

use App\Http\Requests\customerRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class CustomerController extends Controller
{
    public function showCustomers(){
        // $total=Customer::sum('amount');
        // return $total;
        $customers=Customer::where('status','active')->get();
        $deleted=Customer::where('status','deleted')->count();
        return view('showCustomers',compact(['customers','deleted']));
    }
    public function customerForm(){
        return view('addCustomer');
    }

    public function addCustomer(customerRequest $request){

        $customer=new Customer();
        $customer->name=$request->name;
        $customer->phone=$request->phone;
        $customer->area=$request->area;
        $customer->save();
            return redirect()->route('showCustomers');

    }

    public function editCustomer($id){
        $customer=Customer::find($id);
        return view('editCustomer',compact('customer'));
    }


    public function updateCustomer(Request $request,$id){
        $rules=[
            'name'=> 'required|string',
            'phone'=>'required|numeric|digits:11',
            'area' => 'required|string'
        ];
        $validator=Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $customer=Customer::find($id);
        $customer->name=$request->name;
        $customer->phone=$request->phone;
        $customer->area=$request->area;
        $customer->save();
        return redirect()->route('showCustomers');

    }


    public function deleteCustomer($id){
        $customer=Customer::find($id);
        $customer->status='deleted';
        $customer->save();
        return redirect()->route('showCustomers');

    }

    public function showDeletedCustomers(){
        $customers=Customer::where('status','deleted')->get();
        $deleted=Customer::where('status','deleted')->count();

     return view('showDeletedCustomers',compact(['customers','deleted']));

    }

    public function restoreCustomer($id){
        $customer=Customer::find($id);
        $customer->status='active';
        $customer->save();
        return redirect()->route('showCustomers');
    }


    public function permanentDeleteCustomer($id){
        $customer=Customer::find($id)->delete();
        return redirect()->route('showCustomers');
    }
}
