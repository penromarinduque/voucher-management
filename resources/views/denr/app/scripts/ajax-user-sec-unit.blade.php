	
			<script>
    	            
                $('#section').on('change', function(e) {

                    //console.log(e);

                     var section = e.target.value;

                     $.get('/ajax-user-sec-unit?section=' + section, function(data){

                        $('#unit').empty();

                        $('#unit').append('<option value="">Select Unit</option>');

                        $.each(data, function(index, subcatObj){

                            //if inside select option
                            $('#unit').append('<option value="'+ subcatObj.id +'">'+ subcatObj.unit +'</option>');

                        });

                     });

                });

            </script>