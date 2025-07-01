@extends('web.layouts.app')
@section('title', 'Luận Văn')

@section('content')
    <section class="page-header">
        <div class="container">
            <h1 class="fw-bold">Luận văn</h1>
            <p class="lead">Tổng hợp các luận văn trong khoa</p>
        </div>
    </section>
    <section class="container py-5">
        <form method="GET" action="{{ route('web.theses.index') }}" class="mb-4" style="max-width: 300px;">
            <div class="input-group input-group-sm">
                <input type="text" name="search" class="form-control" placeholder="Tìm luận văn..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" style="background-color: #1a237e; color: white;" type="submit"
                    title="Tìm kiếm">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>
        <hr>
        <div class="row g-3 mt-3">
            @foreach ($theses as $index => $item)
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

        @if ($totalPages > 1)
            <div class="card-footer clearfix mt-4">
                <ul class="pagination pagination-sm m-0 justify-content-center">
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <li class="page-item {{ $i == $page ? 'active' : '' }}">
                            <a class="page-link"
                                href="{{ route('web.theses.index', ['page' => $i, 'search' => request('search')]) }}">{{ $i }}</a>
                        </li>
                    @endfor
                </ul>
            </div>
        @endif
    </section>
@endsection