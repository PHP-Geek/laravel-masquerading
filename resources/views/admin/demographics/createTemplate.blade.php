@extends('./layouts.admin')
@section('content') 
<style>
    .margin-top-14{
        margin-top:14px !important;
    }
    textarea{
        cursor: pointer !important;
    }
</style>
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE HEAD-->
                <!--                        <div class="page-head">
                                            <div class="container">
                                                 
                                                <div class="page-title">
                                                    <h1>Companies
                                                        
                                                    </h1>
                                                </div>
                                            </div>
                                        </div>-->
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE BREADCRUMBS -->
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="{{url('/home')}}">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span><a href="{{url('/admin/trait/templates')}}">Trait Templates</a></span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Create</span>
                            </li>
                        </ul>
                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet light ">
                                            <div class="portlet-title">
                                                <div class="caption font-red-sunglo">
                                                    <span class="caption-subject font-red-sunglo bold uppercase"> Trait Template Details</span><small>  (Please do not include the columns <b>First Name, Last Name, Email, Contact, Pass Code and Contact Method</b>)</small>
                                                </div>
                                                      
                                            </div>
                                            <form role="form" id="traitTemplateForm" method="post">
                                                {{csrf_field()}}
                                                <div class="portlet-body form">
                                                    <div class="form-body">
                                                        <div class="row margin-top-10">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Template Title</label>
                                                                    <input type="text" name="templateTitle" id="templateTitle" class="form-control" placeholder="Template Title"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Template Fields</label>
                                                            </div>
                                                        </div><br/>
                                                        <div class="clone_component_1">
                                                            <div class="row perRow" id="row_0">
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                        <label>Field Label</label>
                                                                        <input type="text" class="form-control" placeholder="Label" name="templateFieldLabel[]" id="templateFieldLabel"> 
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <div class="form-group">
                                                                        <label>Required</label>
                                                                        <select id="required" name="required[]" class="form-control">
                                                                            <option value="0">No</option>
                                                                            <option value="1">Yes</option>
                                                                        </select>
                                                                    </div>
                                                                </div>  
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                        <label>Field Type</label>
                                                                        <select name="templateFieldControl[]" id="templateFieldControl" class="form-control selectField" onchange="showValue(0)">
                                                                            <option value="text">Text Field</option>
                                                                            <option value="select">Drop Down List</option>
                                                                            <option value="radio">Radio Button</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4  validation-block">
                                                                    <div class="form-group">
                                                                        <label>Validation</label>
                                                                        <select id="templateValidation" name="templateValidation[]" class="form-control"> 
                                                                            <option value="">Select</option>

                                                                            <option value="1">Digit</option>
                                                                            <option value="2">Currency</option>
                                                                            <option value="3">Date</option>

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-4 value-block" style="display:none">
                                                                    <div class="form-group">
                                                                        <label>Value(s)</label>
                                                                        <textarea id="templateFieldValue_0" name="templateFieldValue[]" class="form-control valueField" readonly="true" onclick="openmodal(0)"></textarea> 
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <div class="btn-group margin-top-20">
                                                                        <a class="clr-green-custom margin-right-10 remove_component_button_1 hidden" onclick="remove_component(this, 1)"><i class="fa fa-minus-circle  fa-2x clr-green margin-top-14" aria-hidden="true"></i> </a>
                                                                        &nbsp;               <a class="clr-green-custom clone_component_button_1 " onclick="clone_component(this, 1);"><i class="fa fa-plus-circle fa-2x clr-green margin-top-14" aria-hidden="true"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-orange">Submit</button>
                                                    <button id="cancelBtn" type="button" class="btn default">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- END PAGE CONTENT INNER -->
                    </div>
                </div>
                <!-- END PAGE CONTENT BODY -->
                <!-- END CONTENT BODY -->
            </div>
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
    </div>
</div>


<!-- Modal -->
<div id="fieldsValueModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add values for the control</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="rowId"/>
                <div class="clone_component_2">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" name="value[]" class="form-control setValue" id="value" placeholder="Value"/>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="btn-group">
                                <a class="clr-green-custom margin-right-10 remove_component_button_2 hidden" onclick="remove_component(this, 2)"><i class="fa fa-minus-circle  fa-2x clr-green margin-top-14" aria-hidden="true"></i> </a>
                                &nbsp;<a class="clr-green-custom clone_component_button_2" onclick="clone_component(this, 2);"><i class="fa fa-plus-circle fa-2x clr-green margin-top-14" aria-hidden="true"></i></a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="setValueBtn" class="btn yellow-gold">Add Value(s)</button>
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
            </div>
        </div>

    </div>
</div>


<script src="{{url('/js/admin/demographics/createTemplate.js')}}"></script>
@endsection