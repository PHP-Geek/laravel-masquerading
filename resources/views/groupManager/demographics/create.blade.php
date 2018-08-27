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
                                <span><a href="{{url('/group-manager/traits')}}">Traits</a></span>
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
                                                    <span class="caption-subject font-red-sunglo bold uppercase"> Trait Details</span>
                                                </div>
                                            </div>
                                            <form role="form" id="traitForm" method="post">
                                                {{csrf_field()}}
                                                <div class="portlet-body form">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label> Template</label>
                                                                    <select  name="templateId" id="templateId" class="form-control">
                                                                        <option selected="selected" value="" disabled="disabled">Select Template</option>
                                                                        @foreach($templateArray as $template)
                                                                        <option value="{{$template->id}}">{{$template->templateTitle}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="showform">
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

<script src="{{url('/js/groupManager/demographics/create.js')}}"></script>
@endsection