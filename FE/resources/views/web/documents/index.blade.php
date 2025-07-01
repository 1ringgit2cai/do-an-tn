@extends('web.layouts.app')
@section('title', 'Tài Liệu')

@section('content')
    <section class="page-header">
        <div class="container">
            <h1 class="fw-bold">Tài liệu</h1>
            <p class="lead">Tổng hợp các tài liệu môn học</p>
        </div>
    </section>
    <section class="container py-5">
        <form method="GET" action="{{ route('web.documents.index') }}" class="mb-4" style="max-width: 300px;">
            <div class="input-group input-group-sm">
                <input type="text" name="search" class="form-control"
                    placeholder="Tìm tài liệu..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" style="background-color: #1a237e; color: white;" type="submit" title="Tìm kiếm">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>
        <hr>
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
                                <i class="fa-solid fa-download me-1"></i> Xem & Tải
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($totalPages > 1)
            <div class="card-footer clearfix mt-4">
                <ul class="pagination pagination-sm m-0 justify-content-center">
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <li class="page-item {{ $i == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ route('web.documents.index', ['page' => $i, 'search' => request('search')]) }}">{{ $i }}</a>
                        </li>
                    @endfor
                </ul>
            </div>
        @endif
    </section>
@endsection