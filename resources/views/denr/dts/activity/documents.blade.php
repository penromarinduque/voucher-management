<?php 

use App\Helpers\Helper;

$window = helper::window();
$subwindow = helper::subwindow();
$access = helper::access($window, $subwindow);

$user = Auth::user();
$user_type = $user->user_type;
$user_role = $user->user_role;

?>

@extends('denr.layouts.app')

@section('page-css')

@endsection

@section('page-content')

            
<div class="row">

    @include('denr.layouts.blocks.pageloc')

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" style="padding-top: 12px;">
            <ul class="nav nav-tabs" style="font-size: 11px; text-transform: uppercase;">
                <li @if($category == 'PENDING') class="active" @endif style="margin-left: 12px;">
                    <a href="{{ route('dts.document.index', ['id' => 'pending']) }}"><i class="fa fa-file-o" aria-hidden="true"></i>  Vouchers</a>
                </li>
                <li @if($category == 'ACTED') class="active" @endif>
                    <a href="{{ route('dts.document.index', ['id' => 'acted']) }}"><i class="fa fa-paper-plane fa-fw"></i> Acted</a>
                </li>
                <li @if($category == 'COMPLETED') class="active" @endif>
                    <a href="{{ route('dts.document.index', ['id' => 'completed']) }}"><i class="fa fa-check-square fa-fw"></i> Completed</a>
                </li>
                {{-- <li @if($category == 'ACTED') class="active" @endif>
                    <a href="{{ route('dts.document.acted') }}"><i class="fa fa-paper-plane fa-fw"></i> Acted</a>
                </li>
                <li @if($category == 'COMPLETED') class="active" @endif>
                    <a href="{{ route('dts.document.completed') }}"><i class="fa fa-check-square fa-fw"></i> Completed</a>
                </li> --}}
                @if($user_role != '4')
                <li>
                    <a href="{{ route('dts.document.create') }}"><i class="fa fa-plus fa-fw"></i> New Voucher</a>
                </li>
                @endif
            </ul>
            <div class="panel-body">
                <div class="row"> 
                    <div class="col-lg-12">
                        @include('denr.layouts.blocks.msgconfirmation')
                    </div>
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                <tr>
                                    <td colspan="6" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; text-transform: uppercase; ">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default">
                                                    <i class="fa fa-search fa-fw"></i> 
                                                </button>
                                            </div>
                                            <div style="width: 99%;">
                                                <input type="hidden" name="category_id" id="category_id" value="{{$category}}">
                                                <input type="text" name="search_doc" id="search_doc" value="" onchange="searchData()" onkeyup="searchDataEnter()" onkeydown="searchDataEnter()" placeholder="Search {{$cat_desc}}" class="form-control" style="height: 34px; font-size: 12px; border-radius: 0px;">
                                            </div>
                                            <div class="input-group-btn">
                                                <a href="javascript:void(0)" class="btn-filter" data-id="{{ $cat_desc }}" data-id2="{{ strtoupper($category) }}" >
                                                    <button type="button" class="btn btn-default">
                                                        <i class="fa fa-search fa-fw"></i> Filter
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="div_post_data">
                            @include('denr.dts.activity.documentPage')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODALS -->

@include('denr.dts.activity.modal.documentFilterModal')
@include('denr.dts.activity.modal.historyModal')
@include('denr.dts.activity.modal.attachmentModal')
@include('denr.dts.activity.modal.forwardModal')
@include('denr.dts.activity.modal.completeModal')

<!-- SCRIPTS -->


@include('denr.dts.activity.script.jScriptFilterPage')
@include('denr.dts.activity.script.jScriptSearchDocument')
@include('denr.dts.activity.script.jScriptDateTimeFormat')
            
@endsection