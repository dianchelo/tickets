<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cart as Cart;
use \App\Ticket;
use \App\Reservation;
use \App\Order;
use Session;
use Mollie;
use DB;
use Auth;

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
        // This function will run on it's continuesly on the live server, now we'll do it upon pageload.
        //$this->checkAllTicketsAndCarts();
        // The cart can be updated in the background so we restore the cart from the DB.
        //Cart::restore(Auth::user()->facebook_id);

        // The restore function deletes the cart from the DB so we'll have to save it back again.
        //Cart::store(Auth::user()->facebook_id);

        $tickets = [];

        $restoredCart = Cart::instance('default')->restore(Auth::user()->facebook_id);
        if(isset($restoredCart) ){ 
            foreach($restoredCart as $key => $item){
                
                $item->ticket = Ticket::find($item->id);
                $till = date('Y-m-d H:i:s', strtotime($item->ticket->reservation->created_at->toDateTimeString() . ' +10 seconds'));
                $item->ticket->reservation->reserved_till =  $till;

                $tickets[$key] = $item;
            }
        }
        else{
            $restoredCart = null;
        }

        return view('cart.index')->withTickets($restoredCart);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        // Delete previous cart in the database
        DB::table('shoppingcart')->where('identifier', '=',  Auth::user()->facebook_id)->delete();
        // Add new item to cart session
        $cartItem = Cart::add($request->id, $request->name, 1, $request->price);
        Cart::associate($cartItem->rowId, \App\Ticket::class);
        // Store new cart in the database
        Cart::store(Auth::user()->facebook_id);

        foreach(Cart::content() as $item) {
            $ticket = Ticket::find($item->id);

            $status = DB::table('ticket_reservations')
                ->where('ticket_id', '=', $ticket->id)
                ->get()->toArray();

            if(count($status) == 0){ 
                DB::table('ticket_reservations')->insert(['ticket_id' => $ticket->id, 'event_id' => $ticket->event->id, 'buyer_id' => Auth::user()->facebook_id , 'status' => 'R', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
            }else{
                // If the ticket wasn't reserved by user yet, update the timestamps.
                if($ticket->reservation->status != 'R'){
                    DB::table('ticket_reservations')->where('ticket_id', $ticket->id)->update(['created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), 'buyer_id' => Auth::user()->facebook_id]);
                }
                // Don't update timestamps, item was already in the cart
                DB::table('ticket_reservations')->where('ticket_id', $ticket->id)->update(['status' => 'R', 'buyer_id' => Auth::user()->facebook_id]);
            }
        }

        Session::flash('success', 'Item was added to your cart!');

        return redirect('/cart');
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
        // Delete previous cart in the database
        DB::table('shoppingcart')->where('identifier', '=',  Auth::user()->facebook_id)->delete();

        $rows  = Cart::content();
        $itemToDelete = $rows->where('id', $id)->first();
        $rowId = $rows->where('id', $id)->first()->rowId;

        DB::table('ticket_reservations')
            ->where('ticket_id', $itemToDelete->id)
            ->update(['status' => 'A']);

        Cart::remove($rowId);

        // Store new cart in the database
        Cart::store(Auth::user()->facebook_id);
        Session::flash('success', 'Item has been removed!');
        return redirect('/cart');
    }


    public function checkout(){

        DB::table('shoppingcart')->where('identifier', '=',  Auth::user()->facebook_id)->delete();

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->cart = serialize(Cart::content());
        $order->save();

        $total = Cart::total();

        Cart::destroy();

        try
        {
            $payment = Mollie::api()->payments()->create(
                array(
                    'amount'      => $total,
                    'description' => 'Dianchelo Bazoer Events - Ticket orderid: '.$order->id,
                    'redirectUrl' => 'http://localhost:8000/checkout/order/'.$order->id,
                    'metadata'    => array(
                        'order_id' => $order->id
                    )
                )
            );

            $payment = Mollie::api()->payments()->get($payment->id);

            DB::table('orders')->where('id', $order->id)->update(['payment_id' => $payment->id]);

            foreach(Cart::content() as $key => $item){
                $ticket = Ticket::find($item->id);
                DB::table('ticket_reservations')->where('ticket_id', $ticket->id)->update(['status' => 'S']);
            }

            

            /*
             * Send the customer off to complete the payment.
             */
            header("Location: " . $payment->getPaymentUrl());
            exit;
        }
        catch (Mollie_API_Exception $e)
        {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
            echo " on field " . htmlspecialchars($e->getField());
        }

    }

    public function orderAfterCheckout($id) {
        $order = Order::find($id);
        $cart = unserialize($order->cart);
        $payment = Mollie::api()->payments()->get($order->payment_id);

        DB::table('orders')->where('id', $order->id)->update(['payment_status' => $payment->status]);

        return view('orders.postcheckout')->withOrder($order)->withPayment($payment)->withCart($cart);
    }   

    public function showOrder($id) {

        

    }

    // Temporary function
    public function checkAllTicketsAndCarts(){
        date_default_timezone_set("Europe/Amsterdam");

        $tickets = Ticket::all();
        $now = date("Y-m-d H:i:s");
        $now = strtotime($now);

        foreach($tickets as $key => $ticket) {
            if(isset($ticket->reservation) && $ticket->reservation->status == 'R') {
                $reservationExpiration = strtotime($ticket->reservation->created_at->toDateTimeString() . ' +10 seconds');
                if ($now >= $reservationExpiration ) {
                    $reservation = Reservation::where('ticket_id', $ticket->id)->first();
                    // status below needs to be 'A'
                    //$reservation->update(['status' => 'R']);

                    $cartContent = Cart::restoreFromDB($reservation->buyer_id);

                    if($cartContent) {
                        foreach($cartContent as $cartItem) {
                            if($cartItem->id == $ticket->id) {
                                $cartContent->pull($cartItem->rowId);                                
                            }
                        }
                        $cartContent = serialize($cartContent);

                        DB::table('shoppingcart')
                            ->where('identifier', $reservation->buyer_id)
                            ->update(['content' => $cartContent]);
                    }
                }
            }
        }
    }
}
