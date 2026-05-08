<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()//done
    {
        $todayBookings = Booking::whereDate('date', Carbon::today())->count();

        $totalTables = Table::count();

        $bookedTables = Booking::whereDate('date', Carbon::today())
            ->distinct('table_id')
            ->count('table_id');

        $availableTables = $totalTables - $bookedTables;

        $monthlyRevenue = Booking::whereMonth('date', Carbon::now()->month)
            ->sum('total_price') / 1000000;

        $totalUsers = User::count();

        $recentBookings = Booking::with(['user', 'table'])
            ->latest()
            ->take(5)
            ->get();

        $labels = [];
        $revenues = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            $labels[] = $date->format('d/m');

            $revenues[] = Booking::whereDate('date', $date)
                ->sum('total_price') / 1000000;
        }

        $confirmed = Booking::where('status', 'confirmed')->count();
        $pending = Booking::where('status', 'pending')->count();
        $cancelled = Booking::where('status', 'cancelled')->count();

        return view('admin.dashboard', compact(
            'todayBookings',
            'availableTables',
            'totalTables',
            'monthlyRevenue',
            'totalUsers',
            'recentBookings',
            'labels',
            'revenues',
            'confirmed',
            'pending',
            'cancelled'
        ));
    }

}