@extends('./layouts.admin')
@section('content')
<style>
    .plan-collapse{
        cursor: pointer !important;
    }
    .padding-30{
        padding: 30px;
    }
    .margin0{
        margin: 0;
    }
    .edit-plan {
        position: absolute;
        top: 10px;
        right: 30px;
        display: inline-block;
        cursor: pointer;
    }
    .min-height-150{
        min-height: 150px;
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
                                <span>Plans & Pricing</span>
                            </li>
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->
                        <!-- BEGIN PAGE CONTENT INNER -->

                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="form-actions ">
                                    <a type="button" href="{{url('/package/add')}}" class="btn default btn-green pull-right margin-bottom-10 text-white"> Add Plan</a>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet light ">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="font-red-sunglo text-center font-36 sbold">VADI Plans & Pricing</h3>
                                                </div>
                                            </div>
                                            <div class="margin-top-20"></div>
                                            @foreach($packageDetailsArray as $key => $package)
                                            @if($key == 0 || $key%3 == 0)
                                            <div class="row">
                                                @endif 
                                                <?php $typeArray = ['1' => 'Month', '2' => 'Year', '3' => 'Day']; ?>
                                                <!-- item -->
                                                <div class="col-md-4 text-center">
                                                    <div class="panel panel-success  panel-pricing">
                                                        <div class="panel-heading">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <h3  class="sbold">{{$package->packageTitle}} </h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel-body text-center">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <h3 class="price padding-30 margin0">
                                                                          Price : 
                                                                            @if($package->packagePrice == 0)
                                                                            Free
                                                                            @else
                                                                            ${{number_format($package->packagePrice,2)}}                                         @endif   <br>      
                                                                       
                                                                          Duration : 
                                                                            @if($package->packageDuration == 0)
                                                                           No Duration
                                                                           @else
                                                                            {{($package->packageDuration)}}  {{$typeArray[$package->packageType]}}      
                                                                            @endif
                                                                           
                                                                      

                                                                        <a href='{{url('/package/edit/'.$package->id.'/'.$package->packageSlug)}}'> <span class="fa fa-pencil edit-plan"></span></a>
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <p class="padding-30 margin0">
                                                                        {{$package->packageDescription}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="list-group min-height-150 text-center margin-bottom-20">
                                                            @foreach($package->packageDetail as $packageDetail)
                                                            <li class="list-group-item"><i class="fa fa-check"></i> {{$packageDetail->description}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- /item -->

                                                @if($key != 0 && (($key%3 - 2) == 0 || count($package) - 1 == $key))
                                            </div>
                                            <div class="margin-top-40"></div>
                                            @endif
                                            @endforeach
                                            <div class="margin-top-40"></div>
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
</div>
@endsection