@extends('admin.layouts.app')
@section('title', 'Sửa Tài Liệu')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Sửa Tài Liệu</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.documents.index') }}">Tài Liệu</a></li>
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

        <form method="POST" action="{{ route('admin.documents.update', $document['id']) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Cập Nhật Tài Liệu</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $document['title']) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Mô Tả</label>
                        <textarea class="form-control" id="editor" name="description" rows="5">{{ old('description', $document['description']) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Môn Học</label>
                        <select name="course_id" class="form-control" required>
                            <option value="">-- Chọn môn học --</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course['id'] }}" {{ old('course_id', $document['course_id']) == $course['id'] ? 'selected' : '' }}>
                                    {{ $course['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>File PDF</label><br>
                        @if ($document['file_path'])
                            <a href="http://127.0.0.1:3001{{ $document['file_path'] }}" target="_blank" class="d-block mb-2">Tài liệu hiện tại</a>
                        @endif
                        <input type="file" class="form-control-file" name="file_path" accept=".pdf">
                    </div>

                    <div class="form-group">
                        <label>Ngày Upload</label>
                        <input type="datetime-local" class="form-control" name="uploaded_at"
                            value="{{ old('uploaded_at', \Carbon\Carbon::parse($document['uploaded_at'])->format('Y-m-d\TH:i')) }}">
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('admin.documents.index') }}" class="btn btn-secondary">Quay Lại</a>
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
