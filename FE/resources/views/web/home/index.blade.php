@extends('web.layouts.app')
@section('title', 'Cổng Thông Tin Tuyển Sinh Thạc Sĩ KHDL')

@section('content')

    <section class="hero">
        <div class="container">
            <h1 class="display-4 fw-bold">Tuyển Sinh Thạc Sĩ Khoa Học Dữ Liệu</h1>
            <p class="lead mt-3">Nền tảng hỗ trợ tra cứu tài liệu, quản lý môn học và luận văn hiệu quả dành cho học
                viên cao học.</p>
            <button class="btn btn-warning fw-bold" data-bs-toggle="modal" data-bs-target="#registerModal"
                style="background: white; border: 1px solid white; color: #1a237e;">
                <i class="fas fa-paper-plane me-1"></i> Liên Hệ
            </button>
        </div>
    </section>

    <!-- Statistics -->
    <section class="container text-center mt-5">
        <h2 class="mb-5" style="color: #1a237e; font-weight: bold; font-size: 1.9rem;">Nghiên cứu</h2>
        <div style="border-top: 3px solid #1a237e; width: 15%; margin: 0 auto; margin-top: -35px; margin-bottom: 40px;">
        </div>

        <div class="row g-5 justify-content-center">
            <div class="col-md-4">
                <div class="topic-box shadow-sm">
                    <i class="fas fa-brain topic-icon text-primary"></i>
                    <p class="topic-title">Học máy</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="topic-box shadow-sm">
                    <i class="fas fa-camera topic-icon text-success"></i>
                    <p class="topic-title">Thị giác máy tính </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="topic-box shadow-sm">
                    <i class="fas fa-database topic-icon text-info"></i>
                    <p class="topic-title">Khai phá dữ liệu</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="topic-box shadow-sm">
                    <i class="fas fa-pen-nib topic-icon text-danger"></i>
                    <p class="topic-title">Xử lý ngôn ngữ tự nhiên</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="topic-box shadow-sm">
                    <i class="fas fa-chart-line topic-icon text-warning"></i>
                    <p class="topic-title">Khoa học dữ liệu </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="topic-box shadow-sm">
                    <i class="fas fa-flask topic-icon text-secondary"></i>
                    <p class="topic-title">Tính toán khoa học </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Announcements -->
    <section class="container mb-5">
        <h2 class="section-title mb-5">Thông báo</h2>
        <div class="row g-4">
            @foreach ($announcements as $index => $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if (!empty($item['cover_image']))
                            <img src="http://127.0.0.1:3001{{ $item['cover_image'] }}" class="card-img-top" alt="Ảnh thông báo"
                                style="height: 200px; width: 100%;">
                        @else
                            <img src="https://placehold.co/600x400?text=No+Image" class="card-img-top" alt="No Image"
                                style="height: 200px; width: 100%;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-bold">
                                <a href="{{ route('web.announcements.show', $item['id']) }}"
                                    class="text-decoration-none text-dark">
                                    {{ $item['title'] }}
                                </a>
                            </h6>
                            <small class="text-muted mb-2">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ \Carbon\Carbon::parse($item['createdAt'])->format('d/m/Y') }}
                            </small>
                            <p class="card-text text-muted" style="max-height: 4.5em; overflow: hidden;">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item['content']), 150) }}
                            </p>
                            <div class="mt-auto text-right">
                                <a href="{{ route('web.announcements.show', $item['id']) }}"
                                    class="text-decoration-none fw-bold float-end">
                                    <i class="fas fa-chevron-right"></i> Xem thêm
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($totalPages > 1)
            <div class="mt-4 text-center">
                <ul class="pagination pagination-sm justify-content-center">
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <li class="page-item {{ $i == $page ? 'active' : '' }}">
                            <a class="page-link"
                                href="{{ route('web.home', ['page' => $i, 'search' => request('search')]) }}">{{ $i }}</a>
                        </li>
                    @endfor
                </ul>
            </div>
        @endif
    </section>

    <section class="container text-center mt-5">
        <h2 class="mb-5" style="color: #1a237e; font-weight: bold; font-size: 1.9rem;">Thông tin</h2>
        <div style="border-top: 3px solid #1a237e; width: 15%; margin: 0 auto; margin-top: -35px; margin-bottom: 40px;">
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="stats-card shadow-sm">
                    <i class="fas fa-book fa-2x text-primary mb-2"></i>
                    <!-- <h3>120+</h3> -->
                    <p>Môn học</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card shadow-sm">
                    <i class="fas fa-chalkboard-teacher fa-2x text-success mb-2"></i>
                    <!-- <h3>35+</h3> -->
                    <p>Giảng viên</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card shadow-sm">
                    <i class="fas fa-file-alt fa-2x text-warning mb-2"></i>
                    <!-- <h3>500+</h3> -->
                    <p>Tài liệu</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card shadow-sm">
                    <i class="fas fa-scroll fa-2x text-danger mb-2"></i>
                    <!-- <h3>180+</h3> -->
                    <p>Luận văn</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Documents -->
    <section class="container mb-5">
        <h2 class="section-title mb-4">Tài liệu</h2>

        <div class="row g-3 mt-3">
            @foreach ($documents as $index => $item)
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100 rounded-3 overflow-hidden" style="max-height: 450px;">
                        <div class="pdf-preview-wrapper" style="height: 300px;">
                            <canvas class="pdf-thumbnail" data-pdf-url="http://127.0.0.1:3001{{ $item['file_path'] }}"
                                style="width: 100%; height: 100%; object-fit: cover;"></canvas>
                        </div>

                        <div class="card-body py-3 px-3 d-flex flex-column" style="line-height: 2.5em;">
                            <h6 class="fw-semibold mb-1 text-truncate" title="{{ $item['title'] }}">
                                {{ $item['title'] }}
                            </h6>

                            <small class="text-muted mb-2 d-block text-truncate">
                                {{ $item['course']['name'] ?? 'Không rõ môn học' }}
                            </small>
                            <a href="http://127.0.0.1:3001{{ $item['file_path'] }}" target="_blank"
                                class="text-decoration-none fw-bold mt-auto text-center">
                                <i class="fa-solid fa-download me-1"></i> Tải Về
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('web.documents.index') }}" class="btn btn-outline-dark btn-sm px-4 btn-get-all">
                Xem Tất Cả
            </a>
        </div>
    </section>

    <!-- Theses -->
    <section class="container mb-5">
        <h2 class="section-title mb-4">Luận văn</h2>

        <div class="row g-3 mt-3">
            @foreach ($thesis as $index => $item)
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100 rounded-3 overflow-hidden" style="max-height: 500px;">
                        <div class="pdf-preview-wrapper" style="height: 300px;">
                            <canvas class="pdf-thumbnail" data-pdf-url="http://127.0.0.1:3001{{ $item['file_path'] }}"
                                style="width: 100%; height: 100%; object-fit: cover;"></canvas>
                        </div>

                        <div class="card-body py-3 px-3 d-flex flex-column" style="line-height: 2.2em;">
                            <h6 class="fw-semibold mb-1 text-truncate" title="{{ $item['title'] }}">
                                {{ $item['title'] }}
                            </h6>

                            <small class="text-muted mb-1 d-block text-truncate">
                                <i class="fa-solid fa-user me-1"></i> {{ $item['author_name'] ?? 'Chưa rõ' }}
                            </small>

                            <small class="text-muted mb-2">
                                <i class="fa-solid fa-calendar text-muted me-1"></i> {{ $item['year'] ?? 'N/A' }}
                            </small>

                            @if (!empty($item['file_path']))
                                <a href="http://127.0.0.1:3001{{ $item['file_path'] }}" target="_blank"
                                    class="text-decoration-none fw-bold mt-auto text-center">
                                    <i class="fa-solid fa-download me-1"></i> Tải Về
                                </a>
                            @else
                                <span class="text-muted text-center mt-auto">Chưa có file</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('web.theses.index') }}" class="btn btn-outline-dark btn-sm px-4 btn-get-all">
                Xem Tất Cả
            </a>
        </div>
    </section>

@endsection