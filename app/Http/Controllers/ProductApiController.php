<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductApiController extends Controller
{
    public function index()
    {
        // GET
        try {
            $products = Product::all();
            return response()->json([
                'status' => 'success',
                'message' => 'Dữ liệu được lấy thành công',
                'data' => ProductResource::collection($products),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function store(Request $request)
    {
        // POST
        try {
            $validatedData = $request->validate([
                'title' => 'required',
                'price' => 'required|numeric',
                'image' => 'nullable|url',
            ], [
                'title.required' => 'Vui lòng nhập tên sản phẩm',
                'price.required' => 'Vui lòng nhập giá sản phẩm',
                'price.numeric' => 'Giá sản phẩm phải là số',
                'image.url' => 'Vui lòng nhập đúng định dạng URL cho ảnh',
            ]);

            $product = Product::create([
                'title' => $request->title,
                'price' => $request->price,
                'image' => $request->image,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Thêm sản phẩm thành công',
                'data' => new ProductResource($product),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
                'data' => null,
            ], 400);
        }
    }

    public function show($id)
    {
        // GET
        try {
            $product = Product::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Lấy dữ liệu sản phẩm thành công',
                'data' => new ProductResource($product),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
                'data' => null,
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        // PUT/PATCH
        try {
            $validatedData = $request->validate([
                'title' => 'required',
                'price' => 'required|numeric',
                'image' => 'nullable|url',
            ], [
                'title.required' => 'Vui lòng nhập tên sản phẩm',
                'price.required' => 'Vui lòng nhập giá sản phẩm',
                'price.numeric' => 'Giá sản phẩm phải là số',
                'image.url' => 'Vui lòng nhập đúng định dạng URL cho ảnh',
            ]);

            $product = Product::findOrFail($id);
            $product->update([
                'title' => $request->title,
                'price' => $request->price,
                'image' => $request->image,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Cập nhật sản phẩm thành công',
                'data' => new ProductResource($product),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function destroy($id)
    {
        // DELETE
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Xóa sản phẩm thành công',
                'data' => null,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}
