<?php

namespace App\Http\Controllers;

use App\Models\CustomSack;
use Illuminate\Http\Request;

class CustomSackController extends Controller
{
    public function showSack(){
        $sacks=CustomSack::get();
        return view('customSack' , compact("sacks"));
    }
    public function addSack(Request $request){
        $sack=new CustomSack();
        $sack->name=$request->name;
        $sack->save();
        return redirect()->back();
    }
    public function editSack($id){
        $sack=CustomSack::find($id);
        return view('editSack',compact('sack'));

    }

    public function updateSack(Request $request,$id){
        $sack=CustomSack::find($id);
        $sack->name=$request->name;
        $sack->save();
        return redirect()->route('showSack');
    }

    public function deleteSack($id){
        CustomSack::find($id)->delete();
        return redirect()->back();
    }
}
