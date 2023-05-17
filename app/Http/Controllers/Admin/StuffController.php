<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Stuff;
use Illuminate\Http\Request;

class StuffController extends Controller
{
    public function index($category_id = 1){

        $categories = Category::all();
        $stuffs = Stuff::orderByDesc('updated_at')->get();
        return view('admin.stuff.index',compact('stuffs','categories'));
    }
    public function destroy($id){
        Stuff::where('id', $id)->delete();
        return redirect()->back()->with('msg','کالای موردنظر پاک شد');
    }
    public function update(Request $request){
        if ($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
           Stuff::where('id', $request->id)->update([
                'image' => $path
            ]);
        }
        Stuff::where('id', $request->id)->update([
            'name' => $request->name,
            'brands' => $request->brand,
            'category_id' => $request->category,
        ]);
        return redirect()->back()->with('msg','کالای موردنظر ویرایش شد');
    }
    public function store(Request $request){
        $path = "https://via.placeholder.com/300";
        if ($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
        }


        $validatedData = $request->validate([
            'name' => ['required','max:255'],
            'cat' => ['required'],
        ]);

        Stuff::create([
            'name' => $request->name,
            'brands' => $request->brand ?? '-',
            'image' => $path,
            'category_id' => $request->cat,
        ]);
        return redirect()->back()->with('msg','کالای موردنظر ایجاد شد');
    }
}
