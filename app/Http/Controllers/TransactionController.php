<?php

namespace App\Http\Controllers;

use App\Models\CartDetail;
use App\Models\CartHeader;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TransactionController extends BaseController
{
    //
    function index()
    {
       
        return view('transactionHistory', [
            'title' => 'Transaction History',
            'histories' => TransactionHeader::latest('transaction_headers.created_at')
                ->where('transaction_headers.user_id', '=', strval(Session::get('user')['id']))
                ->join('transaction_details', 'transaction_headers.id', '=', 'transaction_details.transaction_id')
                ->join('items', 'items.id', '=', 'transaction_details.item_id')
                ->groupBy(['transaction_headers.id','transaction_headers.created_at'])
                ->selectRaw('sum(quantity*price) as sum,sum(quantity) as ctr, transaction_headers.id, transaction_headers.created_at as created')
                ->get()
        ]);
    }

    function checkout(Request $req)
    {
        $rules = [
            'name' => 'required',
            "address" => 'required'
        ];

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) return back()->withErrors($validator);

        $header = new TransactionHeader();
        $header->receiver_name = $req->name;
        $header->receiver_address = $req->address;
        $header->user_id = Session::get('user')['id'];
        $header->save();

        $datas = CartDetail::where('cart_id', '=', $req->cart_id)->get();

        foreach ($datas as $data) {
            $detail = new TransactionDetail();
            $detail->transaction_id = $header->id;
            $detail->item_id = $data->item_id;
            $detail->quantity = $data->quantity;
            $detail->save();
        }
        CartDetail::where('cart_id', '=', $req->cart_id)->delete();

        return redirect()->route('transactionHistory');
    }
}
