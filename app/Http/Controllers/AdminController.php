<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\OrderDetail;

class AdminController extends Controller
{
    function index()
    {
        //lấy dữ liệu từ model

        //truyền dữ liệu sang view
        return view('admin.dashboard');
    }
    function users()
    {
        //lấy dữ liệu từ model

        //truyền dữ liệu sang view
        return view('admin.user');
    }
    
}
