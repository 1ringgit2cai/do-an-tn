@extends('admin.layouts.app')
@section('title', 'Sửa Giảng Viên')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Sửa Giảng Viên</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.lecturers.index') }}">Giảng Viên</a></li>
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

        <form method="POST" action="{{ route('admin.lecturers.update', $lecturer['id']) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Cập Nhật Giảng Viên</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Họ Tên</label>
                        <input type="text" class="form-control" name="full_name" value="{{ old('full_name', $lecturer['full_name']) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Học Hàm</label>
                        <input type="text" class="form-control" name="academic_title" value="{{ old('academic_title', $lecturer['academic_title']) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Khoa</label>
                        <input type="text" class="form-control" name="department" value="{{ old('department', $lecturer['department']) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Ảnh Hiện Tại</label><br>
                        @if ($lecturer['image'])
                            <img src="http://127.0.0.1:3001{{ $lecturer['image'] }}" alt="Ảnh" width="150" class="mb-2"><br>
                        @endif
                        <input type="file" class="form-control-file" name="image" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label>Giới Thiệu</label>
                        <textarea class="form-control" id="editor" name="bio" rows="5">{{ old('bio', $lecturer['bio']) }}</textarea>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('admin.lecturers.index') }}" class="btn btn-secondary">Quay Lại</a>
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
