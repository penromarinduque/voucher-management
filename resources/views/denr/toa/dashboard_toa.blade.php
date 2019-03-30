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

    @if($toa_access1 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #009ACD; border-radius: 0px;  margin: 0px; ">
                <a href="{{ route('travel.order.list') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Travel Order</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-navicon"></i>
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

    @if($toa_access2 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color:  #00CDCD; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('travel.order.form') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Add Travel Order</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-pencil-square"></i>
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

    @if($toa_access3 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color:  #7171C6; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('travel.order.filter.form') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Travel Order Report</div>
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

    @if($toa_access4 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color:  #00C957; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('employee.filter.form') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Employee Report</div>
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

    <div class="col-md-12" style="padding: 0px 5px 0px 5px;">

    @if($toa_access5 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #EE6363; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('pending.travel.order.list') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Pending Travel Order</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-warning"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Approval Manager</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($toa_access6 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #00C78C; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('approved.travel.order.list') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Approved Travel Order</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-check-square"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Approval Manager</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($toa_access7 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #DB7093; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('disapproved.travel.order.list') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Disapprove Travel Order</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-times-circle"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Approval Manager</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($toa_access8 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #AB82FF; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('cancelled.travel.order.list') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;"> Cancelled Travel Order</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-times-circle-o"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Approval Manager</div>
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