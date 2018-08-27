function deleteParticipant(that) {
    var id = $(that).attr('data-value');
    swal({
        title: "Confirmation",
        text: "Are you sure to delete this participant from list?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn btn-orange text-white",
        confirmButtonText: "Confirm",
        closeOnConfirm: false
    },
            function (res) {
                if (res) {
                    $(window).block({
                        'message': '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>',
                        'css': {
                            border: '0',
                            padding: '0',
                            backgroundColor: 'none',
                            marginTop: '5%',
                            zIndex: '10600'
                        },
                        overlayCSS: {
                            backgroundColor: '#555',
                            opacity: 0.3,
                            cursor: 'wait',
                            zIndex: '10600'
                        },
                    });
                    $.post(base_url + '/admin/session/list/delete-list-user', {
                        _token: $("input[name=_token]").val(),
                        listUserId: id
                    }, function (response) {
                        if (response.code == '1') {
                            swal({
                                title: '',
                                text: 'Success',
                                type: 'success'
                            }, function () {
                                $("#row_" + id).remove();
                            });
                        } else {
                            swal('', response.message, 'error');
                        }
                        $(window).unblock();
                    });
                }
            });
}


$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than 5 MB');



