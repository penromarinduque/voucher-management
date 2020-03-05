<script type="text/javascript">
    
    $('.btn-forward').on('click', function() {
        var doc_no = $(this).attr('data-id');
        var doc_cat = $(this).attr('data-id2');
        $(".modal-header #doc_no_title").html(doc_no);
        $(".modal-body #doc_no").val(doc_no);
        $(".modal-body #doc_category").val(doc_cat);
        $('#forward_modal').modal('show');
    });

</script>