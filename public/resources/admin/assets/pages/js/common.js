function info(j) {
    console.log();
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