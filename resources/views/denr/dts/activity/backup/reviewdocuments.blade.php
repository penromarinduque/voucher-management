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
                                <a href="{{ route('view.incoming.documents') }}"><i class="fa fa-sign-in fa-fw"></i> Incoming Document</a>
                            </li>

                            <li>
                                <a href="{{ route('view.outgoing.documents') }}"><i class="fa fa-sign-out fa-fw"></i> Outgoing Document</a>
                            </li>

                            <li class="active">
                                <a href="#"><i class="fa fa-edit fa-fw"></i> View Document</a>
                            </li>

                            <li>
                                <a href="{{ route('received.documents') }}"><i class="fa fa-arrow-down fa-fw"></i> Received Document</a>
                            </li>

                            <li>
                                <a href="{{ route('forwarded.documents') }}"><i class="fa fa-arrow-up fa-fw"></i> Forwarded Document</a>
                            </li>

                            

                        </ul>   

                        <div class="panel-body">

                            <div class="row"> 

                                <div class="col-lg-12">

                                    <div class="panel panel-default">

            	                        <table class="table table-striped table-bordered table-hover tooltip-demo">

            	                            <tr>

            	                            	@php 
            	                            		$code = Crypt::encrypt($doc_details['DOC_NO']); 
            	                            		$status = DB::table('dts_document_record')->where('DOC_NO', '=', Crypt::decrypt($code))->get();
            	                            	@endphp
            	                                <td colspan="6" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; text-transform: uppercase;"><i class="fa fa-pencil-square fa-fw"></i> UPDATE DOCUMENT 
            	                                
            	                                @foreach($status as $stat)

                                                <a href="javascript:void(0)" class="btn-history btn btn-sm btn-danger pull-right" data-id="{{$doc_details->DOC_NO}}" class="btn btn-sm btn-info pull-right" style="width: 100px; margin-right:5px; "> History </a>

            	                                <a href='#' class="btn-return btn btn-sm btn-warning pull-right" style="width: 100px; margin-right:5px;">Return</a>

                                                <a href='#' class="btn-sign btn btn-sm btn-success pull-right" style="width: 100px; margin-right:5px;">Sign</a>
                                                
            	                                <a href="javascript:void(0)" class="btn-forward btn btn-sm btn-primary pull-right" data-id="{{$doc_details->DOC_NO}}" class="btn btn-sm btn-info pull-right" style="width: 100px; margin-right:5px; @if($stat->STATUS == 'F') display: none; @endif "> Forward </a>
            	                                
            	                                

            	                                @endforeach

            	                               </td>

            	                            </tr>

            	                        </table>

            	                    </div>

            	                    <div class="panel panel-default">

                                        <table class="table table-striped table-bordered table-hover tooltip-demo">

                                        	<tr>
                                                <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DOCUMENT NO. :</td>
                                                <td style="padding: 0px;" colspan="3"><input id="doc_no" class="form-control" type="text" name='doc_no' data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly" value="{{$doc_details['DOC_NO']}}"></td>

                                                
                                                <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase;"><font style="color: #F00;">*</font> Doc Date :</td>
                                                <td style="padding: 0px;" colspan="3"><input type="date" name='doc_date' class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " required value="{{$doc_details['DOC_DATE']}}" readonly></td>
                                            </tr>

                                            <tr>
                                                <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Doc. Type :</td>
                                                @php
                                                $doc_type_list = DB::table('dts_document_types')->get();
                                                @endphp
                                                <td style="padding: 0px;" colspan="3">
                                                    <select class="form-control" type="text" name='doc_type' data-toggle="tooltip" data-placement="left" title="Required" id="doc_type" readonly="readonly">
                                                        <option value=''>- - SELECT - -</option>
                                                        @foreach($doc_type_list as $doc_type_item)
                                                            <option value="{{$doc_type_item->ID}}" @if($doc_type_item->ID == $doc_details['DOC_TYPE']) @php echo "selected = selected"; @endphp @endif>{{$doc_type_item->TYPE_NAME}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <script type="text/javascript">
                                                    $("#doc_type").change(function(){

                                                        var id = $("doc_type").val();

                                                        $.ajax ({
                        
                                                            type: "GET",
                                                            url: "{{ route('ajax.get.doc.no') }}",
                                                            cache: false,
                                                            data: { id : id },
                                                            success: function(data)
                                                        
                                                            {
                                                               $("#doc_no").attr("readonly", false); 
                                                               $("#doc_no").val(data);
                                                               $("#doc_no").attr("readonly", true); 
                                                            } 


                                                        });

                                                    });
                                                </script>

                                                <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase;"><font style="color: #F00;">*</font> Doc Time :</td>
                                                <td style="padding: 0px;" colspan="3"><input type="time" name='doc_time' class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " required value="{{$doc_details['DOC_TIME']}}" readonly></td>
                                            </tr>
                                            @php
                                            $user_details = DB::table('employee_position')->where('id', '=', Auth::user()->user_position)->first();

                                            @endphp
                                            <tr>
                                            	<td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Sender :</td>
                                                @php $counter_from = 0; @endphp
                                                @foreach($document_senders as $sender)
                                                	@php $counter_from++; @endphp
                                                	@php
                                                		if(is_numeric($sender->DOC_SENDER)){
                                                			$get_user = DB::table('users')->where('id', '=', $sender->DOC_SENDER)->first();
                                                			$sender_name = $get_user->fname.' '.$get_user->mi.'. '.$get_user->lname.' '.$get_user->xname;
                                                		}else{
                                                			$sender_name = $sender->DOC_SENDER;
                                                		}
                                                	@endphp
                                                	@if($counter_from == 1)
                                                		<td style="padding: 0px;" colspan="6"><input class="form-control" name='doc_from[]' type="text" data-toggle="tooltip" data-placement="left" title="Required" value="{{$sender_name}}" required readonly="readonly"></td>
                                                	@elseif($counter_from > 1)
                                                	<tr>
                                                		<td></td>
                                                    	<td style="padding: 0px;" colspan="6"><input class="form-control" name='doc_from[]' type="text" data-toggle="tooltip" data-placement="left" title="Required" value="{{$sender_name}}" required readonly="readonly"></td>
                                                    </tr>
                                                    @endif
                                                 @endforeach
                                            </tr>

                                            @php
                                            $addresee_list = DB::table('users')->select('users.*', 'employee_division.division', 'employee_section.section', 'employee_unit.unit')->leftjoin('employee_division', 'users.user_division', '=', 'employee_division.id')->leftjoin('employee_section', 'users.user_section', '=', 'employee_section.id')->leftjoin('employee_unit', 'users.user_unit', '=', 'employee_unit.id')->orderby('users.lname')->get();

                                            @endphp
                                            <script type="text/javascript">
                                                $('#btn-outsider-sender1').click(function(){
                                                    $('.SenderGroup1.sender_type_1').show();
                                                    $('.SenderGroup1.sender_type_2').hide();
                                                    $('.SenderGroup1 #sender_type_2_input').val("");
                                                });

                                                $('#btn-others-sender1').click(function(){
                                                    $('.SenderGroup1.sender_type_1').hide();
                                                    $('.SenderGroup1.sender_type_2').show();
                                                    $('.SenderGroup1 #sender_type_1_input').val("");
                                                });

                                                function outSiderBtn(n){
                                                    $('.SenderGroup'+n+'.sender_type_1').show();
                                                    $('.SenderGroup'+n+'.sender_type_2').hide();
                                                }
                                                function OthersBtn(n){
                                                    $('.SenderGroup'+n+'.sender_type_1').hide();
                                                    $('.SenderGroup'+n+'.sender_type_2').show();
                                                }

                                                $('#btn-add-sender').click(function(){
                                                    var numRowSender = $('.btn-panel-sender').length + 1;
                                                    var removeGroup = 'SenderGroup'+numRowSender;

                                                    var newSenderRow = '<tr class="btn-panel-sender"><td></td><td style="padding: 0px; " colspan="2"  class="SenderGroup'+numRowSender+' sender_type_2"><select id="sender_type_'+numRowSender+'_input" class="form-control" style="font-size: 12px" name="doc_from[]" data-toggle="tooltip" data-placement="left"><option value="">- - SELECT - -</option>'+
                                                        
                                                        @foreach($addresee_list as $addresee_item)
                                                        '<option value="{{$addresee_item->id}}">{{$addresee_item->fname}} {{$addresee_item->lname}}' @if($addresee_item->division != "") +'-- DIVISION( {{$addresee_item->division}} )' @endif @if($addresee_item->section != "")+'-- SECTION( {{$addresee_item->section}} )' @endif @if($addresee_item->unit != '')+'-- UNIT( {{$addresee_item->unit}} )' @endif +'</option>'+
                                                        @endforeach
                                                        +'</select></td><td class="SenderGroup'+numRowSender+' sender_type_1" style="display: none; width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;"></font> </td><td style="padding: 0px;display: none;" colspan="2" class="SenderGroup'+numRowSender+' sender_type_1"><input name="doc_from[]" class="form-control"  id="sender_type_'+numRowSender+'_input" type="text" data-toggle="tooltip" data-placement="left" title="Required"></td> <td style="padding: 0;" colspan="2"><button class="btn btn-warning btn-sm pull-right" type="button" id="btn-outsider-sender'+numRowSender+'" onclick=outSiderBtn("'+numRowSender+'") style="font-size: 11px; width: 50%;">OUTSIDER</button> <button class="btn btn-success btn-sm pull-right" type="button" id="btn-others-sender'+numRowSender+'" style="font-size: 11px; width: 50%;"  onclick=OthersBtn("'+numRowSender+'")>OTHERS</button></td><td style="padding: 0;" colspan="2"><button class="fa fa-remove btn btn-danger btn-lg pull-right" type="button" id="btn-remove-sender'+numRowSender+'" onclick="removeSenderRow(this)"></button></td></tr>';

                                                    $(newSenderRow).insertAfter('.add_sender_rows_here');
                                                });


                                                function removeSenderRow(btn){
                                                    var row = btn.parentNode.parentNode;
                                                    row.parentNode.removeChild(row);
                                                }
                                            </script>
                                            <tr>
                                                <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Originating Office :</td>
                                                <td style="padding: 0px;" colspan="6"><input class="form-control" name='doc_origin_office' type="text" data-toggle="tooltip" data-placement="left" title="Required" value="{{$doc_details['ORIGIN_OFFICE']}}" readonly></td>
                                            </tr>

                                            <tr>
                                                <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Address :</td>
                                                <td style="padding: 0px;" colspan="6"><input class="form-control" name='doc_address' type="text" data-toggle="tooltip" data-placement="left" title="Required" value="{{$doc_details['DOC_ADDRESS']}}" readonly></td>
                                            </tr>

                                            <tr>
                                                <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Subject :</td>
                                                <td style="padding: 0px;" colspan="6"><input class="form-control" name='doc_subject' type="text" data-toggle="tooltip" data-placement="left" title="Required" value="{{$doc_details['DOC_SUBJ']}}" readonly></td>
                                            </tr>

                                            @php
                                            $addresee_list = DB::table('users')->select('users.*', 'employee_division.division', 'employee_section.section', 'employee_unit.unit')->leftjoin('employee_division', 'users.user_division', '=', 'employee_division.id')->leftjoin('employee_section', 'users.user_section', '=', 'employee_section.id')->leftjoin('employee_unit', 'users.user_unit', '=', 'employee_unit.id')->orderby('users.lname')->get();

                                            @endphp
                                            <!-- <tr class='btn-panel-addresee add_receiver_rows_here' style="display: none;">
                                                <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Address To :</td>
                                                <td style="padding: 0px;" colspan="4" id="ReceiverGroup1">
                                                    <select class="form-control" style='font-size: 12px' name='doc_to[]' data-toggle="tooltip" data-placement="left" title="Required">
                                                        <option value=''>- - SELECT - -</option>
                                                        @foreach($addresee_list as $addresee_item)
                                                            <option value='{{$addresee_item->id}}'>{{$addresee_item->fname}} {{$addresee_item->lname}} @if($addresee_item->division != '')-- DIVISION( {{$addresee_item->division}} )@endif @if($addresee_item->section != '')-- SECTION( {{$addresee_item->section}} )@endif @if($addresee_item->unit != '')-- UNIT( {{$addresee_item->unit}} )@endif</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td style="padding: 0;" colspan='2'>
                                                    <button class='fa fa-plus btn btn-primary btn-lg pull-right' type="button" id='btn-add-addresee'></button>
                                                </td>
                                            </tr>

                                            <script type="text/javascript">
                                                $("#btn-add-addresee").click(function(){
                                                    var numRowReceiver = $('.btn-panel-addresee').length + 1;

                                                    var newReceiverRow = '<tr class="btn-panel-addresee"><td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;"></font></td> <td style="padding: 0px;" colspan="4" id="ReceiverGroup1"><select class="form-control" style="font-size: 12px" name="doc_to[]" data-toggle="tooltip" data-placement="left" title="Required"><option value="">- - SELECT - -</option>'+
                                                        @foreach($addresee_list as $addresee_item)
                                                            '<option value="{{$addresee_item->id}}">{{$addresee_item->fname}} {{$addresee_item->lname}}"'+ @if($addresee_item->division != "")'-- DIVISION( {{$addresee_item->division}} )'+@endif @if($addresee_item->section != "")'-- SECTION( {{$addresee_item->section}} )'+@endif @if($addresee_item->unit != "")'-- UNIT( {{$addresee_item->unit}} )'+@endif'</option>'+
                                                        @endforeach
                                                    '</select></td><td style="padding: 0;" colspan="2"></button><button class="fa fa-remove btn btn-danger btn-lg pull-right" type="button" id="btn-remove-addresee" onclick="removeReceiverRow(this)"></button></td></tr>';
                                                    $(newReceiverRow).insertAfter('.add_receiver_rows_here');
                                                });
                                                function removeReceiverRow(btn){
                                                    var row = btn.parentNode.parentNode;
                                                    row.parentNode.removeChild(row);
                                                }
                                            </script> -->

                                            <tr>
                                                <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Classification :</td>
                                                <td style="padding: 0px;" colspan="3">
                                                    <select class="form-control" type="text" name='doc_classification' data-toggle="tooltip" data-placement="left" title="Required" readonly>
                                                        <option value="">- - SELECT - -</option>
                                                        <option value="S" @if($doc_details['DOC_CLASSIFICATION'] == 'S') @php echo 'selected = selected'; @endphp @endif>Simple </option>
                                                        <option value="C" @if($doc_details['DOC_CLASSIFICATION'] == 'C') @php echo 'selected = selected'; @endphp @endif> Complex </option>
                                                    </select>
                                                </td>

                                                <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Is this Urgent ?</td>
                                                <td style="padding: 0px;" colspan="3">
                                                    <select class="form-control" type="text" name='doc_urgent' data-toggle="tooltip" data-placement="left" title="Required" readonly>
                                                        <option value="N" @if($doc_details['DOC_URGENT'] == 'N') @php echo 'selected = selected'; @endphp @endif> NO </option>
                                                        <option value="Y" @if($doc_details['DOC_URGENT'] == 'Y') @php echo 'selected = selected'; @endphp @endif> YES </option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Particulars / Remarks :</td>
                                                <td style="padding: 0px;" colspan="6">
                                                    <textarea class="form-control" style="min-height: 8em; font-size: 12px; border-radius: 0px; " name='doc_remarks'>{{$doc_details['REMARKS']}}</textarea>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; "><font style="color: #F00;">*</font> Attach File :</td>
                                                <td style="padding: 0px;" colspan="6">
                                                    <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                	@php $attach_count = 0; @endphp
                                                	@foreach($doc_attachments as $attachments)
                                                		@php $attach_count++; @endphp
                                                		@if($attach_count == 1)
                                                        <tr>
                                                			<td style="padding: 0px;" colspan="6">
                                                                <input class="form-control" type="text" data-toggle="tooltip" data-placement="left" title="Required" value="{{$attachments->FILE_ATTACHMENT}}" required readonly="readonly">
                                                            </td>
                                                        </tr>
                                                		@elseif($attach_count > 1)
                                                        <tr>
                                                			<td style="padding: 0px;" colspan="6">
                                                                <input class="form-control" type="text" data-toggle="tooltip" data-placement="left" title="Required" value="{{$attachments->FILE_ATTACHMENT}}" required readonly="readonly">
                                                            </td>
                                                        </tr>
                                                		@endif
                                                	@endforeach
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td colspan="6">
                                                    <input type="submit" name="add" value="Save" class="btn btn-success btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="left">
                                                    <input type="reset" value="Clear" class="btn btn-danger btn-xs" style="height: 25px; width: 60px;">
                                                </td>
                                            </tr>

                                        </table>

                                    </div>

                                  

                                </div>

                            </div>

                        </div>

                	</div>

                </div>

            </div>

            @include('denr.dts.activity.forwardModal')
            @include('denr.dts.activity.historyModal')



@endsection