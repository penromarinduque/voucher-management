@extends('denr.layouts.window')

@section('page-css')

@endsection

@section('page-content')

            
        

            <div class="row">
                
                <div class="col-lg-12">
                    
                    <div class="panel panel-default" style="padding-top: 12px;">

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">

                                        <a onClick="window.close();" id="gen_link"><button type="button" class="btn btn-default btn-xs" style="height: 25px; width:60px; font-size: 11px; float: right; margin-right: 10px;" data-toggle="tooltip" data-placement="right" title="Close"><i class="fa fa-times"></i> CLOSE</button></a>
                                        <a onclick="window.print();" id="gen_link"><button type="button" class="btn btn-default btn-xs" style="height: 25px; width:60px; font-size: 11px; float: right; margin-right: 10px;" data-toggle="tooltip" data-placement="right" title="Print Travel Order"><i class="fa fa-print"></i> PRINT</button></a>
                                        
                                        <div style="width:1000px; margin:auto; padding:20px; font-family: Times New Roman;">

                                            <div style="width: 1000px; margin-bottom: 10px;">
                                                <img src="{{URL::asset('/img/denr_logo.png')}}" width="120" height="120"  style="margin-bottom:-100px; margin-left: 100px;" />
                                                <div style="width: 1000px; padding-left: 230px; font-size:20px; line-height: 23px; font-weight: bold;">
                                                    <font style="color: #000;"> Republic of the Philippines </font><br/>
                                                    <font style="color: green;"> Department of Environment and Natural Resources </font><br/>
                                                    <font style="color: green;"> Provincial Environment and Natural Resources Office </font><br/>
                                                    <font style="color: #09C;"> Boac, Marinduque </font>
                                                </div>
                                            </div>

                                            <hr style="height: 5px; background-color: purple;"/>

                                            <table style="line-height: 30px; font-size: 20px; margin-left: 110px; width: 780px; font-family: arial;">
                                                <tr>
                                                    <td colspan="2" style="text-align: center; font-weight: bold; text-decoration: underline;"> TRAVEL ORDER</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: center; font-weight: bold;"> (No. {{$order['order_no']}})</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding:10px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 430px;">Name: &nbsp; <font style="text-decoration: underline; width: 300px;">{{ $employee['fname'] }} {{ $employee['mname'] }} {{ $employee['lname'] }}</font></td>
                                                    <td style="width: 350px;">Salary: &nbsp; <font style="text-decoration: underline; width: 300px;">P {{$order['salary']}}</font></td>
                                                </tr>
                                                <tr>
                                                    <td>Position: &nbsp; <font style="text-decoration: underline; width: 300px;">{{ $position['position_title'] }}</font></td>
                                                    <td>Div/Sec/Unit: &nbsp; <font style="text-decoration: underline; width: 300px;">{{ $division['division'] }} {{ $section['section'] }} {{ $unit['unit'] }}</font></td>
                                                </tr>
                                                <tr>
                                                    <td>Date of Filling: &nbsp; <font style="text-decoration: underline; width: 300px;">{{date('F d, Y' ,strtotime($order['date_filling']))}}</font></td>
                                                    <td>Departure Date: &nbsp; <font style="text-decoration: underline; width: 300px;">{{date('F d, Y' ,strtotime($order['departure_date']))}}</font></td>
                                                </tr>
                                                <tr>
                                                    <td> Station: &nbsp; <font style="text-decoration: underline; width: 300px;">{{$order['station']}}</font></td>
                                                    <td> Date of Arrival: &nbsp; <font style="text-decoration: underline; width: 300px;">{{date('F d, Y' ,strtotime($order['arrival_date']))}}</font></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"> Destination: &nbsp; <font style="text-decoration: underline; width: 300px;">{{$order['destination']}}</font></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Purpose of Travel: &nbsp; <font style="text-decoration: underline; width: 300px;">{{$order['purpose_of_travel']}}</font></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Per Diems/Expenses Allowed: &nbsp; <font style="text-decoration: underline; width: 300px;">P {{$order['per_diems_allowed']}}</font></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Assistantor/ Laborers Allowed: &nbsp; <font style="text-decoration: underline; width: 300px;">P {{$order['assistantor_allowed']}}</font></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Appropriations to which Travel should be charged: &nbsp; <font style="text-decoration: underline; width: 300px;">{{$order['appropriation']}}</font></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Remarks or Special Instructions: &nbsp; <font style="text-decoration: underline; width: 300px;">{{$order['remarks']}}</font></td>
                                                </tr>


                                                <tr>
                                                    <td colspan="2" style="padding:10px;"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding:10px;"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Certifications:</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding:10px;"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is to certify that travel is necessary and is connected with the functions of the official/employee of this Div./Sec./Unit.</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding:20px;"></td>
                                                </tr>
                                                <tr>
                                                    <td >
                                                        <b>
                                                            @if($order['recommender'] != $order['user_id'])
                                                                @if($order['approver'] != $order['user_id'])
                                                                    Recommending Approval:
                                                                @endif
                                                            @endif
                                                        </b>
                                                    </td>
                                                    <td ><b style="margin-left: 100px;">Approved:</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding:15px;"></td>
                                                </tr>
                                                @php $user = Auth::user(); @endphp
                                                @php $recom = DB::table('users')->where('id', '=', $order['recommender'])->get()->first(); @endphp
                                                @php $recom_position_id = $recom->user_position @endphp
                                                @php $recom_pos = DB::table('employee_position')->where('id', '=', $recom_position_id)->get()->first(); @endphp

                                                @php $app = DB::table('users')->where('id', '=', $order['approver'])->get()->first(); @endphp
                                                @php $app_position_id = $app->user_position @endphp
                                                @php $app_pos = DB::table('employee_position')->where('id', '=', $app_position_id)->get()->first(); @endphp

                                                @php $emp = DB::table('users')->where('id', '=', $order['user_id'])->get()->first(); @endphp
                                                @php $emp_position_id = $emp->user_position @endphp
                                                @php $emp_pos = DB::table('employee_position')->where('id', '=', $emp_position_id)->get()->first(); @endphp

                                                <tr>
                                                    <td >
                                                        <div style="font-weight: bold; @if($order['recommender'] != $order['user_id']) @if($order['approver'] != $order['user_id']) border-bottom: 2px solid #000; @endif @endif width: 300px; text-align: center; text-transform: uppercase;">
                                                        @if($order['recommender'] != $order['user_id'])
                                                            @if($order['approver'] != $order['user_id'])
                                                                {{ $recom->fname }} {{ $recom->mi }}. {{ $recom->lname }}
                                                            @endif
                                                        @endif
                                                        </div>
                                                    </td>
                                                    <td ><div style="font-weight: bold; border-bottom: 2px solid #000; width: 300px; text-align: center; text-transform: uppercase; margin-left: 100px;">{{ $app->fname }} {{ $app->mi }}. {{ $app->lname }}</div></td>
                                                </tr>

                                                <tr>
                                                    <td >
                                                        <div style="font-weight: 100; width: 300px; text-align: center; ">
                                                        @if($order['recommender'] != $order['user_id'])
                                                            @if($order['approver'] != $order['user_id'])
                                                                {{ $recom_pos->position_title }}
                                                            @endif
                                                        @endif
                                                        </div>
                                                    </td>
                                                    <td ><div style="font-weight: 100; width: 300px; margin-left: 100px; text-align: center;">{{ $app_pos->position_title }}</div></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2" style="padding:10px;"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding:10px;"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: center; font-weight: bold;">AUTHORIZATION</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding:10px;"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; I Hereby authorized the Account to deduct the corresponding amount of the unliquidated cash advance from my succeeding salary for my failure to liquidate this travel within twenty (20) days upon return to my permanent official station pursuant to Commission on Audit(COA) Circular No. 2012-004 dated November 28, 2012.</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding:10px;"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding:10px;"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding:10px;"></td>
                                                </tr>
                                                <tr>
                                                    <td ></td>
                                                    <td ><div style="font-weight: bold; border-bottom: 2px solid #000; width: 300px; text-align: center; text-transform: uppercase; margin-left: 100px;">{{ $emp->fname }} {{ $emp->mi }}. {{ $emp->lname }}</div></td>
                                                </tr>

                                                <tr>
                                                    <td ></td>
                                                    <td ><div style="font-weight: 100; width: 300px; margin-left: 100px; text-align: center;">{{ $emp_pos->position_title }}</div></td>
                                                </tr>
                                                
                                            </table>
                                           
                                        </div>

                                    
                                    

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>



@endsection