@extends('admin.layouts.app')
@section('title', 'Chỉnh Sửa Trang')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Chỉnh Sửa Trang</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Quản Lý Trang</a></li>
                    <li class="breadcrumb-item active">Chỉnh Sửa</li>
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

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Chỉnh sửa thông tin trang</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.pages.update', $page['id']) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input type="text" class="form-control" name="title" id="titleInput" value="{{ old('title', $page['title']) }}" required>
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" class="form-control" name="slug" id="slugInput" value="{{ old('slug', $page['slug']) }}">
                                @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Loại Trang</label>
                                <select name="type" class="form-control" required>
                                    <option value="">-- Chọn loại --</option>
                                    <option value="admission" {{ old('type', $page['type']) == 'admission' ? 'selected' : '' }}>Tuyển sinh</option>
                                    <option value="support" {{ old('type', $page['type']) == 'support' ? 'selected' : '' }}>Hỗ trợ</option>
                                </select>
                                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea class="form-control" id="editor" name="content" rows="6">{{ old('content', $page['content']) }}</textarea>
                                @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="text-right">
                                <a class="btn btn-secondary" href="{{ route('admin.pages.index') }}">Quay Lại</a>
                                <button type="submit" class="btn btn-primary">Cập Nhật Trang</button>
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
<script>
    function removeVietnameseTones(str) {
        str = str.toLowerCase();
        str = str.replace(/á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/g, "a");
        str = str.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/g, "e");
        str = str.replace(/i|í|ì|ỉ|ĩ|ị/g, "i");
        str = str.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/g, "o");
        str = str.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/g, "u");
        str = str.replace(/ý|ỳ|ỷ|ỹ|ỵ/g, "y");
        str = str.replace(/đ/g, "d");
        str = str.replace(/\s+/g, "-");
        str = str.replace(/[^a-z0-9\-]/g, "");
        str = str.replace(/\-+/g, "-");
        str = str.replace(/^-+|-+$/g, "");
        return str;
    }

    const titleInput = document.getElementById('titleInput');
    const slugInput = document.getElementById('slugInput');

    titleInput.addEventListener('input', function () {
        if (!slugInput.dataset.manualEdit) {
            slugInput.value = removeVietnameseTones(titleInput.value);
        }
    });

    slugInput.addEventListener('input', function () {
        this.dataset.manualEdit = true;
    });
</script>
@endsection
