<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
class ProductController extends Controller
{


     public function showProduct(){
        $product='';
        $products=Product::get();
        // return $products;
        return view('form',compact('products'));

    }


    public function addProduct(Request $request){
        $product= new Product();
       $product->name=$request->name;
       $product->save();
       return redirect()->back();
    }

    public function editProduct(Request $request){
        $product=Product::find($request->id);
            return view('editProduct',compact('product'));
    }

    public function updateProduct(Request $request){
        $product=Product::find($request->id);
        $product->name=$request->name;
        $product->save();
        return redirect()->route('showProduct');
    }


    public function deleteProduct(Request $request){
        $product=Product::find($request->id);
        $product->delete();
        return redirect()->back();
    }

}
