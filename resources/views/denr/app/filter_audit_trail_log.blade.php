@extends('denr.layouts.window')

@section('page-css')

@endsection

@section('page-content')

            <div class="row">
                
                <div class="col-lg-12">

                    <a onClick="window.close();" id="gen_link"><button type="button" class="btn btn-default btn-xs" style="height: 25px; width:60px; font-size: 11px; float: right; margin-right: 10px;" data-toggle="tooltip" data-placement="right" title="Close"><i class="fa fa-times"></i> CLOSE</button></a>
                    <a onclick="window.print();" id="gen_link"><button type="button" class="btn btn-default btn-xs" style="height: 25px; width:60px; font-size: 11px; float: right; margin-right: 10px;" data-toggle="tooltip" data-placement="right" title="Print Travel Order"><i class="fa fa-print"></i> PRINT</button></a>
                                        
                    
                        <div class="panel-body">

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
                            <font style="font-weight: bold; font-size: 16px;">AUDIT TRAIL REPORT</font><br/>
                            
                            
                            <table class="table table-striped table-bordered table-hover tooltip-demo" style="background-color: #FFF; margin-top: 15px;">
                                <thead>
                                    <tr style="font-size: 11px; text-transform: uppercase;">
                                        <th style="padding: 5px 10px 5px 10px;">USER</th>
                                        <th style="padding: 5px 10px 5px 10px;">DATE/TIME</th>
                                        <th style="padding: 5px 10px 5px 10px;">ACTION</th>
                                        <th style="padding: 5px 10px 5px 10px;">MODULE</th>
                                        <th style="padding: 5px 10px 5px 10px;">WINDOW/FORM</th>
                                        <th style="padding: 5px 10px 5px 10px;">REMARKS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                @if($fcount > 0)

                                    @foreach($audit as $id => $col)

                                    <tr class="odd gradeX" style="font-size: 11px; vertical-align: middle;">
                                        <td style="padding: 3px 10px 3px 10px; ">
                                           
                                            @php $employee = DB::table('users')->where('id', '=', $col['user_id'])->get()->first(); @endphp
                                            
                                            {{$employee->fname}} {{$employee->mname}} {{$employee->lname}}
 
                                            
                                        </td>
                                        <td style="padding: 3px 10px 3px 10px; ">{{ date('m/d/Y h:i:A', strtotime($col['date_action']))}}</td>
                                        <td style="padding: 3px 10px 3px 10px; ">
                                        
                                        @php
                                        
                                            $type = $col['action_type'];

                                            if($type == 'ADD') {
                                                echo 'Add';
                                            } else if($type == 'EDIT') {
                                                echo 'Edit';
                                            } else if($type == 'DEL') {
                                                echo 'Delete';
                                            } else if($type == 'APPROVE') {
                                                echo 'Approve';
                                            } else if($type == 'RECOMMEND') {
                                                echo 'Recommend';
                                            } else if($type == 'LOGIN') {
                                                echo 'Login';
                                            } else if($type == 'LOGOUT') {
                                                echo 'Logout';
                                            }

                                        @endphp
                                        
                                        </td>
                                        <td style="padding: 3px 10px 3px 10px; ">{{$col['module_code']}}</td>
                                        <td style="padding: 3px 10px 3px 10px; ">{{$col['window_page']}}</td>
                                        <td style="padding: 3px 10px 3px 10px; ">{{$col['remarks']}}</td>
                                    </tr>
                                    
                                    @endforeach

                                @elseif($fcount == 0)
                                    
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