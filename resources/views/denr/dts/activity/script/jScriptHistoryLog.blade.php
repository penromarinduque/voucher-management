<script type="text/javascript">
	
	$(document).ready(function() {

        $('.btn-history').on('click', function() {
            $('#history_modal').modal('show');
            var doc_no = $(this).attr('data-id');
            $(".modal-header #history_title").html(doc_no);
            $('.log-history').remove();

            $.ajax ({
                type: "GET",
                url: "{{ route('ajax.history.logs') }}",
                dataType:'JSON',
                success:'success',
                data: { doc_no : doc_no },
                success: function(data)
                {
                    $header = $('<tr style="background-color:#F0FFF0;">'
                                    +'<td style="width:3%; font-size: 11px; vertical-align:middle; color: #5B5B5B; text-transform: uppercase;font-weight: bold;  text-align: center;"><i class="fa fa-bell"></i></td>'
                                    +'<td style="width:14%; font-size: 11px; vertical-align:middle; color: #5B5B5B; text-transform: uppercase;font-weight: bold; padding-left:15px; text-align: left;">Document From</td>'
                                    +'<td style="width:14%; font-size: 11px; vertical-align:middle; color: #5B5B5B; text-transform: uppercase;font-weight: bold; padding-left:15px; text-align: left;">Document To</td>'
                                    +'<td style="width:8%; font-size: 11px; vertical-align:middle; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: center;">Received</td>'
                                    +'<td style="width:10%; font-size: 11px; vertical-align:middle; color: #5B5B5B; text-transform: uppercase; font-weight: bold; text-align: center;">Released</td>'
                                    +'<td style="width:10%; font-size: 11px; vertical-align:middle; color: #5B5B5B; text-transform: uppercase;font-weight: bold; padding-left:15px; text-align: left;">Runtime</td>'
                                    +'<td style="width:32%; font-size: 11px; vertical-align:middle; color: #5B5B5B; text-transform: uppercase;font-weight: bold; padding-left:15px; text-align: left;">Action to be Taken / Remarks</td>'
                                    +'<td style="width:7%; font-size: 11px; vertical-align:middle; color: #5B5B5B; text-transform: uppercase;font-weight: bold; text-align: center;">Action</td>'
                                +'</tr>');

                    $('#log_header').html($header);

                    $.each(data.history, function(i,index) {

                        var no = i+1;

                        if(index.SEEN == 'Y') { 
                            var seen = 'Yes'; 
                            var bg = '#00CD00'; 
                            var title = 'Seen';

                        } else if(index.SEEN == 'N') { 
                            var seen = 'No';
                            var bg = '#F00'; 
                            var title = 'Unseen'; 
                        }

                        if(index.DOC_TO == <?php echo $user->id ?>) {
                            if(index.SEEN == 'N') { var form_stat = 'inline'; } 
                            else if(index.SEEN == 'Y') { var form_stat = 'none'; }
                        } else { var form_stat = 'none'; }

                        if(index.FW_NO == 1) { var sender_class = 'sender_1'; } 
                        else if(index.FW_NO > 1) { var sender_class = 'sender_'+ no; }

                        if(index.ACTION_STATUS == 0) { var action_status = ''; } 
                        else if(index.ACTION_STATUS == 1) { var action_status = 'display:none;'; }

                        var date1, date2;  

                        date1 = new Date(index.REC_DATE_TIME);
                        date2 = new Date(index.REL_DATE_TIME);
                        var res = Math.abs(date1 - date2) / 1000;
                        var days = Math.floor(res / 86400);       
                        var hours = Math.floor(res / 3600) % 24;        
                        var minutes = Math.floor(res / 60) % 60;
                        var seconds = res % 60;

                        if(days > 0) {
                            if(days > 1) { var con_days = days + ' days, '; } 
                            else if(days == 1) { var con_days = days + ' day, '; }
                        } else if(days == 0) { var con_days = ''; }

                        if(hours > 0) {
                            if(hours > 1) { var con_hours = hours + ' hrs. '; } 
                            else if(hours == 1) { var con_hours = hours + ' hr. '; }
                        } else if(hours == 0) { var con_hours = ''; }

                        if(minutes > 0) {
                            if(minutes > 1) {
                                if(hours > 0) { var con_minutes = ' & ' + minutes + ' mins. '; } 
                                else if(hours == 0) { var con_minutes = minutes + ' mins. '; }
                            } else if(minutes == 1) {
                                if(hours > 0) { var con_minutes = ' & ' + minutes + ' min. '; } 
                                else if(hours == 0) { var con_minutes = minutes + ' min. '; }
                            }
                        } else if(minutes == 0) { var con_minutes = ''; }

                        var time_consumed = con_days + '' + con_hours + '' + con_minutes;

                        ///////////////////////////////////////////////////////////////////////

                        var new_date1, new_date2;  

                        new_date1 = new Date(index.SEEN_DATE_TIME);
                        new_date2 = new Date(<?php date('Y-m-d H:i:s'); ?>);
                        var new_res = Math.abs(new_date1 - new_date2) / 1000;
                        var new_days = Math.floor(new_res / 86400);       
                        var new_hours = Math.floor(new_res / 3600) % 24;        
                        var new_minutes = Math.floor(new_res / 60) % 60;
                        var new_seconds = new_res % 60;

                        if(new_days > 0) {
                            if(new_days > 1) { var new_con_days = new_days + ' days, '; } 
                            else if(new_days == 1) { var new_con_days = new_days + ' day, '; }
                        } else if(new_days == 0) { var new_con_days = ''; }

                        if(new_hours > 0) {
                            if(new_hours > 1) { var new_con_hours = new_hours + ' hrs. '; } 
                            else if(new_hours == 1) { var new_con_hours = new_hours + ' hr. '; }
                        } else if(new_hours == 0) { var new_con_hours = ''; }

                        if(new_minutes > 0) {
                            if(new_minutes > 1) {
                                if(new_hours > 0) { var new_con_minutes = ' & ' + new_minutes + ' mins. '; } 
                                else if(new_hours == 0) { var new_con_minutes = new_minutes + ' mins. '; }
                            } else if(new_minutes == 1) {
                                if(new_hours > 0) { var new_con_minutes = ' & ' + new_minutes + ' min. '; } 
                                else if(new_hours == 0) { var new_con_minutes = new_minutes + ' min. '; }
                            }
                        } else if(new_minutes == 0) { var new_con_minutes = ''; }

                        var new_time_consumed = new_con_days + '' + new_con_hours + '' + new_con_minutes;

                        if(index.DOC_REMARKS != null) { var doc_remarks = index.DOC_REMARKS; } 
                        else { var doc_remarks = ''; }

                        if(index.SEEN_DATE_TIME != null) {
                            var rec_date = formatDate(index.SEEN_DATE_TIME);
                            var rec_time = formatTime(index.SEEN_DATE_TIME);
                            var run_time = new_time_consumed;
                        } else {
                            var rec_date = '';
                            var rec_time = '';
                            var run_time = '';
                        }

                        if(index.ACTION == 13) {
                            var new_action = '';
                        } else {
                            var new_action = index.ACTION;
                        }

                        //////////////////////////////////////////

                        $row = $('<tr class="log-history" style="background-color:#FFF;">'
                                    +'<td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">'
                                        +'<div style="width: 10px; height: 10px; border-radius:20px; background: '+ bg +'; margin: auto;" data-toggle="tooltip" data-placement="left" title="'+ title +' ('+ formatDate(index.SEEN_DATE_TIME) +' '+ formatTime(index.SEEN_DATE_TIME) +')"></div>'
                                    +'</td>'
                                    +'<td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">'
                                        +'<ul class="'+ sender_class +'" style="padding-left: 20px; margin-bottom: 0px;">'
                                        +'</ul>'
                                    +'</td>'
                                    +'<td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">'
                                        +'<ul style="padding-left: 20px; margin-bottom: 0px;">'
                                            +'<li>'+ index.to_fname +' '+ index.to_lname +'</li>'
                                        +'</ul>'
                                    +'</td>'
                                    +'<td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">'+ formatDate(index.REC_DATE_TIME) +'<br/>'+ formatTime(index.REC_DATE_TIME) +'</td>'
                                    +'<td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">'+ formatDate(index.REL_DATE_TIME) +'<br/>'+ formatTime(index.REL_DATE_TIME) +'</td>'
                                    +'<td style="text-align:left;padding:4px 7px 4px 15px;vertical-align:middle;font-size:12px;">'+ time_consumed +'</td>'
                                    +'<td style="text-align:left;padding:4px 7px 4px 15px;vertical-align:middle;font-size:12px;">'+ new_action +' '+ doc_remarks +'</td>'
                                    +'<td style="padding: 0px; text-align: center; vertical-align: middle;">'
                                        +'<a href="javascript:void(0)" class="btn-log-attachment btn btn-default" data-id="'+ index.ID +'" data-id2="'+ index.FW_NO +'" data-id3="'+ index.DOC_NO +'" data-id4="'+ index.DOC_TO +'" data-toggle="tooltip" data-placement="top" title="Attachments" style="font-size: 12px; color: #09C; border-radius: 2px; width: 50%; float: left; "><i class="glyphicon glyphicon-paperclip"></i></a>'
                                        +'{{Form::open(array("action"=>"denr\dts\activity\DocumentTrackingController@seen"))}}'
                                            +'<input type="hidden" name="log_id" value="'+ index.ID +'">'
                                            +'<button type="submit" class="btn btn-default" data-id="" data-toggle="tooltip" data-placement="top" title="Seen?" style="font-size: 12px; color: green; border-radius: 2px; width: 50%; float: left; display:'+ form_stat +';"><i class="fa fa-check"></i></button>'
                                        +'{{Form::close()}}'
                                    +'</td>'
                                 +'</tr>'
                                 +'<tr class="log-history" style="background-color:#FFF;'+ action_status +'">'
                                    +'<td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;"></td>'
                                    +'<td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">'
                                        +'<ul style="padding-left: 20px; margin-bottom: 0px;">'
                                            +'<li>'+ index.to_fname +' '+ index.to_lname +'</li>'
                                        +'</ul>'
                                    +'</td>'
                                    +'<td style="text-align:left;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;"></td>'
                                    +'<td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;">'+ rec_date +'<br/>'+ rec_time +'</td>'
                                    +'<td style="text-align:center;padding:4px 7px 4px 7px;vertical-align:middle;font-size:12px;"></td>'
                                    +'<td style="text-align:left;padding:7px 7px 7px 15px;vertical-align:middle;font-size:12px;">'+ run_time +'</td>'
                                    +'<td style="text-align:left;padding:7px 7px 7px 15px;vertical-align:middle;font-size:12px;">Pending / No Action Taken</td>'
                                    +'<td style="padding: 0px; text-align: center; vertical-align: middle;"></td>'
                                 +'</tr>');

                        $('#log_content').append($row);

                        if(index.FW_NO > 1) {
                            $('.sender_'+ no).html('<li>'+ index.from_fname +' '+ index.from_lname +'</li>');
                        }
                    });


                    $.each(data.doc_sender, function(i,index2) {

                        if(index2.SENDER_TYPE == 'IN') {
                            $row = $('<li>'+ index2.fname +' '+ index2.lname +'</li>');
                        } else if(index2.SENDER_TYPE == 'OUT') {
                            $row = $('<li>'+ index2.fname +'</li>');
                        }

                        $('.sender_1').append($row);
                    });


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
                }
            });
        });
    });

</script>