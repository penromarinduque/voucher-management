<?php 

use App\Helpers\Helper;
$doc_class = helper::doc_class();
$icon_class = helper::icon_class();

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

                            <li style="margin-left: 12px;">
                                <a href="{{ route('view.documents') }}"><i class="{{$icon_class}} fa-fw"></i> {{$doc_class}} Document</a>
                            </li>
                            
                            <li>
                                <a href="{{ route('add.documents') }}"><i class="fa fa-plus fa-fw"></i> Add {{$doc_class}} Document</a>
                            </li>

                            <li class="active">
                                <a href="#"><i class="fa fa-send fa-fw"></i> Forward {{$doc_class}} Document</a>
                            </li>

                            <li>
                                <a href="{{ route('received.documents') }}"><i class="fa fa-arrow-down fa-fw"></i> Received {{$doc_class}} Document</a>
                            </li>

                            <li>
                                <a href="{{ route('forwarded.documents') }}"><i class="fa fa-arrow-up fa-fw"></i> Forwarded {{$doc_class}} Document</a>
                            </li>

                        </ul>   
                        
                        <div class="panel-body">

                            <div class="row"> 

                                <div class="col-lg-12">

                                    <div class="panel panel-default">

				                        
		                            	@php 
		                            		$code1 = Crypt::decrypt($doc_no); 
		                            		$code = Crypt::encrypt($code1); 
		                            	@endphp


				                        <table class="table table-striped table-bordered table-hover tooltip-demo">
                                            <tr>
                                                <td colspan="6" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; text-transform: uppercase;"><i class="fa fa-pencil-square fa-fw"></i> FORWARD {{$doc_class}} DOCUMENT <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                            </tr>
                                        </table>

	                    			</div>

	                    			{{Form::open(array('action'=>'denr\dts\activity\DocumentTrackingController@viewTheForward', 'files'=>'true', 'name'=>'form' ))}}
			                        
                                    	<div class="panel panel-default">

                                        	<table class="table table-striped table-bordered table-hover tooltip-demo">

                                            	<input type="hidden" value="{{$code1}}" name="doc_no">

                                            	<tbody>

                                            		@php
														$addresee_list = DB::table('users')->select('users.*', 'employee_division.division', 'employee_section.section', 'employee_unit.unit')->leftjoin('employee_division', 'users.user_division', '=', 'employee_division.id')->leftjoin('employee_section', 'users.user_section', '=', 'employee_section.id')->leftjoin('employee_unit', 'users.user_unit', '=', 'employee_unit.id')->orderby('users.lname')->get();
													@endphp

									                <tr class='btn-panel-addresee add_receiver_rows_here'>
									                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Address To :</td>
									                    <td style="padding: 0px;" colspan="4" id="ReceiverGroup1">
									                        <select class="form-control" style='font-size: 12px' name='doc_to[]' data-toggle="tooltip" data-placement="left" title="Required">
									                            <option value=''>- - SELECT - -</option>
									                            @foreach($addresee_list as $addresee_item)
									                                <option value='{{$addresee_item->id}}' >{{$addresee_item->fname}} {{$addresee_item->lname}}</option>
									                            @endforeach
									                        </select>
									                    </td>
									                    <td style="padding: 0;" colspan='2'>
									                        <button class='btn btn-default btn-sm pull-left' type="button" id='btn-add-addresee' style="font-size: 11px; width: 30%; height: 33px; color: #09C;"><i class="fa fa-plus"></i>	ADDRESS TO</button>
									                    </td>
									                </tr>

									                <script type="text/javascript">
									                    $("#btn-add-addresee").click(function(){

									                        var numRowReceiver = $('.btn-panel-addresee').length + 1;

									                        var newReceiverRow = '<tr class="btn-panel-addresee">'
									                        						+'<td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; ">'
									                        							+'<font style="color: #F00;"></font>'
									                        						+'</td>'
									                        						+'<td style="padding: 0px;" colspan="4" id="ReceiverGroup1">'
									                        							+'<select class="form-control" style="font-size: 12px" name="doc_to[]" data-toggle="tooltip" data-placement="left" title="Required">'
									                        								+'<option value="">- - SELECT - -</option>'+
																                            @foreach($addresee_list as $addresee_item)
																                                '<option value="{{$addresee_item->id}}">{{$addresee_item->fname}} {{$addresee_item->lname}}</option>'+
																                            @endforeach
									                        							+'</select>'
									                        						+'</td>'
									                        						+'<td style="padding: 0;" colspan="2">'
									                        							+'<button class="btn btn-default btn-sm pull-left" type="button" id="btn-remove-addresee" onclick="removeReceiverRow(this)" style=" font-size: 11px; width: 30%; height:33px; color:#F00; text-align:left;"><i class="fa fa-times "></i> REMOVE</button>'
									                        						+'</td>'
									                        					+'</tr>';
									                        $(newReceiverRow).insertAfter('.add_receiver_rows_here');
									                    });
									                    function removeReceiverRow(btn){
									                        var row = btn.parentNode.parentNode;
									                        row.parentNode.removeChild(row);
									                    }
									                </script>

									                <tr>
	                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Particulars / Remarks :</td>
	                                                    <td style="padding: 0px;" colspan="6"><textarea class="form-control" style="min-height: 8em; font-size: 12px; border-radius: 0px; " name='doc_remarks' required="required"></textarea></td>
	                                                </tr>
									                
									                <tr>
									                	<td></td>
									                	<td colspan="6">
	                                                        <input type="submit" name="add" value="Forward" class="btn btn-success btn-xs pull-left" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="left">
                                                    	</td>
									                </tr>

                                            	</tbody>

                                            </table>

                                    	</div>
			                                        
			                        {{Form::close()}}      

			                    </div>

                			</div>

            			</div>

                	</div>

                </div>

            </div>


@endsection