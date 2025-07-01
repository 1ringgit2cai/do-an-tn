@extends('web.layouts.app')
@section('title', $page['title'])

@section('content')
    <section class="page-header">
        <div class="container">
            <h1 class="fw-bold">{{ $page['title'] }}</h1>
            <p class="lead">
                <a class="text-decoration-none text-white" href="{{ route('web.home') }}">Trang Chủ</a> » {{ $page['title'] ?? 'Trang' }}
            </p>
        </div>
    </section>
    <section class="container mt-3">
        <div class="course-detail shadow-sm">
            <div class="course-description">
                {!! $page['content'] !!}
            </div>
        </div>
    </section>

    <section class="container mb-5">
        <h2 class="section-title mb-4" style="margin-top: 0px">Thông báo mới nhất</h2>
        <hr>
        <div class="row g-4">
            @foreach ($announcements['data'] as $index => $item)
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
    </section>
@endsection