<?php

namespace Modules\Ebook\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ebook\Models\Ebook;
use Modules\Ebook\Models\EbookCart;
use Modules\Ebook\Models\EbookOrder;
use Modules\Ebook\Models\EbookReview;
use Modules\Ebook\Models\EbookCategory;
use Modules\Ebook\Models\EbookOrderDetail;
use Auth;
use Session;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['ebooks'] = Ebook::where('status','1')->get();
        $data['categories'] = EbookCategory::where('status','1')->get();
        $data['search'] = '';
        $data['category_id'] = '';
        return view('ebook::web.ebook_list',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function detail($id)
    {
        $data['ebook'] = Ebook::find($id);
        $data['ebooks'] = Ebook::where('status','1')->where('category_id',$data['ebook']->category_id)->where('id','!=',$id)->get();
        $data['reviews'] = EbookReview::where('ebook_id',$id)->get();
        if(Auth::check()){
            $data['order'] = EbookOrder::where('user_id',Auth::user()->id)->where('ebook_id',$id)->get();
        } else {
            $data['order'] = [];
        }        
        $data['category_id'] = '';
        return view('ebook::web.ebook_detail',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function search(Request $request)
    {
        $data['search'] = $request->search;
        $data['ebooks'] = Ebook::where('status','1')->where('title','like',"%{$request->search}%")->get();
        $data['categories'] = EbookCategory::where('status','1')->get();
        $data['category_id'] = '';
        return view('ebook::web.ebook_list',$data);
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function filter($id)
    {
        $data['ebooks'] = Ebook::where('status','1')->where('category_id',$id)->get();
        $data['categories'] = EbookCategory::where('status','1')->get();
        $data['search'] = '';
        $data['category_id'] = $id;
        return view('ebook::web.ebook_list',$data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function rating(Request $request)
    {
        $request->validate([
            'rating' => 'required',
        ]);

        if(EbookReview::where('ebook_id',$request->ebook_id)->where('user_id',Auth::user()->id)->exists()){
            $data['ebook_id'] = $request->ebook_id;
            $data['user_id'] = Auth::user()->id;
            $data['rating'] = $request->rating;
            $data['comment'] = $request->comment;
            EbookReview::where('ebook_id',$request->ebook_id)->where('user_id',Auth::user()->id)->update($data);
            Session::flash('success', trans('flash.UpdatedSuccessfully'));
        } else {
            $data['ebook_id'] = $request->ebook_id;
            $data['user_id'] = Auth::user()->id;
            $data['rating'] = $request->rating;
            $data['comment'] = $request->comment;
            EbookReview::create($data);
            Session::flash('success', trans('flash.CreateSuccessfully'));
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function dopayment(Request $request)
    {
        $payment_method = 'RazorPay';
        $order_id = '#ebook'.'-'.date('d-m-Y').'-'.mt_rand(1000000, 9999999);
        $data['order_id'] = $order_id;
        $data['user_id'] = Auth::user()->id;
        $data['ebook_id'] = $request->ebook_id;
        $data['orignal_price'] = $request->orignal_price;
        $data['total_amount'] = $request->amount;
        $data['transaction_id'] = $request->razorpay_payment_id;
        $data['payment_method'] = $payment_method;        
        $data['currency'] = Session::get('changed_currency');
        $order = EbookOrder::create($data);
        EbookCart::where('user_id',Auth::user()->id)->delete();
        Session::flash('success', trans('OrderCreateSuccessfully'));
        return redirect('web/ebook/confirm-order');
    }

    public function orderConfirm()
    {
        $data['order'] = EbookOrder::where('user_id',Auth::user()->id)->latest()->first();
        return view('ebook::web.invoice',$data);
    }

    public function myinvoice($id)
    {
        $data['order'] = EbookOrder::where('user_id',Auth::user()->id)->whereId($id)->first();
        return view('ebook::web.invoice',$data);
    }
    public function myEbook()
    {
        if(Auth::check()){
            if(EbookOrder::where('user_id',Auth::user()->id)->exists()){
                $data['myebooks'] = EbookOrder::where('user_id',Auth::user()->id)->get();
                return view('ebook::web.myebook',$data);
            } else {
                Session::flash('success', trans('NoAnyBook'));
                return back();
            }            
        } else {
            Session::flash('success', trans('LoginFirst'));
            return back();
        }        
    }

    public function freeenroll(Request $request,$ebook_id)
    {
        $payment_method = 'Free';
        $order_id = '#ebook'.'-'.date('d-m-Y').'-'.mt_rand(1000000, 9999999);
        $data['order_id'] = $order_id;
        $data['user_id'] = Auth::user()->id;
        $data['ebook_id'] = $ebook_id;
        $data['orignal_price'] = '00';
        $data['total_amount'] = '00';
        $data['transaction_id'] = '';
        $data['payment_method'] = $payment_method;        
        $data['currency'] = Session::get('changed_currency');
        $order = EbookOrder::create($data);
        EbookCart::where('user_id',Auth::user()->id)->delete();
        return view('ebook::web.confirmation');
    }
}