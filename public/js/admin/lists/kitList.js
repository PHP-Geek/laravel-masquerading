
/**
 * navigate to participant list
 * @param {*} id 
 */
function participants(id) {
    window.location.href = base_url + '/admin/session/list/kit-list-participants/' + id + '/' + curData.sessionId;
}

$(".sessionListUpdate").on('click', function () {
    var kitListId = $(this).attr('data-value');
    swal({
            title: "Confirmation",
            text: "Are you sure to change the participant list for the session?",
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
                $.post(base_url + '/admin/session/change-session-kitList', {
                    _token: $("input[name=_token]").val(),
                    sessionId: curData.sessionId,
                    kitListId: kitListId
                }, function (response) {
                    if (response.code == '1') {
                        swal({
                            title: '',
                            text: 'Success',
                            type: 'success'
                        }, function () {
                            window.location.href = '';
                        });
                    } else {
                        swal('', response.message, 'error');
                    }
                    $(window).unblock();
                });
            }
        });

});


