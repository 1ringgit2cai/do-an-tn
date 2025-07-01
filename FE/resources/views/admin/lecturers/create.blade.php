@extends('admin.layouts.app')
@section('title', 'Thêm Giảng Viên')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Giảng Viên</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.lecturers.index') }}">Quản Lý Giảng Viên</a></li>
                    <li class="breadcrumb-item active">Thêm Giảng Viên</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Nhập thông tin giảng viên</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.lecturers.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Họ Tên</label>
                                <input type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" placeholder="Nhập họ tên" required>
                                @error('full_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Học Hàm</label>
                                <input type="text" class="form-control" name="academic_title" value="{{ old('academic_title') }}" placeholder="Nhập học hàm" required>
                                @error('academic_title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Khoa</label>
                                <input type="text" class="form-control" name="department" value="{{ old('department') }}" placeholder="Nhập tên khoa" required>
                                @error('department') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Ảnh Đại Diện</label>
                                <input type="file" class="form-control-file" name="image" accept="image/*">
                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Giới Thiệu</label>
                                <textarea class="form-control" id="editor" name="bio" rows="5" placeholder="Nhập giới thiệu">{{ old('bio') }}</textarea>
                                @error('bio') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="text-right">
                                <a class="btn btn-secondary" href="{{ route('admin.lecturers.index') }}">Quay Lại</a>
                                <button type="submit" class="btn btn-primary">Thêm Giảng Viên</button>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => console.error(error));
</script>
@endsection
