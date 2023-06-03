<?php

namespace Modules\Ebook\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ebook\Models\EbookCart;
use Auth;
use Session;

class EbookCartController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function addToCart($id)
    {
        if(Auth::check()){
            $params['user_id'] = Auth::user()->id; 
        } else {
            $user_id = mt_rand(1000000, 9999999);
            Session::put('user_id', $user_id);
            $params['user_id'] = $user_id; 
        } 
        $params['ebook_id'] = $id;
        if(EbookCart::where('user_id',$params['user_id'])->exists()){
            EbookCart::where('user_id',$params['user_id'])->update($params);
        } else {
            EbookCart::create($params);
        }       
        
        return redirect('web/ebook/cart');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function cart()
    {
        if(Auth::check()){
            $user_id = Auth::user()->id; 
        } else {
            $user_id = Session::get('user_id');
        } 
        $data['carts'] = EbookCart::where('user_id',$user_id)->get();
        $data['coupon'] = '';
        return view('ebook::web.cart',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function checkout(Request $request)
    {
        $data['price_total'] = $request->price_total;
        $data['offer_total'] = $request->offer_total;
        Session::put('price_total', $request->price_total);
        Session::put('offer_total', $request->offer_total);
        if(Auth::check()){
            $user_id = Auth::user()->id; 
        } else {
            $user_id = Session::get('user_id');
        }
        return redirect('web/ebook/cart/checkout');
        
    }

    public function checkout_page(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id; 
        } else {
            $user_id = Session::get('user_id');
        }
        $data['price_total'] = Session::get('price_total');;
        $data['offer_total'] = Session::get('offer_total');;
        $data['carts'] = EbookCart::where('user_id',$user_id)->get();
        return view('ebook::web.checkout',$data);
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function removeItem($id)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id; 
        } else {
            $user_id = Session::get('user_id');
        } 
        EbookCart::whereId($id)->delete();
        Session::flash('success', trans('flash.RemoveSuccessfully'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('ebook::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
