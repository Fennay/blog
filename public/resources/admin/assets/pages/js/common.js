function info(j) {
    var status = j.status || 'error';
    info = j.info || '系统错误';
    data = j.data;
    if ('success' === status) {
        html = '<i class="glyphicon glyphicon-ok"></i> ';
    } else {
        html = '<i class="glyphicon glyphicon-remove"></i> ';
    }
    $('.info .modal-body').html(html + info);
    $('.info').modal('show');
    if (null !== data.url) {
        setTimeout(function () {
            window.location.href = data.url;
        }, 3000);
    }
}


function msg(j) {
    var status = j.status || 'error',
        info = j.info || '系统错误',
        url = j.data.url || '';
    swal({
        title: info,
        type: status,
        allowOutsideClick: true,
        timer: 3000,
    });
    if ('' !== url) {
        setTimeout(function () {
            window.location.href = url;
        }, 2000);
    }
}

function deleteAlert(url) {
    swal({
            title: "确定删除吗？",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "确定删除！",
            closeOnConfirm: false
        },
        function () {
            $.ajax({
                type: "delete",
                url: url,
                dataType: "json",
                success: function (j) {
                    msg(j);
                }
            });
        });
}

/**
 * 上传图片
 * @returns {boolean}
 */
function uploadImage(uploadFile,imgUrl) {
    var url = "/upload",
        data = new FormData,
        upload = $('#' + uploadFile),
        files = upload.prop('files');
    data.append('file', files[0]);
    if ('' === upload.val()) {
        return false;
    }
    $.ajax({
        type: "post",
        url: url,
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        success: function (j) {
            $('#' + uploadFile).val("");
            $('#' + imgUrl).val(j.data.img_url);
            msg(j);
        }
    });
}