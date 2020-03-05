<script type="text/javascript">

    $("#btn-add-addresee").click(function(){
        var numRowReceiver = $('.btn-panel-addresee').length + 1;
        var newReceiverRow = '<tr class="btn-panel-addresee">'
                                +'<td style="font-size: 11px; color: #5B5B5B; text-align: right; text-transform: uppercase; ">'
                                    +'<font style="color: #F00;"></font>'
                                +'</td>'
                                +'<td style="padding: 0px;" colspan="4" id="ReceiverGroup1">'
                                    +'<select class="form-control" name="doc_to[]" style="height: 33px; float:left; width:50%; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Addressee">'
                                        +'<option value="">Select Addressee</option>'
                                        @foreach($addresee_list as $addresee_item)
                                            +'<option value="{{$addresee_item->id}}">{{$addresee_item->fname}} {{$addresee_item->lname}}</option>'
                                        @endforeach
                                    +'</select>'
                                    +'<select class="form-control" name="doc_action[]" style="height: 33px; float:left; width:50%; font-size: 12px; border-radius: 0px;" data-toggle="tooltip" data-placement="left" title="Action to be Taken">'
                                        +'<option value="">Select Action to be Taken</option>'
                                        @foreach($doc_action as $doc)
                                            +'<option value="{{$doc->ID}}">{{$doc->ACTION}}</option>'
                                        @endforeach
                                    +'</select>'
                                +'</td>'
                                +'<td style="padding: 0; text-align: center;" colspan="2">'
                                    +'<button class="btn btn-default" type="button" id="btn-remove-addresee" onclick="removeReceiverRow(this)" style=" font-size: 12px; width: 100%; height:33px; color:#F00;"><i class="fa fa-times "></i></button>'
                                +'</td>'
                            +'</tr>';

        $(newReceiverRow).insertAfter('.add_receiver_rows_here');
    });

    function removeReceiverRow(btn){
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

</script>