<?php 

use App\Helpers\Helper;
$doc_class = helper::doc_class();
$icon_class = helper::icon_class();

$user = Auth::user();
$user_type = $user->user_type;
$user_role = $user->user_role;

?>
@inject('helper', 'App\Helpers\Helper')

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

                <li style="margin-left: 12px;">
                    <a href="{{ route('dts.document.index', ['id' => 'in']) }}"><i class="fa fa-sign-in fa-fw"></i> Incoming Document</a>
                </li>

                <li>
                    <a href="{{ route('dts.document.index', ['id' => 'out']) }}"><i class="fa fa-sign-out fa-fw"></i> Outgoing Document</a>
                </li>

                <li>
                    <a href="{{ route('dts.document.acted') }}"><i class="fa fa-paper-plane fa-fw"></i> Acted</a>
                </li>
                <li class="active">
                    <a href="{{ route('dts.document.completed') }}"><i class="fa fa-check-square fa-fw"></i> Completed</a>
                </li>

                @if($user_role != '4')
                
                <li>
                    <a href="{{ route('dts.document.create') }}"><i class="fa fa-plus fa-fw"></i> New Document</a>
                </li>

                @endif

            </ul>

            <div class="panel-body">
            	<div class="row"> 
                    <div class="col-lg-12">
                        @include('denr.layouts.blocks.msgconfirmation')
                    </div>
                    <div class="col-lg-12">
                        <div class="panel-default">
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
                                                <input type="hidden" name="category_id" id="category_id" value="">
                                                <input type="text" name="search_doc" id="search_doc" value="" onchange="searchData()" onkeyup="searchDataEnter()" onkeydown="searchDataEnter()" placeholder="Search " class="form-control" style="height: 34px; font-size: 12px; border-radius: 0px;">
                                            </div>
                                            <div class="input-group-btn">
                                                <a href="javascript:void(0)" class="btn-filter" data-id="" data-id2="" >
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
                        <div class="panel panel-default">
                            <table class="table table-striped table-bordered table-hover tooltip-demo" style="table-layout: fixed;">
                                <thead>
                                    <tr>
                                        <th style="width:4%;font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: right">#</th>
                                        <th style="width:8%;font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: left">DOC. NO.</th>
                                        <th style="width:6%;font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: left">DOC. DATE</th>
                                        <th style="width:9%;font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: left">TYPE</th>
                                        <th style="width:12%;font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: left">ORIGINATING OFFICE</th>
                                        <th style="width:12%;font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: left">SUBJECT</th>
                                        <td style="width:16%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Remarks</td>
                                        <td style="width:12%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Encoded By</td>
                                        <td style="width:12%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Action</td>
                                    </tr>
                                </thead>
                                {{-- <thead>
                                    <tr>
                                        <td style="width:4%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: right;">No.</td>
                                        <td style="width:3%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: center;"><i class="fa fa-bell "></i></td>
                                        <td style="width:3%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: center;"><i class="fa fa-star "></i></td>
                                        <td style="width:8%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: left;">Doc. No.</td>
                                        <td style="width:6%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Doc. Date</td>
                                        <td style="width:9%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Type</td>
                                        <td style="width:12%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Originating Office</td>
                                        <td style="width:15%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Subject</td>
                                        <td style="width:16%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Remarks</td>
                                        <td style="width:12%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Encoded By</td>
                                        <td style="width:12%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Action</td>
                                    </tr>
                                </thead> --}}
                                <tbody>
                                @if(!empty($documents))
                                    @php $c = 1; @endphp
                                    @foreach($documents as $document)
                                    <tr>
                                        <td style="font-size: 11px; color: #5B5B5B; text-align: right; ">{{$c++}}</td>
                                        <td style="font-size: 11px; color: #5B5B5B; text-align: left; ">
                                            {{$document->DOC_NO}}
                                        </td>
                                        <td style="font-size: 11px; color: #5B5B5B; text-align: left; ">{{$document->DOC_DATE}}</td>
                                        <td style="font-size: 11px; color: #5B5B5B; text-align: left; ">{{$document->DOC_TYPE}}</td>
                                        <td style="font-size: 11px; color: #5B5B5B; text-align: left; ">{{$document->ORIGIN_OFFICE}}</td>
                                        <td style="font-size: 11px; color: #5B5B5B; text-align: left; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;  ">{{$document->DOC_SUBJ}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    	</div>

    </div>

</div>
@endsection