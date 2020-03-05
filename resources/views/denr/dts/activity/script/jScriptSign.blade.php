<script type="text/javascript">

    $(document).ready(function() {
        $('.btn-sign').on('click', function() {
            $('#sign_modal').modal('show');
            var refcode = $(this).attr('data-id');
            $(".modal-body #com_name").html(refcode);
            $(".modal-footer #com_id").val(refcode);                                          
        });
    });

</script>