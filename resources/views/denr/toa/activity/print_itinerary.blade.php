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

                                            <div style="width: 1200px; margin-bottom: 10px;">
                                                <img src="{{URL::asset('/img/denr_logo.png')}}" width="120" height="120"  style="margin-bottom:-100px; margin-left: 100px;" />
                                                <div style="width: 1000px; padding-left: 230px; font-size:20px; line-height: 23px; font-weight: bold;">
                                                    <font style="color: #000;"> Republic of the Philippines </font><br/>
                                                    <font style="color: green;"> Department of Environment and Natural Resources </font><br/>
                                                    <font style="color: green;"> Provincial Environment and Natural Resources Office </font><br/>
                                                    <font style="color: #09C;"> Boac, Marinduque </font>
                                                </div>
                                            </div>

                                            <hr style="height: 5px; background-color: purple;"/>

                                            <table border="1" style="line-height: 30px; font-size: 20px; margin-left: 0px; width: 960px;">
                                                <!-- <tr>
                                                    <td colspan="8" style="font-size: 18px; text-align: left; font-weight: bold; padding: 5px 10px 5px 10px;"> APPENDIX A</td>
                                                </tr> -->
                                                <tr>
                                                    <td colspan="8" style="font-size: 18px; text-align: left; font-weight: bold; padding: 5px 10px 5px 10px;"> (T.O. {{$order['order_no']}})</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="8" style="text-align: center; font-weight: bold; padding: 5px 10px 5px 10px;"> ITINERARY OF TRAVEL ORDER </td>
                                                </tr>
                                                
                                                <tr style="font-weight: bold; font-family: arial; line-height: 20px;">
                                                    <td rowspan="2" style="font-size: 16px; text-align: center; vertical-align: middle; padding: 10px; width: 100px; ">Date</td>
                                                    <td rowspan="2" style="font-size: 16px; text-align: center; vertical-align: middle; padding: 10px; width: 200px; ">Place to be visited (Destination)</td>
                                                    <td colspan="2" style="font-size: 16px; text-align: center; vertical-align: middle; padding: 10px; width: 100px;">Time</td>
                                                    <td rowspan="2" style="font-size: 16px; text-align: center; vertical-align: middle; padding: 10px; width: 120px;">Means of Transportation</td>
                                                    <td rowspan="2" style="font-size: 16px; text-align: center; vertical-align: middle; padding: 10px; width: 100px; ">Fare</td>
                                                    <td rowspan="2" style="font-size: 16px; text-align: center; vertical-align: middle; padding: 10px; width: 100px; ">Per Diems</td>
                                                    <td rowspan="2" style="font-size: 16px; text-align: center; vertical-align: middle; padding: 10px; width: 100px; ">Traveling Allowance</td>
                                                </tr>

                                                <tr style="font-weight: bold; font-family: arial; line-height: 20px;">
                                                    <td style="font-size: 16px; text-align: center; vertical-align: middle; padding: 10px; width: 100px; ">Departure</td>
                                                    <td style="font-size: 16px; text-align: center; vertical-align: middle; padding: 10px; width: 100px; ">Arrival</td>
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

                                                <tr class="item-row" id="tr1" style="font-family: arial;">
                                                    <td style="font-size: 14px; text-align: left; vertical-align: middle; padding: 5px 10px 5px 10px; ">{{date('m/d/Y', strtotime($col['it_date']))}}</td>
                                                    <td style="font-size: 14px; text-align: left; vertical-align: middle; padding: 5px 10px 5px 10px; ">{{$col['it_place']}}</td>
                                                    <td style="font-size: 14px; text-align: center; vertical-align: middle; padding: 5px 10px 5px 10px; ">{{date('H:i:A', strtotime($col['it_departure']))}}</td>
                                                    <td style="font-size: 14px; text-align: center; vertical-align: middle; padding: 5px 10px 5px 10px; ">{{date('H:i:A', strtotime($col['it_arrival']))}}</td>
                                                    <td style="font-size: 14px; text-align: left; vertical-align: middle; padding: 5px 10px 5px 10px; ">{{$col['it_means_of_trn']}}</td>
                                                    <td style="font-size: 14px; text-align: right; vertical-align: middle; padding: 5px 10px 5px 10px; ">{{number_format((float)$col['it_fare'], 2, '.', ',')}}</td>
                                                    <td style="font-size: 14px; text-align: right; vertical-align: middle; padding: 5px 10px 5px 10px; ">{{number_format((float)$col['it_per_diems'], 2, '.', ',')}}</td>
                                                    <td style="font-size: 14px; text-align: right; vertical-align: middle; padding: 5px 10px 5px 10px; ">{{number_format((float)$col['it_allowance'], 2, '.', ',')}}</td>
                                                </tr>

                                                @endforeach

                                                <tr class="item-row" id="tr1" style="font-family: arial;">
                                                    <td colspan="5" style="font-size: 16px; text-align: right; vertical-align: middle; padding: 5px 10px 5px 10px; font-weight: bold; ">Total</td>
                                                    <td style="font-size: 16px; text-align: right; vertical-align: middle; padding: 5px 10px 5px 10px; ">{{ number_format((float)$total_fare, 2, '.', ',') }}</td>
                                                    <td style="font-size: 16px; text-align: right; vertical-align: middle; padding: 5px 10px 5px 10px; ">{{ number_format((float)$total_per_diems, 2, '.', ',') }}</td>
                                                    <td style="font-size: 16px; text-align: right; vertical-align: middle; padding: 5px 10px 5px 10px; ">{{ number_format((float)$total_allowance, 2, '.', ',') }}</td>
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

                                                <tr style="font-family: arial; font-size: 16px;">

                                                    <td colspan="4" style="padding:10px;">
                                                    I certify : <br/>
                                                    &nbsp;&nbsp;&nbsp; (1)  I have reviewed the foregoing itinerary <br/>
                                                    &nbsp;&nbsp;&nbsp; (2)  the travel is necessary to the service <br/>
                                                    &nbsp;&nbsp;&nbsp; (3)  the period covered is reasonable <br/>
                                                    &nbsp;&nbsp;&nbsp; (4)  the expenses claimed are proper <br/>
                                                    </td>

                                                    <td colspan="4" style="padding:10px;">
                                                    Prepared by: (Official/employee)<br/><br/><br/>
                                                    <div style="font-weight: bold; border-bottom: 2px solid #000; width: 300px; text-align: center; text-transform: uppercase; margin-left: 100px;">{{ $emp->fname }} {{ $emp->mi }}. {{ $emp->lname }}</div>
                                                    <div style="font-weight: 100; width: 300px; margin-left: 100px; text-align: center;">{{ $emp_pos->position_title }}</div>
                                                    </td>

                                                </tr>

                                                <tr style="font-family: arial; font-size: 16px;">

                                                    <td colspan="4" style="padding:10px;">
                                                    @if($order['recommender'] != $order['user_id'])
                                                        @if($order['approver'] != $order['user_id'])
                                                            Recommending Approval : <br/><br/><br/><br/>
                                                            <div style="font-weight: bold; border-bottom: 2px solid #000; width: 350px; text-align: center; text-transform: uppercase; margin-left: 100px;">{{ $recom->fname }} {{ $recom->mi }}. {{ $recom->lname }}</div>
                                                            <div style="font-weight: 100; width: 350px; margin-left: 100px; text-align: center;">{{ $recom_pos->position_title }}</div>
                                                        @endif
                                                    @endif
                                                    </td>

                                                    <td colspan="4" style="padding:10px;">
                                                    Approved by: (Head of Agency/Authorized Official)<br/><br/><br/><br/>
                                                    <div style="font-weight: bold; border-bottom: 2px solid #000; width: 300px; text-align: center; text-transform: uppercase; margin-left: 100px;">{{ $app->fname }} {{ $app->mi }}. {{ $app->lname }}</div>
                                                    <div style="font-weight: 100; width: 300px; margin-left: 100px; text-align: center;">{{ $app_pos->position_title }}</div>
                                                    </td>

                                                </tr>

                                                <tr style="font-family: arial; font-size: 16px;">

                                                    <td colspan="8" style="padding:10px;">
                                                        This form shall be attached to all claims for travelling expenses
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



@endsection