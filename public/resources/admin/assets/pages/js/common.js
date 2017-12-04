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
    var status = j.status || 'error';
    var info = j.info || '系统错误';
    var url = j.data.url || '';
    swal({
        title: info,
        type: status,
        allowOutsideClick: true,
        timer: 3000,
    });
    if (null !== url) {
        setTimeout(function () {
            window.location.href = url;
        }, 3000);
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
                type:"delete",
                url:url,
                dataType:"json",
                success:function (j) {
                    msg(j);
                }
            });
        });
}

function uploadImage() {
    var url = "/upload",
        data = new FormData,
        files = $('#uploadFile').prop('files');
    data.append('thumb', files[0]);
    $.ajax({
        type: "post",
        url: url,
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        success: function (j) {
            msg(j);
        }
    });
}