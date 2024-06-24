@extends('admin.layout')
@section('title', 'Admin danh mục | Furnitica')
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
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <i class="far fa-times-circle"></i>
            @foreach ($errors->all() as $error)
            {{ $error }},
            @endforeach
        </div>
    </div>
    @endif
    <div class="row mb-3">
        <div class="card w-100">
            <div class="card-body">
                <p class="m-0">
                    <button class="btn btn-primary {{ $errors->any() ? 'collapsed' : '' }}" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                        <i class="far fa-edit"></i> Thêm danh mục
                    </button>
                </p>
                <form action="{{route('admin.addcate')}}" method="POST">
                    @csrf
                    <div class="collapse mt-3 {{ $errors->any() ? 'show' : '' }}" id="collapseExample1">
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" placeholder="Tên danh mục">
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
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
                <h4>Danh mục</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên danh mục</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $cate)
                            <tr>
                                <td>{{$cate->id}}</td>
                                <td>{{$cate->name}}</td>
                                <td>
                                    <div class="d-flex" style="gap: 10px;">
                                        <a href="{{ route('admin.editcate',$cate->id)}}" class="btn btn-warning">Sửa</a>
                                        <form id="delete-form-{{ $cate->id }}" action="{{ route('admin.delete',$cate->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger delete-button" data-id="{{ $cate->id }}">Xóa</button>
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
                    text: 'Sau khi xoá, Danh mục sẽ không thể phục hồi, những sản phẩm liên quan thì danh mục sẽ chuyển thành null!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal({
                            title: 'Hoàn thành! Danh mục đã được xóa!',
                            icon: 'success',
                        }).then(() => {
                            document.getElementById('delete-form-' + id).submit();
                        });
                    } else {
                        swal('Hủy xóa danh mục thành công!');
                    }
                });
        });
    });
</script>
@endsection