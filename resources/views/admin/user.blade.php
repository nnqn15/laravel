@extends('admin.layout')
@section('title', 'Admin tài khoản | Furnitica')
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
                <h4>Tài khoản</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Tên tài khoản</th>
                                <th>Email</th>
                                <th>Tình trạng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @if($user->status===1)
                                <td>
                                    <div class="badge badge-success badge-shadow">Còn hoạt động</div>
                                </td>
                                @else
                                <td>
                                    <div class="badge badge-danger badge-shadow">Ngưng hoạt động</div>
                                </td>
                                @endif
                                <td>
                                    <div class="d-flex" style="gap: 10px;">
                                        <a href="{{ route('admin.edituser', $user->id) }}" class="btn btn-warning">Sửa</a>
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('admin.deleteuser', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger delete-button" data-id="{{ $user->id }}">Xóa</button>
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
                    text: 'Sau khi xóa, Bạn sẽ không thể phục hồi lại được và nếu tài khoản đã được mua sẽ chuyển trạng thái thành ngưng hoạt động và không thể xóa!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        document.getElementById('delete-form-' + id).submit();
                    } else {
                        swal('Hủy xóa tài khoản thành công!');
                    }
                });
        });
    });
</script>
@endsection