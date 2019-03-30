@extends('denr.layouts.window')

@section('page-css')

@endsection

@section('page-content')

            <div class="row">
                
                <div class="col-lg-12">
                    
                        <div class="panel-body">

                            <a onClick="window.close();" id="gen_link"><button type="button" class="btn btn-default btn-xs" style="height: 25px; width:60px; font-size: 11px; float: right; margin-right: 10px;" data-toggle="tooltip" data-placement="right" title="Close"><i class="fa fa-times"></i> CLOSE</button></a>
                            <a onclick="window.print();" id="gen_link"><button type="button" class="btn btn-default btn-xs" style="height: 25px; width:60px; font-size: 11px; float: right; margin-right: 10px;" data-toggle="tooltip" data-placement="right" title="Print Travel Order"><i class="fa fa-print"></i> PRINT</button></a>
                                        

                            <div style="width: 1000px; margin-bottom: 10px; font-family: Times New Roman;">
                                <img src="{{URL::asset('/img/denr_logo.png')}}" width="120" height="120"  style="margin-bottom:-100px; margin-left: 0px;" />
                                <div style="width: 1000px; padding-left: 130px; font-size:20px; line-height: 23px; font-weight: bold;">
                                    <font style="color: #000;"> Republic of the Philippines </font><br/>
                                    <font style="color: green;"> Department of Environment and Natural Resources </font><br/>
                                    <font style="color: green;"> Provincial Environment and Natural Resources Office </font><br/>
                                    <font style="color: #09C;"> Boac, Marinduque </font>
                                </div>
                            </div>

                            <hr style="height: 5px; background-color: purple;"/>
                            <font style="font-weight: bold; font-size: 16px;">TRAVEL ORDER REPORT</font><br/>
                            <font style="font-weight: bold; font-size: 12px;">Employee: {{ $employee }}, Position: {{ $position }}, Division: {{ $division }}, Section: {{ $section }}, Unit: {{ $unit }}, Status: {{ $status }}, Date From: {{ $date_from }}, Date To: {{ $date_to }}, Order No. Form: {{ $order_from }}, Order No. To: {{ $order_to }}</font>
                            
                            <table class="table table-striped table-bordered table-hover tooltip-demo" style="background-color: #FFF; margin-top: 15px;">
                                <thead>
                                    <tr style="font-size: 11px; text-transform: uppercase;">
                                        <th style="padding: 5px 10px 5px 10px;">ORDER NO.</th>
                                        <th style="padding: 5px 10px 5px 10px;">EMPLOYEE</th>
                                        <th style="padding: 5px 10px 5px 10px;">POSITION</th>
                                        <th style="padding: 5px 10px 5px 10px;">STATUS</th>
                                        <th style="padding: 5px 10px 5px 10px;">DATE</th>
                                        <th style="padding: 5px 10px 5px 10px;">STATION</th>
                                        <th style="padding: 5px 10px 5px 10px;">SALARY</th>
                                        <th style="padding: 5px 10px 5px 10px;">DIV/SEC/UNIT</th>
                                        <th style="padding: 5px 10px 5px 10px;">DEPARTURE</th>
                                        <th style="padding: 5px 10px 5px 10px;">ARRIVAL</th>
                                        <th style="padding: 5px 10px 5px 10px;">DESTINATION</th>
                                        <th style="padding: 5px 10px 5px 10px;">PURPOSE</th>
                                        <th style="padding: 5px 10px 5px 10px;">PER_DIEMS</th>
                                        <th style="padding: 5px 10px 5px 10px;">ASSISTANTOR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                @if($rcount > 0)

                                    @foreach($report as $id => $col)

                                    <tr class="odd gradeX" style="font-size: 11px; vertical-align: middle;">
                                        <td style="padding: 3px 10px 3px 10px; ">{{$col['order_no']}}</td>
                                        <td style="padding: 3px 10px 3px 10px; ">
                                            @php $employee = DB::table('users')->where('id', '=', $col['user_id'])->get()->first(); @endphp
                                            {{$employee->fname}} {{$employee->mname}} {{$employee->lname}}
                                        </td>
                                        <td style="padding: 3px 10px 3px 10px; ">
                                            @php $position = DB::table('employee_position')->where('id', '=', $col['position_id'])->get()->first(); @endphp
                                            {{$position->position_title}}
                                        </td>
                                        <td style="padding: 3px 10px 3px 10px; ">
                                            @if($col['approval_status']=='0')
                                                Pending
                                            @elseif($col['approval_status']=='1')
                                                Recommended
                                            @elseif($col['approval_status']=='2')
                                                Approved
                                            @endif
                                        </td>
                                        <td style="padding: 3px 10px 3px 10px; ">{{ date('m/d/Y', strtotime($col['date_filling']))}}</td>
                                        <td style="padding: 3px 10px 3px 10px; ">{{$col['station']}}</td>
                                        <td style="padding: 3px 10px 3px 10px; ">{{$col['salary']}}</td>
                                        <td style="padding: 3px 10px 3px 10px; ">
                                            @php $division = DB::table('employee_division')->where('id', '=', $col['division'])->get()->first(); @endphp
                                            @php $section = DB::table('employee_section')->where('id', '=', $col['section'])->get()->first(); @endphp
                                            @php $unit = DB::table('employee_unit')->where('id', '=', $col['unit'])->get()->first(); @endphp
                                            @php
                                            $count_section = count($section);
                                            $count_unit = count($unit);
                                            @endphp
                                            @if($count_section > 0 && $count_unit > 0)
                                            {{$division->division}} / {{$section->section}} / {{$unit->unit}}
                                            @elseif($count_section > 0 && $count_unit == 0)
                                            {{$division->division}} / {{$section->section}}
                                            @elseif($count_section == 0 && $count_unit == 0)
                                            {{$division->division}}
                                            @endif
                                        </td>
                                        <td style="padding: 3px 10px 3px 10px; ">{{ date('m/d/Y', strtotime($col['departure_date']))}}</td>
                                        <td style="padding: 3px 10px 3px 10px; ">{{ date('m/d/Y', strtotime($col['arrival_date']))}}</td>
                                        <td style="padding: 3px 10px 3px 10px; ">{{$col['destination']}}</td>
                                        <td style="padding: 3px 10px 3px 10px; ">{{$col['purpose_of_travel']}}</td>
                                        <td style="padding: 3px 10px 3px 10px; ">{{$col['per_diems_allowed']}}</td>
                                        <td style="padding: 3px 10px 3px 10px; ">{{$col['assistantor_allowed']}}</td>
                                    </tr>
                                    
                                    @endforeach

                                @elseif($rcount == 0)
                                    
                                    <tr class="odd gradeX" style="font-size: 11px; vertical-align: middle;">
                                        <td style="padding: 20px; text-align: center; font-size: 12px; background-color: #FFF;" colspan="14">NO RESULT FOUND !</td>
                                    </tr>
                                    
                                @endif

                                </tbody>
                            </table>

                        </div>

                </div>

            </div>

@endsection