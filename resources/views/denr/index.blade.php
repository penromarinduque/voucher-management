<?php include(resource_path() . '/views/denr/layouts/helpers_data.php'); ?>

@extends('denr.layouts.app_main')

@section('page-css')

@endsection

@section('page-content')

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"> 

            <font style="color: #5B5B5B;"><i class="fa fa-home"></i> {{ config('app.name', 'Laravel') }}</font>

        </h3>
    </div>
</div>

<div class="row">

    <div class="col-lg-12">

        @include('denr.layouts.blocks.msgconfirmation')
        
    </div>

    <div class="col-md-12" style="padding: 0px 5px 0px 5px;">

    @if($pis_access > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #A2CD5A; border-radius: 0px;  margin: 0px; ">
                <a href="{{ route('pis') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">PIS</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-language"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Personal Information System</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($toa_access > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #009ACD; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('toa') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">TOA</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-globe"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Travel Order Application</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($dts_access > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #00CDCD; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('dts') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">DTS</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-file-text-o"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Document Tracking System</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($lms_access > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #AB82FF; border-radius: 0px;  margin: 0px;">
                <a href="#" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">LMS</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Leave Monitoring System</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    </div>

    <div class="col-md-12" style="padding: 0px 5px 0px 5px;">

    @if($fsa_access > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #DB7093; border-radius: 0px;  margin: 0px;">
                <a href="#" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">FSA</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-navicon"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Frontline Services Application</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($user->user_type == 1)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #00C78C; border-radius: 0px; margin: 0px; ">
                <a href="{{ route('app') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">APP</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-laptop"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Application Manager</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #9BCD9B; border-radius: 0px; margin: 0px; ">
                <a href="#" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">BRM</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-undo"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Backup & Recovery Manager</div>
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