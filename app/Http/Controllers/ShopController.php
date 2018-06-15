<?php

namespace App\Http\Controllers;

use App\Lotshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function becomeshop()
    {
        return view('becomeshop');
    }
    public function postShop(Request $request) {
        $data = Input::all();
        $validator = Validator::make($data, Lotshop::$rules, Lotshop::$messages);

        if ($validator->fails()) {
//            return back()->with(['errormsg'=>$validator->getMessageBag()->first()]);
            return view('becomeshop')->with(['errormsg'=>$validator->getMessageBag()->first()]);
        }
        $data['loginusername'] = Auth::user()->name;
        $data['loginuserid'] = Auth::user()->id;
        Lotshop::create($data);
        return view('welcome');
    }
    public  function  personalshop(Request $request){
        return view('personalshop');
    }
    public  function  emotions(Request $request) {
        return view('emotions');
    }
    public  function  xuanpiao(Request $request) {
        return view('xuanpiao');
    }
   public function  querenhao(Request $request) {
        $red = $request->get('red');
        $blue = $request->get('blue');
        $beishu = $request->get('beishu');
        return $red;


   }
}
