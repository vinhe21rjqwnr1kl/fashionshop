@if ($errors->any())
    <div class="alert alert-danger" id="session-alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger" id="session-alert">
        {{ Session::get('error') }}
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success" id="session-alert">
        {{ Session::get('success') }}
    </div>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Tìm tất cả các thông báo có class .alert
        let alerts = document.querySelectorAll('.alert');
        
        // Ẩn sau 5 giây 
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.display = 'none';
            }, 5000);
        });
    });
</script>
