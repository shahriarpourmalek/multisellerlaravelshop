<?php

namespace App\Http\Controllers\Sellers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Maincontroller extends Controller
{
    public function index()
    {
        $sellerId = Auth::guard('sellers')->user()->id;

        $products_count = Cache::rememberForever("sellers.products_count", function () use ($sellerId) {
            return Product::where('seller_id', $sellerId)->count();
        });
        $orders_count = Cache::rememberForever("sellers.orders_count", function () use ($sellerId) {
            return OrderItem::whereHas('product', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })->count();
        });

        $total_sell = Cache::rememberForever("sellers.total_sell", function () use ($sellerId) {
            return OrderItem::whereHas('product', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })->whereHas('order', function ($query) {
                $query->where('status', 'paid');
            })->sum('real_price');
        });
        return view('sellers.index'
            , compact(
            'products_count',
            'orders_count',
            'total_sell'
        )
        );
    }
    public function get_tags(Request $request)
    {
        $tags = Tag::detectLang()->where('name', 'like', '%' . $request->term . '%')
            ->latest()
            ->take(5)
            ->pluck('name')
            ->toArray();

        return response()->json($tags);
    }

    public function getLabels(Request $request)
    {
        $labels = Label::detectLang()->where('title', 'like', '%' . $request->term . '%')
            ->latest()
            ->take(5)
            ->pluck('title')
            ->toArray();

        return response()->json($labels);
    }


    public function notifications()
    {
        $notifications = auth('sellers')->user()->notifications()->paginate(15);

        auth('sellers')->user()->unreadNotifications->markAsRead();

        return view('sellers.notifications', compact('notifications'));
    }

    public function fileManager()
    {
        $this->authorize('sellers.file-manager');

        return view('sellers.file-manager');
    }

    public function fileManagerIframe()
    {
        $this->authorize('file-manager');

        return view('sellers.file-manager-iframe');
    }
}
