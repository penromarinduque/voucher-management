<script type="text/javascript">

    $(document).ready(function() {

        $('.btn-complete').on('click', function() {
                                                    
            $('#complete_modal').modal('show');
            var refcode = $(this).attr('data-id');
            var refcode2 = $(this).attr('data-id2');
            var doc_log_id = $(this).attr('data-log-id');
            console.log(doc_log_id)
            $(".modal-body #com_name").html(refcode);
            $(".modal-body #doc_log_id").val(doc_log_id);
            $(".modal-footer #com_id").val(refcode);
            $(".modal-footer #doc_cat").val(refcode2);                                          
        });
    });

</script>