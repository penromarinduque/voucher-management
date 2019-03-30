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
                                <a href="{{ route('travel.order.list') }}"><i class="fa fa-navicon fa-fw"></i> Travel Order</a>
                            </li>
                            
                            <li>
                                <a href="{{ route('travel.order.form') }}"><i class="fa fa-plus fa-fw"></i> Add New Travel Order</a>
                            </li>

                            <li class="active" >
                                <a href="#"><i class="fa fa-edit fa-fw"></i> View Travel Order</a>
                            </li>

                        </ul>

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">

                                    @php $user = Auth::user(); @endphp
                                    
                                    {{Form::open(array('action'=>'denr\toa\activity\TravelOrderController@EditTravelOrder', 'name'=>'form'))}}

                                         <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td colspan="4" style="width:150px; font-weight:bold; font-size: 12px; color: #5B5B5B; padding: 10px; "><i class="fa fa-pencil-square fa-fw"></i> TRAVEL ORDER <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> ORDER NO. <input type="hidden" name="get_id" value="{{$order['id']}}"></td>
                                                    <td style="padding: 0px;" ><input required type="text" name="order_no" value="@if($errors->has('order_no'))@else{{$order['order_no']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('order_no')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('order_no'))Order No. is required @else Order No. @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> AFFIX-E-SIGNATURE</td>
                                                    <td style="padding: 0px;" ><input type="hidden" name="sign" value="0"><input type="checkbox" name="sign" value="1" @if($order['signature'] == '1') checked @endif style="height: 17px; width: 17px; margin-top: 8px; margin-left: 10px;" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> EMPLOYEE NAME <input type="hidden" name="user_id" value="{{$order['user_id']}}"></td>
                                                    <td style="padding: 0px;"><input required type="text" value="{{ Auth::user()->fname }} {{ Auth::user()->mname }} {{ Auth::user()->lname }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_id')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_id'))Name is required @else Name @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> SALARY</td>
                                                    <td style="padding: 0px;" ><input type="text" name="salary" value="@if($errors->has('salary'))@else{{$order['salary']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('salary')) border-color: #F08080;  box-shadow: none; @endif " placeholder="Salary"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> POSITION <input type="hidden" name="user_position" value="{{$order['position_id']}}"></td>
                                                    <td style="padding: 0px;"><input required type="text" value="{{ $position['position_title'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_position')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_position'))Position is required @else Position @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DIVISION <input type="hidden" name="user_division" value="{{$order['division']}}"></td>
                                                    <td style="padding: 0px;" ><input required type="text" value="{{ $division['division'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_division')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_division'))Division is required @else Division @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> SECTION <input type="hidden" name="user_section" value="{{$order['section']}}"></td>
                                                    <td style="padding: 0px;"><input type="text" value="{{ $section['section'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_section')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_section'))Section is required @else Section @endif"  readonly="readonly"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> UNIT <input type="hidden" name="user_unit" value="{{$order['unit']}}"></td>
                                                    <td style="padding: 0px;" ><input type="text" value="{{ $unit['unit'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_unit')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_unit'))unit is required @else Unit @endif"  readonly="readonly"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> DATE OF FILLING</td>
                                                    <td style="padding: 0px;" ><input type="date" name="date_filling" value="@if($errors->has('date_filling'))@else{{$order['date_filling']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('date_filling')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('date_filling'))Date Filling is required @else Date Filling @endif" data-toggle="tooltip" data-placement="left" ></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DEPARTURE DATE</td>
                                                    <td style="padding: 0px;" ><input required type="date" name="departure" value="@if($errors->has('departure'))@else{{$order['departure_date']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('departure')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('departure'))Departure Date is required @else Departure Date @endif" data-toggle="tooltip" data-placement="left" title="Required"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> STATION</td>
                                                    <td style="padding: 0px;" ><input required type="text" name="station" value="@if($errors->has('station'))@else{{$order['station']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('station')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('station'))Station is required @else Station @endif" data-toggle="tooltip" data-placement="left" title="Required"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> ARRIVAL DATE</td>
                                                    <td style="padding: 0px;" ><input required type="date" name="arrival" value="@if($errors->has('arrival'))@else{{$order['arrival_date']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('arrival')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('arrival'))Arrival Date is required @else Arrival Date @endif" data-toggle="tooltip" data-placement="left" title="Required"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DESTINATION</td>
                                                    <td style="padding: 0px;" colspan="3"><input required type="text" name="destination" value="@if($errors->has('destination'))@else{{$order['destination']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('destination')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('destination'))Destination is required @else Destination @endif" data-toggle="tooltip" data-placement="left" title="Required"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> PURPOSE OF TRAVEL</td>
                                                    <td style="padding: 0px;" colspan="3"><textarea required name="purpose" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('purpose')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('purpose'))Purpose of Travel is required @else Purpose of Travel @endif" data-toggle="tooltip" data-placement="left" title="Required">@if($errors->has('purpose'))@else{{$order['purpose_of_travel']}}@endif</textarea></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> PER DIEMS</td>
                                                    <td style="padding: 0px;" ><input type="text" name="perdiems" value="@if($errors->has('perdiems'))@else{{$order['per_diems_allowed']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('perdiems')) border-color: #F08080;  box-shadow: none; @endif " placeholder="Per Diems/Expenses Allowed"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> ASSISTANTOR</td>
                                                    <td style="padding: 0px;" ><input type="text" name="assistantor" value="@if($errors->has('assistantor'))@else{{$order['assistantor_allowed']}}@endif" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('assistantor')) border-color: #F08080;  box-shadow: none; @endif " placeholder="Assistantor/Laborers Allowed"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> APPROPRIATIONS</td>
                                                    <td style="padding: 0px;" colspan="3"><textarea name="appropriation" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('appropriation')) border-color: #F08080;  box-shadow: none; @endif " placeholder="Appropriations to which travel should be charged">@if($errors->has('appropriation'))@else{{$order['appropriation']}}@endif</textarea></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> REMARKS</td>
                                                    <td style="padding: 0px;" colspan="3"><textarea name="remarks" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('remarks')) border-color: #F08080;  box-shadow: none; @endif " placeholder="Remarks or Special Instructions">@if($errors->has('remarks'))@else{{$order['remarks']}}@endif</textarea></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:190px;  font-size: 11px; color: #5B5B5B; text-align: right; ">@if($recommender_count == 0 && $approver_count == 0)<font style="color: #F00;">*</font> RECOMMENDING APPROVER @endif</td>
                                                    <td style="padding: 0px;" >
                                                    <!-- @if($recommender_count == 0 && $approver_count == 0)
                                                        <select required name="recommended_by" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('recommended_by')) border-color: #F08080;  box-shadow: none; @endif " data-toggle="tooltip" data-placement="left" title="Required">
                                                            <option value=""> Select Recommending Approver </option>
                                                            @foreach($recommender as $id => $col)
                                                            <option value="{{$col['id']}}" @if($order['recommender'] == $col['id']) selected @endif> {{$col['fname']}} {{$col['mname']}} {{$col['lname']}} </option>
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        <input type="hidden" name="recommended_by" value="{{$user->id}}">
                                                    @endif -->

                                                    @if($recommender_count == 0 && $approver_count == 0)
                                                        @if($user->with_recom == 1)
                                                            <select required name="recommended_by" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('recommended_by')) border-color: #F08080;  box-shadow: none; @endif " data-toggle="tooltip" data-placement="left" title="Required">
                                                            @if($count_recommender == 0)
                                                                @foreach($default_recommender as $id => $col)
                                                                <option value="{{$col['id']}}" @if($order['recommender'] == $col['id']) selected @endif> {{$col['fname']}} {{$col['mname']}} {{$col['lname']}} </option>
                                                                @endforeach
                                                            @elseif($count_recommender > 0)
                                                                @foreach($recommender as $id => $col)
                                                                <option value="{{$col['id']}}" @if($order['recommender'] == $col['id']) selected @endif> {{$col['fname']}} {{$col['mname']}} {{$col['lname']}} </option>
                                                                @endforeach
                                                            @endif
                                                            </select>
                                                            <input type="hidden" name="recommended_at" value="">
                                                        @elseif($user->with_recom == 0)
                                                            <input type="hidden" name="recommended_by" value="{{$user->id}}">
                                                            <input type="hidden" name="recommended_at" value="{{ date('Y-m-d H:i s') }}">
                                                        @endif
                                                    @else
                                                        <input type="hidden" name="recommended_by" value="{{$user->id}}">
                                                        <input type="hidden" name="recommended_at" value="{{ date('Y-m-d H:i s') }}">
                                                    @endif

                                                    </td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> APPROVER</td>
                                                    <td style="padding: 0px;" >
                                                        <!-- <select required name="approved_by" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('approved_by')) border-color: #F08080;  box-shadow: none; @endif " data-toggle="tooltip" data-placement="left" title="Required">
                                                            <option value=""> Select Approver </option>
                                                            @foreach($approver as $id => $col)
                                                            <option value="{{$col['id']}}" @if($order['approver'] == $col['id']) selected @endif> {{$col['fname']}} {{$col['mname']}} {{$col['lname']}} </option>
                                                            @endforeach
                                                        </select> -->

                                                        <select required name="approved_by" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('approved_by')) border-color: #F08080;  box-shadow: none; @endif " data-toggle="tooltip" data-placement="left" title="Required">
                                                        @if($count_approver == 0)
                                                            @foreach($default_approver as $id => $col)
                                                            <option value="{{$col['id']}}" @if($order['approver'] == $col['id']) selected @endif> {{$col['fname']}} {{$col['mname']}} {{$col['lname']}} </option>
                                                            @endforeach
                                                        @elseif($count_approver > 0)
                                                            @foreach($approver as $id => $col)
                                                            <option value="{{$col['id']}}" @if($order['approver'] == $col['id']) selected @endif> {{$col['fname']}} {{$col['mname']}} {{$col['lname']}} </option>
                                                            @endforeach
                                                        @endif
                                                        </select>

                                                    </td>
                                                </tr>
                                            </table>
                                           
                                        </div>

                                        <div class="panel panel-default" style="overflow:auto; padding-bottom:20px; height: 400px;">
                                            <table id="tbl1" class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td colspan="10" style="width:150px; font-weight:bold; font-size: 12px; color: #5B5B5B; padding: 10px; "><i class="fa fa-pencil-square fa-fw"></i> ITINERARY OF TRAVEL ORDER </td>
                                                </tr>
                                                <tr id="tr1" style="font-weight: bold; text-transform: uppercase;">
                                                    <td style="font-size: 12px; color: #5B5B5B; text-align: center; vertical-align: middle; width: 40px;"><i class="fa fa-times-circle"></i></td>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: center; vertical-align: middle; width: 150px;">DATE</td>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: center; vertical-align: middle; width: 300px;">PLACE TO BE VISIT <br/> (DESTINATION)</td>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: center; vertical-align: middle; width: 90px;">DEPARTURE <br/>TIME</td>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: center; vertical-align: middle; width: 90px;">ARRIVAL <br/>TIME</td>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: center; vertical-align: middle; width: 200px;">MEANSE OF TRANSPORTATION</td>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: center; vertical-align: middle; width: 150px;">FARE</td>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: center; vertical-align: middle; width: 150px;">PER DIEMS</td>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-align: center; vertical-align: middle; width: 150px;">TRAVELING ALLOWANCE</td>
                                                </tr>

                                                @php

                                                    $total_fare = 0;
                                                    $total_per_diems = 0;
                                                    $total_allowance = 0;

                                                @endphp

                                                @foreach($itinerary as $id => $col)

                                                @php

                                                    $total_fare= $itinerary->sum('it_fare');
                                                    $total_per_diems= $itinerary->sum('it_per_diems');
                                                    $total_allowance= $itinerary->sum('it_allowance');

                                                @endphp

                                                <tr class="item-row" id="tr1">
                                                    <td style="padding: 0px; vertical-align: middle; text-align: left;"><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color:#F00; width:30px;"><i class="fa fa-times"></i></button></td>
                                                    <td style="padding: 0px;"><input required type="date" name="it_date[]" value="{{$col['it_date']}}" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px;"></td>
                                                    <td style="padding: 0px;"><input required type="text" name="it_place[]" value="{{$col['it_place']}}" class="form-control" style="width:300px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Destination"></td>
                                                    <td style="padding: 0px;"><input required type="time" name="it_departure[]" value="{{$col['it_departure']}}" class="form-control" style="width:120px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Departure"></td>
                                                    <td style="padding: 0px;"><input required type="time" name="it_arrival[]" value="{{$col['it_arrival']}}" class="form-control" style="width:120px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Arrival"></td>
                                                    <td style="padding: 0px;"><input required type="text" name="it_means[]" value="{{$col['it_means_of_trn']}}" class="form-control" style="width:200px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Means of Trnsportation"></td>
                                                    <td style="padding: 0px;"><input type="number" name="it_fare[]" value="{{$col['it_fare']}}" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Fare"></td>
                                                    <td style="padding: 0px;"><input type="number" name="it_per_diems[]" value="{{$col['it_per_diems']}}" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Per Diems"></td>
                                                    <td style="padding: 0px;"><input type="number" name="it_allowance[]" value="{{$col['it_allowance']}}" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Allowance"></td>
                                                </tr>

                                                @endforeach

                                            </table>

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr class="item-row" id="tr1">
                                                    <td style="padding: 0px" colspan="7"><input type="text" value="TOTAL" class="form-control" style="width:925px; height: 33px; font-weight:bold; font-size: 11px; color: #5B5B5B; text-align:right; border-radius: 0px;" placeholder="" readonly="readonly"></td>
                                                    <td style="padding: 0px; width: 150px;"><input type="number" name="total_fare" id="total_fare" value="{{ number_format((float)$total_fare, 2, '.', '') }}" class="form-control" style="width:150px; height: 33px; font-size: 12px; font-weight: bold; text-align:right; border-radius: 0px; background-color: #FAFAFA;" placeholder="" readonly="readonly"></td>
                                                    <td style="padding: 0px; width: 150px;"><input type="number" name="total_per_diems" id="total_per_diems" value="{{ number_format((float)$total_per_diems, 2, '.', '') }}" class="form-control" style="width:150px; height: 33px; font-size: 12px; font-weight: bold; text-align:right; border-radius: 0px; background-color: #FAFAFA;" placeholder="" readonly="readonly"></td>
                                                    <td style="padding: 0px; width: 150px;"><input type="number" name="total_allowance" id="total_allowance" value="{{ number_format((float)$total_allowance, 2, '.', '') }}" class="form-control" style="width:150px; height: 33px; font-size: 12px; font-weight: bold; text-align:right; border-radius: 0px; background-color: #FAFAFA;" placeholder="" readonly="readonly"></td>
                                                    <td style="padding: 0px; width: 40px;"></td>
                                                </tr>
                                            </table>

                                        </div>

                                        <div class="panel panel-default">
                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td style="width: 190px;"></td>
                                                    <td colspan="7">
                                                        <button type="button" id='addRow' class="btn btn-primary btn-xs" style="height: 25px; width: 70px; margin-right: 3px;" data-toggle="tooltip" data-placement="left" title="Add Month Details"><i class="fa fa-plus"></i> Details</button>
                                                        <button type="submit" name="add" class="btn btn-success btn-xs" style="height: 25px; width: 60px; margin-right: 3px;" data-toggle="tooltip" data-placement="left" title="Save"><i class="fa fa-save"></i> Save</button>
                                                        <button type="reset" class="btn btn-danger btn-xs" onClick="window.location.reload()" style="height: 25px; width: 60px; margin-right: 3px;" data-toggle="tooltip" data-placement="right" title="Clear"><i class="fa fa-times"></i> Clear</button>
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


            <script type="text/javascript">
                
                function findTotal() {


                    ////XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


                    var total_fare = 0;
                    var row = 0;

                    while (document.forms['form'].elements['it_fare[]'][row]) {
                                                                                    
                        fare = document.forms['form'].elements['it_fare[]'][row];
                        total_fare += parseFloat(fare.value);
                        row++;
                        
                    }


                    ////XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


                    document.getElementById('total_fare').value = total_fare.toFixed(2);
                    
                    var total_per_diems = 0;
                    var row = 0;

                    while (document.forms['form'].elements['it_per_diems[]'][row]) {
                                                                                    
                        per_diems = document.forms['form'].elements['it_per_diems[]'][row];
                        total_per_diems += parseFloat(per_diems.value);
                        row++;
                        
                    }

                    document.getElementById('total_per_diems').value = total_per_diems.toFixed(2);
                    

                    ////XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


                    var total_allowance = 0;
                    var row = 0;

                    while (document.forms['form'].elements['it_allowance[]'][row]) {
                                                                                    
                        allowance = document.forms['form'].elements['it_allowance[]'][row];
                        total_allowance += parseFloat(allowance.value);
                        row++;
                        
                    }

                    document.getElementById('total_allowance').value = total_allowance.toFixed(2);


                    ////XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

                }

            </script>


            <script>

                $(function(){
                // window.alert(numRows);

                    $('#addRow').click(function() {  
                    
                        numRows = $("#tbl1 #tr1").length;
                        
                        var str = "" + numRows
                        var pad = "0"
                        var ans = pad.substring(0, pad.length - str.length) + str

                            $row = $('<tr class="item-row" id="tr1">'
                                        +'<td style="padding: 0px; vertical-align: middle; text-align: left;"><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color:#F00; width:30px;"><i class="fa fa-times"></i></button></td>'
                                        +'<td style="padding: 0px;"><input required type="date" name="it_date[]" value="" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px;"></td>'
                                        +'<td style="padding: 0px;"><input required type="text" name="it_place[]" value="" class="form-control" style="width:300px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Destination"></td>'
                                        +'<td style="padding: 0px;"><input required type="time" name="it_departure[]" value="" class="form-control" style="width:120px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Departure"></td>'
                                        +'<td style="padding: 0px;"><input required type="time" name="it_arrival[]" value="" class="form-control" style="width:120px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Arrival"></td>'
                                        +'<td style="padding: 0px;"><input required type="text" name="it_means[]" value="" class="form-control" style="width:200px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Means of Trnsportation"></td>'
                                        +'<td style="padding: 0px;"><input type="number" name="it_fare[]" value="0.00" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Fare"></td>'
                                        +'<td style="padding: 0px;"><input type="number" name="it_per_diems[]" value="0.00" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Per Diems"></td>'
                                        +'<td style="padding: 0px;"><input type="number" name="it_allowance[]" value="0.00" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Allowance"></td>'
                                    +'</tr>')
                           
                            $('#tbl1').append($row);

                    });

                });

                
                function deleteRow(btn) {
                  var row = btn.parentNode.parentNode;
                  row.parentNode.removeChild(row);
                }

            </script>

@endsection