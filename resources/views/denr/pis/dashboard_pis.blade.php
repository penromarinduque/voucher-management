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

    @if($pis_access1 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #A2CD5A; border-radius: 0px;  margin: 0px; ">
                <a href="{{ route('personal.information') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Personal Information</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-navicon"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Personal Data Sheet</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($pis_access2 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #009ACD; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('family.background') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Family Background</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-navicon"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Personal Data Sheet</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($pis_access3 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color:  #00CDCD; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('educational.background') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Educational Background</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-navicon"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Personal Data Sheet</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($pis_access4 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #EE6363; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('civil.service.eligibility') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Civil Service Eligibility</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-navicon"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Personal Data Sheet</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    </div>

    <div class="col-md-12" style="padding: 0px 5px 0px 5px;">

    @if($pis_access5 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #AB82FF; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('work.experience') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Work Experience</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-navicon"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Personal Data Sheet</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($pis_access6 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #DB7093; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('voluntary.work') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Voluntary Work</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-navicon"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Personal Data Sheet</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($pis_access7 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #00C78C; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('learning.development') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;"> Learning & Development</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-navicon"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Personal Data Sheet</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    @endif

    @if($pis_access8 > 0)

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #458B74; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('other.information') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Other Information</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-navicon"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Personal Data Sheet</div>
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