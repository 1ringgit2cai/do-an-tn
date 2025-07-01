@extends('admin.layouts.app')
@section('title', 'Quản Lý Giảng Viên Môn Học')

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
                    <li class="breadcrumb-item active">Giảng Viên</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @if ($errors->has('message'))
            <div class="alert alert-danger">{{ $errors->first('message') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.courses.lecturers.create', $courseId) }}" class="btn btn-primary float-right">
                    <i class="fa fa-plus"></i> Thêm Mới
                </a>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh Thẻ</th>
                            <th>Họ Tên</th>
                            <th>Học Hàm</th>
                            <th>Khoa</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lecturers as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($item['image'])
                                        <img src="http://127.0.0.1:3001{{ $item['image'] }}" width="80" height="100">
                                    @endif
                                </td>
                                <td>{{ $item['full_name'] }}</td>
                                <td>{{ $item['academic_title'] }}</td>
                                <td>{{ $item['department'] }}</td>
                                <td>
                                    <form action="{{ route('admin.courses.lecturers.destroy', [$item['id'], $courseId]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa giảng viên khỏi môn học này?')">
                                            <i class="fas fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="6">Không có giảng viên nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
