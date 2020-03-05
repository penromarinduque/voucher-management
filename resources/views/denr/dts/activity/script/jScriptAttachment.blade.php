<script type="text/javascript">

    $(document).ready(function() {

        $('.btn-log-attachment').on('click', function() {
                                    
            $('#log_attachment_modal').modal('show');

            var log_id = $(this).attr('data-id');
            var forward_no = $(this).attr('data-id2');
            var doc_no = $(this).attr('data-id3');
            var doc_to = $(this).attr('data-id4');

            $(".modal-header #attach_title").html(doc_no);

            $('.attach-files').remove();

            $.ajax ({

                type: "GET",
                url: "{{ route('ajax.log.attachment') }}",
                dataType:'JSON',
                success:'success',
                data: { log_id : log_id, forward_no : forward_no, doc_no : doc_no, doc_to : doc_to, },
                success: function(data)
        
                {

                    $header = $('<tr style="background-color:#FFF;">'
                                    +'<td style="width:5%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: right;">No.</td>'
                                    +'<td style="width:20%; font-size: 11px; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: left;">Attachment</td>'
                                    +'<td style="width:53%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Description</td>'
                                    +'<td style="width:15%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Type</td>'
                                    +'<td style="width:7%; font-size: 11px; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: left;">Action</td>'
                                +'</tr>');

                    $('#attach_header').html($header);
                    
                    $.each(data.attachments, function(i,index) {

                        var no = i+1;

                        if(index.FILE_TYPE == 'jpg' || index.FILE_TYPE == 'JPEG' || index.FILE_TYPE == 'png' || index.FILE_TYPE == 'PNG' || index.FILE_TYPE == 'gif' || index.FILE_TYPE == 'GIF' || index.FILE_TYPE == 'io') {

                            var file_type = 'Image File';
                            var file_icon = '<i class="fa fa-file-image-o"></i>';
                            var file_view = '';
                            var display = '';
                            var displax = 'display:none;';
                            var preview = 'Preview';

                        } else if(index.FILE_TYPE == 'pdf') {

                            var file_type = 'Pdf File';
                            var file_icon = '<i class="fa fa-file-pdf-o"></i>';
                            var file_view = '';
                            var display = '';
                            var displax = 'display:none;';
                            var preview = 'Preview';

                        } else if(index.FILE_TYPE == 'docx') {

                            var file_type = 'Word File';
                            var file_icon = '<i class="fa fa-file-word-o"></i>';
                            var file_view = 'disabled';
                            var display = 'display:none;';
                            var displax = '';
                            var preview = 'Preview not available';

                        } else if(index.FILE_TYPE == 'xlsx' || index.FILE_TYPE == 'csv') {

                            var file_type = 'Excel File';
                            var file_icon = '<i class="fa fa-file-excel-o"></i>';
                            var file_view = 'disabled';
                            var display = 'display:none;';
                            var displax = '';
                            var preview = 'Preview not available';

                        } else if(index.FILE_TYPE == 'csv') {

                            var file_type = 'Csv File';
                            var file_icon = '<i class="fa fa-file-excel-o"></i>';
                            var file_view = 'disabled';
                            var display = 'display:none;';
                            var displax = '';
                            var preview = 'Preview not available';

                        } else if(index.FILE_TYPE == 'pptx') {

                            var file_type = 'Powerpoint File';
                            var file_icon = '<i class="fa fa-file-powerpoint-o"></i>';
                            var file_view = 'disabled';
                            var display = 'display:none;';
                            var displax = '';
                            var preview = 'Preview not available';

                        } else if(index.FILE_TYPE == 'mp4') {

                            var file_type = 'Video File';
                            var file_icon = '<i class="fa fa-file-video-o"></i>';
                            var file_view = '';
                            var display = '';
                            var displax = 'display:none;';
                            var preview = 'Preview';

                        } else if(index.FILE_TYPE == 'txt') {

                            var file_type = 'Text File';
                            var file_icon = '<i class="fa fa-file-text-o"></i>';
                            var file_view = 'disabled';
                            var display = 'display:none;';
                            var displax = '';
                            var preview = 'Preview not available';

                        } else {

                            var file_type = 'Other File';
                            var file_icon = '<i class="fa fa-file-code-o"></i>';
                            var file_view = 'disabled';
                            var display = 'display:none;';
                            var displax = '';
                            var preview = 'Preview not available';


                        }

                        //////////////////////////////////////////

                        $row = $('<tr class="attach-files">'
                                    +'<td style="text-align:right;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">'+ no +'</td>'
                                    +'<td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">'+ index.FILE_ATTACHMENT +'</td>'
                                    +'<td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">'+ index.ATTACHMENT_DESC +'</td>'
                                    +'<td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">'+ file_type +'</td>'
                                    +'<td style="padding: 0px; text-align: left; vertical-align: middle;">'
                                        +'<a href="{{url("/dts/activity/document/download/")}}/'+ index.FILE_ATTACHMENT +'/'+ data.log_id +'/'+ data.doc_to +'" class="btn-download btn btn-default" data-id="" data-toggle="tooltip" data-placement="top" title="Download" style="font-size: 12px; color: green; border-radius: 2px; width: 50%; float: left; "><i class="fa fa-download"></i></a>'
                                        +'<a href="{{url("/dts/activity/document/preview/")}}/'+ index.ID +'/'+ data.log_id +'/'+ file_type +'/'+ data.doc_to +'" target="_blank" class="btn-preview btn btn-default" data-id="" data-toggle="tooltip" data-placement="top" title="'+ preview +'" style="font-size: 15px; color: #000; border-radius: 2px; width: 50%; float: left; padding:4px 0px 4px 0px; '+ display +'" '+ file_view +'>'+ file_icon +'</a>'
                                        +'<a class="btn-preview btn btn-default" data-id="" data-toggle="tooltip" data-placement="top" title="'+ preview +'" style="font-size: 15px; color: #BABABA; border-radius: 2px; width: 50%; float: left; padding:4px 0px 4px 0px;'+ displax +'">'+ file_icon +'</a>'
                                    +'</td>'
                                 +'</tr>');

                        $('#attach_content').append($row);
                
                    });
   
                }
                        
            });
                                                        
        });

    });

</script>