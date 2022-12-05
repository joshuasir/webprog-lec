<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class ItemController extends BaseController
{
    //
    public  function indexProductsFood()
    {
        return view('products', [
            'title' => 'Food Products',
            'products' => Item::latest()
                ->where('category','=','Food')
                ->filter()
                ->paginate(6)
                ->withQueryString(),
                'category' => 'food'
        ]);
    }

    public  function indexProductsDrink()
    {
        return view('products', [
            'title' => 'Drink Products',
            'products' => Item::latest()
                ->where('category','=','Beverage')
                ->filter()
                ->paginate(6)
                ->withQueryString(),
            'category' => 'beverage'
        ]);
    }

    public  function indexProductsDessert()
    {
        return view('products', [
            'title' => 'Dessert Products',
            'products' => Item::latest()
                ->where('category','=','Dessert')
                ->filter()
                ->paginate(6)
                ->withQueryString(),
            'category' => 'dessert'
        ]);
    }

    public  function indexProductDetail(Item $product)
    {
        return view('productDetail', [
            "title" => "Product Detail",
            "product" => $product
        ]);
    }


    function indexManageItem()
    {
        return view('manageItem', ['products' => Item::all()]);
    }
    function deleteItem(item $product)
    {
        if ($product->image !== 'images/default-image.jpg')
            Storage::delete('public/' . $product->image);
        Item::destroy($product->id);
        return redirect('/manageItem')->with('success', 'Item has been deleted!');
    }

    function indexAddItem()
    {
        return view('addItem');
    }

    function addItem(Request $req)
    {

        $validData = $req->validate([
            'id' => 'required|unique:items|string|min:5|max:5',
            'name' => 'required|unique:items|string|max:20',
            'price' => 'required|numeric|gte:1000',
            'description' => 'required|string|max:200',
            'image' => 'required|image',
            'category' => 'required|in:Food,Beverage,Dessert'
        ]);

        $image = $req->file('image');
        $imageName = date('YmdHi') . $image->getClientOriginalName();
        Storage::putFileAs('public/images', $image, $imageName);
        $imageURL = 'images/' . $imageName;
        $validData['image'] = $imageURL;
        Item::create($validData);
        return redirect('/manageItem')->with('success', 'Item has been added!');
    }

    function indexUpdateItem(Item $product)
    {
        return view('updateItem', [
            'title' => "updateItem",
            "product" => $product
        ]);
    }

    function updateItem(Request $req, Item $product)
    {
        $rules = [
            'price' => 'required|numeric|gte:1000',
            'description' => 'required|string|max:200',
            'category' => 'required|in:Food,Beverage,Dessert'
        ];

        if ($req->name != $product->name) {
            $rules['name'] = 'required|unique:items|string|max:20';
        }

        if ($req->has('image')) {
            $rules['image'] = 'required|image';
            $validData = $req->validate($rules);

            // delete gambar yang lama yang bukan default
            if ($product->image !== 'images/default-image.jpg')
                Storage::delete('public/' . $product->image);

            $image = $req->file('image');
            $imageName = date('YmdHi') . $image->getClientOriginalName();
            Storage::putFileAs('public/images', $image, $imageName);
            $imageURL = 'images/' . $imageName;
            $validData['image'] = $imageURL;
            Item::where('id', $product->id)->update($validData);
        } else {
            $validData = $req->validate($rules);
            $validData['image'] = $product->image;
            Item::where('id', $product->id)->update($validData);
        }
        return redirect('/manageItem')->with('success', 'Item has been updated!');
    }
}
