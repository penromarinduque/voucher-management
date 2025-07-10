<script type="text/javascript">

    $(document).ready(function() {

        $('.btn-recall').on('click', function() {
            $('textarea').val('');                        
            $('#recall_modal').modal('show');
            var refcode = $(this).attr('data-id');
            var refcode3 = $(this).attr('data-id3');
            $(".modal-body #com_name").html(refcode);
            $(".modal-footer #com_id").val(refcode);
            $(".modal-footer #doc_cat").val(refcode3);                                          
        });

        $('.btn-recall2').on('click', function() {
            $('textarea').val('');                                  
            $('#recall_modal2').modal('show');
            var doc_log_id = $(this).attr('data-id');
            var doc_no = $(this).attr('data-id2');
            var doc_cat = $(this).attr('data-id3');
            var receiver = $(this).attr('data-id4');
            $(".modal-body #doc_no").html(doc_no);
            $(".modal-body #receiver").html(receiver);
            $(".modal-footer #doc_log_id").val(doc_log_id);
            $(".modal-footer #doc_no").val(doc_no);
            $(".modal-footer #doc_cat").val(doc_cat);                                          
        });

        $('#form_recall').submit(function (){
            $('#btn_recall').prop('disabled',true);
            $('textarea').attr('readonly','readonly');
            $('button').attr('disabled','disabled');
        });

        $('#form_recall1').submit(function (){
            $('#btn_recall1').prop('disabled',true);
            $('textarea').attr('readonly','readonly');
            $('button').attr('disabled','disabled');
        });
    });

</script>