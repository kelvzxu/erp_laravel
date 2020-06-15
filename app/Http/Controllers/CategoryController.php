<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Category;
use Illuminate\Support\Facades\Auth;
use App\access_right;
use App\User;

class CategoryController extends Controller
{
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $categories = Category::orderBy('created_at', 'DESC')->paginate(10);
        return view('categories.index', compact('categories','access','group'));
    }

    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            $categories = Category::firstOrCreate([
                'name' => $request->name
            ], [
                'description' => $request->description
            ]);
            return redirect()->back()->with(['success' => 'Kategori: ' . $categories->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $categories = Category::findOrFail($request->id);
        $categories->delete();
        return redirect(route('product-categories'))->with(['success' => 'data berhasil Telah Dihapus']);
    }

    public function edit($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $categories = Category::findOrFail($id);
        return view('categories.edit', compact('categories','access','group'));
    }

    public function update(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            $categories = Category::where('id',$request->id)->update([
                'name' => $request->name,
                'description' => $request->description
            ]);
            // print_r($request->name);
            return redirect(route('product-categories'))->with(['success' => 'Kategori: '.$request->name.' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
