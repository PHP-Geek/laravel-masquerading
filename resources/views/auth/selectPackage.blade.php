@extends('./layouts.common')
@section('content')
<style>
    form{
        display: block !important;
    }
    .has-error .help-block{
        color:#ff6666 !important;
    }
    .table thead tr th {
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }

    .login {
        background: #eff3f8!important; 
    }
    .login-custom-header .page-header-inner {
        background: url(images/bg.png);
        position: relative;
    }
    .login-custom-header .page-header-inner:before{
        top:0;
        position: absolute;
        background: rgba(0,0,0, 0.2);
    }
    /*.login-custom-header .page-header-inner {
        background: rgba(0,0,0, 0.2);
    }*/

    .login .logo {
        margin: 60px auto 20px;
    }
    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        white-space: nowrap;
    }
    .clr-green {
        color: #417d6b !important;
    }
    #package {
        text-transform: uppercase;
        transition: all .9s ease 0s;
    }
    .sea-green-bg-products1 {
        background: #fff;
        padding: 10px 0px 116px;
        position: relative;
    }
    .GREY{
        background-color: #EEE !important;
    }
    .text-center{
        text-align: center;
    }
    .font-20{
        font-size: 20px;
    }
    .padding-9 {
        padding: 0px 11px 0px !important;
        margin-bottom: 20px;
    }
    .border-top {
        border-top: 1px solid #000;
    }
    .panel-heading {
        color: #333;
        background-color: #f5f5f5;
        border-color: #ddd;
        padding: 15px 16px !important;
    }
    .font-13 {
        font-size: 13px;
    }
    .panel-heading1 {
        color: #333;
        background-color: #ebebeb;
        border-color: #ddd;
        padding: 15px 16px !important;
    }
    .button-moving {
        position: relative;
        left: 0;
        right: 0;
        bottom: -133px;
        margin: 0px auto;
        text-align: center;
    }
    .margin-45 {
        margin: 0 0 58px 0;
    }

    .margin-top-3{
        margin-top: 3px;
    }
    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }
    .card-body {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .portlet.light {
        padding: 12px 20px 15px;
        background-color: #f9f9f9 !important;
    }
    .plan-collapse{
        cursor: pointer !important;
    }
    .min-height-150{
        min-height: 150px;
    }
</style>
<div class="container">
    <div class="mt-content-body">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="portlet light ">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="font-red-sunglo text-center font-36 margin-top-40 bold">VADI Plans &amp; Pricing</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="font-red-sunglo text-center font-36 margin-top-40 bold">Select Plan :<small>Select plan to register with VaDi</small></h2>
                        </div>
                    </div>
                    <div class="margin-top-20"></div>
                    @foreach($packageDetailsArrray as $key => $package)
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
                                            <h3 class="sbold">{{$package->packageTitle}}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body text-center">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h3 class="price padding-30 margin0">
                                                <strong>
                                                    @if($package->packagePrice == 0)
                                                    Free
                                                    @else
                                                    ${{number_format($package->packagePrice,2)}}
                                                    <?php
                                                    $duration = 0;
                                                    if ($package->packageDuration == 1) {
                                                        $duration = 1;
                                                    }
                                                    ?>
                                                    {{$duration == 1?'/': $package->packageDuration}} {{$typeArray[$package->packageType].($duration == 1?'': 's')}}
                                                    @endif
                                                </strong> 
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
                                <div class="panel-footer padding-tb-20 magin-top-30">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button type="button" class="btn btn-circle btn-success" onclick="selectPackage({{$package->id}})">Select Package</button>
                                        </div>
                                    </div>
                                </div>
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
<script src="{{url('/js/auth/selectPackage.js')}}"></script>
@endsection



