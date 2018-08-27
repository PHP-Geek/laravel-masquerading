@extends('./layouts.admin') @section('content')
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <div class="container">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>File Validation
                                <small>File Name : {{$fileName}}</small>
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE BREADCRUMBS -->
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <span>Import Participant List</span>
                            </li>
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->
                        <!-- BEGIN PAGE CONTENT INNER -->
                        <!-- END PAGE CONTENT BODY -->
                        <!-- END CONTENT BODY -->
                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet light">
                                            <div class="portlet-body">
                                                <div class="form-body">
                                                    @if(count($error) > 0)
                                                    <form id="importParticipantForm" method="post" action="" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Upload file (excel sheet) max 5 MB</label>
                                                                    <input type="file"  placeholder="Participant Name" id="participantFile" name="participantFile">
                                                                    <input type="hidden" name="sessionId" value="{{$sessionId}}"/>
                                                                    <input type="hidden" name="listId" value="{{$listId}}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <button type="submit" class="btn btn-orange text-white">Submit</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    @endif
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <h4>File Name : {{$fileName}}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-10 col-sm-offset-1">
                                                            @if($error != '' && count($error) > 0)
                                                            @foreach($error as $err)
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="alert alert-danger"><div class="pull-right"><i class="fa fa-times-circle fa-2x"></i></div>{{$err}}</div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @if(count($error) == 0 && $success == 1)
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="alert alert-success">
                                                                <strong>Success!</strong> Data validation done. You can proceed now.
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <form id="saveFileDataForm" method="post" action="{{url('/admin/session/list/save-participant-data')}}">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="sessionId" value="{{$sessionId}}"/>
                                                                <input type="hidden" name="listId" value="{{$listId}}"/>
                                                                <input type="hidden" name="filePath" value="{{$filePath}}"/>
                                                                <button id="successButton" type="submit" class="btn btn-orange text-white text-center">Save Participants</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END QUICK SIDEBAR -->
    </div>
    <!-- END CONTAINER -->
</div>
<script>
    $("#importParticipantForm").validate({
        errorElement: 'span',
        errorClass: 'help-block text-right',
        rules: {
            participantFile: {
                required: true,
                filesize: 5242880,
                extension: "xls,xlsx"
            }
        },
        messages: {
            participantFile: {
                required: "Please upload a file",
                filesize: "File must be less than 5 MB",
                extension: "Please upload a valid file"
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
                }
            });
            $("#importParticipantForm")[0].submit();
        }
    });
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than 5 MB');
</script>
@endsection