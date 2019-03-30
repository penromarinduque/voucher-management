<?php include(resource_path() . '/views/denr/layouts/helpers_data.php'); ?>

@extends('denr.layouts.window')

@section('page-css')

@endsection

@section('page-content')

            <div class="row">
                
                <div class="col-lg-12">
                    
                        <div class="panel-body">
                            
                            <table class="table table-striped table-bordered table-hover tooltip-demo" style="background-color: #FFF;">
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
                                            
                                            @php $users = DB::table('users')->where('id', '=', $col['user_id'])->get()->first(); @endphp
                                            
                                            {{ $users->fname }} {{ $users->mname }} {{ $users->lname }}
                                        
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