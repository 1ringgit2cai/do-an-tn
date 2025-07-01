@extends('admin.layouts.app')
@section('title', 'Hệ Thống Quản Lý')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="display-4 font-weight-bold text-primary">Chào Mừng Đến Với Trang Quản Trị</h1>
                <p class="lead mt-3">Bạn đang sử dụng hệ thống quản lý thông minh để kiểm soát dữ liệu một cách dễ dàng và hiệu quả.</p>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center text-center">
            <div class="col-md-4">
                <div class="card rounded-lg border-0">
                    <div class="card-body">
                        <i class="fas fa-bullhorn fa-3x text-info mb-3"></i>
                        <h5 class="card-title font-weight-bold">Quản Lý Thông Báo</h5>
                        <p class="card-text">Tạo và cập nhật thông báo gửi đến người dùng hệ thống.</p>
                        <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline-info">Xem Ngay</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-4 mt-md-0">
                <div class="card rounded-lg border-0">
                    <div class="card-body">
                        <i class="fas fa-file-alt fa-3x text-success mb-3"></i>
                        <h5 class="card-title font-weight-bold">Quản Lý Tài Liệu</h5>
                        <p class="card-text">Dễ dàng thêm, chỉnh sửa và xóa các tài liệu học tập.</p>
                        <a href="{{ route('admin.documents.index') }}" class="btn btn-outline-success">Xem Ngay</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-4 mt-md-0">
                <div class="card rounded-lg border-0">
                    <div class="card-body">
                        <i class="fas fa-graduation-cap fa-3x text-warning mb-3"></i>
                        <h5 class="card-title font-weight-bold">Quản Lý Khóa Luận</h5>
                        <p class="card-text">Quản lý tài liệu khóa luận của sinh viên.</p>
                        <a href="{{ route('admin.theses.index') }}" class="btn btn-outline-warning">Xem Ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
