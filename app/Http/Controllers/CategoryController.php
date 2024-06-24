<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    function categories($id){
        //lấy dữ liệu từ model
        $categories=Category::select('id','name')->get();
        $category=Category::select('id','name')->where('id','=',$id)->first();
        $bestsellers=Product::select('id','title','image','image1','price','sale')->orderBy('sale','asc')->limit(3)->get();
        $products=Product::select('id','title','image','image1','price','sale','description')->where('category_id','=',$id)->limit(9)->get();
        $link='categories/'.$id;
        $titlepage='Danh mục '.$category->name;
        //truyền dữ liệu sang view
        return view('product.shop',['link'=>$link,'titlepage'=>$titlepage,'categories'=>$categories,'bestsellers'=>$bestsellers,'products'=>$products]);
    }
    function admincategories()
    {
        //lấy dữ liệu từ model
        $categories = Category::orderBy('id', 'desc')->get();
        //truyền dữ liệu sang view
        return view('admin.category', ['categories' => $categories]);
    }
    function addcate(Request $request)
    {
        //lấy dữ liệu từ model
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục',
        ]);
        Category::create(
            [
                'name' => $request->name,
            ]
        );
        return redirect()->route('admin.categories')->with('success', 'Thêm danh mục thành công');
    }
    function editcate($id)
    {
        //lấy dữ liệu từ model
        $cate = Category::findorfail($id);
        //truyền dữ liệu sang view
        return view('admin.editcate', compact('cate'));
    }
    function updatecate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục',
        ]);

        $cate = Category::findOrFail($id);
        $cate->name = $request->input('name');
        $cate->save();

        return redirect()->route('admin.categories')->with('success', 'Sửa danh mục thành công');
    }

    function destroy($id)
    {
        $category = Category::findorfail($id);
        $category->products()->update(['category_id' => null]);
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Xoá danh mục thành công');
    }
}
