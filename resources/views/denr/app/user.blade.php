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
                                <a href="{{ route('employee.user.list') }}"><i class="fa fa-navicon fa-fw"></i> User / Employee</a>
                            </li>
                            
                            <li>
                                <a href="{{ route('employee.user.form') }}"><i class="fa fa-plus fa-fw"></i> Register New User</a>
                            </li>

                        </ul>

                        <div class="panel-body">
                            
                            <table width="100%" class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                    <tr style="font-size: 11px; text-transform: uppercase;">
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>User Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user as $id => $col)
                                    <tr class="odd gradeX">
                                        <td style="padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: middle;">{{$col['username']}}</td>
                                        <td style="padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: middle;">{{$col['fname']}} {{$col['mi']}}. {{$col['lname']}}</td>
                                        <td style="padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: middle;">{{$col['email']}}</td>
                                        <td style="padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: middle;">
                                            @if($col['user_type']=='1')
                                                {{'Super Administrator'}}
                                            @elseif($col['user_type']=='2')
                                                {{'System Administrator'}}
                                            @elseif($col['user_type']=='3')
                                                {{'Employee'}}
                                            @endif
                                        </td>
                                        <td style="padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: middle;">
                                            @if($col['user_status']=='1')
                                                {{'Active'}}
                                            @else($col['user_status']=='0')
                                                {{'Inactive'}}
                                            @endif
                                        </td>
                                        <td style="padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: middle;">
                                            @php
                                                $passId = Crypt::encrypt($col['id'])
                                            @endphp
                                            <!-- <a href="javascript:void(0)" class="btn-employee-view" data-employee-id="{{ $passId }}"><button style="width: 50px;" class="btn btn-outline btn-success btn-xs"">Profile</button></a> -->
                                            <a href="{{ url('app/maintenance/user/edit/'.$passId) }}"><button style="width: 50px;" class="btn btn-outline btn-success btn-xs">View</button></a>
                                            <a href="javascript:void(0)" class="btn-delete" data-id="{{ $col['id'] }}" data-username="{{ $col['username'] }}"><button style="width: 50px;" class="btn btn-outline btn-danger btn-xs">Delete</button></a>
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
                                                
                            Are you sure you want to delete User Employee ( <b id="del_name"></b> ) ?
                                                           
                        </div>
                        <div class="modal-footer">

                            {{Form::open(array('action'=>'denr\app\UserController@DeleteUser'))}}

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

            @include('denr.layouts.blocks.msgconfirmation')

@endsection