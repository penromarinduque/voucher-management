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
                            <font style="font-weight: bold; font-size: 16px;">EMPLOYEE LIST REPORT</font><br/>
                            <font style="font-weight: bold; font-size: 12px;">Employee From: {{ $employee_from }}, Employee To: {{ $employee_to }}, Position: {{ $position }}, Division: {{ $division }}, Section: {{ $section }}, Unit: {{ $unit }}, Status: {{ $status }}</font>
                            
                            <table class="table table-striped table-bordered table-hover tooltip-demo" style="background-color: #FFF; margin-top: 15px;">
                                <thead>
                                    <tr style="font-size: 11px; text-transform: uppercase;">
                                        <th style="padding: 5px 10px 5px 10px;">EMPLOYEE NAME</th>
                                        <th style="padding: 5px 10px 5px 10px;">POSITION</th>
                                        <th style="padding: 5px 10px 5px 10px;">EMAIL</th>
                                        <th style="padding: 5px 10px 5px 10px;">USER TYPE</th>
                                        <th style="padding: 5px 10px 5px 10px;">STATUS</th>
                                        <th style="padding: 5px 10px 5px 10px;">DIVISION</th>
                                        <th style="padding: 5px 10px 5px 10px;">SECTION</th>
                                        <th style="padding: 5px 10px 5px 10px;">UNIT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                @if($rcount > 0)

                                    @foreach($report as $id => $col)

                                    <tr class="odd gradeX" style="font-size: 11px; vertical-align: middle;">
                                        <td style="padding: 3px 10px 3px 10px; ">
                                            {{$col['fname']}} {{$col['mname']}} {{$col['lname']}}
                                        </td>
                                        <td style="padding: 3px 10px 3px 10px; ">
                                            @if($col['user_position']!='')
                                                @php $position = DB::table('employee_position')->where('id', '=', $col['user_position'])->get()->first(); @endphp
                                                {{$position->position_title}}
                                            @endif
                                        </td>
                                        <td style="padding: 3px 10px 3px 10px; ">{{ $col['email']}}</td>
                                        <td style="padding: 3px 10px 3px 10px; ">
                                            @if($col['user_type']=='1')
                                                Super Admin
                                            @elseif($col['user_type']=='2')
                                                Admin
                                            @elseif($col['user_type']=='3')
                                                User/Employee
                                            @endif
                                        </td>
                                        <td style="padding: 3px 10px 3px 10px; ">
                                            @if($col['user_status']=='0')
                                                Inactive
                                            @elseif($col['user_status']=='1')
                                                Active
                                            @endif
                                        </td>
                                        <td style="padding: 3px 10px 3px 10px; ">
                                            @if($col['user_division']!='')
                                                @php $division = DB::table('employee_division')->where('id', '=', $col['user_division'])->get()->first(); @endphp
                                                {{$division->division}}
                                            @endif
                                        </td>
                                        <td style="padding: 3px 10px 3px 10px; ">
                                            @if($col['user_section']!='')
                                                @php $section = DB::table('employee_section')->where('id', '=', $col['user_section'])->get()->first(); @endphp
                                                {{$section->section}}
                                            @endif
                                        </td>
                                        <td style="padding: 3px 10px 3px 10px; ">
                                            @if($col['user_unit']!='')
                                                @php $unit = DB::table('employee_unit')->where('id', '=', $col['user_unit'])->get()->first(); @endphp
                                                {{$unit->unit}}
                                            @endif
                                        </td>
                                    </tr>
                                    
                                    @endforeach

                                @elseif($rcount == 0)
                                    
                                    <tr class="odd gradeX" style="font-size: 11px; vertical-align: middle;">
                                        <td style="padding: 20px; text-align: center; font-size: 12px; background-color: #FFF;" colspan="8">NO RESULT FOUND !</td>
                                    </tr>
                                    
                                @endif

                                </tbody>
                            </table>

                        </div>

                </div>

            </div>

@endsection