@extends('./layouts.admin')
@section('content') 
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE BREADCRUMBS -->
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="{{url("/home")}}">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Trail Templates</span>
                            </li>
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->
                        <!-- BEGIN PAGE CONTENT INNER -->

                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet light ">
                                            <div class="portlet-title">
                                                <div class="caption font-red-sunglo">
                                                    <span class="caption-subject font-red-sunglo bold uppercase"> Trait Templates</span>
                                                </div> 
                                                <div class="caption caption-md pull-right">
                                                    <a href="javascript:;" onclick="addTemplate()" class="btn btn-orange text-white"><i class="fa fa-plus-circle"></i> Add New</a>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="projectDatatable">
                                                        <tr>
                                                            <th>Template</th>
                                                            <th>Created by</th>
                                                            <th>Date</th>
                                                            <th>Fields</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        @if(count($traitArray) > 0)
                                                        @foreach($traitArray as $trait)
                                                        <tr>
                                                            <td>{{$trait->templateTitle}}</td>
                                                            <td>{{$trait->templateCreatedBy->firstName.' '.$trait->templateCreatedBy->lastName}}</td>
                                                            <td>{{date('m/d/Y h:i A',strtotime($trait->created_at))}}</td>
                                                            <td>
                                                                <a onclick="viewTrait('{{$trait->id}}')" href="javascript:;" class="btn yellow btn-outline btn-xs"><i class="fa fa-eye"></i></a>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td colspan="4" class="text-center">No Data</td>
                                                        </tr>
                                                        @endif
                                                    </table>
                                                </div>
                                            </div>
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
                <h4 class="modal-title">Template Fields</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table" id="fields">

                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn default">OK</button>
            </div>
        </div>

    </div>
</div>
<script src="{{url('/js/admin/demographics/templates.js')}}"></script>
@endsection