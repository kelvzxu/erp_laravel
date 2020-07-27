<?php

namespace App\Addons\Inventory\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Inventory\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = category::orderBy('created_at', 'DESC')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            $categories = category::firstOrCreate([
                'name' => $request->name
            ], [
                'description' => $request->description
            ]);
            return redirect()->back()->with(['success' => 'Category: ' . $categories->name . ' created success']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $categories = category::findOrFail($request->id);
        $categories->delete();
        return redirect(route('product-categories'))->with(['success' => 'data berhasil Telah Dihapus']);
    }

    public function edit($id)
    {
        $categories = category::findOrFail($id);
        return view('categories.edit', compact('categories'));
    }

    public function update(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            $categories = category::where('id',$request->id)->update([
                'name' => $request->name,
                'description' => $request->description
            ]);
            return redirect(route('product-categories'))->with(['success' => 'Kategori: '.$request->name.' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
