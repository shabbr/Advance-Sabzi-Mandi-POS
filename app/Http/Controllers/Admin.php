<?php

namespace App\Http\Controllers;

use App\Models\Profit;
use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class Admin extends Controller
{
    public function addAdmin(){
        $admins=User::get();
        return view('auth.adminList',compact(['admins']));
    }
    public function newAdmin(Request $request){
// return $request;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password= Hash::make($request->password);
        $user->save();
        return redirect()->route('addAdmin');
    }



    public function dashboard(){
        $currentDate = Carbon::now()->toDateString();
      $todaySales=Sale::whereDate('created_at',$currentDate)->sum('total_price');
      $totalSales=Sale::sum('total_price');
      $todayRevenue=Profit::whereDate('created_at',$currentDate)->sum('profit');
      $totalRevenue=Profit::sum('profit');
return view('dashboard',compact(['todaySales','totalSales','todayRevenue','totalRevenue']));
    }
}
