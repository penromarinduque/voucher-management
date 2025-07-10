<script type="text/javascript">

    $(document).ready(function() {

        $('.btn-edit').on('click', function() {
                                                    
            $('#edit_modal').modal('show');
            var doc_no = $(this).attr('data-id');
            // var doc_subj = $(this).attr('data-subject');
            // var doc_classification = $(this).attr('data-classification');
            $(".modal-header #doc_no").html(doc_no);
            // $(".modal-body #doc_subject_edit").val(doc_subj);
            // $(".modal-body #doc_classification_edit").val(doc_classification);
            $(".modal-footer #doc_no").val(doc_no);                                        
        });

        $('#btn_remove_attachment').click(function (){
            var att_id = $(this).val();
            if (confirm("Are you sure you want to DELETE this Attachment?")) {
                // console.log(att_id);
                $(this).prop('disabled',true).html('Removing').fadeTo(function (){
                    $.ajax({
                        type: 'GET',
                        url: "/ajax-remove-attachment/"+att_id,
                        // data: {att_id:att_id},
                        success: function (result){
                            // console.log(result);
                            const json_obj = JSON.parse(result);
                            if (json_obj.success) {
                                $('#att_'+att_id).remove();
                            } else {
                                alert('Oops! Something went wrong. Please try again.');
                                $('#btn_remove_attachment').prop('disabled',false).html('Remove');
                            }
                        },
                        error: function (result){
                            // console.log(result);
                            alert('Oops! Something went wrong. Please try again.');
                            $('#btn_remove_attachment').prop('disabled',false).html('Remove');
                        }
                    });
                });
            }
        });

        $('#form_edit').submit(function (event) {
            if (confirm('DO YOU REALLY WANT TO SUBMIT THE FORM? PLEASE MAKE SURE ALL OF THE DOCUMENT DETAILS ARE CORRECT BEFORE SUBMITTING.')) {
                $('#btn_update').prop('disabled',true).html('Saving...');
                $('input[type=text], input[type=button], input[type=date], input[type=time], input[type=file]').prop('readonly',true);
                $('select').attr('readonly','readonly');
                $('button').attr('disabled','disabled');
                return true;
            } else {
                event.preventDefault();
            }
        });

    });

</script>