<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Đặt bàn hôm nay
        $todayBookings = Booking::whereDate('time', Carbon::today())->count();

        // Tổng bàn
        $totalTables = Table::count();

        // Bàn đang được đặt hôm nay
        $bookedTables = Booking::whereDate('time', Carbon::today())
            ->distinct('table_id')
            ->count('table_id');

        $availableTables = $totalTables - $bookedTables;

        // Doanh thu tháng (triệu)
        $monthlyRevenue = Booking::whereMonth('time', Carbon::now()->month)
            ->sum('total_price') / 1000000;

        // Tổng user
        $totalUsers = User::count();

        // Booking gần đây
        $recentBookings = Booking::with(['user', 'table'])
            ->latest()
            ->take(5)
            ->get();

        // Chart doanh thu 7 ngày
        $labels = [];
        $revenues = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            $labels[] = $date->format('d/m');

            $revenues[] = Booking::whereDate('time', $date)
                ->sum('total_price') / 1000000;
        }

        // Trạng thái booking
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