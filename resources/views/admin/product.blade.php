@extends('admin.layout')
@section('title', 'Admin sản phẩm | Furnitica')
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
    <div class="row mb-3">
        <div class="card w-100">
            <div class="card-body">
                <p class="m-0">
                    <button class="btn btn-primary {{ $errors->any() ? 'collapsed' : '' }}" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                        <i class="far fa-edit"></i> Thêm sản phẩm
                    </button>
                </p>
                <form action="{{route('admin.addpro')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="collapse mt-3 {{ $errors->any() ? 'show' : '' }}" id="collapseExample1">
                        <div class="form-group">
                            <label>Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" placeholder="Tên sản phẩm">
                            @error('title')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>File ảnh chính <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}">
                            @error('image')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>File ảnh phụ 1 <span class="text-danger">*</span></label>
                            <input type="file" name="image1" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>File ảnh phụ 2</label>
                            <input type="file" name="image2" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>File ảnh phụ 3</label>
                            <input type="file" name="image3" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Giá <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="price" class="form-control currency  {{ $errors->has('price') ? 'is-invalid' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        VND
                                    </div>
                                </div>
                                @error('price')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Sale</label>
                            <div class="input-group">
                                <input type="number" name="sale" class="form-control currency  {{ $errors->has('sale') ? 'is-invalid' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        VND
                                    </div>
                                </div>
                                @error('sale')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Giới thiệu sản phẩm ngắn</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Chi tiết sản phẩm</label>
                            <textarea name="detail" style="height: 300px !important;" class="form-control"></textarea>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card w-100">
            <div class="card-header">
                <h4>Sản phẩm</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Ảnh chính</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Tình trạng</th>
                                <th>Giá</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $pro)
                            <tr>
                                <td><img src="{{ asset('storage/products/' . $pro->image) }}" width="150px" alt="image"></td>
                                <td>{{ $pro->title }}</td>
                                @if($pro->Category)
                                <td>{{ $pro->Category->name }}</td>
                                @else
                                <td>Danh mục trống</td>
                                @endif
                                @if($pro->status==='1')
                                <td>
                                    <div class="badge badge-success badge-shadow">Còn hàng</div>
                                </td>
                                @else
                                <td>
                                    <div class="badge badge-danger badge-shadow">Hết hàng</div>
                                </td>
                                @endif
                                @if($pro->sale)
                                <td>
                                    <strong class="text-danger">{{ number_format($pro->sale, 0, ',', '.') }} VND</strong>
                                    <del class="text-secondary">{{ number_format($pro->price, 0, ',', '.') }} VND</del>
                                </td>
                                @else
                                <td><strong class="text-danger">{{ number_format($pro->price, 0, ',', '.') }} VND</strong></td>
                                @endif
                                <td>
                                    <div class="d-flex" style="gap: 10px;">
                                        <a href="{{ route('admin.editpro', $pro->id) }}" class="btn btn-warning">Sửa</a>
                                        <form id="delete-form-{{ $pro->id }}" action="{{ route('admin.prodelete', $pro->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger delete-button" data-id="{{ $pro->id }}">Xóa</button>
                                        </form>
                                    </div>
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
<script>
    document.querySelectorAll('.delete-button').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var id = this.getAttribute('data-id');
            swal({
                    title: 'Bạn chắc chứ?',
                    text: 'Sau khi xóa, Bạn sẽ không thể phục hồi lại được và nếu sản phẩm đã được mua sẽ chuyển trạng thái thành hết hàng và không thể xóa!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        document.getElementById('delete-form-' + id).submit();
                    } else {
                        swal('Hủy xóa sản phẩm thành công!');
                    }
                });
        });
    });
</script>
@endsection