<?php

namespace App\Http\Controllers;

use App\Models\CartDetail;
use App\Models\CartHeader;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ValidatedInput;

class CartController extends BaseController
{

    function index()
    {
        return view('cart', [
            'title' => 'Cart Page',
            'cartitems' => CartHeader::latest('cart_headers.created_at')
                ->where('cart_headers.user_id', '=', strval(Session::get('user')['id']))
                ->join('cart_details', 'cart_headers.id', '=', 'cart_details.cart_id')
                ->join('items', 'items.id', '=', 'cart_details.item_id')
                ->groupBy('cart_headers.id')
                ->selectRaw('sum(quantity*price) as sum,sum(quantity) as ctr, cart_headers.id')
                ->first()
        ]);
    }



    function indexUpdateCart(Item $product)
    {
        return view('updateCart', [
            'title' => "Update Cart Item",
            "product" => $product,
            "quantity" => CartHeader::where('user_id', '=', strval(Session::get('user')['id']))->first()
            ->cartDetail()->where('cart_details.item_id','=',$product->id)
            ->first()['quantity']
        ]);
    }
    public function updateCartQuantity(Request $req)
    {

        $rules = [
            'quantity' => 'required|gte:1',
            "id" => 'exists:items'
        ];

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) return back()->withErrors($validator);

        if (
            !Session::get('user') ||
            CartHeader::where('user_id', '=', strval(Session::get('user')['id']))
            ->get()
            ->count() == 0
        ) {
            return redirect()->route('login');
        }

        $header = CartHeader::where('user_id', '=', strval(Session::get('user')['id']))->first('id');

        CartDetail::where([
            ['cart_id', '=', $header['id']],
            ['item_id', '=', $req->id]
        ])->update(['quantity' => $req->quantity]);


        return back()->with('success', 'Updated!');
    }

    public function deleteCartItem(Request $req)
    {


        if (
            !Session::get('user') ||
            CartHeader::where('user_id', '=', strval(Session::get('user')['id']))
            ->get()
            ->count() == 0
        ) {
            return redirect()->route('login');
        }
        CartDetail::where([
            ['cart_id', '=', $req->cart_id],
            ['item_id', '=', $req->item_id]
        ])->delete();

        return back();
    }


    public function addCart(Request $req)
    {
        $validatedInput = $req->validate([
            'quantity' => 'required|gte:1',
            "id" => 'exists:items'
        ]);


        if (!Session::get('user')) {
            return redirect()->route('login');
        }

        if (
            CartHeader::where('user_id', '=', strval(Session::get('user')['id']))
            ->get()
            ->count() == 0
        ) {
            $cartHeader = new CartHeader();
            $cartHeader->user_id = Session::get('user')['id'];
            $cartHeader->save();
        }


        $cartId = CartHeader::where('user_id', '=', strval(Session::get('user')['id']))
            ->select('id')
            ->first()['id'];

        if (CartDetail::where([
            ['cart_id', '=', $cartId],
            ['item_id', '=', $validatedInput['id']]
        ])->get()->count() != 0) {
            CartDetail::where([
                ['cart_id', '=', $cartId],
                ['item_id', '=', $validatedInput['id']]
            ])->increment('quantity', $validatedInput['quantity']);
        } else {
            $cartDetail = new CartDetail();
            $cartDetail->cart_id = $cartId;
            $cartDetail->item_id = $validatedInput['id'];
            $cartDetail->quantity =  $validatedInput['quantity'];
            $cartDetail->save();
        }
        return back()->with('success', 'Added!');
    }
}
