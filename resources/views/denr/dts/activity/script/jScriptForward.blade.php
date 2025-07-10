<script type="text/javascript">
    
    $('.btn-forward').on('click', function() {
        var doc_no = $(this).attr('data-id');
        var doc_cat = $(this).attr('data-id2');
        var doc_log_id = $(this).attr('data-log-id');
        console.log(doc_log_id);
        $(".modal-header #doc_no_title").html(doc_no);
        $(".modal-body #doc_no").val(doc_no);
        $(".modal-body #doc_log_id").val(doc_log_id);
        $(".modal-body #doc_category").val(doc_cat);
        $('#forward_modal').modal('show');
    });

    $('#form_forward').submit(function (event){
        if (confirm('DO YOU REALLY WANT TO SUBMIT THE FORM?')) {
            $('#btn_forward').prop('disabled',true).html('Sending...');
            $('input[type=text], input[type=button], input[type=date], input[type=time], input[type=file]').prop('readonly',true);
            $('select').attr('readonly','readonly');
            $('button').attr('disabled','disabled');
            return true;
        } else {
            event.preventDefault();
        }
    });

</script>