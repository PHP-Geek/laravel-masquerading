$(function () {
    $("#traitTemplateForm").validate({
        errorElement: 'span', errorClass: 'help-block text-right',
        rules: {
            templateTitle: {
                required: true
            }
        },
        messages: {
            templateTitle: {
                required: "Template title is required"
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
            $.post('', $("#traitTemplateForm").serialize(), function (data) {
                if (data.code === '1') {
                    swal({title: "", text: data.message, type: "success"}, function () {
                        window.location.href = base_url + '/admin/trait/templates';
                    });
                } else if (data.code == '0') {
                    swal("", data.message, "error");
                } else {
                    swal("", data.message, "error");
                }
                $(window).unblock();
            });
        }
    });

});

// hide show validation and value w.r.t. select field
function showValue(rowNo) {
    if ($("#row_" + rowNo).find(".selectField").val() == 'text') {
        $("#row_" + rowNo).find('.validation-block').show();
        $("#row_" + rowNo).find('.value-block').hide();
        $("#row_" + rowNo).find('.valueField').html('');
    } else {
        $("#row_" + rowNo).find('.validation-block').hide();
        $("#row_" + rowNo).find('.value-block').show();
        $("#row_" + rowNo).find('#templateValidation').find('option:selected').removeAttr('selected');
    }
}

//clone component
function clone_component(t, n) {
    var tr = $(t).closest('.clone_component_' + n);
    clone = tr.clone();
    clone.find('input,textarea').val('');
    clone.find('.validation-block').show();
    clone.find('.value-block').hide();
    tr.after(clone);
    clone.find('.remove_component_button_' + n).removeClass("hidden");
    if ($('.clone_component_' + n).length > 1) {
        $('.remove_component_button_' + n).removeClass("hidden");
    }
    $("#traitTemplateForm").find("textarea").each(function (key, value) {
        $(value).attr('id', 'templateFieldValue_' + key);
        $(value).attr('onclick', 'openmodal(' + key + ')');
    });
    $("#traitTemplateForm").find(".selectField").each(function (k, v) {
        $(v).attr('onchange', 'showValue(' + k + ')');
    });
    $('.clone_component_' + n).each(function (index, val) {
        $(this).find('.perRow').attr('id', 'row_' + index);
    });
    $(t).addClass("hidden");
}


//remove component
function remove_component(t, n) {
    if ($('.clone_component_' + n).length !== 1) {
        $(t).closest('.clone_component_' + n).remove();
        if ($('.clone_component_' + n).length === 1) {
            $('.remove_component_button_' + n).addClass("hidden");
        } else {
            $('.remove_component_button_' + n).eq(($('.clone_component_' + n).length - 1)).removeClass("hidden");
        }
    } else {
        $('.remove_component_button_' + n).addClass("hidden");
    }
    $('.clone_component_button_' + n).eq(($('.clone_component_' + n).length - 1)).removeClass("hidden");
}

function openmodal(rowId) {
    $("#fieldsValueModal").find('#rowId').val(rowId);
    $("#fieldsValueModal").modal('show');
}

$("#setValueBtn").on('click', function () {
    var id = $("#fieldsValueModal").find('#rowId').val();
    var valueArray = [];
    $("#fieldsValueModal").find('.setValue').each(function (i, v) {
        valueArray.push($(v).val());
    });
    $("#templateFieldValue_" + id).val(JSON.stringify(valueArray));
    $("#fieldsValueModal").modal('hide');
});

$("#cancelBtn").on('click', function () {
    window.location.href = base_url + '/group-manager/trait/templates';
})

