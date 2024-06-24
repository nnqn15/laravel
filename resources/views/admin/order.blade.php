@extends('admin.layout')
@section('title', 'Admin đơn hàng | Furnitica')
@section('content')
<section class="section">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <i class="far fa-check-circle"></i> {{ session('success') }}
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <i data-feather="alert-circle"></i>
            {{session('error')}}
        </div>
    </div>
    @endif
    <div class="row">
        <div class="card w-100">
            <div class="card-header">
                <h4>Đơn hàng</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                            <tr>
                                <th>ID đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Phương thức thanh toán</th>
                                <th>Tình trạng thanh toán</th>
                                <th>Tình trạng giao hàng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $ord)
                            <tr>
                                <td>{{ $ord->id }}</td>
                                <td>
                                    @if ($ord->user)
                                    {{ $ord->user->name }}
                                    @else
                                    Không có người dùng
                                    @endif
                                </td>
                                <td>{{ $ord->payment_method }}</td>
                                <td>
                                    @if ($ord->status === 'canceled')
                                    <div class="badge badge-danger badge-shadow">Đã hủy</div>
                                    @elseif ($ord->status === 'completed')
                                    <div class="badge badge-success badge-shadow">Đã thanh toán</div>
                                    @elseif ($ord->status === 'pending')
                                    <div class="badge badge-warning badge-shadow">Chưa thanh toán</div>
                                    @else
                                    <div class="badge badge-secondary badge-shadow">Không xác định</div>
                                    @endif
                                </td>
                                <td>
                                    @if ($ord->ship === 1)
                                    <div class="badge badge-success badge-shadow">Đặt thành công</div>
                                    @elseif ($ord->ship === 2)
                                    <div class="badge badge-warning badge-shadow">Đang soạn đơn</div>
                                    @elseif ($ord->ship === 3)
                                    <div class="badge badge-info badge-shadow">Đang giao hàng</div>
                                    @else
                                    <div class="badge badge-primary badge-shadow">Giao hàng thành công</div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.editorder', $ord->id) }}" class="btn btn-warning">Sửa</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection