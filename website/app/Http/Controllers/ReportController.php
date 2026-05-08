<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Table;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller //done
{
    public function index()
    {
        $emptyTables = Table::where('status', 'available')->count();
        $bookedTables = Table::where('status', 'reserved')->count();
        $usingTables = Table::where('status', 'occupied')->count();

        $totalBookings = Booking::count();
        $totalRevenue = Booking::sum('total_price');

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
    $data = [
        ['Loại báo cáo', 'Giá trị'],

        ['Số bàn trống', $emptyTables = \App\Models\Table::where('status', 'available')->count()],
        ['Số bàn đã đặt', $bookedTables = \App\Models\Table::where('status', 'reserved')->count()],
        ['Số bàn đang sử dụng', $usingTables = \App\Models\Table::where('status', 'occupied')->count()],

        ['Tổng đặt bàn', $totalBookings = \App\Models\Booking::count()],
        ['Tổng doanh thu', $totalRevenue = \App\Models\Booking::sum('total_price')],

        ['Tổng khách hàng', $totalUsers = \App\Models\User::count()],
        ['Khách hàng mới hôm nay', $newUsersToday = \App\Models\User::whereDate('created_at', today())->count()],
    ];

    return Excel::download(new ReportsExport($data), 'bao_cao.xlsx');
}
}