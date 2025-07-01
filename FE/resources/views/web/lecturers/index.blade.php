@extends('web.layouts.app')
@section('title', 'Giảng Viên')

@section('content')
    <section class="page-header">
        <div class="container">
            <h1 class="fw-bold">Giảng viên</h1>
            <p class="lead">Thông tin giảng viên trong chương trình Thạc sĩ Khoa học Dữ liệu</p>
        </div>
    </section>
    <section class="container py-5">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th scope="col" class="text-center">Hình Ảnh</th>
                        <th scope="col" class="text-center">Họ Tên</th>
                        <th scope="col" class="text-center">Học Vị</th>
                        <th scope="col" class="text-center">Khoa</th>
                        <th scope="col" class="text-center">Giảng Dạy</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lecturers as $index => $lecturer)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">
                                <img src="http://127.0.0.1:3001{{ $lecturer['image'] }}" alt="{{ $lecturer['full_name'] }}" class="img-fluid" style="max-width: 100px; height: 100px;">
                            </td>
                            <td class="text-center">{{ $lecturer['full_name'] }}</td>
                            <td class="text-center">{{ $lecturer['academic_title'] }}</td>
                            <td class="text-center">{{ $lecturer['department'] }}</td>
                            <td>
                                <ul style="line-height: 35px; list-style: auto;">
                                    @foreach ($lecturer['courses'] as $course)
                                        <li><a class="text-decoration-none text-dark" href="{{ route('web.courses.show', $course['id']) }}">{{ $course['course_code'] }} - {{ $course['name'] }}</a></li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection