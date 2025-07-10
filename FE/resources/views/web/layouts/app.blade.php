<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang chủ - @yield('title', 'Cổng thông tin tuyển sinh Thạc Sĩ')</title>
    <link rel="icon" type="image/png" href="https://tuyensinh.hcmus.edu.vn/wp-content/uploads/2025/06/cropped-logo-KHTN_REMAKE-32x32.png">
    <!-- Favicon cho Apple devices -->
    <link rel="apple-touch-icon" sizes="180x180" href="https://tuyensinh.hcmus.edu.vn/wp-content/uploads/2025/06/cropped-logo-KHTN_REMAKE-32x32.png">

    <!-- Favicon nhiều kích thước (Windows, Android,...) -->
    <link rel="icon" type="image/png" sizes="32x32" href="https://tuyensinh.hcmus.edu.vn/wp-content/uploads/2025/06/cropped-logo-KHTN_REMAKE-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://tuyensinh.hcmus.edu.vn/wp-content/uploads/2025/06/cropped-logo-KHTN_REMAKE-32x32.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top" style="background-color: #1a237e;">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('web.home') }}" style="max-width: 250px">
                <img src="https://hcmus.edu.vn/wp-content/uploads/2023/04/hcmus-logo-white.png" alt="" style="width: 100%; height: 35px">
            <img src="https://www.math.hcmus.edu.vn/images/Logo-Math-CS.png" alt="" style=" width: 100%; height: 35px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                {{-- Menu chức năng bên trái --}}
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="{{ route('web.home') }}"
                            class="nav-link {{ request()->routeIs('web.home') ? 'active' : '' }}">
                            <i class="fas fa-home me-1"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('web.courses.index') }}"
                            class="nav-link {{ request()->routeIs('web.courses.*') ? 'active' : '' }}">
                            <i class="fas fa-book-open me-1"></i> Môn học
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('web.lecturers.index') }}" class="nav-link">
                            <i class="fas fa-chalkboard-teacher me-1"></i> Giảng viên
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('web.documents.index') }}" class="nav-link">
                            <i class="fas fa-folder-open me-1"></i> Tài liệu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('web.theses.index') }}" class="nav-link">
                            <i class="fas fa-file-alt me-1"></i> Luận văn
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownTuyensinh" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-graduation-cap me-1"></i> Tuyển sinh
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownTuyensinh">
                            <li>
                                <a class="dropdown-item" href="{{ route('web.announcements.index') }}">
                                    Thông báo mới
                                </a>
                            </li>                            
                            @foreach ($all_pages as $index => $p)
                                @if($p["type"] == "admission")
                                    <li>
                                        <a class="dropdown-item" href="{{ route('web.pages.show', $p["slug"]) }}">
                                            {{ $p["title"] }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>

                {{-- Nút ứng tuyển bên phải --}}
                <div class="d-flex align-items-center gap-2">
                    {{-- Nút tìm kiếm --}}
                    <form action="{{ route('web.announcements.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control form-control-sm search-info"
                            placeholder="Tìm kiếm thông tin" style="width: 200px;">
                        <button type="submit" class="btn btn-outline-primary btn-sm ms-1"
                            style="color: #1a237e; background-color: #fff; border: 1px solid #1a237e;">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    {{-- Nút liên hệ --}}
                    <button class="btn btn-warning btn-sm fw-bold" data-bs-toggle="modal"
                        data-bs-target="#registerModal"
                        style="background: white; border: 1px solid white; color: #1a237e;">
                        <i class="fas fa-paper-plane me-1"></i> Liên Hệ
                    </button>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <div class="contact-buttons">
        <a href="https://www.facebook.com/khoatoantinhoc" class="btn-contact" target="_blank" title="Facebook">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/500px-Facebook_Logo_%282019%29.png"
                style="width: 100%; height: 100%" alt="Messenger" class="contact-icon">
        </a>
        <a href="https://zalo.me/khoatoantinhoc?fbclid=IwY2xjawLQp3pleHRuA2FlbQIxMABicmlkETFldFZmbzFPTlF6Q0Y2Z0JMAR70FACSOj1_jZuV8Mms93BAxr1dXuSudzZX6ngHPibYYVqWOS8s5lCsRCFx1g_aem_XPv_PXQ5roFk6bBDU31v4A" class="btn-contact" target="_blank" title="Zalo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Icon_of_Zalo.svg/2048px-Icon_of_Zalo.svg.png"
                style="width: 100%; height: 100%" alt="Zalo" class="contact-icon">
        </a>
        <a href="mailto:math@hcmus.edu.vn" class="btn-contact" title="Gmail">
            <img src="https://images.vexels.com/media/users/3/140928/isolated/preview/8d338f5acd60bfbc9b5fb1b208c8814f-outlined-email-round-icon.png?w=360"
                style="width: 100%; height: 100%" alt="Gmail" class="contact-icon">
        </a>
    </div>
    <!-- Modal Đăng ký -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header text-white" style="background-color: #1a237e;">
                    <h5 class="modal-title" id="registerModalLabel">
                        <i class="fas fa-user-plus me-1"></i> Liên Hệ Tuyển Sinh
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form action="{{ route('web.register.store') }}" method="POST">
                    @csrf
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="full_name"
                                class="form-control @error('full_name') is-invalid @enderror" placeholder="Họ và tên"
                                value="{{ old('full_name') }}" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Số điện thoại</label>
                            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Số điện thoại" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Quê quán</label>
                            <input type="text" name="address"
                                class="form-control @error('address') is-invalid @enderror" placeholder="Quê quán"
                                value="{{ old('address') }}" required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Trình độ hiện tại</label>
                            <input type="text" name="education"
                                class="form-control @error('education') is-invalid @enderror"
                                placeholder="Cử nhân / Kỹ sư / Khác" value="{{ old('education') }}" required>
                            @error('education')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Chuyên ngành hiện tại</label>
                            <input type="text" name="major" class="form-control @error('major') is-invalid @enderror"
                                placeholder="Chuyên ngành" value="{{ old('major') }}" required>
                            @error('major')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" style="background-color: #1a237e;">
                            <i class="fas fa-paper-plane me-1"></i> Gửi Đăng Ký
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-white pt-5 pb-4" style="background-color: #1a237e;">
        <div class="container text-center text-md-start">
            <div class="row text-center text-md-start">
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <img src="https://hcmus.edu.vn/wp-content/uploads/2023/04/hcmus-logo-white.png" alt="" style=" height: 90px;">
                  <img src="https://www.math.hcmus.edu.vn/images/Logo-Math-CS.png" alt="" style=" height: 90px;">
                    <br>
                    <br>
                    <p>Cổng thông tin hỗ trợ học viên cao học ngành Khoa học Dữ liệu - Đại học KHTN - ĐHQG HCM</p>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold text-white">Thông tin</h5>
                    <p><a href="{{ route('web.courses.index') }}" class="text-white text-decoration-none">Môn học</a></p>
                    <p><a href="{{ route('web.documents.index') }}" class="text-white text-decoration-none">Tài liệu</a></p>
                    <p><a href="{{ route('web.theses.index') }}" class="text-white text-decoration-none">Luận văn</a></p>
                    <p><a href="{{ route('web.lecturers.index') }}" class="text-white text-decoration-none">Giảng viên</a></p>
                </div>

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold text-white">Hỗ trợ</h5>
                    @foreach ($all_pages as $index => $pfooter)
                        @if($pfooter["type"] == "support")
                            <p><a href="{{ route('web.pages.show', ['slug' => $pfooter["slug"]]) }}" class="text-white text-decoration-none">{{ $pfooter["title"] }}</a></p>
                        @endif
                    @endforeach
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold text-white">Liên hệ</h5>
                    <p><i class="fas fa-home me-3"></i> 227 Nguyễn Văn Cừ, Q.5, TP.HCM</p>
                    <p><i class="fas fa-envelope me-3"></i> dtsaudaihoc@hcmus.edu.vn</p>
                    <p><i class="fas fa-phone me-3"></i> (+84) 28 38.350.097</p>
                    <p><i class="fas fa-globe me-3"></i> sdh.hcmus.edu.vn</p>
                </div>
            </div>

            <hr class="my-3">

            <div class="row d-flex justify-content-between">
                <div class="col-md-7 col-lg-8">
                    <p class="text-white">© 2025 Khoa Toán - Tin học - Đại học Khoa học Tự Nhiên - ĐHQG HCM</p>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="text-center text-md-end">
                        <a href="https://www.facebook.com/VNUHCM.US" class="text-white me-4"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.youtube.com/@vnuhcmus" class="text-white me-4"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-white me-4"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/school/vnuhcm---university-of-science/" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Thanh thông tin nằm phía dưới, dính khi cuộn -->
    <div class="sticky-contact-bar text-white py-2">
        <div class="container d-flex justify-content-between text-center" style="width: 800px;">
            <!-- Đại học -->
            <div class="d-flex align-items-center">
                <img src="https://ts.hust.edu.vn/storage/app/public/settings/icons/search-document.png" alt="hotline" width="24"
                    height="24" class="me-2">
                <div class="text-start">
                    <a href="{{ route('web.announcements.index') }}" class="text-white text-decoration-none">
                        <div class="fw-bold small">THÔNG TIN</div>
                        <div class="fw-bold text-warning">TRA CỨU</div>
                    </a>
                    
                </div>
            </div>

            <!-- Đại học -->
            <div class="d-flex align-items-center">
                <img src="https://ts.hust.edu.vn/storage/app/public/settings/icons/hotline.png" alt="hotline" width="24"
                    height="24" class="me-2">
                <div class="text-start">
                    <div class="fw-bold small">PHẢN HỒI</div>
                    <div class="fw-bold text-warning">(+84) 28 38.350.097</div>
                </div>
            </div>

            <!-- Sau đại học -->
            <div class="d-flex align-items-center">
                <img src="https://ts.hust.edu.vn/storage/app/public/settings/icons/hotline.png" alt="hotline" width="24"
                    height="24" class="me-2">
                <div class="text-start">
                    <div class="fw-bold small">TUYỂN SINH</div>
                    <div class="fw-bold text-warning">(+84) 28 38.350.097</div>
                </div>
            </div>

        </div>
    </div>
    </div>
    @if ($errors->any())
        <script>
            window.addEventListener('load', function () {
                const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
                registerModal.show();
            });
        </script>
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        const notyf = new Notyf({
            duration: 4000,
            ripple: true,
            position: { x: 'right', y: 'top' },
            types: [
                {
                    type: 'success',
                    background: '#1a237e',
                    icon: {
                        className: 'fas fa-check-circle',
                        tagName: 'i',
                        color: 'white'
                    }
                },
                {
                    type: 'error',
                    background: '#d9534f',
                    icon: {
                        className: 'fas fa-times-circle',
                        tagName: 'i',
                        color: 'white'
                    }
                }
            ]
        });

        @if (session('success'))
            notyf.success("{{ session('success') }}");
        @endif

        @if ($errors->has('message'))
            notyf.error("{{ $errors->first('message') }}");
        @endif
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const canvases = document.querySelectorAll(".pdf-thumbnail");

            canvases.forEach(canvas => {
                const url = canvas.getAttribute("data-pdf-url");

                const loadingTask = pdfjsLib.getDocument(url);
                loadingTask.promise.then(pdf => {
                    pdf.getPage(1).then(page => {
                        const viewport = page.getViewport({ scale: 0.8 }); // scale lớn để nét
                        const context = canvas.getContext("2d");
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        const renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        page.render(renderContext);
                    });
                }).catch(err => {
                    console.error("Lỗi khi load PDF:", err);
                    canvas.style.display = 'none';
                });
            });
        });
    </script>
</body>

</html>