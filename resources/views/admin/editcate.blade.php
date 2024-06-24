@extends('admin.layout')
@section('title', 'Sửa danh mục | Furnitica')
@section('content')
<section class="section">
  <div class="row">
    <div class="card w-50 m-auto">
      <div class="card-header">
        <h4>Sửa danh mục</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.updatecate', $cate->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" value="{{ old('name', $cate->name) }}" placeholder="Tên danh mục">
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
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
