@extends('main')

@section('content')
<body class="animsition" style="animation-duration: 1500ms; opacity: 1;">
    <section class="bg0 p-t-104 p-b-116">
        <div class="container d-flex justify-content-center">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <h4 class="mtext-105 cl2 txt-center p-b-30">User Profile</h4>
                
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                <form id="profileForm" action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Avatar upload -->
                    <div class="text-center mb-4">
                        <div id="image_show" class="d-flex justify-content-center">
                            <a href="{{ filter_var($user->thumb, FILTER_VALIDATE_URL) ? $user->thumb : asset('storage/' . $user->thumb) }}" target="_blank">
                                <img id="previewImage" src="{{ filter_var($user->thumb, FILTER_VALIDATE_URL) ? $user->thumb : asset('storage/' . $user->thumb) }}" class="img-thumbnail" height="200px" width="180px">
                            </a>
                        </div>
                        <input type="file" id="upload" name="thumb" style="display: none;" onchange="uploadImage()">
                        <button type="button" onclick="document.getElementById('upload').click()" class="btn btn-outline-primary mt-2">
                            Upload Avatar
                        </button>
                    </div>
                    
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                            <span class="input-group-text"><i class="fa fa-pencil"></i></span>
                        </div>
                    </div>

                    <!-- Email (readonly) -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                            <span class="input-group-text"><i class="fa fa-pencil"></i></span>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </section>
</body>
<script>
    function uploadImage() {
        const fileInput = document.getElementById('upload');
        const previewImage = document.getElementById('previewImage');
        
        // Hiển thị ảnh xem trước
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>
@endsection
