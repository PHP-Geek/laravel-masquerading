
$(function () {
    $("#sessionDate").inputmask("mm/dd/yyyy");
    $("#sessionStart").inputmask("hh:mm");
    $("#sessionEnd").inputmask("hh:mm");
    $("#createSessionForm").validate({
        errorElement: 'span', errorClass: 'help-block text-right',
        rules: {

            sessionName: {
                required: true
            },
            sessionStart: {
                required: true,
            },
            sessionEnd: {
                required: true
            },
            sessionKitId: {
                required: function () {

                    if ($('#sessionListId').val() == "") {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            sessionListId: {
                required: function () {

                    if ($('#sessionKitId').val() == "") {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            sessionDate: {
                required: true
            }
        },
        messages: {

            sessionName: {
                required: "Session title is required"
            },
            sessionStart: {
                required: "Session start time is required",

            },
            sessionEnd: {
                required: "Session end time is required"
            },
            sessionKitId: {
                required: "Select one of kit list or participant"

            },
            sessionListId: {
                required: "Select one of kit list or participant"
            },
            sessionDate: {
                required: "Session Date is required"
            }
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        success: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
            $(element).closest('.form-group').children('span.help-block').remove();

        },
        errorPlacement: function (error, element) {
            error.appendTo(element.closest('.form-group'));
        },
        submitHandler: function (form) {
            $(window).block({
                'message': '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>',
                'css': {
                    border: '0',
                    padding: '0',
                    backgroundColor: 'none',
                    marginTop: '5%',
                    zIndex: '10600'
                },
                overlayCSS: {backgroundColor: '#555', opacity: 0.3, cursor: 'wait', zIndex: '10600'},
            });
            $.post('', $("#createSessionForm").serialize(), function (result) {
                if (result.code == '1') {
                    swal({title: '', text: result.message, type: 'success'}, function () {
                        window.location.href = base_url + '/admin/session/list';
                    });
                } else {
                    swal('', result.message, 'error');
                }
                $(window).unblock();
            });
        }
    });
});

$("#sessionKitId").on('change', function () {
    $("#sessionListId").find('option:selected').removeAttr('selected');
});


$("#sessionListId").on('change', function () {
    $("#sessionKitId").find('option:selected').removeAttr('selected');
});
