	
			<script>
    	            
                $('#division').on('change', function(e) {

                    //console.log(e);

                     var division = e.target.value;

                     $.get('/ajax-user-div-sec?division=' + division, function(data){

                        $('#section').empty();

                        $('#section').append('<option value="">Select Section</option>');

                        $.each(data, function(index, subcatObj){

                            //if inside select option
                            $('#section').append('<option value="'+ subcatObj.id +'">'+ subcatObj.section +'</option>');

                        });

                     });

                });

            </script>