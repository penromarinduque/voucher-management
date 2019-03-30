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
                            
                            <li class="active">
                                <a href="{{ route('travel.order.form') }}"><i class="fa fa-plus fa-fw"></i> Add New Travel Order</a>
                            </li>

                        </ul>

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">

                                    @php $user = Auth::user(); @endphp
                                    
                                    {{Form::open(array('action'=>'denr\toa\activity\TravelOrderController@AddTravelOrder', 'name'=>'form'))}}

                                        @php $str = $formno->form_no @endphp
                                        @php $no = strlen($str) @endphp
                                        @php $new_no = str_pad($formno->form_no+1, $no, "0", STR_PAD_LEFT) @endphp
                                        @php $cur_no = str_pad($formno->form_no, $no, "0", STR_PAD_LEFT) @endphp


                                         <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td colspan="4" style="width:150px; font-weight:bold; font-size: 12px; color: #5B5B5B; padding: 10px; "><i class="fa fa-pencil-square fa-fw"></i> TRAVEL ORDER <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                                </tr>
                                                <tr>
                                                    <input type="hidden" name="formid" value="{{ $formno->id }}">
                                                    <input type="hidden" name="neworder_no" value="{{ $new_no }}">
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> ORDER NO.</td>
                                                    <td style="padding: 0px;" ><input required type="text" name="order_no" value="{{ $formno->form_text }}{{ $cur_no }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('order_no')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('order_no'))Order No. is required @else Order No. @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> AFFIX-E-SIGNATURE</td>
                                                    <td style="padding: 0px;" ><input type="hidden" name="sign" value="0"><input type="checkbox" name="sign" value="1" @if(old('sign') == '1') checked @endif style="height: 17px; width: 17px; margin-top: 8px; margin-left: 10px;" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> EMPLOYEE NAME <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"></td>
                                                    <td style="padding: 0px;"><input required type="text" value="{{ Auth::user()->fname }} {{ Auth::user()->mname }} {{ Auth::user()->lname }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_id')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_id'))Name is required @else Name @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; ">SALARY</td>
                                                    <td style="padding: 0px;" ><input type="text" name="salary" value="{{ old('salary') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('salary')) border-color: #F08080;  box-shadow: none; @endif " placeholder="Salary"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> POSITION <input type="hidden" name="user_position" value="{{ Auth::user()->user_position }}"></td>
                                                    <td style="padding: 0px;"><input required type="text" value="{{ $position['position_title'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_position')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_position'))Position is required @else Position @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DIVISION <input type="hidden" name="user_division" value="{{ Auth::user()->user_division }}"></td>
                                                    <td style="padding: 0px;" ><input required type="text" value="{{ $division['division'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_division')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_division'))Division is required @else Division @endif" data-toggle="tooltip" data-placement="left" title="Required" readonly="readonly"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> SECTION <input type="hidden" name="user_section" value="{{ Auth::user()->user_section }}"></td>
                                                    <td style="padding: 0px;"><input type="text" value="{{ $section['section'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_section')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_section'))Section is required @else Section @endif"  readonly="readonly"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> UNIT <input type="hidden" name="user_unit" value="{{ Auth::user()->user_unit }}"></td>
                                                    <td style="padding: 0px;" ><input type="text" value="{{ $unit['unit'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('user_unit')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('user_unit'))unit is required @else Unit @endif"  readonly="readonly"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> DATE OF FILLING</td>
                                                    <td style="padding: 0px;" ><input type="date" name="date_filling" value="{{ old('date_filling') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('date_filling')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('date_filling'))Date Filling is required @else Date Filling @endif" data-toggle="tooltip" data-placement="left" ></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DEPARTURE DATE</td>
                                                    <td style="padding: 0px;" ><input required type="date" name="departure" value="{{ old('departure') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('departure')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('departure'))Departure Date is required @else Departure Date @endif" data-toggle="tooltip" data-placement="left" title="Required"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> STATION</td>
                                                    <td style="padding: 0px;" ><input required type="text" name="station" value="{{ old('station') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('station')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('station'))Station is required @else Station @endif" data-toggle="tooltip" data-placement="left" title="Required"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> ARRIVAL DATE</td>
                                                    <td style="padding: 0px;" ><input required type="date" name="arrival" value="{{ old('arrival') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('arrival')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('arrival'))Arrival Date is required @else Arrival Date @endif" data-toggle="tooltip" data-placement="left" title="Required"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> DESTINATION</td>
                                                    <td style="padding: 0px;" colspan="3"><input required type="text" name="destination" value="{{ old('destination') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('destination')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('destination'))Destination is required @else Destination @endif" data-toggle="tooltip" data-placement="left" title="Required"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> PURPOSE OF TRAVEL</td>
                                                    <td style="padding: 0px;" colspan="3"><textarea required name="purpose" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('purpose')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('purpose'))Purpose of Travel is required @else Purpose of Travel @endif" data-toggle="tooltip" data-placement="left" title="Required">{{ old('purpose') }}</textarea></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> PER DIEMS</td>
                                                    <td style="padding: 0px;" ><input type="text" name="perdiems" value="{{ old('perdiems') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('perdiems')) border-color: #F08080;  box-shadow: none; @endif " placeholder="Per Diems/Expenses Allowed"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> ASSISTANTOR</td>
                                                    <td style="padding: 0px;" ><input type="text" name="assistantor" value="{{ old('assistantor') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('assistantor')) border-color: #F08080;  box-shadow: none; @endif " placeholder="Assistantor/Laborers Allowed"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> APPROPRIATIONS</td>
                                                    <td style="padding: 0px;" colspan="3"><textarea name="appropriation" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('appropriation')) border-color: #F08080;  box-shadow: none; @endif " placeholder="Appropriations to which travel should be charged">{{ old('appropriation') }}</textarea></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> REMARKS</td>
                                                    <td style="padding: 0px;" colspan="3"><textarea name="remarks" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('remarks')) border-color: #F08080;  box-shadow: none; @endif " placeholder="Remarks or Special Instructions">{{ old('remarks') }}</textarea></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:190px;  font-size: 11px; color: #5B5B5B; text-align: right; ">@if($recommender_count == 0 && $approver_count == 0) <font style="color: #F00;">*</font> RECOMMENDING APPROVER @endif</td>
                                                    <td style="padding: 0px;" >
                                                    @if($recommender_count == 0 && $approver_count == 0)
                                                        @if($user->with_recom == 1)
                                                            <select required name="recommended_by" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('recommended_by')) border-color: #F08080;  box-shadow: none; @endif " data-toggle="tooltip" data-placement="left" title="Required">
                                                            @if($count_recommender == 0)
                                                                @foreach($default_recommender as $id => $col)
                                                                <option value="{{$col['id']}}" @if(old('recommended_by') == $col['id']) selected @endif> {{$col['fname']}} {{$col['mname']}} {{$col['lname']}} </option>
                                                                @endforeach
                                                            @elseif($count_recommender > 0)
                                                                @foreach($recommender as $id => $col)
                                                                <option value="{{$col['id']}}" @if(old('recommended_by') == $col['id']) selected @endif> {{$col['fname']}} {{$col['mname']}} {{$col['lname']}} </option>
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
                                                        <select required name="approved_by" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('approved_by')) border-color: #F08080;  box-shadow: none; @endif " data-toggle="tooltip" data-placement="left" title="Required">
                                                        @if($count_approver == 0)
                                                            @foreach($default_approver as $id => $col)
                                                            <option value="{{$col['id']}}" @if(old('approved_by') == $col['id']) selected @endif> {{$col['fname']}} {{$col['mname']}} {{$col['lname']}} </option>
                                                            @endforeach
                                                        @elseif($count_approver > 0)
                                                            @foreach($approver as $id => $col)
                                                            <option value="{{$col['id']}}" @if(old('approved_by') == $col['id']) selected @endif> {{$col['fname']}} {{$col['mname']}} {{$col['lname']}} </option>
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
                                                <tr class="item-row" id="tr1">
                                                    <td style="padding: 0px; vertical-align: middle; text-align: left; "><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color:#F00; width:30px;"><i class="fa fa-times"></i></button></td>
                                                    <td style="padding: 0px;"><input required type="date" name="it_date[]" value="" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px;"></td>
                                                    <td style="padding: 0px;"><input required type="text" name="it_place[]" value="" class="form-control" style="width:300px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Destination"></td>
                                                    <td style="padding: 0px;"><input required type="time" name="it_departure[]" value="" class="form-control" style="width:120px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Departure"></td>
                                                    <td style="padding: 0px;"><input required type="time" name="it_arrival[]" value="" class="form-control" style="width:120px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Arrival"></td>
                                                    <td style="padding: 0px;"><input required type="text" name="it_means[]" value="" class="form-control" style="width:200px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Means of Trnsportation"></td>
                                                    <td style="padding: 0px;"><input type="number" name="it_fare[]" value="0.00" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Fare"></td>
                                                    <td style="padding: 0px;"><input type="number" name="it_per_diems[]" value="0.00" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Per Diems"></td>
                                                    <td style="padding: 0px;"><input type="number" name="it_allowance[]" value="0.00" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Allowance"></td>
                                                </tr>
                                                <tr class="item-row" id="tr1">
                                                    <td style="padding: 0px; vertical-align: middle; text-align: left;"><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color:#F00; width:30px;"><i class="fa fa-times"></i></button></td>
                                                    <td style="padding: 0px;"><input required type="date" name="it_date[]" value="" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px;"></td>
                                                    <td style="padding: 0px;"><input required type="text" name="it_place[]" value="" class="form-control" style="width:300px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Destination"></td>
                                                    <td style="padding: 0px;"><input required type="time" name="it_departure[]" value="" class="form-control" style="width:120px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Departure"></td>
                                                    <td style="padding: 0px;"><input required type="time" name="it_arrival[]" value="" class="form-control" style="width:120px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Arrival"></td>
                                                    <td style="padding: 0px;"><input required type="text" name="it_means[]" value="" class="form-control" style="width:200px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Means of Trnsportation"></td>
                                                    <td style="padding: 0px;"><input type="number" name="it_fare[]" value="0.00" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Fare"></td>
                                                    <td style="padding: 0px;"><input type="number" name="it_per_diems[]" value="0.00" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Per Diems"></td>
                                                    <td style="padding: 0px;"><input type="number" name="it_allowance[]" value="0.00" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Allowance"></td>
                                                </tr>
                                                <tr class="item-row" id="tr1">
                                                    <td style="padding: 0px; vertical-align: middle; text-align: left;"><button onclick="deleteRow(this)" style="background-color:transparent; border:0px; color:#F00; width:30px;"><i class="fa fa-times"></i></button></td>
                                                    <td style="padding: 0px;"><input required type="date" name="it_date[]" value="" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px;"></td>
                                                    <td style="padding: 0px;"><input required type="text" name="it_place[]" value="" class="form-control" style="width:300px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Destination"></td>
                                                    <td style="padding: 0px;"><input required type="time" name="it_departure[]" value="" class="form-control" style="width:120px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Departure"></td>
                                                    <td style="padding: 0px;"><input required type="time" name="it_arrival[]" value="" class="form-control" style="width:120px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Arrival"></td>
                                                    <td style="padding: 0px;"><input required type="text" name="it_means[]" value="" class="form-control" style="width:200px; height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Means of Trnsportation"></td>
                                                    <td style="padding: 0px;"><input type="number" name="it_fare[]" value="0.00" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Fare"></td>
                                                    <td style="padding: 0px;"><input type="number" name="it_per_diems[]" value="0.00" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Per Diems"></td>
                                                    <td style="padding: 0px;"><input type="number" name="it_allowance[]" value="0.00" onChange="findTotal()" class="form-control" style="width:150px; height: 33px; font-size: 12px; border-radius: 0px; text-align:right;" placeholder="Allowance"></td>
                                                </tr>
                                            </table>
                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr class="item-row" id="tr1">
                                                    <td style="padding: 0px" colspan="7"><input type="text" value="TOTAL" class="form-control" style="width:925px; height: 33px; font-weight:bold; font-size: 11px; color: #5B5B5B; text-align:right; border-radius: 0px;" placeholder="" readonly="readonly"></td>
                                                    <td style="padding: 0px; width: 150px;"><input type="number" name="total_fare" id="total_fare" value=".00" class="form-control" style="width:150px; height: 33px; font-size: 12px; font-weight: bold; text-align:right; border-radius: 0px; background-color: #FAFAFA;" placeholder="" readonly="readonly"></td>
                                                    <td style="padding: 0px; width: 150px;"><input type="number" name="total_per_diems" id="total_per_diems" value=".00" class="form-control" style="width:150px; height: 33px; font-size: 12px; font-weight: bold; text-align:right; border-radius: 0px; background-color: #FAFAFA;" placeholder="" readonly="readonly"></td>
                                                    <td style="padding: 0px; width: 150px;"><input type="number" name="total_allowance" id="total_allowance" value=".00" class="form-control" style="width:150px; height: 33px; font-size: 12px; font-weight: bold; text-align:right; border-radius: 0px; background-color: #FAFAFA;" placeholder="" readonly="readonly"></td>                                                </tr>
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