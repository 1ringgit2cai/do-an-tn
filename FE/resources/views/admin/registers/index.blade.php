@extends('admin.layouts.app')
@section('title', 'Quản Lý Tuyển Sinh')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản Lý Tuyển Sinh</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                        <li class="breadcrumb-item active">Quản Lý Tuyển Sinh</li>
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
                    <form class="form-inline" method="GET" action="{{ route('admin.registers.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm tên hoặc email"
                                value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Họ và Tên</th>
                                <th>Liên Hệ</th>
                                <th>Quê Quán</th>
                                <th>Trình Độ</th>
                                <th>Ngành</th>
                                <th>Trạng Thái</th>
                                <th>Thời Gian</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($registers as $index => $item)
                                <tr>
                                    <td>{{ ($page - 1) * 10 + $index + 1 }}</td>

                                    <td class="fw-semibold">
                                        {{ $item['full_name'] }}
                                    </td>

                                    <td>
                                        <div>
                                            <i class="fas fa-envelope me-1 text-dark"></i>
                                            <span class="text-muted small">{{ $item['email'] }}</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-phone-alt me-1 text-dark"></i>
                                            <span class="text-muted small">{{ $item['phone'] }}</span>
                                        </div>
                                    </td>

                                    <td>
                                        {{ $item['address'] }}
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark px-2 py-1">{{ $item['education'] }}</span>
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark px-2 py-1">{{ $item['major'] }}</span>
                                    </td>

                                    <td>
                                        @if($item['status'] === 'pending')
                                            <span class="badge bg-warning text-dark">
                                                Chưa xử lý
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                Đã xử lý
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($item['createdAt'])->format('d/m/Y H:i:s') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.registers.edit', $item['id']) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        <form action="{{ route('admin.registers.destroy', $item['id']) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Xóa đăng ký này?')">
                                                <i class="fas fa-trash"></i> Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center text-muted">
                                    <td colspan="8">Không có đăng ký nào.</td>
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
                                    <a class="page-link"
                                        href="{{ route('admin.registers.index', ['page' => $i, 'search' => request('search')]) }}">{{ $i }}</a>
                                </li>
                            @endfor
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection