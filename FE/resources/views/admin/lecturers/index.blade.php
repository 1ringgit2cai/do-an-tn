@extends('admin.layouts.app')
@section('title', 'Quản Lý Giảng Viên')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Giảng Viên</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item active">Giảng Viên</li>
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

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <form class="form-inline" method="GET" action="{{ route('admin.lecturers.index') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Tìm kiếm tên" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.lecturers.create') }}" class="btn btn-primary float-right">
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
                                <td>{{ ($page - 1) * 10 + $index + 1 }}</td>
                                <td>
                                    @if ($item['image'])
                                        <img src="http://127.0.0.1:3001{{ $item['image'] }}" width="80" height="100">
                                    @endif
                                </td>
                                <td>{{ $item['full_name'] }}</td>
                                <td>{{ $item['academic_title'] }}</td>
                                <td>{{ $item['department'] }}</td>
                                <td>
                                    <a href="{{ route('admin.lecturers.edit', $item['id']) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('admin.lecturers.destroy', $item['id']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa giảng viên này?')">
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

            @if ($totalPages > 1)
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        @for ($i = 1; $i <= $totalPages; $i++)
                            <li class="page-item {{ $i == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ route('admin.lecturers.index', ['page' => $i, 'search' => request('search')]) }}">{{ $i }}</a>
                            </li>
                        @endfor
                    </ul>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
