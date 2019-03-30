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

                            <li class="active" style="margin-left: 12px;">
                                <a href="{{ route('travel.order.list') }}"><i class="fa fa-navicon fa-fw"></i> Travel Order</a>
                            </li>
                            
                            <li>
                                <a href="{{ route('travel.order.form') }}"><i class="fa fa-plus fa-fw"></i> Add New Travel Order</a>
                            </li>

                         </ul>

                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                    <tr style="font-size: 11px; text-transform: uppercase;">
                                        <th>NO.</th>
                                        <th>Order No.</th>
                                        <!-- <th>Filling Date</th> -->
                                        <th>Destination</th>
                                        <th>Approval Status</th>
                                        <th>Date Recommended</th>
                                        <th>Date Approved</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $id => $col)
                                    <tr class="odd gradeX" @if($col['approval_status']!='2' && $col['approval_status']!='3' && $col['approval_status']!='4') style="background-color: #f2dede;" @endif>
                                        <td style="width: 30px; padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top; text-align: right;">{{ $id+1 }}</td>
                                        <td style=" padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top;">{{$col['order_no']}}</td>
                                        <!-- <td style=" padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top;">{{$col['date_filling']}}</td> -->
                                        <td style=" padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top;">{{$col['destination']}}</td>
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
                                        <td style="width: 320px; padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: middle;">
                                            @php $code = Crypt::encrypt($col->id) @endphp
                                            <a style="cursor:pointer;" onClick=MM_openBrWindow("{{ url('toa/activity/travelorder/print/1/'.$code) }}",'')><button style="width: 85px;" class="btn btn-outline btn-success btn-xs">Travel Order</button></a>
                                            <a style="cursor:pointer;" onClick=MM_openBrWindow2("{{ url('toa/activity/travelorder/print/2/'.$code) }}",'')><button style="width: 65px;" class="btn btn-outline btn-primary btn-xs">Itinerary</button></a>
                                            @if($col['approver'] == $col['user_id'] || $col['recommender'] == $col['user_id'])
                                                @if($col['approval_status']=='1' || $col['approval_status']=='0')
                                                <a href="{{ url('toa/activity/travelorder/edit/'.$code) }}"><button style="width: 50px;" class="btn btn-outline btn-primary btn-xs">Edit</button></a>
                                                <a href="javascript:void(0)" class="btn-cancel" data-id="{{ $col['id'] }}" data-username="{{ $col['order_no'] }}"><button style="width: 50px;" class="btn btn-outline btn-danger btn-xs">Cancel</button></a>
                                                <a href="javascript:void(0)" class="btn-delete" data-id="{{ $col['id'] }}" data-username="{{ $col['order_no'] }}"><button style="width: 50px;" class="btn btn-outline btn-danger btn-xs">Delete</button></a>
                                                @endif
                                            @elseif($col['approver'] != $col['user_id'] && $col['recommender'] != $col['user_id'])
                                                @if($col['approval_status']=='0')
                                                <a href="{{ url('toa/activity/travelorder/edit/'.$code) }}"><button style="width: 50px;" class="btn btn-outline btn-primary btn-xs">Edit</button></a>
                                                <a href="javascript:void(0)" class="btn-cancel" data-id="{{ $col['id'] }}" data-username="{{ $col['order_no'] }}"><button style="width: 50px;" class="btn btn-outline btn-danger btn-xs">Cancel</button></a>
                                                <a href="javascript:void(0)" class="btn-delete" data-id="{{ $col['id'] }}" data-username="{{ $col['order_no'] }}"><button style="width: 50px;" class="btn btn-outline btn-danger btn-xs">Delete</button></a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>

            </div>

            <div id="deleteModal" class="modal fade" role="dialog">
                <div class="modal-dialog" style="margin-top: 100px; width: 450px;">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="color: #F00;"><i class="fa fa-times-circle"></i> Delete Confirmation</h4>
                        </div>
                        <div class="modal-body" style="padding: 30px 25px 30px 25px; text-align: center;">
                                                
                            Are you sure you want to delete Travel Order ( <b id="del_name"></b> ) ?
                                                           
                        </div>
                        <div class="modal-footer">

                            {{Form::open(array('action'=>'denr\toa\activity\TravelOrderController@DeleteTravelOrder'))}}

                                <input type="hidden" id="del_id" name="del_id" value="" />
                                <input type="hidden" id="del_id2" name="del_id2" value="" />
                                <button type="button" class="btn btn-danger" data-dismiss="modal" style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right; margin-left:10px;'>No</button>
                                <input type='submit' name='delete' value='Yes' class='btn btn-success' style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right;'/>
                                                                
                            {{Form::close()}}

                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">

                $(document).ready(function() {

                    $('.btn-delete').on('click', function() {
                                                                
                        $('#deleteModal').modal('show');
                        var refcode = $(this).attr('data-id');
                        var refcode2 = $(this).attr('data-username');
                        $(".modal-body #del_name").html(refcode2);
                        $(".modal-footer #del_id").val(refcode);
                        $(".modal-footer #del_id2").val(refcode2);                                          
                    });
                });
            
            </script>


            <div id="cancelModal" class="modal fade" role="dialog">
                <div class="modal-dialog" style="margin-top: 100px; width: 450px;">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="color: #F00;"><i class="fa fa-times-circle"></i> Cancel Confirmation</h4>
                        </div>
                        <div class="modal-body" style="padding: 30px 25px 30px 25px; text-align: center;">
                                                
                            Are you sure you want to cancel Travel Order ( <b id="del_name"></b> ) ?
                                                           
                        </div>
                        <div class="modal-footer">

                            {{Form::open(array('action'=>'denr\toa\activity\TravelOrderController@CancelTravelOrder'))}}

                                <input type="hidden" id="del_id" name="del_id" value="" />
                                <input type="hidden" id="del_id2" name="del_id2" value="" />
                                <button type="button" class="btn btn-danger" data-dismiss="modal" style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right; margin-left:10px;'>No</button>
                                <input type='submit' name='cancel' value='Yes' class='btn btn-success' style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right;'/>
                                                                
                            {{Form::close()}}

                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">

                $(document).ready(function() {

                    $('.btn-cancel').on('click', function() {
                                                                
                        $('#cancelModal').modal('show');
                        var refcode = $(this).attr('data-id');
                        var refcode2 = $(this).attr('data-username');
                        $(".modal-body #del_name").html(refcode2);
                        $(".modal-footer #del_id").val(refcode);
                        $(".modal-footer #del_id2").val(refcode2);                                          
                    });
                });
            
            </script>

            @include('denr.layouts.blocks.msgconfirmation')

@endsection