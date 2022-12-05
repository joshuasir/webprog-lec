<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function index()
    {
        return view('home',[
            'favourites'=>Item::latest('ctr')
            ->join('transaction_details', 'items.id', '=', 'transaction_details.item_id')
            ->groupBy(['items.id','items.name','items.image'])
            ->selectRaw('sum(quantity) as ctr, items.id,items.name,items.image')->take(10)->get()

        ]);
    }
}
