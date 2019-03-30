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

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #A2CD5A; border-radius: 0px;  margin: 0px; ">
                <a href="{{ route('employee.user.list') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">User / Employee</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-users"></i>
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

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #009ACD; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('user.module.access') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">User Module Access</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-random"></i>
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

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #00CDCD; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('user.access') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;"> User Access</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-retweet"></i>
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

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #EE6363; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('employee.position.list') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Position</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-sitemap"></i>
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

    </div>

    <div class="col-md-12" style="padding: 0px 5px 0px 5px;">
              
        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color:  #AB82FF; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('employee.division.list') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Division</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-database"></i>
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
    
        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #DB7093; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('employee.section.list') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Section</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-database"></i>
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

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #00C78C; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('employee.unit.list') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Unit</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-database"></i>
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

    </div>

    <div class="col-md-12" style="padding: 0px 5px 0px 5px;">   

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #FFA07A; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('form.signatory.form') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Form Signatories</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-pencil"></i>
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

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #8FBC8F; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('no.generation.form') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Form No. Generation</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-refresh"></i>
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

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #458B74; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('audit.trail.log.form') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Audit Trail</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-search"></i>
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

    </div>

</div>

@include('denr.my_account.dashboard_myaccount')

@endsection