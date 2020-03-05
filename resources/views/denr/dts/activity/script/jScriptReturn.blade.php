<script type="text/javascript">
    
    $('.btn-return').on('click', function() {
        var doc_no = $(this).attr('data-id');
        $(".modal-header #doc_no_title").html(doc_no);
        $(".modal-body #doc_no").val(doc_no);
        $('#return_modal').modal('show');
    });

</script>