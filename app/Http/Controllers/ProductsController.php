<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Order;

class ProductsController extends Controller
{
    function index()
    {
        //lấy dữ liệu từ model
        $categories = Category::select('id', 'name')->get();
        $bestsellers = Product::select('id', 'title', 'image', 'image1', 'price', 'sale')->orderBy('sale', 'asc')->limit(3)->get();
        $products = Product::select('id', 'title', 'image', 'image1', 'price', 'sale', 'description')->limit(9)->get();
        $link = 'shop';
        $titlepage = 'Cửa hàng';
        //truyền dữ liệu sang view
        return view('product.shop', ['link' => $link, 'titlepage' => $titlepage, 'categories' => $categories, 'bestsellers' => $bestsellers, 'products' => $products]);
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        // lấy dữ liệu từ model
        $categories = Category::select('id', 'name')->get();
        $bestsellers = Product::select('id', 'title', 'image', 'image1', 'price', 'sale')->orderBy('sale', 'asc')->limit(3)->get();
        $products = searchInTable('products', $keyword); // Adjusted to use the helper method

        $link = 'shop';
        $titlepage = 'Sản phẩm có từ khóa "'.$keyword.'"';

        // truyền dữ liệu sang view
        return view('product.shop', [
            'link' => $link,
            'titlepage' => $titlepage,
            'categories' => $categories,
            'bestsellers' => $bestsellers,
            'products' => $products
        ]);
    }
    function detail($id)
    {
        //lấy dữ liệu từ model
        $categories = Category::select('id', 'name')->get();
        $product = Product::Where('id', '=', $id)->first();
        $sameproducts = Product::select('id', 'title', 'image', 'image1', 'price', 'sale')->Where('category_id', '=', $product->category_id)->limit(3)->get();
        $bestsellers = Product::select('id', 'title', 'image', 'image1', 'price', 'sale')->orderBy('sale', 'asc')->limit(3)->get();
        //truyền dữ liệu sang view
        return view('product.detail', ['id' => $id, 'categories' => $categories, 'product' => $product, 'sameproducts' => $sameproducts, 'bestsellers' => $bestsellers]);
    }
    public function cart()
    {
        $cart = session()->get('cart', []);

        // Tính tổng tạm tính
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['quantity'] * $item['sale'];
        }

        // Giả sử phí giao hàng là 0
        $shipping = 0;
        $total = $subtotal + $shipping;

        return view('product.cart', compact('cart', 'subtotal', 'total'));
    }
    public function checkout()
    {
        $cart = session()->get('cart', []);

        // Tính tổng tạm tính
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['quantity'] * $item['sale'];
        }

        // Giả sử phí giao hàng là 0
        $shipping = 0;
        $total = $subtotal + $shipping;

        return view('product.checkout', compact('cart', 'subtotal', 'total'));
    }
    function order(Request $request)
    {
        //lấy dữ liệu từ model
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required|regex:/^[0-9]{10}$/',
        ], [
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Vui lòng nhập số điện thoại đúng định dạng',
        ]);
        $user_order = Auth::check() ? Auth::user()->id : null;
        $order = Order::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'payment_method' => 'cash',
                'status' => 'pending',
                'ship' => 1,
                'user_id' => $user_order,
            ]
        );
        $order_id = $order->id;

        // Lấy thông tin sản phẩm từ giỏ hàng
        $cartItems = session('cart');

        // Lưu sản phẩm vào bảng chi tiết đơn hàng
        foreach ($cartItems as $item) {
            $orderDetails =OrderDetail::create([
                'order_id' => $order_id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['sale'],
            ]);
        }

        // Xóa giỏ hàng sau khi đã tạo đơn hàng thành công
        session()->forget('cart');
        Mail::to($request->email)->send(new OrderConfirmation($orderDetails));
        if (Auth::check()) {
            return redirect()->route('user.dashboard')->with('success', 'Mua hàng thành công');
        } else {
            return redirect()->route('home')->with('success', 'Mua hàng thành công');
        }
    }
    public function addcart(Request $request)
    {
        $cart = session()->get('cart', []);

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        if (isset($cart[$request->id])) {
            // Nếu sản phẩm đã tồn tại, cập nhật số lượng
            $cart[$request->id]['quantity'] += $request->quantity;
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm vào giỏ hàng
            $cart[$request->id] = [
                "id" => $request->id,
                "quantity" => $request->quantity,
                "title" => $request->title,
                "price" => $request->price,
                "sale" => $request->sale,
                "image" => $request->image,
            ];
        }

        // Cập nhật giỏ hàng trong session
        session()->put('cart', $cart);

        return response()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công!')->json(['success' => true]);
    }

    public function updatecart(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        // Tính tổng tạm tính
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['quantity'] * $item['sale'];
        }

        // Giả sử phí giao hàng là 0
        $shipping = 0;
        $total = $subtotal + $shipping;

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'subtotal' => $subtotal,
            'total' => $total
        ]);
    }

    public function removecart(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        // Tính toán lại tổng tiền và các thông số khác (nếu cần)

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['quantity'] * $item['sale'];
        }

        // Cập nhật các giá trị cần thiết
        $total = $subtotal; // Ví dụ

        return response()->json([
            'success' => true,
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }
    public function clearCart()
    {
        session()->forget('cart');

        return route('home');
    }
    function products()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.product', ['products' => $products, 'categories' => $categories]);
    }
    function addproduct(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'sale' => 'nullable|numeric|lt:price',
        ], [
            'title.required' => 'Tiêu đề sản phẩm là bắt buộc.',
            'title.max' => 'Tiêu đề không được vượt quá :max ký tự.',
            'image.required' => 'Hình ảnh sản phẩm là bắt buộc.',
            'image.image' => 'Tệp phải là ảnh.',
            'image.mimes' => 'Chỉ chấp nhận các định dạng ảnh: jpeg, png, jpg, gif.',
            'image.max' => 'Kích thước ảnh không được vượt quá :max KB.',
            'image1.required' => 'Hình ảnh sản phẩm là bắt buộc.',
            'image1.image' => 'Tệp phải là ảnh.',
            'image1.mimes' => 'Chỉ chấp nhận các định dạng ảnh: jpeg, png, jpg, gif.',
            'image1.max' => 'Kích thước ảnh không được vượt quá :max KB.',
            'image2.image' => 'Tệp phải là ảnh.',
            'image2.mimes' => 'Chỉ chấp nhận các định dạng ảnh: jpeg, png, jpg, gif.',
            'image2.max' => 'Kích thước ảnh không được vượt quá :max KB.',
            'image3.image' => 'Tệp phải là ảnh.',
            'image3.mimes' => 'Chỉ chấp nhận các định dạng ảnh: jpeg, png, jpg, gif.',
            'image3.max' => 'Kích thước ảnh không được vượt quá :max KB.',
            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'price.numeric' => 'Giá sản phẩm phải là một số.',
            'sale.numeric' => 'Giá khuyến mãi phải là một số.',
            'sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá sản phẩm.',
        ]);

        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('storage/products'), $imageName);

        $image1Name = time() . '_' . $request->file('image1')->getClientOriginalName();
        $request->file('image1')->move(public_path('storage/products'), $image1Name);

        $image2Name = null;
        if ($request->hasFile('image2')) {
            $image2Name = time() . '_' . $request->file('image2')->getClientOriginalName();
            $request->file('image2')->move(public_path('storage/products'), $image2Name);
        }

        $image3Name = null;
        if ($request->hasFile('image3')) {
            $image3Name = time() . '_' . $request->file('image3')->getClientOriginalName();
            $request->file('image3')->move(public_path('storage/products'), $image3Name);
        }

        Product::create([
            'title' => $request->title,
            'image' => $imageName,
            'image1' => $image1Name,
            'image2' => $image2Name,
            'image3' => $image3Name,
            'description' => $request->description,
            'detail' => $request->detail,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'sale' => $request->sale,
            'status' => 1,
        ]);

        return redirect()->route('admin.products')->with('success', 'Thêm sản phẩm thành công');
    }
    function editproduct(Request $request, $id)
    {
        $pro = Product::findorfail($id);
        $categories = Category::orderBy('id', 'asc')->get();
        //truyền dữ liệu sang view
        return view('admin.editpro', compact('pro', 'categories'));
    }
    function updateproduct(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'sale' => 'nullable|numeric|lt:price',
        ], [
            'title.required' => 'Tiêu đề sản phẩm là bắt buộc.',
            'title.max' => 'Tiêu đề không được vượt quá :max ký tự.',
            'image.image' => 'Tệp phải là ảnh.',
            'image.mimes' => 'Chỉ chấp nhận các định dạng ảnh: jpeg, png, jpg, gif.',
            'image.max' => 'Kích thước ảnh không được vượt quá :max KB.',
            'image1.image' => 'Tệp phải là ảnh.',
            'image1.mimes' => 'Chỉ chấp nhận các định dạng ảnh: jpeg, png, jpg, gif.',
            'image1.max' => 'Kích thước ảnh không được vượt quá :max KB.',
            'image2.image' => 'Tệp phải là ảnh.',
            'image2.mimes' => 'Chỉ chấp nhận các định dạng ảnh: jpeg, png, jpg, gif.',
            'image2.max' => 'Kích thước ảnh không được vượt quá :max KB.',
            'image3.image' => 'Tệp phải là ảnh.',
            'image3.mimes' => 'Chỉ chấp nhận các định dạng ảnh: jpeg, png, jpg, gif.',
            'image3.max' => 'Kích thước ảnh không được vượt quá :max KB.',
            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'price.numeric' => 'Giá sản phẩm phải là một số.',
            'sale.numeric' => 'Giá khuyến mãi phải là một số.',
            'sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá sản phẩm.',
        ]);

        $pro = Product::findOrFail($id);
        if ($request->hasFile('image')) {
            // Xử lý tải lên và lưu hình ảnh mới (nếu có)
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/products'), $imageName);
            $pro->image = $imageName;
        } else if ($request->hasFile('image1')) {
            $image1Name = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/products'), $image1Name);
            $pro->image1 = $image1Name;
        } else if ($request->hasFile('image2')) {
            $image2Name = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/products'), $image2Name);
            $pro->image2 = $image2Name;
        } else if ($request->hasFile('image3')) {
            $image3Name = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/products'), $image3Name);
            $pro->image3 = $image3Name;
        }
        $pro->title = $request->input('title');
        $pro->description = $request->input('description');
        $pro->detail = $request->input('detail');
        $pro->category_id = $request->input('category_id');
        $pro->price = $request->input('price');
        $pro->sale = $request->input('sale');
        $pro->save();

        return redirect()->route('admin.products')->with('success', 'Sửa sản phẩm thành công');
    }
    function destroy($id)
    {
        $product = product::findorfail($id);
        // Kiểm tra xem sản phẩm có trong order details hay không
        $orderDetailsCount = OrderDetail::where('product_id', $id)->count();

        if ($orderDetailsCount > 0) {
            // Cập nhật trạng thái sản phẩm thành 2
            $product->status = 2;
            $product->save();

            return redirect()->route('admin.products')->with('error', 'Xóa sản phẩm không thành công do sản phẩm đã được mua hàng! Sản phẩm đã được chuyển sang trạng thái hết hàng!');
        }
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Xoá sản phẩm thành công');
    }
}
 