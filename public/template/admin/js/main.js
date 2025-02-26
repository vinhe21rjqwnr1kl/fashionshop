$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
console.log($('meta[name="csrf-token"]').attr('content')); // Kiểm tra giá trị CSRF token

function removeRow(id, url) {
    swal({
        title: "Bạn có chắc chắn không?",
        text: "Bạn sẽ không thể khôi phục dữ liệu này!",
        icon: "warning",
        buttons: true,
        dangerMode: true
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'DELETE',
                dataType: 'JSON',
                data: { id },
                url: url,
                success: function (result) {
                    if (result.error === false) {
                        swal({
                            title: result.message,
                            text: "Hàng đã được xóa thành công.",
                            icon: "success"
                        })
                        .then(() => {
                            location.reload();
                        });
                    } else {
                        swal({
                            title: result.message,
                            text: "Lỗi xoá . Vui lòng thử lại.",
                            icon: "error"
                        })
                    }
                }
            });
        }
    });
}

// UpLoad File
$('#upload').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/services',
        success: function (results) {
            if (results.error == false) {
                $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                    '<img src="' + results.url + '"height="200px" width="180px"></a>');
                $('#thumb').val(results.url);
            } else {
                alert('Upload file lỗi');
            }
        },
    });
});

  


