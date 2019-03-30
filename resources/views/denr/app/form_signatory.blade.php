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

                            <li class="active">
                                <a href="{{ route('form.signatory.form') }}"><i class="fa fa-cog fa-fw"></i> TRAVEL ORDER SIGNATORIES</a>
                            </li>

                            <li >
                                <a href="{{ route('no.generation.form') }}"><i class="fa fa-cog fa-fw"></i> FORM NO. GENERATION</a>
                            </li>

                         </ul>

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">
                                    
                                    {{Form::open(array('action'=>'denr\app\FormSignatoryController@AddFormSignatory'))}}


                                         <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td colspan="3" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; "><i class="fa fa-pencil-square fa-fw"></i> FORM SIGNATORIES <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                                </tr>
                                            </table>

                                        </div>

                                        <div class="panel panel-default">

                                            <table id="tbl1" class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr class="item-row" id="tr1">
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: left; vertical-align:middle; font-weight: bold; padding-left: 15px; width: 40px;" > #</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: left; vertical-align:middle; font-weight: bold; padding-left: 15px;" > NAME OF SIGNATORY</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: left; vertical-align:middle; font-weight: bold; padding-left: 15px;" > TYPE OF SIGNATORY</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: left; vertical-align:middle; font-weight: bold; padding-left: 15px;" > DIVISION</td>
                                                    <td style=" font-size: 11px; color: #5B5B5B; text-align: left; vertical-align:middle; font-weight: bold; padding-left: 15px; width: 50px;" > REMOVE</td>
                                                </tr>
                                                @foreach($signatory as $id => $sign)
                                                    <tr class="item-row" id="tr1">
                                                        <td style="padding: 0px 10px 0px 0px; text-align:right; vertical-align:middle; width:40px;">{{$id+1}}</td>
                                                        <td style="padding: 0px;">
                                                            <select name="signatory_name[]" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;">
                                                                <option value=""> - Select Name of Signatory - </option>
                                                                    @foreach($users as $id => $col)
                                                                    <option value="{{$col['id']}}" @if($col['id'] == $sign['signatory']) selected @endif > {{$col['fname']}} {{$col['mname']}} {{$col['lname']}} </option>
                                                                    @endforeach
                                                            <select>
                                                        </td>
                                                        <td style="padding: 0px;">
                                                            <select name="signatory_type[]" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;">
                                                                <option value=""> - Select Type of Signatory - </option>
                                                                <option value="R" @if($sign['signatory_type'] == 'R') selected @endif > Recommending Approver </option>
                                                                <option value="A" @if($sign['signatory_type'] == 'A') selected @endif> Approver </option>
                                                            <select>
                                                        </td>
                                                        <td style="padding: 0px;">
                                                            <select name="signatory_division[]" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;">
                                                                <option value=""> - Select Division - </option>
                                                                    @foreach($division as $id => $col)
                                                                    <option value="{{$col['id']}}" @if($col['id'] == $sign['signatory_division']) selected @endif  > {{$col['division']}} </option>
                                                                    @endforeach
                                                                <select>
                                                            </td>
                                                        <td style="padding: 0px; vertical-align: middle; text-align: center;"><button type="button" onclick="deleteRow(this)" style="background-color:transparent; border:0px; color:#F00;"><i class="fa fa-times"></i></button></td>
                                                    </tr>            
                                                @endforeach
                                            </table>

                                        </div>

                                        <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td style="width: 40px;"></td>
                                                    <td >
                                                        <button type="button" id='addRow' class="btn btn-primary btn-xs" style="height: 25px; width: 80px; margin-right: 3px;" data-toggle="tooltip" data-placement="left" title="Add Month Details"><i class="fa fa-plus"></i> Signatory</button>
                                                        <button type="submit" name="add" class="btn btn-success btn-xs" style="height: 25px; width: 60px; margin-right: 3px;" data-toggle="tooltip" data-placement="left" title="Save"><i class="fa fa-save"></i> Save </button>
                                                        <button type="reset" class="btn btn-danger btn-xs" onClick="window.location.reload()" style="height: 25px; width: 60px; margin-right: 3px;" data-toggle="tooltip" data-placement="right" title="Clear"><i class="fa fa-times"></i> Clear</button>
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

            <script type="text/javascript">
            
                $(function(){
                
                    $('#addRow').click(function() {  
                    
                        numRows = $("#tbl1 #tr1").length;
          
                        $row = $('<tr class="item-row" id="tr1">'
                                    +'<td style="padding: 0px 10px 0px 0px; text-align:right; vertical-align:middle; width:40px;">'+ numRows +'</td>'
                                    +'<td style="padding: 0px;">'
                                        +'<select name="signatory_name[]" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;">'
                                            +'<option value=""> - Select Name of Signatory - </option>'
                                                @foreach($users as $id => $col)
                                                +'<option value="{{$col['id']}}"> {{$col['fname']}} {{$col['mname']}} {{$col['lname']}} </option>'
                                                @endforeach
                                        +'<select>'
                                    +'</td>'
                                    +'<td style="padding: 0px;">'
                                        +'<select name="signatory_type[]" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;">'
                                            +'<option value=""> - Select Type of Signatory - </option>'
                                                +'<option value="R"> Recommending Approver </option>'
                                                +'<option value="A"> Approver </option>'
                                            +'<select>'
                                    +'</td>'
                                    +'<td style="padding: 0px;">'
                                        +'<select name="signatory_division[]" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;">'
                                            +'<option value=""> - Select Division - </option>'
                                                @foreach($division as $id => $col)
                                                +'<option value="{{$col['id']}}"> {{$col['division']}} </option>'
                                                @endforeach
                                        +'<select>'
                                    +'</td>'
                                    +'<td style="padding: 0px; vertical-align: middle; text-align: center;"><button type="button" onclick="deleteRow(this)" style="background-color:transparent; border:0px; color:#F00;"><i class="fa fa-times"></i></button></td>'
                                +'</tr>')

                        
                                $('#tbl1').append($row);
                    });

                });

                function deleteRow(btn) {
                    var row = btn.parentNode.parentNode;
                    row.parentNode.removeChild(row);
                }


            </script>



@endsection