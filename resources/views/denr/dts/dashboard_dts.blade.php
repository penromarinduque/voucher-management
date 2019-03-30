<?php include(resource_path() . '/views/denr/layouts/helpers_data.php'); ?>

@extends('denr.layouts.app_main')

@section('page-css')

@endsection

@section('page-content')
 
@include('denr.layouts.blocks.page_header')

<div class="row">

    <div class="col-lg-12">

        @include('denr.layouts.blocks.msgconfirmation')
        
    </div>

    @include('denr.dashboard_main')

    <div class="col-md-12" style="padding: 0px 5px 0px 5px;">

    @if($dts_access1 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #009ACD; border-radius: 0px;  margin: 0px; ">
                <a href="{{ route('view.documents', ['id' => 'in']) }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Incoming Document</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8" style="font-size: 40px;">
                                <i class="fa fa-download"></i>
                            </div>
                            @if($in_notification > 0)
                            <div class="col-xs-2" style="font-size: 18px; float: right; font-weight: bold; width: 40px; height: 40px; border-radius: 50px; background-color: #A2CD5A; color: #FFF; padding: 8px; text-align: center; margin-top: 5px; margin-right: 20px;">
                                {{$in_notification}}
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Activity</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($dts_access1 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #A2CD5A; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('view.documents', ['id' => 'out']) }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Outgoing Document</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8" style="font-size: 40px;">
                                <i class="fa fa-upload"></i>
                            </div>
                            @if($out_notification > 0)
                            <div class="col-xs-2" style="font-size: 18px; float: right; font-weight: bold; width: 40px; height: 40px; border-radius: 50px; background-color: #009ACD; color: #FFF; padding: 8px; text-align: center; margin-top: 5px; margin-right: 20px;">
                                {{$out_notification}}
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-xs-9">
                                <div style=" font-size: 14px;">Activity</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($dts_access2 > 0)

        @if($user_role != '4')

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color:  #00CDCD; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('add.documents') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Add Document</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-plus"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Activity</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        @endif

    @endif

    @if($dts_access3 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #DB7093; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('doc.type.list') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Document Type</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-folder-open"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Maintenance</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    </div>

    <div class="col-md-12" style="padding: 0px 5px 0px 5px;">

        <!-- <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #EE6363; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('received.documents') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Received Document</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-inbox"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Activity</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #AB82FF; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('forwarded.documents') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Forwarded Document</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-send"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Activity</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> -->

    @if($dts_access4 > 0)   

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #7171C6; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('document.report') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;"> Document Report</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-bar-chart-o"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Report</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    </div>

</div>

@include('denr.my_account.dashboard_myaccount')

@endsection