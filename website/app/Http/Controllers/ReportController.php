<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Table;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // Trang báo cáo
    public function index()
    {
        // ===== Báo cáo bàn =====
        $emptyTables = Table::where('status', 'empty')->count();
        $bookedTables = Table::where('status', 'booked')->count();
        $usingTables = Table::where('status', 'using')->count();

        // ===== Báo cáo hoạt động =====
        $totalBookings = Booking::count();
        $totalRevenue = Booking::sum('total_price');

        // ===== Báo cáo khách hàng =====
        $totalUsers = User::count();
        $newUsersToday = User::whereDate('created_at', today())->count();

        return view('admin.reports', compact(
            'emptyTables',
            'bookedTables',
            'usingTables',
            'totalBookings',
            'totalRevenue',
            'totalUsers',
            'newUsersToday'
        ));
    }

    // Export báo cáo (nếu cần sau này)
    public function export()
    {
        // logic export excel/pdf sau
        return response()->json(['message' => 'Export thành công']);
    }
}