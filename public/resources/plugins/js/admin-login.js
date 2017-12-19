$('.login-form').validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-block', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    rules: {
        username: {
            required: true
        },
        password: {
            required: true
        },
        remember: {
            required: false
        }
    },

    messages: {
        username: {
            required: "用户名必须填写"
        },
        password: {
            required: "密码必须填写"
        }
    },

    invalidHandler: function(event, validator) { //display error alert on form submit
        $('.alert-danger', $('.login-form')).show();
    },

    highlight: function(element) { // hightlight error inputs
        $(element)
            .closest('.form-group').addClass('has-error'); // set error class to the control group
    },

    success: function(label) {
        label.closest('.form-group').removeClass('has-error');
        label.remove();
    },

    errorPlacement: function(error, element) {
        error.insertAfter(element.closest('.input-icon'));
    },

    submitHandler: function(form) {
        // form.submit(); // form validation success, call ajax form submit
        var form = $('.login-form');
        var url = form.attr('action');
        var data = form.serializeArray();
        $.ajax({
            url:url,
            type:'post',
            data:data,
            dataType:'json',
            success:function(j){
                alert(j.info);
                if('success' == j.status){
                    window.location.href = j.data.url;
                }
            }
        });
    }
});
