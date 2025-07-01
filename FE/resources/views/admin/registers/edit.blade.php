@extends('admin.layouts.app')
@section('title', 'Trạng Thái Tuyển Sinh')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Trạng Thái Tuyển Sinh</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.registers.index') }}">Quản Lý Tuyển Sinh</a>
                    </li>
                    <li class="breadcrumb-item active">Cập Nhật</li>
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

        <form method="POST" action="{{ route('admin.registers.update', $register['id']) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cập Nhật Trạng Thái</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="status">Trạng Thái</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="pending" {{ old('status', $register['status']) === 'pending' ? 'selected' : '' }}>
                                Chưa xử lý
                            </option>
                            <option value="processed" {{ old('status', $register['status']) === 'processed' ? 'selected' : '' }}>
                                Đã xử lý
                            </option>
                        </select>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('admin.registers.index') }}" class="btn btn-secondary">Quay Lại</a>
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection