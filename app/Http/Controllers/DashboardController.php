<?php

namespace App\Http\Controllers;


use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() 
    {
        $items = Item::all();
        $types = Item::select('type')->distinct()->get();

        return view ('pages.dashboard.index',[
            'items' => $items,
            'types' => $types

        ]);
    }
}
