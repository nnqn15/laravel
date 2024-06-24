<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class HomeController extends Controller
{
    function index(){
        //lấy dữ liệu từ model
        $categories=Category::select('id','name')->limit(12)->get();
        $products=Product::select('id','title','image','image1','price','sale')->get();
        $newpro=Product::select('id','title','image','image1','price','sale')->orderBy('id','desc')->limit(4)->get();
        $specialpro=Product::select('id','title','image','image1','price','sale')->orderBy('sale','desc')->limit(4)->get();
        $bestsellers=Product::select('id','title','image','image1','price','sale')->orderBy('sale','asc')->limit(4)->get();
        $get6bestsellers=Product::select('id','title','image','image1','price','sale')->orderBy('sale','asc')->limit(6)->get();
        //truyền dữ liệu sang view
        return view('home',['products'=>$products,'categories'=>$categories,'newpro'=>$newpro,'bestsellers'=>$bestsellers,'specialpro'=>$specialpro,'get6bestsellers'=>$get6bestsellers]);
    }
    function about(){
        //lấy dữ liệu từ model

        //truyền dữ liệu sang view
        return view('about');
    }
    function contact(){
        //lấy dữ liệu từ model

        //truyền dữ liệu sang view
        return view('contact');
    }
}
