<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{

    public function adminIndex()
    {
        $tables = Table::all();
        return view('admin.tables', compact('tables'));
    }

    // Lấy chi tiết một bàn theo ID
    public function show($id)
    {
        $table = Table::findOrFail($id);
        return response()->json($table, 200);
    }

    // Thêm bàn mới
    public function create()
    {
        return view('admin.tables.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:tables',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:1000',
            'location' => 'required|in:Sảnh chính,Sân thượng,Khu VIP',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('table', 'public');
        }

        Table::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'location' => $request->location,
            'price' => (int) $request->price,
            'image' => $imagePath,
        ]);
        return redirect()->route('admin.tables')->with('success', 'Thêm bàn mới thành công');
    }

    // Cập nhật thông tin bàn
    public function edit($id)
    {
        $table = Table::findOrFail($id);
        return view('admin.tables.edit', compact('table'));
    }

    public function update(Request $request, $id)
    {
        $table = Table::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|unique:tables,name,' . $id,
            'capacity' => 'sometimes|integer|min:1',
            'status' => 'sometimes|in:available,reserved,occupied',
            'price' => 'sometimes|numeric|min:1',
            'location' => 'sometimes|in:Sảnh chính,Sân thượng,Khu VIP',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('table', 'public');
            $validated['image'] = $imagePath;
        }

        $table->update($validated);
        return redirect()->route('admin.tables')->with('success', 'Cập nhật bàn thành công');
    }

    // Xóa bàn
    public function destroy($id)
    {
        $table = Table::findOrFail($id);

        // Chỉ cho phép xóa nếu bàn đang trống
        if ($table->status !== 'available') {
            return redirect()->route('admin.tables')->with('error', 'Bàn đang được sử dụng, không thể xóa');
        }

        $table->delete();
        return redirect()->route('admin.tables')->with('success', 'Xóa bàn thành công');
    }




    // Đặt trạng thái bàn thành "occupied"
    public function occupy($id)
    {
        $table = Table::findOrFail($id);

        if ($table->status !== 'reserved') {
            return redirect()->route('admin.tables')->with('error', 'Bàn phải được đặt trước khi chuyển sang trạng thái đang sử dụng');
        }

        $table->update(['status' => 'occupied']);
        return redirect()->route('admin.tables')->with('success', 'Bàn đang được sử dụng');
    }

    // Set trạng thái bàn thành "available"
    public function release($id)
    {
        $table = Table::findOrFail($id);
        $table->update(['status' => 'available']);
        return redirect()->route('admin.tables')->with('success', 'Bàn đã trống');
    }
}
