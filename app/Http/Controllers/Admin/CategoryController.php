<?php
namespace App\Http\Controllers\Admin;
use App\Category;
use App\Http\Controllers\Controller;
use App\Stuff;
use Illuminate\Http\Request;
class CategoryController extends Controller
{
    public function index( ){
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }

    public function store(Request $request){
        $path = "https://via.placeholder.com/300";

        if ($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
        }

        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'parent_id' => 'required',
        ]);

        Category::create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'image'=>$path,
        ]);

        return redirect()->back()->with('msg','دسته افزوده شد');
    }
    public function update(Request $request){

        if ($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
            Category::where('id', $request->id)->update([
                'image' => $path
            ]);
        }

        Category::where('id',$request->id)->update([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id
        ]);
        return redirect()->back()->with('msg','تغییرات ایجاد شد');
    }
    public function destroy($id)
    {
        Category::where('id',$id)->delete();
        Stuff::where('category_id',$id)->update([
            'category_id'=>1
        ]);
        return redirect()->back()->with('msg','تغییرات ایجاد شد');
    }
}
