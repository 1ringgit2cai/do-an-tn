@extends('admin.layouts.app')
@section('title', 'Thêm Khóa Luận')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Khóa Luận</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.theses.index') }}">Quản Lý Khóa Luận</a></li>
                    <li class="breadcrumb-item active">Thêm Khóa Luận</li>
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
                        <h3 class="card-title">Nhập thông tin khóa luận</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.theses.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Nhập tiêu đề khóa luận" required>
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Tóm Tắt</label>
                                <textarea class="form-control" id="editor" name="abstract" rows="5" placeholder="Nhập tóm tắt">{{ old('abstract') }}</textarea>
                                @error('abstract') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Tên Tác Giả</label>
                                <input type="text" class="form-control" name="author_name" value="{{ old('author_name') }}" placeholder="Nhập tên sinh viên thực hiện" required>
                                @error('author_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Năm Thực Hiện</label>
                                <input type="number" class="form-control" name="year" value="{{ old('year', date('Y')) }}" min="2000" max="2100" required>
                                @error('year') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>File Khóa Luận (PDF)</label>
                                <input type="file" class="form-control-file" name="file_path" accept=".pdf" required>
                                @error('file_path') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="text-right">
                                <a class="btn btn-secondary" href="{{ route('admin.theses.index') }}">Quay Lại</a>
                                <button type="submit" class="btn btn-primary">Thêm Khóa Luận</button>
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
