<div id="signModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 100px; width: 450px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: #F00;"><i class="fa fa-pencil-square"></i> Sign Confirmation</h4>
            </div>
            <div class="modal-body" style="padding: 30px 25px 30px 25px; text-align: center;">
                                    
                Are you sure you want to sign Document ( <b id="com_name"></b> ) ?
                                               
            </div>
            <div class="modal-footer">

                {{Form::open(array('action'=>'denr\dts\activity\DocumentTrackingController@DocumentSign'))}}

                    <input type="hidden" id="com_id" name="com_id" value="" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right; margin-left:10px;'>No</button>
                    <input type='submit' name='sign' value='Yes' class='btn btn-success' style='width:50px; height:30px; padding:2px 2px 2px 2px; float:right;'/>
                                                    
                {{Form::close()}}

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {

        $('.btn-sign').on('click', function() {
                                                    
            $('#signModal').modal('show');
            var refcode = $(this).attr('data-id');
            $(".modal-body #com_name").html(refcode);
            $(".modal-footer #com_id").val(refcode);                                          
        });
    });

</script>