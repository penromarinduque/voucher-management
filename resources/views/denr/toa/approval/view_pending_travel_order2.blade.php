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
                                <a href="{{ route('pending.travel.order.list') }}"><i class="fa fa-navicon fa-fw"></i> Pendng Travel Order</a>
                            </li>

                            <li class="active" >
                                <a href=""><i class="fa fa-edit fa-fw"></i> View Pending Travel Order</a>
                            </li>

                        </ul>

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">
                                    
                                    {{Form::open(array('action'=>'denr\approval\PendingTravelOrderController@ApprovePendingTravelOrder'))}}

                                        @php $employee = DB::table('users')->where('id', '=', $order['user_id'])->get()->first(); @endphp
                                        @php $position = DB::table('employee_position')->where('id', '=', $order['position_id'])->get()->first(); @endphp
                                        @php $division = DB::table('employee_division')->where('id', '=', $order['division'])->get()->first(); @endphp
                                        @php $section = DB::table('employee_section')->where('id', '=', $order['section'])->get()->first(); @endphp
                                        @php $unit = DB::table('employee_unit')->where('id', '=', $order['unit'])->get()->first(); @endphp


                                         <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td colspan="4" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; "><i class="fa fa-pencil-square fa-fw"></i> TRAVEL ORDER <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> ORDER NO. <input type="hidden" name="get_id" value="{{$order['id']}}"></td>
                                                    <td style="padding: 0px;" ><input type="text" name="order_no" value="@if($errors->has('order_no'))@else{{$order['order_no']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('order_no')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('order_no'))Order No. is required @else Order No. @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> AFFIX-E-SIGNATURE</td>
                                                    <td style="padding: 0px;" ><input type="hidden" name="sign" value="0"><input type="checkbox" name="sign" value="1" @if($order['signature'] == '1') checked @endif onClick="return false" style="height: 17px; width: 17px; margin-top: 8px; margin-left: 10px;" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> EMPLOYEE NAME <input type="hidden" name="user_id" value="{{$order['user_id']}}"></td>
                                                    <td style="padding: 0px;"><input type="text" value="{{ $employee->fname }} {{ $employee->mname }} {{ $employee->lname }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_id')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_id'))Name is required @else Name @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> SALARY</td>
                                                    <td style="padding: 0px;" ><input type="text" name="salary" value="@if($errors->has('salary'))@else{{$order['salary']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('salary')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('salary'))Salary is required @else Salary @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> POSITION <input type="hidden" name="user_position" value="{{$order['position_id']}}"></td>
                                                    <td style="padding: 0px;"><input type="text" value="{{ $position->position_title }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_position')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_position'))Position is required @else Position @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DIVISION <input type="hidden" name="user_division" value="{{$order['division']}}"></td>
                                                    <td style="padding: 0px;" ><input type="text" value="{{ $division->division }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_division')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_division'))Division is required @else Division @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> SECTION <input type="hidden" name="user_section" value="{{$order['section']}}"></td>
                                                    <td style="padding: 0px;"><input type="text" value="{{ $section->section }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_section')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_section'))Section is required @else Section @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> UNIT <input type="hidden" name="user_unit" value="{{$order['unit']}}"></td>
                                                    <td style="padding: 0px;" ><input type="text" value="{{ $unit->unit }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_unit')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_unit'))unit is required @else Unit @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DATE OF FILLING</td>
                                                    <td style="padding: 0px;" ><input type="date" name="date_filling" value="@if($errors->has('date_filling'))@else{{$order['date_filling']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('date_filling')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('date_filling'))Date Filling is required @else Date Filling @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DEPARTURE DATE</td>
                                                    <td style="padding: 0px;" ><input type="date" name="departure" value="@if($errors->has('departure'))@else{{$order['departure_date']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('departure')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('departure'))Departure Date is required @else Departure Date @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> STATION</td>
                                                    <td style="padding: 0px;" ><input type="text" name="station" value="@if($errors->has('station'))@else{{$order['station']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('station')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('station'))Station is required @else Station @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> ARRIVAL DATE</td>
                                                    <td style="padding: 0px;" ><input type="date" name="arrival" value="@if($errors->has('arrival'))@else{{$order['arrival_date']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('arrival')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('arrival'))Arrival Date is required @else Arrival Date @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DESTINATION</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="destination" value="@if($errors->has('destination'))@else{{$order['destination']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('destination')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('destination'))Destination is required @else Destination @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> PURPOSE OF TRAVEL</td>
                                                    <td style="padding: 0px;" colspan="3"><textarea name="purpose" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('purpose')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('purpose'))Purpose of Travel is required @else Purpose of Travel @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly">@if($errors->has('purpose'))@else{{$order['purpose_of_travel']}}@endif</textarea></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> PER DIEMS</td>
                                                    <td style="padding: 0px;" ><input type="text" name="perdiems" value="@if($errors->has('perdiems'))@else{{$order['per_diems_allowed']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('perdiems')) border-color: #F08080;  box-shadow: none; @endif " placeholder="Per Diems/Expenses Allowed" readonly="readonly"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> ASSISTANTOR</td>
                                                    <td style="padding: 0px;" ><input type="text" name="assistantor" value="@if($errors->has('assistantor'))@else{{$order['assistantor_allowed']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('assistantor')) border-color: #F08080;  box-shadow: none; @endif " placeholder="Assistantor/Laborers Allowed" readonly="readonly"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> APPROPRIATIONS TO WHICH TRAVEL SHOULD BE CHARGED</td>
                                                    <td style="padding: 0px;" colspan="3"><textarea name="appropriation" class="form-control" style="height: 61px; font-size: 12px; border-radius: 0px; @if($errors->has('appropriation')) border-color: #F08080;  box-shadow: none; @endif " placeholder="Appropriations to which travel should be charged" readonly="readonly" readonly="readonly">@if($errors->has('appropriation'))@else{{$order['appropriation']}}@endif</textarea></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> REMARKS OR SPECIAL INTRUCTIONS</td>
                                                    <td style="padding: 0px;" colspan="3"><textarea name="remarks" class="form-control" style="height: 61px; font-size: 12px; border-radius: 0px; @if($errors->has('remarks')) border-color: #F08080;  box-shadow: none; @endif " placeholder="Remarks or Special Instructions" readonly="readonly">@if($errors->has('remarks'))@else{{$order['remarks']}}@endif</textarea></td>
                                                </tr>
                                                <tr>
                                                    <td ></td>
                                                    <td colspan="5">
                                                        <input type="submit" name="add" value="Save" class="btn btn-success btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="left" title="Are you sure you filled-up all required fields?">
                                                        <input type="reset" value="Clear" class="btn btn-danger btn-xs" style="height: 25px; width: 60px;">
                                                    </td>
                                                </tr>
                                            </table>
                                           
                                        </div>

                                    
                                    {{Form::close()}}

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            @include('denr.layouts.blocks.msgconfirmation')

@endsection