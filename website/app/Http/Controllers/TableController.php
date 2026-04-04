<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    // Lấy danh sách tất cả bàn
    public function index()
    {
        $tables = Table::all();
        return response()->json($tables, 200);
    }

    // Lấy chi tiết một bàn theo ID
    public function show($id)
    {
        $table = Table::findOrFail($id);
        return response()->json($table, 200);
    }

    // Thêm bàn mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:tables',
            'capacity' => 'required|integer|min:1',
            'status' => 'in:available,reserved,occupied'
        ]);

        $table = Table::create($validated);
        return response()->json($table, 201);
    }

    // Cập nhật thông tin bàn
    public function update(Request $request, $id)
    {
        $table = Table::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|unique:tables,name,' . $id,
            'capacity' => 'sometimes|integer|min:1',
            'status' => 'sometimes|in:available,reserved,occupied'
        ]);

        $table->update($validated);
        return response()->json($table, 200);
    }

    // Xóa bàn
    public function destroy($id)
    {
        $table = Table::findOrFail($id);

        // Chỉ cho phép xóa nếu bàn đang trống
        if ($table->status !== 'available') {
            return response()->json(['error' => 'Bàn đang được sử dụng, không thể xóa'], 400);
        }

        $table->delete();
        return response()->json(['message' => 'Xóa bàn thành công'], 200);
    }

    // Đặt trạng thái bàn thành "occupied"
    public function occupy($id)
    {
        $table = Table::findOrFail($id);

        if ($table->status !== 'reserved') {
            return response()->json(['error' => 'Bàn phải được đặt trước khi chuyển sang trạng thái đang sử dụng'], 400);
        }

        $table->update(['status' => 'occupied']);
        return response()->json(['message' => 'Bàn đang được sử dụng'], 200);
    }

    // Giải phóng bàn (trở lại trạng thái available)
    public function release($id)
    {
        $table = Table::findOrFail($id);
        $table->update(['status' => 'available']);
        return response()->json(['message' => 'Bàn đã trống'], 200);
    }
}
