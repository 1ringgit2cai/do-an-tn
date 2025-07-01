@extends('admin.layouts.app')
@section('title', 'Quản Lý Tài Liệu')

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
                    <li class="breadcrumb-item active">Tài Liệu</li>
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
                <form class="form-inline" method="GET" action="{{ route('admin.documents.index') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Tìm kiếm tiêu đề" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.documents.create') }}" class="btn btn-primary float-right">
                    <i class="fa fa-plus"></i> Thêm Mới
                </a>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu Đề</th>
                            <th>Môn Học</th>
                            <th>Ngày Upload</th>
                            <th>Tệp</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($documents as $index => $item)
                            <tr>
                                <td>{{ ($page - 1) * 10 + $index + 1 }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ $item['course']['name'] ?? 'Không có' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item['uploaded_at'])->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if ($item['file_path'])
                                        <a href="http://127.0.0.1:3001{{ $item['file_path'] }}" target="_blank">Tải xuống</a>
                                    @else
                                        <span class="text-muted">Không có file</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.documents.edit', $item['id']) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('admin.documents.destroy', $item['id']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa tài liệu này?')">
                                            <i class="fas fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="6">Không có tài liệu nào.</td>
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
                                <a class="page-link" href="{{ route('admin.documents.index', ['page' => $i, 'search' => request('search')]) }}">{{ $i }}</a>
                            </li>
                        @endfor
                    </ul>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
