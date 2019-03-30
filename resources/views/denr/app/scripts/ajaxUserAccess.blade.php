            
            <script>
                
                $('#user').on('change', function() {

                    var user = $("#user").val();

                    var module = $("#module").val();

                    $.ajax ({

                        type: "GET",
                        url: "{{ route('ajax.user.access') }}",
                        dataType:'JSON',
                        success:'success',
                        data: { user : user, module : 'ALL'},
                        success: function(data)

                        {

                            $('#access').empty();

                            $.each(data.record, function(index, collection) {

                                var numRows = $("#tblA tr").length;

                                var user_id = collection.user;
                                var window_id = collection.window_id;
                                var window_desc = collection.window_desc;
                                var window_type = collection.window_type;
                                var module_code = collection.module_code;
                                var view_access = collection.view_access;
                                var add_access = collection.add_access;
                                var edit_access = collection.edit_access;
                                var delete_access = collection.delete_access;
                                var print_access = collection.print_access;

                                if(view_access == '1' & user_id == user) { var checked1 = 'checked'; } else { var checked1 = ''; }
                                if(add_access == '1' & user_id == user) { var checked2 = 'checked'; } else { var checked2 = ''; }
                                if(edit_access == '1' & user_id == user) { var checked3 = 'checked'; } else { var checked3 = ''; }
                                if(delete_access == '1' & user_id == user) { var checked4 = 'checked'; } else { var checked4 = ''; }
                                if(print_access == '1' & user_id == user) { var checked5 = 'checked'; } else { var checked5 = ''; }
                                
                                if(module_code == 'APP') { var module_desc = 'Application Manager'; }
                                else if(module_code == 'PIS') { var module_desc = 'Personal Information System'; }
                                else if(module_code == 'DTS') { var module_desc = 'Document Tracking System'; }
                                else if(module_code == 'TOA') { var module_desc = 'Travel Order Application'; }
                                else if(module_code == 'LMS') { var module_desc = 'Leave Monitoring System'; }

                                
                                if(window_type == 'T') {

                                    var type = 'Table';
                                    var hidden_view = 'checkbox';
                                    var hidden_add = 'checkbox';
                                    var hidden_edit = 'checkbox';
                                    var hidden_del = 'checkbox';
                                    var hidden_print = 'checkbox';

                                    var name_view = 'view_access[]';
                                    var name_add = 'add_access[]';
                                    var name_edit = 'edit_access[]';
                                    var name_del = 'delete_access[]';
                                    var name_print = 'print_access[]';

                                } else if(window_type == 'A') {

                                    var type = 'Activity';
                                    var hidden_view = 'checkbox';
                                    var hidden_add = 'checkbox';
                                    var hidden_edit = 'checkbox';
                                    var hidden_del = 'checkbox';
                                    var hidden_print = 'checkbox';

                                    var name_view = 'view_access[]';
                                    var name_add = 'add_access[]';
                                    var name_edit = 'edit_access[]';
                                    var name_del = 'delete_access[]';
                                    var name_print = 'print_access[]';

                                } else if(window_type == 'R') {

                                    var type = 'Report';
                                    var hidden_view = 'hidden';
                                    var hidden_add = 'hidden';
                                    var hidden_edit = 'hidden';
                                    var hidden_del = 'hidden';
                                    var hidden_print = 'checkbox';

                                    var name_view = '';
                                    var name_add = '';
                                    var name_edit = '';
                                    var name_del = '';
                                    var name_print = 'print_access[]';
                                }

                               

                                $('#access').append('<tr id="row'+ numRows +'">'
                                                        +'<td style="padding: 0px; text-align: center;">'
                                                            +'<input type="checkbox" data-rowid="row'+ numRows +'" onchange="toggleRowCbs(this)" style="height: 15px; width: 15px; margin-top: 8px;" data-toggle="tooltip" data-placement="left" title="Check all '+ window_id +' ">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px;">'
                                                            +'<input type="hidden" name="window_id[]" value="'+ window_id +'" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" readonly="readonly" data-toggle="tooltip" data-placement="left" title="'+ window_id +' ">'
                                                            +'<input type="text" name="window_desc[]" value="'+ window_desc +'" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" readonly="readonly" data-toggle="tooltip" data-placement="left" title="'+ window_desc +' ">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px;">'
                                                            +'<input type="text" name="window_type[]" value="'+ type +'" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" readonly="readonly">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px;">'
                                                            +'<input type="hidden" name="module_code[]" value="'+ module_code +'">'
                                                            +'<input type="text" value="'+ module_desc +'" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" readonly="readonly">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px; text-align: center;">'
                                                            +'<input type="'+ hidden_view +'" name="'+ name_view +'" value="1" '+ checked1 +' style="height: 15px; width: 15px; margin-top: 8px;" data-toggle="tooltip" data-placement="left" title="View">'
                                                            +'<input type="hidden" name="view_access[]" value="0">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px; text-align: center;">'
                                                            +'<input type="'+ hidden_add +'" name="'+ name_add +'" value="1" '+ checked2 +' style="height: 15px; width: 15px; margin-top: 8px;" data-toggle="tooltip" data-placement="left" title="Add">'
                                                            +'<input type="hidden" name="add_access[]" value="0">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px; text-align: center;">'
                                                            +'<input type="'+ hidden_edit +'" name="'+ name_edit +'" value="1" '+ checked3 +' style="height: 15px; width: 15px; margin-top: 8px;" data-toggle="tooltip" data-placement="left" title="Edit">'
                                                            +'<input type="hidden" name="edit_access[]" value="0">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px; text-align: center;">'
                                                            +'<input type="'+ hidden_del +'" name="'+ name_del +'" value="1" '+ checked4 +' style="height: 15px; width: 15px; margin-top: 8px;" data-toggle="tooltip" data-placement="left" title="Delete">'
                                                            +'<input type="hidden" name="delete_access[]" value="0">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px; text-align: center;">'
                                                            +'<input type="'+ hidden_print +'" name="'+ name_print +'" value="1" '+ checked5 +' style="height: 15px; width: 15px; margin-top: 8px;" data-toggle="tooltip" data-placement="left" title="Print">'
                                                            +'<input type="hidden" name="print_access[]" value="0">'
                                                        +'</td>');

                            });

                            $('#access').append('<tr style="font-weight: bold; text-transform: uppercase;">'
                                                    +'<td style="width:20px; font-size: 11px; color: #5B5B5B; text-align: center; "><i class="fa fa-check"></i></td>'
                                                    +'<td style="width:250px; font-size: 11px; color: #5B5B5B; text-align: left; ">Window Tag/Title</td>'
                                                    +'<td style="width:100px; font-size: 11px; color: #5B5B5B; text-align: left; ">Window Type</td>'
                                                    +'<td style="width:100px; font-size: 11px; color: #5B5B5B; text-align: left; ">Module</td>'
                                                    +'<td style="width:70px; font-size: 11px; color: #5B5B5B; text-align: center; ">View</td>'
                                                    +'<td style="width:70px; font-size: 11px; color: #5B5B5B; text-align: center; ">Add</td>'
                                                    +'<td style="width:70px; font-size: 11px; color: #5B5B5B; text-align: center; ">Edit</td>'
                                                    +'<td style="width:70px; font-size: 11px; color: #5B5B5B; text-align: center; ">Delete</td>'
                                                    +'<td style="width:70px; font-size: 11px; color: #5B5B5B; text-align: center; ">Print</td>'
                                                +'</tr>');

                        }
                            

                    });



                });

            </script>


            <script>
                
                $('#module').on('change', function(){

                    var user = $("#user").val();

                    var module = $("#module").val();

                    $.ajax ({

                        type: "GET",
                        url: "{{ route('ajax.user.access') }}",
                        dataType:'JSON',
                        success:'success',
                        data: { user : user, module : module },
                        success: function(data)

                        {

                            $('#access').empty();

                            $.each(data.record, function(index, collection) {

                                var numRows = $("#tblA tr").length;

                                var user_id = collection.user;
                                var window_id = collection.window_id;
                                var window_desc = collection.window_desc;
                                var window_type = collection.window_type;
                                var module_code = collection.module_code;
                                var view_access = collection.view_access;
                                var add_access = collection.add_access;
                                var edit_access = collection.edit_access;
                                var delete_access = collection.delete_access;
                                var print_access = collection.print_access;

                                if(view_access == '1' & user_id == user) { var checked1 = 'checked'; } else { var checked1 = ''; }
                                if(add_access == '1' & user_id == user) { var checked2 = 'checked'; } else { var checked2 = ''; }
                                if(edit_access == '1' & user_id == user) { var checked3 = 'checked'; } else { var checked3 = ''; }
                                if(delete_access == '1' & user_id == user) { var checked4 = 'checked'; } else { var checked4 = ''; }
                                if(print_access == '1' & user_id == user) { var checked5 = 'checked'; } else { var checked5 = ''; }
                                
                                if(module_code == 'APP') { var module_desc = 'Application Manager'; }
                                else if(module_code == 'PIS') { var module_desc = 'Personal Information System'; }
                                else if(module_code == 'DTS') { var module_desc = 'Document Tracking System'; }
                                else if(module_code == 'TOA') { var module_desc = 'Travel Order Application'; }
                                else if(module_code == 'LMS') { var module_desc = 'Leave Monitoring System'; }

                                

                                if(window_type == 'T') {

                                    var type = 'Table';
                                    var hidden_view = 'checkbox';
                                    var hidden_add = 'checkbox';
                                    var hidden_edit = 'checkbox';
                                    var hidden_del = 'checkbox';
                                    var hidden_print = 'checkbox';

                                    var name_view = 'view_access[]';
                                    var name_add = 'add_access[]';
                                    var name_edit = 'edit_access[]';
                                    var name_del = 'delete_access[]';
                                    var name_print = 'print_access[]';

                                } else if(window_type == 'A') {

                                    var type = 'Activity';
                                    var hidden_view = 'checkbox';
                                    var hidden_add = 'checkbox';
                                    var hidden_edit = 'checkbox';
                                    var hidden_del = 'checkbox';
                                    var hidden_print = 'checkbox';

                                    var name_view = 'view_access[]';
                                    var name_add = 'add_access[]';
                                    var name_edit = 'edit_access[]';
                                    var name_del = 'delete_access[]';
                                    var name_print = 'print_access[]';

                                } else if(window_type == 'R') {

                                    var type = 'Report';
                                    var hidden_view = 'hidden';
                                    var hidden_add = 'hidden';
                                    var hidden_edit = 'hidden';
                                    var hidden_del = 'hidden';
                                    var hidden_print = 'checkbox';

                                    var name_view = '';
                                    var name_add = '';
                                    var name_edit = '';
                                    var name_del = '';
                                    var name_print = 'print_access[]';

                                }
                               
                                $('#access').append('<tr id="row'+ numRows +'">'
                                                        +'<td style="padding: 0px; text-align: center;">'
                                                            +'<input type="checkbox" data-rowid="row'+ numRows +'" onchange="toggleRowCbs(this)" style="height: 15px; width: 15px; margin-top: 8px;" data-toggle="tooltip" data-placement="left" title="Check All '+ window_id +' ">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px;">'
                                                            +'<input type="hidden" name="window_id[]" value="'+ window_id +'" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" readonly="readonly" data-toggle="tooltip" data-placement="left" title="'+ window_id +' ">'
                                                            +'<input type="text" name="window_desc[]" value="'+ window_desc +'" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" readonly="readonly" data-toggle="tooltip" data-placement="left" title="'+ window_desc +' ">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px;">'
                                                            +'<input type="text" name="window_type[]" value="'+ type +'" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" readonly="readonly">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px;">'
                                                            +'<input type="hidden" name="module_code[]" value="'+ module_code +'">'
                                                            +'<input type="text" value="'+ module_desc +'" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" readonly="readonly">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px; text-align: center;">'
                                                            +'<input type="'+ hidden_view +'" name="'+ name_view +'" value="1" '+ checked1 +' style="height: 15px; width: 15px; margin-top: 8px;" data-toggle="tooltip" data-placement="left" title="View">'
                                                            +'<input type="hidden" name="view_access[]" value="0">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px; text-align: center;">'
                                                            +'<input type="'+ hidden_add +'" name="'+ name_add +'" value="1" '+ checked2 +' style="height: 15px; width: 15px; margin-top: 8px;" data-toggle="tooltip" data-placement="left" title="Add">'
                                                            +'<input type="hidden" name="add_access[]" value="0">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px; text-align: center;">'
                                                            +'<input type="'+ hidden_edit +'" name="'+ name_edit +'" value="1" '+ checked3 +' style="height: 15px; width: 15px; margin-top: 8px;" data-toggle="tooltip" data-placement="left" title="Edit">'
                                                            +'<input type="hidden" name="edit_access[]" value="0">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px; text-align: center;">'
                                                            +'<input type="'+ hidden_del +'" name="'+ name_del +'" value="1" '+ checked4 +' style="height: 15px; width: 15px; margin-top: 8px;" data-toggle="tooltip" data-placement="left" title="Delete">'
                                                            +'<input type="hidden" name="delete_access[]" value="0">'
                                                        +'</td>'
                                                        +'<td style="padding: 0px; text-align: center;">'
                                                            +'<input type="'+ hidden_print +'" name="'+ name_print +'" value="1" '+ checked5 +' style="height: 15px; width: 15px; margin-top: 8px;" data-toggle="tooltip" data-placement="left" title="Print">'
                                                            +'<input type="hidden" name="print_access[]" value="0">'
                                                        +'</td>');





                            });

                            $('#access').append('<tr style="font-weight: bold; text-transform: uppercase;">'
                                                    +'<td style="width:20px; font-size: 11px; color: #5B5B5B; text-align: center; "><i class="fa fa-check"></i></td>'
                                                    +'<td style="width:250px; font-size: 11px; color: #5B5B5B; text-align: left; ">Window Tag/Title</td>'
                                                    +'<td style="width:100px; font-size: 11px; color: #5B5B5B; text-align: left; ">Window Type</td>'
                                                    +'<td style="width:100px; font-size: 11px; color: #5B5B5B; text-align: left; ">Module</td>'
                                                    +'<td style="width:70px; font-size: 11px; color: #5B5B5B; text-align: center; ">View</td>'
                                                    +'<td style="width:70px; font-size: 11px; color: #5B5B5B; text-align: center; ">Add</td>'
                                                    +'<td style="width:70px; font-size: 11px; color: #5B5B5B; text-align: center; ">Edit</td>'
                                                    +'<td style="width:70px; font-size: 11px; color: #5B5B5B; text-align: center; ">Delete</td>'
                                                    +'<td style="width:70px; font-size: 11px; color: #5B5B5B; text-align: center; ">Print</td>'
                                               +'</tr>');

                        }


                    });

                
                });

            </script>


            