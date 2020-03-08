<script type="text/javascript">

    $(document).ready(function() {
        $('.btn-filter').on('click', function() {
            var doc_title = $(this).attr('data-id');
            var doc_cat = $(this).attr('data-id2');
            $(".modal-header #doc_title").html(doc_title);
            $(".modal-body #doc_cat").val(doc_cat);
            $('#doc_filter_modal').modal('show');
        });
    });

    $(document).on('click','.filter-link .pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        filterData(page);
    });

    function filterData(page) {

        var doc_cat = $("#doc_cat").val();
        var doc_from = $("#doc_from").val();
        var doc_to = $("#doc_to").val();
        var doc_type = $("#doc_type").val();
        var doc_class = $("#doc_class").val();
        var doc_urgent = $("#doc_urgent").val();
        var doc_status = $("#doc_status").val();
        var doc_signed = $("#doc_signed").val();

        var dataString = 'page='+ page +'&doc_cat='+ doc_cat+'&doc_from='+ doc_from+'&doc_to='+ doc_to+'&doc_type='+ doc_type+'&doc_class='+ doc_class+'&doc_urgent='+ doc_urgent+'&doc_status='+ doc_status+'&doc_signed='+ doc_signed;

        $.ajax ({
            type: "GET",
            url: "{{ route('dts.document.filter') }}",
            data: dataString,
            cache: false,
            success: function(html) {
                $('#div_post_data').empty();
                $('#div_post_data').html(html); 
            },

            complete: function() { 
                $('#doc_filter_modal').modal('hide');
            } 
        });
    }

</script>