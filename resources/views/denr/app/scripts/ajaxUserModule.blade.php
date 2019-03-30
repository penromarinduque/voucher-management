            
            <script>

                function completeFields(usercode, module) {

                    var user_code = $("#"+usercode).val();
                    var mod_code = $("#"+module).val();

                    $.ajax ({

                        type: "GET",
                        url: "{{ route('ajax.user.module') }}",
                        dataType:'JSON',
                        success:'success',
                        data: { user : user_code },
                        success: function(data)

                        {
                            $('#'+module).empty();

                            $('#'+module).append('<option value="ALL">ALL MODULES</option>');

                            $.each(data.record, function(index, collection){

                                $('#'+module).append('<option value="'+ collection.module_code +'">'+ collection.module_code +' - '+ collection.module_desc +'</option>');

                            });

                        }

                    });

                }

            </script>