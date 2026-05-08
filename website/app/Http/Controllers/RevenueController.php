<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;

class RevenueController extends Controller
{
    public function index()//done
    {
        $monthlyRevenue = Booking::whereMonth('time', Carbon::now()->month)
            ->sum('total_price');

        $revenuesByDate = Booking::selectRaw('date, SUM(total_price) as total')
            ->where('payment_status', 'paid')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(10)
            ->get();

        return view('admin.revenue', compact(
            'monthlyRevenue',
            'revenuesByDate'
        ));
    }
}