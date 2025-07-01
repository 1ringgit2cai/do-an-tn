@extends('admin.layouts.app')
@section('title', 'Sửa Thông Báo')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Sửa Thông Báo</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.announcements.index') }}">Thông Báo</a></li>
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

        <form method="POST" action="{{ route('admin.announcements.update', $announcement['id']) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Cập Nhật Thông Báo</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $announcement['title']) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Hình Ảnh</label><br>
                        @if ($announcement['cover_image'])
                            <img src="http://127.0.0.1:3001{{ $announcement['cover_image'] }}" alt="Cover" width="200" class="mb-2"><br>
                        @endif
                        <input type="file" class="form-control-file" name="cover_image" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label>Ngày Đăng</label>
                        <input type="datetime-local" class="form-control" name="posted_at"
                            value="{{ old('posted_at', \Carbon\Carbon::parse($announcement['posted_at'])->format('Y-m-d\TH:i')) }}">
                    </div>

                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea class="form-control" id="editor" name="content" rows="5">{{ old('content', $announcement['content']) }}</textarea>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">Quay Lại</a>
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
