$(document).ready(function () {
    setRangeSlider('.noOfDevices', 1, 20, 1, 1, '#noOfDevices');
    setRangeSlider('.speakerGap', 0.0, 5, 0.1, 0.1, '#speakerGap');
    setRangeSlider('.onset', 0.0, 5, 0.1, 0.1, '#onset');
    setRangeSlider('.decay', 0.0, 5, 0.1, 0.1, '#decay');
});
/**
 * set the range slider
 * @param {type} element
 * @param {type} min
 * @param {type} max
 * @param {type} from
 * @param {type} step
 * @returns {undefined}
 */
function setRangeSlider(element, min, max, from, step, textbox) {
    var $range = $(element);
    $range.ionRangeSlider({
        type: "single",
        min: min,
        max: max,
        grid: true,
        from: from,
        step: step,
        hide_min_max: true,
        hide_from_to: true,
        onFinish: function (data) {
            $(textbox).val(data.from);
        }
    });
}


//kit participant datatable
//function listingDatatable() {
var datatable = $('#kitParticipantTable').DataTable({
    processing: true,
    serverSide: true,
    searching: false,
    dom: 'lBfrtip',
    lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
    pageLength: 10,
    buttons: [
        'csv', 'print'
    ],
    ajax: {
        "url": base_url + "/admin/session/list/kit-participant-datatable",
        'method': 'POST',
        'data': function (d) {
            d._token = $("input[name=_token]").val();

        }
    },
    columns: [
        {data: 'kitParticipantName', name: 'kitParticipantName', searchable: false, orderable: false, title: "Kit Name", visible: true},
        {data: 'kitParticipantPrefix', name: 'kitParticipantPrefix', searchable: false, orderable: false, title: "Prefix", visible: true},
        {data: 'noOfDevices', name: 'noOfDevices', searchable: false, orderable: false, title: "No of devices", visible: true},
        {data: 'speakerGap', name: 'speakerGap', searchable: false, orderable: false, title: "Speaker Gap", visible: true},
        {data: 'microphone', name: 'microphone', searchable: false, orderable: false, title: "Microphone", visible: true},
        {data: 'onset', name: 'onset', searchable: false, orderable: false, title: "Onset", visible: true},
        {data: 'decay', name: 'decay', searchable: false, orderable: false, title: "Decay", visible: true},
    ]

});

$.fn.dataTable.ext.errMode = 'throw';

$("#kitParticipantForm").validate({
    errorElement: 'span',
    errorClass: 'help-block text-right',
    rules: {
        kitParticipantName: {
            required: true
        }
    },
    messages: {
        kitParticipantName: {
            required: "Kit Name is required"
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
            overlayCSS: {
                backgroundColor: '#555',
                opacity: 0.3,
                cursor: 'wait',
                zIndex: '10600'
            },
        });
        $.post(base_url + "/admin/session/list/save-kit-participant", $("#kitParticipantForm").serialize(), function (data) {
            if (data.code == '1') {
                swal({
                    title: '',
                    text: 'Success',
                    type: 'success'
                }, function () {
                    datatable.draw();
                });
            } else {
                swal('', data.message, 'error');
            }
            $(window).unblock();

        });

    }

});



