@extends('./layouts.admin')
@section('content')
<style>
    .margin-top-14{
        margin-top:14px !important;
    }
</style>
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
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
                                <a href="{{url('/packages')}}">plans & pricing</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Add </span>
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
                                                <div class="caption ">
                                                    <span class="caption-subject font-red-sunglo bold uppercase"> Plan Details</span>

                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <form role="form" id="addPackageForm" name="addPackageForm" method="post">
                                                    {{csrf_field()}}
                                                    <div class="form-body">

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Name Of Plan</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Name Of Plan" name="packageTitle" id="packageTitle" value='{{ isset($packageDetailsArray) ? $packageDetailsArray->packageTitle:'' }}'> </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Price </label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-dollar"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Price" name="packagePrice" id="packagePrice" value='{{ isset($packageDetailsArray) ? $packageDetailsArray->packagePrice:'' }}'> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Package Type</label>

                                                                    <select name="packageType" id="packageType" class="form-control">

                                                                        <option {{(isset($packageDetailsArray)&& 1==$packageDetailsArray->packageType)?'selected="selected"':''}} value="1" selected="">Monthly</option>
                                                                        <option  {{(isset($packageDetailsArray)&& 2==$packageDetailsArray->packageType)?'selected="selected"':''}} value="2">Yearly</option>
                                                                        <option {{(isset($packageDetailsArray)&& 3==$packageDetailsArray->packageType)?'selected="selected"':''}} value="3">Day</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <?php $durationArray = ['1' => 'Months', '2' => 'Years', '3' => 'Days']; ?>
                                                                    <label>Duration <span id="duration">({{isset($packageDetailsArray)?$durationArray[$packageDetailsArray->packageType]:'Months'}})</span></label>
                                                                    <input type="text" class="form-control" placeholder="Duration" name="packageDuration" id="packageDuration" value='{{ isset($packageDetailsArray) ? $packageDetailsArray->packageDuration:'' }}'> </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="comment">Package Detail</label>
                                                                    <textarea class="form-control" rows="5" id="comment" name="packageDescription" id="packageDescription">{{ isset($packageDetailsArray) ? $packageDetailsArray->packageDescription:'' }}</textarea>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        @if(isset($packageDetailsArray) && count($packageDetailsArray->packageDetail) > 0)
                                                        @foreach($packageDetailsArray->packageDetail as $key1 => $packageDetail)
                                                        <div class="clone_component_1">
                                                            <div class="row">
                                                                <div class="col-xs-8 col-sm-10">
                                                                    <div class="form-group">
                                                                        <label>Feature</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-envelope"></i>
                                                                            </span>
                                                                            <input type="text" class="form-control" placeholder="Feature" value="{{$packageDetail->description}}" name="description[]" id="description"> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-4 col-sm-2">
                                                                    <div class="btn-group margin-top-20">
                                                                        <a class="clr-green-custom margin-right-10 remove_component_button_1 {{count($packageDetailsArray->packageDetail)==1?'hidden':''}}" onclick="remove_component(this, 1)"><i class="fa fa-minus-circle  fa-2x clr-green margin-top-14" aria-hidden="true"></i> </a>
                                                                        &nbsp;               <a class="clr-green-custom clone_component_button_1 {{$key1 !=  (count($packageDetailsArray->packageDetail)- 1) ? 'hidden':''}}" onclick="clone_component(this, 1);"><i class="fa fa-plus-circle fa-2x clr-green margin-top-14" aria-hidden="true"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                        @endforeach
                                                        @else
                                                        <div class="clone_component_1">
                                                            <div class="row">
                                                                <div class="col-xs-8 col-sm-10">
                                                                    <div class="form-group">
                                                                        <label>Feature</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-envelope"></i>
                                                                            </span>
                                                                            <input type="text" class="form-control" placeholder="Feature" name="description[]" id="description"> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-4 col-sm-2">
                                                                    <div class="btn-group margin-top-20">
                                                                        <a class="clr-green-custom margin-right-10 remove_component_button_1 hidden" onclick="remove_component(this, 1)"><i class="fa fa-minus-circle  fa-2x clr-green margin-top-14" aria-hidden="true"></i> </a>
                                                                        &nbsp;               <a class="clr-green-custom clone_component_button_1 " onclick="clone_component(this, 1);"><i class="fa fa-plus-circle fa-2x clr-green margin-top-14" aria-hidden="true"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-actions">
                                                        <button type="submit" id="addPackageBtn" class="btn blue btn-green">Submit</button>
                                                        <a  href="{{url('/packages')}}" class="btn default">Cancel</a>
                                                    </div>
                                                </form>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- END PAGE CONTENT INNER -->
                    </div>
                </div>
            </div>
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
    </div>
</div>
<script src="{{ url('js/superadmin/pricing/add.js') }}"></script>
@endsection