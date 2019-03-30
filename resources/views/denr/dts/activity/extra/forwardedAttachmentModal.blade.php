            
<div id="AttachmentModal" class="modal fade" role="dialog">

    <div class="modal-dialog" id="mod_id" style="margin-top: 50px; width: 70%;">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title" style="color: #09C;"><i class="fa fa-paperclip"></i> Forwarded Attachment - Document no. (<font id="attach_title"></font>)</h5>
            </div>

            <div class="modal-body" style="padding: 0px; text-align: center; background-color: #EEE; overflow: auto; height: 550px;"> 

                <div class="panel-heading" style="padding: 5px;">

                    <table id="table1" class="table table-striped table-bordered table-hover tooltip-demo">

                        <thead id="attach_header"></thead>

                        <tbody id="attach_content"></tbody>

                    </table>

                </div>   

            </div>

        </div>

    </div>

</div>

<script type="text/javascript">

    $(document).ready(function() {

        $('.btn-attachment').on('click', function() {
                                    
            $('#AttachmentModal').modal('show');

            var doc_no = $(this).attr('data-id');

            var send_type = $(this).attr('data-id2');

            $(".modal-header #attach_title").html(doc_no);

            $('.attach').remove();

            $.ajax ({

                type: "GET",
                url: "{{ route('ajax.forwarded.attachment') }}",
                dataType:'JSON',
                success:'success',
                data: { doc_no : doc_no, send_type : send_type },
                success: function(data)
        
                {

                    $header = $('<tr style="background-color:#FFF;">'
                                    +'<td style="width:5px; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: right;">No.</td>'
                                    +'<td style="width:30%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: left;">Attachment</td>'
                                    +'<td style="width:60%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Description</td>'
                                    +'<td style="width:5%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Action</td>'
                                +'</tr>');

                    $('#attach_header').html($header);
                    
                    $.each(data.attachments, function(i,index) {

                        var no = i+1;

                        //////////////////////////////////////////

                        $row = $('<tr class="attach">'
                                    +'<td style="text-align:right;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">'+ no +'</td>'
                                    +'<td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">'+ index.FILE_ATTACHMENT +'</td>'
                                    +'<td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;"> '+ index.ATTACHMENT_DESC +'</td>'
                                    +'<td style="text-align:left;padding:0px;vertical-align:middle;font-size:12px;">'
                                        +'<a href="javascript:void(0)" class="btn-attachment btn btn-default" data-id="" data-toggle="tooltip" data-placement="top" title="View Attachment" style="font-size: 12px; color: #000; border-radius: 2px; width: 100%; "><i class="fa fa-file-text-o"></i></a>'
                                    +'</td>'
                                 +'</tr>');

                        

                        $('#attach_content').append($row);
                
                    });
   
                }
                        
            });
                                                        
        });

    });

</script>