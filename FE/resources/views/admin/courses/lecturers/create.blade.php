@extends('admin.layouts.app')
@section('title', 'Thêm Giảng Viên Môn Học')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Giảng Viên: {{ $course['name'] }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">Quản Lý Môn Học</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.courses.edit', $courseId) }}">{{ $course['name'] }}</a></li>
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
                        <h3 class="card-title">Chọn giảng viên</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.courses.lecturers.store', $courseId) }}">
                            @csrf

                            <div class="form-group">
                                <label>Chọn Giảng Viên</label>
                                <select class="form-control" name="lecturer_id" required>
                                    <option value="">-- Chọn Giảng Viên --</option>
                                    @foreach($lecturers as $index => $lecturer)
                                        <option value="{{ $lecturer['id'] }}">{{ $lecturer['id'] }} | {{ $lecturer['full_name'] }} | {{ $lecturer['academic_title'] }} | {{ $lecturer['department'] }}</option>
                                    @endforeach
                                </select>
                                @error('lecturer_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="text-right">
                                <a class="btn btn-secondary" href="{{ route('admin.courses.lecturers.index', $courseId) }}">Quay Lại</a>
                                <button type="submit" class="btn btn-primary">Thêm Giảng Viên</button>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>
@endsection
