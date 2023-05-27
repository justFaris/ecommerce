<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PhoneController extends Controller
{

   public function index()
   {
      $phones = Product::all();
      return view('phones', ['phones' => $phones]);
   }
   public function cart()
   {
      return view('cart');
   }
   public function addToCart($id)
   {
      $product = Product::findOrFail($id);

      $cart = Session::get('cart', []);

      if (isset($cart[$id])) {
         $cart[$id]['quantity']++;
      } else {
         $cart[$id] = [
            "Name" => $product->Name,
            "Color" => $product->Color,
            "Image" => $product->Img,
            "Price" => $product->Price,
            "quantity" => 1
         ];
      }

      Session::put('cart', $cart);
      return redirect()->back()->with('success', 'Phone add to cart successfully!');
   }
   public function updateCart(Request $request)
   {
      if ($request->id && $request->quantity) {
         $cart = Session::get('cart');
         $cart[$request->id]["quantity"] = $request->quantity;
         Session::put('cart', $cart);
         Session::flash('success', 'Cart successfully updated!');
      }
   }
   public function removeCart(Request $request)
   {
      if ($request->id) {
         $cart = Session::get('cart');
         if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            Session::put('cart', $cart);
         }
         Session::flash('success', 'Phone successfully removed!');
      }
   }


   public function Checkout()
   {
      if (Session::has('cart') && Session::get('cart') != []) {
         
         return view('checkout');
      } else {
         return  redirect('/');
      }
   }

   public function invoice(Request $request)
   {
      // insert row

      $inv = [
         'Name' => $request->fullname,
         'Country' => $request->country,
         'Phone' => $request->phone,
         'Email' => $request->email,
         'Address' => $request->address,
      ];
      // get id of row after insert
      $id = Invoice::insertGetId($inv);
      $cart = Session::get('cart');
      $keys = array_keys($cart);

      foreach ($keys as $k) {
         $row = [
            'product_id' => $k,
            'quantity' => $cart[$k]['quantity'],
            'invoice_id' => $id,
            'user_id' => auth()->user()->id
         ];
         OrderItem::insert($row);
      }
      $cart = [];
      Session::put('cart', $cart);
      return redirect('/invoice/' . $id);
   }
   public function getInvoice($id)
   {

      $invoice = Invoice::with(['orderitems','product'])->find($id);
  
     // dd($invoice->orderitems);
      if (!$invoice) {
         abort(404);
      }
      //dd($invoice);
      return view('invoice', compact('invoice'));
   }
}
