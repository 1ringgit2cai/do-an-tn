@extends('web.layouts.app')
@section('title', 'Thông Báo')

@section('content')
    <section class="page-header">
        <div class="container">
            <h1 class="fw-bold">Thông báo</h1>
            <p class="lead">Cập nhật các thông tin mới nhất</p>
        </div>
    </section>
    <section class="container py-5">
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
            <div class="card-footer clearfix mt-4">
                <ul class="pagination pagination-sm m-0 justify-content-center">
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <li class="page-item {{ $i == $page ? 'active' : '' }}">
                            <a class="page-link"
                                href="{{ route('web.announcements.index', ['page' => $i, 'search' => request('search')]) }}">{{ $i }}</a>
                        </li>
                    @endfor
                </ul>
            </div>
        @endif
    </section>
@endsection