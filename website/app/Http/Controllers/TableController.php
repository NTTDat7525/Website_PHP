<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    // Tìm kiếm bàn (Search tables)
    public function search(Request $request)
    {
        $capacity = $request->input('capacity');
        $type = $request->input('type');
        $status = $request->input('status', 'available');

        $query = Table::where('status', $status);

        if ($capacity) {
            $query->where('capacity', '>=', $capacity);
        }

        if ($type) {
            $query->where('type', $type);
        }

        $tables = $query->get();

        return response()->json([
            'message' => 'Tìm kiếm thành công',
            'data' => $tables
        ], 200);
    }

    // Danh sách tất cả bàn (List all tables)
    public function list()
    {
        $tables = Table::all();

        return response()->json([
            'message' => 'Lấy danh sách bàn thành công',
            'data' => $tables
        ], 200);
    }

    // Chi tiết bàn
    public function show($id)
    {
        $table = Table::find($id);

        if (!$table) {
            return response()->json(['message' => 'Bàn không tồn tại'], 404);
        }

        return response()->json([
            'message' => 'Lấy thông tin bàn thành công',
            'data' => $table
        ], 200);
    }
}
