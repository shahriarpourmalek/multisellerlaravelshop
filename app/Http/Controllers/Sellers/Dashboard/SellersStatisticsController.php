<?php

namespace App\Http\Controllers\Sellers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Sms;
use App\Models\Viewer;
use App\Traits\OrderStatisticsTrait;
use App\Traits\UserStatisticsTrait;
use App\Traits\ViewStatisticsTrait;
use Illuminate\Http\Request;

class SellersStatisticsController extends Controller
{
    use OrderStatisticsTrait, UserStatisticsTrait, ViewStatisticsTrait;

    public function viewsList()
    {
        $this->authorize('sellers.statistics.viewsList');
        $views = Viewer::latest();
        if (auth('sellers')->user()) {
            $views = $views->whereNull('user_id')->orWhere(function ($query) {
                $query->whereHas('user', function ($q1) {
                    $q1->where('level', '!=', 'creator');
                });
            });
        }

        $views = $views->paginate(20);

        return view('sellers.statistics.views.viewsList', compact('views'));
    }

    public function views()
    {
        $this->authorize('sellers.statistics.views');

        return view('sellers.statistics.views.index');
    }

    public function viewers()
    {
        $this->authorize('sellers.statistics.viewers');

        $viewers = Viewer::latest()->whereDate('created_at', now())->get()->unique('user_id');

        return view('sellers.statistics.viewers.viewers', compact('viewers'));
    }

    public function orders()
    {
        $this->authorize('sellers.statistics.orders');

        return view('sellers.statistics.orders.index');
    }

    public function users()
    {
        $this->authorize('sellers.statistics.users');

        return view('sellers.statistics.users.index');
    }

    public function smsLog()
    {
        $this->authorize('sellers.statistics.sms');

        $sms = Sms::latest()->paginate(20);

        return view('sellers.statistics.sms.sms-log', compact('sms'));
    }}
