$(function(){$("#user_login_form").validate({errorElement:"span",errorClass:"help-block text-right",rules:{user_login:{required:!0},user_login_password:{required:!0}},messages:{user_login:{required:"Please enter username or email"},user_login_password:{required:"Please enter password"}},highlight:function(e){$(e).closest(".form-group").addClass("has-error")},unhighlight:function(e){$(e).closest(".form-group").removeClass("has-error")},success:function(e){$(e).closest(".form-group").removeClass("has-error"),$(e).closest(".form-group").children("span.help-block").remove()},errorPlacement:function(e,r){e.appendTo(r.closest(".form-group"))},submitHandler:function(e){$("#user_login_btn").button("loading"),$.post("",{_token:$("input[name=_token]").val(),remember:$("#remember").is(":checked"),login:$.trim($("#user_login").val()),password:md5($.trim($("#user_login_password").val()))},function(e){"1"===e.code?($("#error").hide(),$("#success").show(),setTimeout(function(){document.location.href=base_url+"/home"},2e3)):"0"==e.code?($("#error").find("span").html(e.message),$("#user_login_btn").button("reset"),$("#error").show()):($("#login_tnc_error").html(e),$("#user_login_btn").button("reset"),$("#error").show())})}})});