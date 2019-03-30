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
                                <a href="{{ route('pending.travel.order.list') }}"><i class="fa fa-exclamation-circle fa-fw"></i> Pendng Travel Order</a>
                            </li>

                            <li>
                                <a href="{{ route('approved.travel.order.list') }}"><i class="fa fa-check fa-fw"></i> Approved Travel Order</a>
                            </li>

                            <li class="active">
                                <a href="{{ route('disapproved.travel.order.list') }}"><i class="fa fa-times fa-fw"></i> Disapproved Travel Order</a>
                            </li>

                            <li>
                                <a href="{{ route('cancelled.travel.order.list') }}"><i class="fa fa-times-circle fa-fw"></i> Cancelled Travel Order</a>
                            </li>
                            
                         </ul>

                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                    <tr style="font-size: 11px; text-transform: uppercase;">
                                        <th>NO.</th>
                                        <th>Order No.</th>
                                        <th>Employee Name</th>
                                        <!-- <th>Filling Date</th> -->
                                        <th>Approval Status</th>
                                        <th>Date Recommended</th>
                                        <th>Date Approved</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $id => $col)
                                    <tr class="odd gradeX">
                                        <td style="width: 30px; padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top; text-align: right;">{{ $id+1 }}</td>
                                        <td style=" padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top;">{{$col['order_no']}}</td>
                                        <td style=" padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top;">
                                            
                                            @php $employee = DB::table('users')->where('id', '=', $col['user_id'])->get()->first(); @endphp
                                            
                                            {{$employee->fname}} {{$employee->mi}}. {{$employee->lname}}

                                        </td>
                                        <!-- <td style=" padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top;">{{ date('m/d/Y', strtotime($col['date_filling']))}}</td> -->
                                        <td style=" padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top;">
                                            @if($col['approval_status']=='0')
                                                <font style="color: #F00; font-style: italic;">{{'Pending'}}</font>
                                            @elseif($col['approval_status']=='1')
                                                <font style="color: #09C; font-style: italic;">{{'Recommended'}}</font>
                                            @elseif($col['approval_status']=='2')
                                                <font style="color: green; font-style: italic;">{{'Approved'}}</font>
                                            @elseif($col['approval_status']=='3')
                                                <font style="color: green; font-style: italic;">{{'Disapproved'}}</font>
                                            @elseif($col['approval_status']=='4')
                                                <font style="color: green; font-style: italic;">{{'Cancelled'}}</font>
                                            @endif
                                        </td>
                                        <td style=" padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top;">@if($col['recommended_at']!=NULL) {{ date('m/d/Y h:i A', strtotime($col['recommended_at']))}} @else <i></i> @endif</td>
                                        <td style=" padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top;">@if($col['approved_at']!=NULL) {{ date('m/d/Y h:i A', strtotime($col['approved_at']))}} @else <i></i> @endif</td>
                                        <td style="width: 200px; padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: middle;">
                                            @php $code = Crypt::encrypt($col->id) @endphp
                                            <a style="cursor:pointer;" onClick=MM_openBrWindow("{{ url('toa/approval/pendingtravelorder/edit/'.$code) }}",'')><button style="width: 85px;" class="btn btn-outline btn-success btn-xs">Travel Order</button></a>
                                            <a style="cursor:pointer;" onClick=MM_openBrWindow2("{{ url('toa/activity/travelorder/print/2/'.$code) }}",'')><button style="width: 65px;" class="btn btn-outline btn-primary btn-xs">Itinerary</button></a>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>

            </div>

            @include('denr.layouts.blocks.msgconfirmation')

@endsection