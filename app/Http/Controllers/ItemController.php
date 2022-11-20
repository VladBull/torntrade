<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $numberOfItems = $request->get('items');

        $items = Item::orderBy('game_item_id', 'asc')->paginate($numberOfItems ? $numberOfItems : 100000);
        return view('pages.items.index',[
            'items' => $items           
        ]);
    }

    /**
     * Function that returns add form
    */
    public function add()
    {
        return view('pages.items.add');
        
    }

    /**
     * Function that inserts a new item into the database
     */
    public function save(StoreItemRequest $request)
    {
        if($request->validated()){
            $args = $request->only(['name','game_item_id','description','type','my_price', 'buy_price','sell_price','market_value','circulation']);

            $item = new Item($args);

            $item->save();

        return redirect()->back()->with('success',"Item: $item->name added successfully!");
        }
    }

    /**
     * Function that handles view items
     */
    public function show(Item $item)
    {
        return view('pages.items.show',[
            'item' => $item
        ]);
    }

    /**
     * Function that handles edit items view
     */

    public function edit(Item $item)
    {
        return view('pages.items.edit',[
            'item' => $item
        ]);
    }

    /**
     * Function that handles updating items
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        if($request->validated())
        {
            $args = $request->only(['name','game_item_id','description','type','my_price','market_value','buy_price','sell_price','circulation']);

            $item->update($args);

            return redirect('admin/items')->with('success','Item updated successfully');
        }
    }

    /**
     * Function that handles deleting items
     */
    public function delete(Item $item)
    {
        $item->delete();

        return redirect('admin/items')->with('success','Item deleted from database.');

    }

    /**
     * Function that handles searches
     */ 

    public function search(Request $request)
    {
        $search = $request->get('search');

        $items = Item::where('name', "LIKE", "%$search%")
        ->orWhere("description","LIKE","%$search%")
        ->orWhere('type',"LIKE","%$search%")
        ->paginate(5);

        return view('pages.items.index',[
            'items' => $items
        ]);
    }

}