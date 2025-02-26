@extends('main')

@section('content')
<section class="bg0 p-t-104 p-b-116">
    <div class="container" style="display: flex; justify-content:center;">
        <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
            <h4 class="mtext-105 cl2 txt-center p-b-30">
                Đổi Mật Khẩu
            </h4>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="mb-3">
                    <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">Mật khẩu mới</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required>
                    @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Đổi Mật Khẩu</button>
            </form>
        </div>
    </div>
</section>
@endsection
