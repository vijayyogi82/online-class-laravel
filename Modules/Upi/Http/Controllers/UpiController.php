<?php

namespace Modules\Upi\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Upi\Models\Upi;

class UpiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        $upi = Upi::first();
        return view('upi::setting',compact('upi'));
    }

    public function update(Request $request)
    {
        if(config('app.demolock') == 1){
            return back()->with('delete','Disabled in demo');
        }
        try {

            $upi = Upi::first();
            if ($upi) {
                $upi->status = isset($request->status) ? 1 : 0;
                $upi['name'] = strip_tags($request->name);
                $upi['upiid'] = strip_tags($request->upiid);
                $upi->save();

            } else {

                $upi = new Upi;
                $upi->status = isset($request->status) ? 1 : 0;
                $upi['name'] = strip_tags($request->name);
                $upi['upiid'] = strip_tags($request->upiid);
                $upi->save();
            }
            return redirect()->route('upi')->with('success', trans('flash.UpdatedSuccessfully'));

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function upidetail(){
        
        $upi = UPI::first();
        return response()->json(array('upi' => $upi), 200);
    }
}
