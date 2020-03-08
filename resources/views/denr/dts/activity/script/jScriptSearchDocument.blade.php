<script type="text/javascript">

    $(document).on('click','.search-link .pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        searchData(page);
    });

    function searchDataEnter() {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            searchData(1);
        }
    }

    function searchData(page) {

        var search_doc = $("#search_doc").val();
        var category_id = $("#category_id").val();
        var dataString = 'page='+ page +'&search_doc='+ search_doc+'&doc_cat='+ category_id;

        $.ajax ({
            type: "GET",
            url: "{{ route('dts.document.search') }}",
            data: dataString,
            cache: false,
            success: function(html) {
                $('#div_post_data').empty();
                $('#div_post_data').html(html); 
            },
        });
    }

</script>