<?php

namespace App\Http\Controllers\Sellers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Maincontroller extends Controller
{
    public function index()
    {
//        $users_count = Cache::rememberForever('admin.users_count', function () {
//            return User::where('level', '!=', 'creator')->count();
//        });
//        $products_count = Cache::rememberForever('admin.products_count', function () {
//            return Product::count();
//        });
//        $orders_count = Cache::rememberForever('admin.orders_count', function () {
//            return Order::count();
//        });
//
//        $total_sell = Cache::rememberForever('admin.total_sell', function () {
//            return Order::where('status', 'paid')->sum('price');
//        });

        return view('sellers.index'
//            , compact(
//            'users_count',
//            'products_count',
//            'orders_count',
//            'total_sell'
//        )
        );
    }
}
