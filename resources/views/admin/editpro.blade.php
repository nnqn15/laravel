@extends('admin.layout')
@section('title', 'Sửa sản phẩm | Furnitica')
@section('content')
<section class="section">
    <div class="row">
        <div class="card w-50 m-auto">
            <div class="card-header">
                <h4>Sửa sản phẩm</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.updatepro', $pro->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Tên sản phẩm <span class="text-danger">*</span></label>
                        <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" value="{{ old('title', $pro->title) }}" placeholder="Tên sản phẩm">
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>File ảnh chính</label>
                        <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}">
                        @error('image')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <img src="{{ asset('storage/products/' . $pro->image) }}" width="150px" alt="image">
                    <div class="form-group">
                        <label>File ảnh phụ 1</label>
                        <input type="file" name="image1" class="form-control" value="{{ old('image1', $pro->image1) }}">
                    </div>
                    @if($pro->image1)
                    <img src="{{ asset('storage/products/' . $pro->image1) }}" width="150px" alt="image">
                    @endif
                    <div class="form-group">
                        <label>File ảnh phụ 2</label>
                        <input type="file" name="image2" class="form-control" value="{{ old('image2', $pro->image2) }}">
                    </div>
                    @if($pro->image2)
                    <img src="{{ asset('storage/products/' . $pro->image2) }}" width="150px" alt="image">
                    @endif
                    <div class="form-group">
                        <label>File ảnh phụ 3</label>
                        <input type="file" name="image3" class="form-control" value="{{ old('image3', $pro->image3) }}">
                    </div>
                    @if($pro->image3)
                    <img src="{{ asset('storage/products/' . $pro->image3) }}" width="150px" alt="image">
                    @endif
                    <div class="form-group">
                        <label>Giá <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" name="price" class="form-control currency  {{ $errors->has('price') ? 'is-invalid' : '' }}" value="{{ old('price', $pro->price) }}">
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
                            <input type="number" name="sale" class="form-control currency  {{ $errors->has('sale') ? 'is-invalid' : '' }}" value="{{ old('sale', $pro->sale) }}">
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
                            @if($pro->category_id === null)
                            <option value="" selected>Danh mục trống</option>
                            @endif
                            @foreach($categories as $cate)
                            <option value="{{ $cate->id }}" @if(old('category_id', $pro->category_id) == $cate->id) selected @endif>{{ $cate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tình trạng</label>
                        <select name="status" class="form-control">
                            <option value="1" @if(old('status', $pro->status) == '1') selected @endif>Còn hàng</option>
                            <option value="2" @if(old('status', $pro->status) == '2') selected @endif>Hết hàng</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Giới thiệu sản phẩm ngắn</label>
                        <textarea name="description" class="form-control">{{ old('description', $pro->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Chi tiết sản phẩm</label>
                        <textarea name="detail" style="height: 300px !important;" class="form-control">{{ old('detail', $pro->detail) }}</textarea>
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