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

                            <!-- <li style="margin-left: 12px;">
                                <a href="#"><i class="fa fa-cog fa-fw"></i> SYSTEM SETTING</a>
                            </li> -->

                            <li style="margin-left: 12px;">
                                <a href="{{ route('audit.trail.log.form') }}"><i class="fa fa-cog fa-fw"></i> AUDIT TRAIL LOG</a>
                            </li>

                            <li>
                                <a href="{{ route('form.signatory.form') }}"><i class="fa fa-cog fa-fw"></i> TRAVEL ORDER SIGNATORIES</a>
                            </li>

                            <li class="active">
                                <a href="{{ route('no.generation.form') }}"><i class="fa fa-cog fa-fw"></i> FORM NO. GENERATION</a>
                            </li>

                         </ul>

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">
                                    
                                    {{Form::open(array('action'=>'denr\app\FormNoController@AddFormNo'))}}

                                         <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">

                                                <tr>
                                                    <td colspan="3" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; "><i class="fa fa-pencil-square fa-fw"></i> FORM NO. GENERATION <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                                </tr>

                                                <tr>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold;">Form Title</td>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold;">Prefix</td>
                                                    <td style="font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold;">Last No.</td>
                                                </tr>

                                                @foreach($record as $id => $col)

                                                    <tr>
                                                        <input type="hidden" name="form_id[]" value="{{ $col->id }}">
                                                        <td style="width:150px; font-size: 12px; color: #5B5B5B; "> {{ $col->form_name }}</td>
                                                        <td style="padding: 0px;"><input type="text" name="form_text[]" value="{{ $col->form_text }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('form_text')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('form_text'))Code is required @else Code @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                        <td style="padding: 0px;"><input type="text" name="form_no[]" value="{{ $col->form_no }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('form_no')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('form_no'))Number is required @else Number @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    </tr>

                                                @endforeach

                                                <tr>
                                                    <td ></td>
                                                    <td colspan="2">
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