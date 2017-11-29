var Login = function () {

    var handleLogin = function () {

        $('#user-add').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true,
                    rangelength: [6, 50]
                },
                remember: {
                    required: false
                },
                email: {
                    required: false,
                    email: true
                },
                telephone: {
                    required: false,
                    telephone: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                $('.alert-danger', $('.user-add-form')).show();
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function (form) {
                var url = $(form).attr('action-url');
                var data = $(form).serializeArray();
                $.ajax({
                    type: "post",
                    url: url,
                    data: data,
                    dataType: "json",
                    success: function (j) {
                        var html = ' <i class="glyphicon glyphicon-ok"></i> ' + j.info;
                        if ('success' === j.status) {
                            $('.info .modal-body').html(html);
                            $('.info').modal('show');
                            setTimeout(function () {
                                if(null !== j.data.url){
                                    window.location.href = j.data.url;
                                }
                            },3000);

                        } else {
                            $('.info .modal-body').html(html);
                            $('.info').modal('show')
                        }
                    }
                });
            }
        });

        $('.user-add-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.user-add-form').validate().form()) {
                    $('.user-add-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });

        $('.forget-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
                }
                return false;
            }
        });

        $('#forget-password').click(function () {
            $('.user-add-form').hide();
            $('.forget-form').show();
        });

        $('#back-btn').click(function () {
            $('.user-add-form').show();
            $('.forget-form').hide();
        });
    }


    return {
        //main function to initiate the module
        init: function () {
            handleLogin();
        }

    };

}();

jQuery(document).ready(function () {
    Login.init();
});