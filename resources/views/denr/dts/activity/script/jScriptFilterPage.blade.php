<script type="text/javascript">
    
    $(document).on('click','.def-link .pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        filterPage(page);
    });

    function filterPage(page) {

        var category = $("#category_id").val();
        var dataString = 'page='+ page +'&category='+ category;

        $.ajax ({
            type: "GET",
            url: "{{ route('dts.document.page') }}",
            data: dataString,
            cache: false,
            success: function(html) { 
                $('#div_post_data').empty();
                $('#div_post_data').html(html); 
            }, 

            complete: function() { 
                 
            }
        });
    }

</script>