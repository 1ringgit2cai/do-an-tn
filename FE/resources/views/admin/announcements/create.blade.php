@extends('admin.layouts.app')
@section('title', 'Thêm Thông Báo')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Thông Báo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.announcements.index') }}">Quản Lý Thông Báo</a></li>
                    <li class="breadcrumb-item active">Thêm Thông Báo</li>
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
                        <h3 class="card-title">Nhập thông tin thông báo</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <form method="POST" action="{{ route('admin.announcements.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Nhập tiêu đề" required>
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Phân Loại Thông Báo</label>
                                <select class="form-control" name="category" required>
                                    <option value="">-- Chọn phân loại --</option>
                                    <option value="Học vụ" {{ old('category') == 'Học vụ' ? 'selected' : '' }}>Học vụ</option>
                                    <option value="Khẩn cấp" {{ old('category') == 'Khẩn cấp' ? 'selected' : '' }}>Khẩn cấp</option>
                                    <option value="Tuyển sinh" {{ old('category') == 'Tuyển sinh' ? 'selected' : '' }}>Tuyển sinh</option>
                                    <option value="Hoạt động" {{ old('category') == 'Hoạt động' ? 'selected' : '' }}>Hoạt động</option>
                                    <option value="Khác" {{ old('category') == 'Khác' ? 'selected' : '' }}>Khác</option>
                                </select>
                                @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Hình Ảnh (tùy chọn)</label>
                                <input type="file" class="form-control-file" name="cover_image" accept="image/*">
                                @error('cover_image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Ngày Đăng</label>
                                <input type="datetime-local" class="form-control" name="posted_at" value="{{ old('posted_at') }}">
                                @error('posted_at') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea class="form-control" id="editor" name="content" rows="5" placeholder="Nhập nội dung">{{ old('content') }}</textarea>
                                @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="text-right">
                                <a class="btn btn-secondary" href="{{ route('admin.announcements.index') }}">Quay Lại</a>
                                <button type="submit" class="btn btn-primary">Thêm Thông Báo</button>
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
