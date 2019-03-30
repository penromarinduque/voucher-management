
<script>
    
    $('#user').on('change', function(){

        var user = $('#user').val();

        $.ajax ({

            type: "GET",
            url: "{{ route('ajax.user.module.access') }}",
            dataType:'JSON',
            success:'success',
            data: { user : user},
            success: function(data)

            {

                $('#access').empty();

                $.each(data.record, function(index, collection){

                    var numRows = $("#tblA tr").length;

                    var user_id = collection.user;
                    var modulecode = collection.module_code;
                    var moduledesc = collection.module_desc;
                    var moduleaccess = collection.module_access;

                    if(moduleaccess == '1' & user_id == user) { var checked1 = 'checked'; } else { var checked1 = ''; }

                    $('#access').append('<tr id="row'+ numRows +'">'
                                            +'<td style="padding: 0px; text-align: center;">'
                                                +'<input type="checkbox" data-rowid="row'+ numRows +'" onchange="toggleRowCbs(this)" style="height: 15px; width: 15px; margin-top: 8px;" data-toggle="tooltip" data-placement="left" title="Module Access">'
                                            +'</td>'
                                            +'<td style="padding: 0px;">'
                                                +'<input type="text" name="module_code[]" value="'+ modulecode +'" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" readonly="readonly" data-toggle="tooltip" data-placement="left" title="'+ modulecode +'">'
                                            +'</td>'
                                            +'<td style="padding: 0px;">'
                                                +'<input type="text" name="module_desc[]" value="'+ moduledesc +'" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" readonly="readonly" data-toggle="tooltip" data-placement="left" title="'+ moduledesc +'">'
                                            +'</td>'
                                            +'<td style="padding: 0px; text-align: center;">'
                                                +'<input type="checkbox" name="module_access[]" value="1" '+ checked1 +' style="height: 15px; width: 15px; margin-top: 8px;" data-toggle="tooltip" data-placement="left" title="Module Access">'
                                                +'<input type="hidden" name="module_access[]" value="0">'
                                            +'</td>'
                                            +'<td style="padding: 0px; text-align: center;">'
                                            +'</td>' 
                                        +'</tr>');

                });

                /*$.each(data.modx, function(index, modx){

                $('#mod').append('<div>'+modx.module_code+'</div>');

                });*/

            }

        });



    });

</script>


            


            