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
                                <a href="{{ route('employee.position.list') }}"><i class="fa fa-navicon fa-fw"></i> Employee Position</a>
                            </li>
                            
                            <li class="active">
                                <a href="{{ route('employee.position.form') }}"><i class="fa fa-plus fa-fw"></i> Add New Position</a>
                            </li>

                         </ul>

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">
                                    
                                    {{Form::open(array('action'=>'denr\app\PositionController@AddPosition'))}}

                                         <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td colspan="6" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; "><i class="fa fa-pencil-square fa-fw"></i> EMPLOYEE POSITION FORM <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> POSITION TITLE</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="title" value="{{ old('title') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('title')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('title'))Position Title is required @else Position Title @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> POSITION TITLE</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="description" value="{{ old('description') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('description')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('description'))Position Description is required @else Position Description @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> POSITION TYPE</td>
                                                    <td style="padding: 0px;">
                                                        <select name="position_type" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;">
                                                            <option value=""> - Select Position Type - </option>
                                                            <option value="1" @if(old('position_type') == '1') selected @endif > Officer In Charge </option>
                                                            <option value="2" @if(old('position_type') == '2') selected @endif > Chief Officer </option>
                                                            <option value="3" @if(old('position_type') == '3') selected @endif > Ordinary Employee </option>
                                                        <select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td ></td>
                                                    <td >
                                                        <input type="submit" name="add" value="Save" class="btn btn-success btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="left" title="Are you sure you filled-up all required fields?">
                                                        <input type="reset" value="Clear" class="btn btn-danger btn-xs" style="height: 25px; width: 60px;">
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

@endsection