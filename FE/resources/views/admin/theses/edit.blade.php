@extends('admin.layouts.app')
@section('title', 'Sửa Khóa Luận')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Sửa Khóa Luận</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.theses.index') }}">Khóa Luận</a></li>
                    <li class="breadcrumb-item active">Sửa</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.theses.update', $thesis['id']) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Cập Nhật Khóa Luận</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $thesis['title']) }}" required>
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Tóm Tắt</label>
                        <textarea class="form-control" id="editor" name="abstract" rows="5">{{ old('abstract', $thesis['abstract']) }}</textarea>
                        @error('abstract') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Tác Giả</label>
                        <input type="text" class="form-control" name="author_name" value="{{ old('author_name', $thesis['author_name']) }}" required>
                        @error('author_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Năm Thực Hiện</label>
                        <input type="number" class="form-control" name="year" value="{{ old('year', $thesis['year']) }}" min="2000" max="2100" required>
                        @error('year') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>File PDF</label><br>
                        @if ($thesis['file_path'])
                            <a href="http://127.0.0.1:3001{{ $thesis['file_path'] }}" target="_blank" class="d-block mb-2">Tệp hiện tại</a>
                        @endif
                        <input type="file" class="form-control-file" name="file_path" accept=".pdf">
                        @error('file_path') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('admin.theses.index') }}" class="btn btn-secondary">Quay Lại</a>
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                </div>
            </div>
        </form>
    </div>
</section>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor')).catch(error => console.error(error));
</script>
@endsection
