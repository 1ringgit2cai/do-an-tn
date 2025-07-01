@extends('web.layouts.app')
@section('title', 'Môn Học')

@section('content')
    <section class="page-header">
        <div class="container">
            <h1 class="fw-bold">Danh sách môn học</h1>
            <p class="lead">Tổng hợp các học phần trong chương trình Thạc sĩ Khoa học Dữ liệu</p>
        </div>
    </section>
    <section class="container py-5">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th scope="col" class="text-center">Mã môn</th>
                        <th scope="col" class="text-center">Tên môn học</th>
                        <th scope="col" class="text-center">Số tín chỉ</th>
                        <th scope="col" class="text-center">Xem Chi Tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $index => $item)
                        <tr>
                            <td class="text-center">{{ ($page - 1) * 10 + $index + 1 }}</td>
                            <td class="text-center">{{ $item['course_code'] }}</td>
                            <td class="text-center">{{ $item['name'] }}</td>
                            <td class="text-center">{{ $item['credits'] }}</td>
                            <td class="text-center">
                                <a href="{{ route('web.courses.show', $item['id']) }}"><i class="fa-solid fa-folder-open"></i> Xem Thêm</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($totalPages > 1)
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <li class="page-item {{ $i == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ route('web.courses.index', ['page' => $i, 'search' => request('search')]) }}">{{ $i }}</a>
                        </li>
                    @endfor
                </ul>
            </div>
        @endif
    </section>
@endsection