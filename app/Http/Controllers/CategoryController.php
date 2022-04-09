<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function AllCat(){
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index', compact('categories', 'trashCat'));
    }

    public function AddCat(Request $request){
        $validateData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        return Redirect()->back()->with('success', 'Category Added Successfully');
    }

    public function Edit($id){
        $categories = Category::find($id);
        return view('admin.category.edit', compact('categories'));
    }

    public function Update(Request $request, $id){
        $validateData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);
        $update = Category::find($id)->Update([
                'category_name' =>$request->category_name,
                'user_id' =>Auth::user()->id
        ]);

        return redirect()->route('all.category')->with('success', 'Category Updated Successfull');
    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category soft Delete successfull');
    }

    public function Restore($id){
        $restore = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category restored successfull');
    }
    public function Pdelete($id){
        $pdelete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category deleted permanently');
    }
}
