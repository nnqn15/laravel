@extends('admin.layout')
@section('title', 'Sửa đơn hàng | Furnitica')
@section('content')
<section class="section">
    <div class="row">
        <div class="card w-50 m-auto">
            <div class="card-header">
                <h4>Sửa đơn hàng</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.updateorder', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Tình trạng giao hàng</label>
                        <select name="ship" class="form-control">
                            <option value="1" @if(old('ship', $order->ship) == '1') selected @endif>Đặt thành công</option>
                            <option value="2" @if(old('ship', $order->ship) == '2') selected @endif>Đang soạn đơn</option>
                            <option value="3" @if(old('ship', $order->ship) == '3') selected @endif>Đang giao hàng</option>
                            <option value="4" @if(old('ship', $order->ship) == '4') selected @endif>Giao hàng thành công</option>
                        </select>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card w-100 mt-5">
            <div class="card-header">
                <h4>Thông tin khách hàng</h4>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Tên khách hàng: </strong>{{$order->name}}</li>
                    <li class="list-group-item"><strong>Số điện thoại: </strong>{{$order->phone}}</li>
                    <li class="list-group-item"><strong>Địa chỉ: </strong>{{$order->address}}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row bg-light p-3 mt-4 rounded">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                <thead>
                    <tr>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderDetails as $orderDetail)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/products/' . $orderDetail->product->image) }}" width="150px" alt="Product Image">
                        </td>
                        <td>{{ $orderDetail->product->title }}</td>
                        <td>{{ $orderDetail->price }}</td>
                        <td>{{ $orderDetail->quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</section>
@endsection