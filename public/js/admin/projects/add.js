

$("#cancelBtn").on('click', function () {
    window.location.href = base_url + '/admin/projects';
});


$(function () {
    $('#saveTemplate').click(function () {
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
        $.post(base_url + '/admin/project/template/create', $("#createProjectForm").serialize(), function (result) {
            if (result.code == '1') {
                swal({title: '', text: result.message, type: 'success'}, function () {
                    window.location.href = base_url + '/admin/project/templates';
                });
            } else {
                swal('', result.message, 'error');
            }
            $(window).unblock();
        });
    });

    $("#createProjectForm").validate({
        errorElement: 'span', errorClass: 'help-block text-right',
        rules: {
            projectTypeId: {
                required: true
            },
            groupId: {
                required: true
            },
            projectOwner: {
                required: true
            },

            projectTitle: {
                required: true
            },
            projectDescription: {
                required: true
            },
            projectSessionCount: {
                required: true,
                min: 1
            },
            dictionary: {
                filesize: 5242880,
                extension: "txt"
            },
            projectGuideFile: {
                filesize: 5242880,
                extension: "xls,xlsx,xlsxx"
            },
            productFile: {
                filesize: 5242880,
                extension: "csv,xls,xslx"
            }
        },
        messages: {
            projectTypeId: {
                required: "Project type is required"
            },
            groupId: {
                required: "Group is required"
            },
            projectOwner: {
                required: "Owner is required"
            },
            projectTitle: {
                required: "Title is required"
            },
            projectDescription: {
                required: "Description is required"
            },
            projectSessionCount: {
                required: "No of session is required",
                min: "Please enter valid no of session"
            },
            dictionary: {
                filesize: "File size should be max 5 MB",
                extension: "Please upload valid dictionary(txt) file"
            },
            projectGuideFile: {
                filesize: "File size should be max 5 MB",
                extension: "Please upload valid excel sheet file"
            },
            productFile: {
                filesize: "File size should be max 5 MB",
                extension: "Please upload a valid csv file"
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
            $("#createProjectForm")[0].submit();
        }
    });

});
$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than 5 MB');