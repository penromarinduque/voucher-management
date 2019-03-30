            
<script type="text/javascript">

    $('#btn-outsider-sender1').click(function(){

        $('#sender_type_1_input').show();
        $('#sender_type_1_input').attr('disabled', false);
        $('#sender_type_2_input').hide();
        $('#sender_type_2_input').attr('disabled', true);
        $('#sender_type_1_input').val("");

        $('#sender_type_1_hidden').val('OUT');

    });

    $('#btn-others-sender1').click(function(){

        $('#sender_type_1_input').hide();
        $('#sender_type_1_input').attr('disabled', true);
        $('#sender_type_2_input').show();
        $('#sender_type_2_input').attr('disabled', false);
        $('#sender_type_2_input').val("");

        $('#sender_type_1_hidden').val('IN');

    });

    function outSiderBtn(n){

        $('#sender_type_1'+n+'_input').show();
        $('#sender_type_1'+n+'_input').attr('disabled', false);
        $('#sender_type_2'+n+'_input').hide();
        $('#sender_type_2'+n+'_input').attr('disabled', true);

        $('#sender_type_1'+n+'_hidden').val('OUT');

    }

    function OthersBtn(n){

        $('#sender_type_1'+n+'_input').hide();
        $('#sender_type_1'+n+'_input').attr('disabled', true);
        $('#sender_type_2'+n+'_input').show();
        $('#sender_type_2'+n+'_input').attr('disabled', false);

        $('#sender_type_1'+n+'_hidden').val('IN');

    }

    $('#btn-add-sender').click(function(){
        
        var numRowSender = $('.btn-panel-sender').length + 1;
        var removeGroup = 'SenderGroup'+numRowSender;

        var newSenderRow = '<tr class="btn-panel-sender">'
                            +'<td></td>'
                            +'<td style="padding: 0px; ">'
                                +'<select id="sender_type_2'+numRowSender+'_input" class="form-control" name="doc_from[]" style="height: 33px; width: 76%; float: left; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="top" title="Sender" required>'
                                    +'<option value=""> Select Insider </option>'+
                                    @foreach($addresee_list as $addresee_item)
                                    '<option value="{{$addresee_item->id}}">{{$addresee_item->fname}} {{$addresee_item->lname}}</option>'+
                                    @endforeach
                                +'</select>'
                                +'<input type="text" name="doc_from[]" class="form-control"  id="sender_type_1'+numRowSender+'_input" placeholder="Input Outsider" style="height: 33px; width: 76%; float: left; font-size: 12px; border-radius: 0px;display:none;" data-toggle="tooltip" data-placement="top" title="Sender" required  disabled>'
                                +'<input type="hidden" name="sender_type[]" value="IN" id="sender_type_1'+numRowSender+'_hidden" >'
                                +'<button class="btn btn-default btn-sm pull-left" type="button" id="btn-others-sender'+numRowSender+'" onclick=OthersBtn("'+numRowSender+'") data-toggle="tooltip" data-placement="top" title="Insider" style="font-size: 16px; width: 8%;  height:33px; float: left; color:blue; border-radius:0px;" ><i class="fa fa-sign-in"></i> </button>'
                                +'<button class="btn btn-default btn-sm pull-left" type="button" id="btn-outsider-sender'+numRowSender+'" onclick=outSiderBtn("'+numRowSender+'") data-toggle="tooltip" data-placement="top" title="Outsider" style="font-size: 16px; width: 8%; float: left; height:33px; color:green; border-radius:0px;"><i class="fa fa-sign-out"></i> </button>'
                                +'<button class="btn btn-default btn-sm pull-left" type="button" id="btn-remove-sender'+numRowSender+'" onclick="removeSenderRow(this)" data-toggle="tooltip" data-placement="top" title="" style=" font-size: 16px; width: 8%; height:33px; float: left; color:#F00; border-radius:0px;"><i class="fa fa-times "></i> </button>'
                            +'</td>'
                            +'<td colspan="2"></td>'
                           +'</tr>';

        $(newSenderRow).insertAfter('.add_sender_rows_here');

    });

    function removeSenderRow(btn){

        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);

    }

</script>

<script type="text/javascript">
    
    $(document).ready(function() {

        $('#doc_cat').on('change', function() {
                                    
            var category = $('#doc_cat').val();

            $.ajax ({

                type: "GET",
                url: "{{ route('ajax.get.doc.no') }}",
                dataType:'JSON',
                success:'success',
                data: { category : category },
                success: function(data)
        
                {
                    $('#doc_no').val(data.doc_no);
                    $('#formid').val(data.form_id);
                    $('#neworder_no').val(data.new_no);
                }

            });

        });

    });


</script>

<!-- <script type="text/javascript">
    $("#doc_type").change(function(){

        var id = $("#doc_type").val();

        $.ajax ({

            type: "GET",
            url: "{{ route('ajax.get.doc.no') }}",
            cache: false,
            data: { id : id },
            success: function(data)
        
            {
               $("#doc_no").attr("readonly", false); 
               $("#doc_no").val(data);
               $("#doc_no").attr("readonly", true); 
            } 


        });

    });
</script> -->