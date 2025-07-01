@extends('admin.layouts.app')
@section('title', 'Sửa Môn Học')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Sửa Môn Học</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">Môn Học</a></li>
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

        <form method="POST" action="{{ route('admin.courses.update', $course['id']) }}">
            @csrf
            @method('PUT')

            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Cập Nhật Môn Học</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Mã Môn Học</label>
                        <input type="text" class="form-control" name="course_code" value="{{ old('course_code', $course['course_code']) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Tên Môn Học</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $course['name']) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Số Tín Chỉ</label>
                        <input type="number" class="form-control" name="credits" value="{{ old('credits', $course['credits']) }}" min="0" required>
                    </div>

                    <div class="form-group">
                        <label>Mô Tả</label>
                        <textarea class="form-control" id="editor" name="description" rows="5">{{ old('description', $course['description']) }}</textarea>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Quay Lại</a>
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
