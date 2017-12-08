var Login = function () {

    var handleLogin = function () {

        $('#tags-add').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                name: {
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                $('.alert-danger', $('.tags-add-form')).show();
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
                        // info(j);
                        msg(j);
                    }
                });
            }
        });

        $('.tags-add-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.tags-add-form').validate().form()) {
                    $('.tags-add-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
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