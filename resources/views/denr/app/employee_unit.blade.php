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
                                <a href="{{ route('employee.unit.list') }}"><i class="fa fa-navicon fa-fw"></i> Employee Unit</a>
                            </li>
                            
                            <li>
                                <a href="{{ route('employee.unit.form') }}"><i class="fa fa-plus fa-fw"></i> Add New Unit</a>
                            </li>

                         </ul>

                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                    <tr style="font-size: 11px; text-transform: uppercase;">
                                        <th>NO.</th>
                                        <th>Unit</th>
                                        <th>Division</th>
                                        <th>Section</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($record as $id => $col)
                                    <tr class="odd gradeX">
                                        <td style="width: 30px; padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top; text-align: right;">{{ $id+1 }}</td>
                                        <td style=" padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top;">{{$col['unit']}}</td>
                                        <td style=" padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top;">
                                            
                                            @php $division = DB::table('employee_division')->where('id', '=', $col['division_id'])->get()->first(); @endphp

                                            {{ $division->division }}

                                        </td>
                                        <td style=" padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: top;">
                                            
                                            @php $section = DB::table('employee_section')->where('id', '=', $col['section_id'])->get()->first(); @endphp

                                            {{ $section->section }}

                                        </td>
                                        <td style="width: 150px; padding: 5px 20px 5px 20px; font-size: 12px; vertical-align: middle;">
                                            @php $code = Crypt::encrypt($col->id) @endphp
                                            <a href="{{ url('app/maintenance/unit/edit/'.$code) }}"><button style="width: 50px;" class="btn btn-outline btn-primary btn-xs">Edit</button></a>
                                            <a href="javascript:void(0)" class="btn-delete" data-id="{{ $col['id'] }}" data-username="{{ $col['unit'] }}"><button style="width: 50px;" class="btn btn-outline btn-danger btn-xs">Delete</button></a>
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
                                                
                            Are you sure you want to delete Unit ( <b id="del_name"></b> ) ?
                                                           
                        </div>
                        <div class="modal-footer">

                            {{Form::open(array('action'=>'denr\app\UnitController@DeleteUnit'))}}

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