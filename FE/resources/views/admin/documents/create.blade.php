@extends('admin.layouts.app')
@section('title', 'Thêm Tài Liệu')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Tài Liệu</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.documents.index') }}">Quản Lý Tài Liệu</a></li>
                    <li class="breadcrumb-item active">Thêm Tài Liệu</li>
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
                        <h3 class="card-title">Nhập thông tin tài liệu</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.documents.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Nhập tiêu đề tài liệu" required>
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Mô Tả</label>
                                <textarea class="form-control" id="editor" name="description" rows="5" placeholder="Nhập mô tả tài liệu">{{ old('description') }}</textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Chọn Môn Học</label>
                                <select name="course_id" class="form-control" required>
                                    <option value="">-- Chọn môn học --</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course['id'] }}" {{ old('course_id') == $course['id'] ? 'selected' : '' }}>
                                            {{ $course['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>File Tài Liệu (PDF)</label>
                                <input type="file" class="form-control-file" name="file_path" accept=".pdf" required>
                                @error('file_path') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Ngày Upload</label>
                                <input type="datetime-local" class="form-control" name="uploaded_at" value="{{ old('uploaded_at') }}">
                                @error('uploaded_at') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="text-right">
                                <a class="btn btn-secondary" href="{{ route('admin.documents.index') }}">Quay Lại</a>
                                <button type="submit" class="btn btn-primary">Thêm Tài Liệu</button>
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
