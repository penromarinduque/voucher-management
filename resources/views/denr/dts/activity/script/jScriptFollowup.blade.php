<script type="text/javascript">

    $(document).ready(function() {

        $('.btn-followup').on('click', function() {
            $('textarea').val('');                        
            $('#followup_modal').modal('show');
            var refcode = $(this).attr('data-id');
            var doc_no = $(this).attr('data-id2');
            var refcode3 = $(this).attr('data-id3');
            var log_id = $(this).attr('data-log-id');
            $(".modal-body #com_name").html(doc_no);
            $(".modal-body #doc_log_id").val(log_id);
            $(".modal-footer #com_id").val(doc_no);
            $(".modal-footer #doc_no").val(doc_no);
            $(".modal-footer #doc_cat").val(refcode3);                                          
        });

        $('#form_followup').submit(function (){
            $('#btn_followup').prop('disabled',true);
            $('textarea').attr('readonly','readonly');
            $('button').attr('disabled','disabled');
        });
    });

</script>