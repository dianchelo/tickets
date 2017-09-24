<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cart as Cart;
use Session;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //Cart::add('1', 'Product 1', 3, 9.99, ['size' => 'large'])->associate('Ticket');
        //Cart::destroy();



        return view('cart.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cartItem = Cart::add($request->id, $request->name, 1, $request->price);
        Cart::associate($cartItem->rowId, \App\Ticket::class);


        //dd($request);
        //Cart::associate('Ticket','\App\Ticket')->add($request->id, $request->name, 1, $request->price);
        //die('1');
        return redirect('/cart')->withSuccessMessage('Item was added to your cart!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rows  = Cart::content();
        $rowId = $rows->where('id', $id)->first()->rowId;

        Cart::remove($rowId);
        Session::flash('success', 'Item has been removed!');
        return redirect('/cart');
    }


    public function addToCart(Request $request, $id) {



    }
}
