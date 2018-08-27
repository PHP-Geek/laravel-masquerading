@extends('./layouts.admin') 
@section('content')
<link href="{{url('assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet" type="text/css" />
<script src="{{url('assets/global/plugins/ion.rangeslider/js/ion.rangeSlider.min.js')}}" type="text/javascript"></script>
<style>
    .table thead tr th {
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }
    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        white-space: nowrap;
    }
    .clr-green {
        color: #417d6b !important;
    }
    .magin-top-30{
        margin-top: 30px;
    }
</style>
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER            -->
        <div cass="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper"                                               >
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE HEAD-->
                <!--                        <div c                                   l                                          ass="page-head">
                                                                                                                                       <div              class="container">
                                                                                                                                              
                                                                                                             <div class="page-title">
                                                                                                   <h1>Companies
                                                                               
                                                                     </h1>
                                                       </div>
    </div>
    </div>-->
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container"                            >
                        <!-- BEGIN PAGE BREADCRUMBS -->
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="index.html">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Session Management</span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Manage Session</span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Copy Session</span>
                            </li>
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->
                        <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet light">
                                            <div class="portlet-title">
                                                <div class="caption caption-md">
                                                    <i class="icon-bar-chart font-dark hide"></i>
                                                    <span class="caption-subject font-red-sunglo uppercase bold">Create Phone KIT Participants</span>
                                                    <span class="caption-helper hide">weekly stats...</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <form id="kitParticipantForm" method="post" action="">
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>KIT Name</label>
                                                                        <input class="form-control" id="kitParticipantName" name="kitParticipantName" placeholder="KIT Name" type="text">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Default Prefix</label>
                                                                        <input class="form-control" id="kitParticipantPrefix" name="kitParticipantPrefix" placeholder="Default Prefix" type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Number of Devices</label>
                                                                        <div data-role="rangeslider" style="top:-20px; position: relative;">
                                                                            <input type="range"  class="noOfDevices" > 
                                                                            <input type="hidden" name="noOfDevices" id="noOfDevices" class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Speakers GAP</label>
                                                                        <div data-role="rangeslider" style="top:-20px; position: relative;">
                                                                            <input type="range" class="speakerGap" >
                                                                            <input type="hidden" name="speakerGap" id="speakerGap" class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Microphone</label>
                                                                        <select class="form-control" id="microphone" name="microphone">
                                                                            <option value="phone">Phone </option>
                                                                            <option value="front">Front</option>
                                                                            <option value="blutooth">Bluetooth</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Onset</label>
                                                                        <div data-role="rangeslider" style="top:-20px; position: relative;">
                                                                            <input type="range" class="onset" > 
                                                                            <input type="hidden" name="onset" id="onset" class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Decay</label>
                                                                        <div data-role="rangeslider" style="top:-20px; position: relative;">
                                                                            <input type="range"  class="decay">
                                                                            <input type="hidden" name="decay" id="decay" class="form-control"/>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 margin-bottom-30 text-center magin-top-30">
                                                            <button type="submit" class="btn blue text-white text-center">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="table-responsive">
                                                    <table id="kitParticipantTable" class="table table-bordered"></table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- END PAGE                                                                                                                                                                                                         CONTENT INNER -->
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
<script src="{{url('/js/admin/lists/kitParticipant.js')}}"></script>
@endsection
