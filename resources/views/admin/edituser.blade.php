@extends('admin.layout')
@section('title', 'Sửa tài khoản | Furnitica')
@section('content')
<section class="section">
    <div class="row">
        <div class="card w-50 m-auto">
            <div class="card-header">
                <h4>Sửa tài khoản</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.updateuser', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Tên tài khoản <span class="text-danger">*</span></label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Tên tài khoản">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Tình trạng</label>
                        <select name="status" class="form-control">
                            <option value="1" @if(old('status', $user->status) == '1') selected @endif>Còn hoạt động</option>
                            <option value="2" @if(old('status', $user->status) == '2') selected @endif>Ngưng hoạt động</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quyền</label>
                        <select name="role" class="form-control">
                            <option value="1" @if(old('role', $user->role) == '1') selected @endif>Khách hàng</option>
                            <option value="2" @if(old('role', $user->role) == '2') selected @endif>Admin</option>
                        </select>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection