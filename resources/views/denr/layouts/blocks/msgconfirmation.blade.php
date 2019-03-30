<div id="FailedModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 100px; width: 30%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: #F00;"><i class="fa fa-warning"></i> Submission Failed</h4>
            </div>
            <div class="modal-body" style="padding: 15px; text-align: left; color: #000; ">
                <div style="padding: 20px 0px 10px 0px; text-align: left; font-size: 14px; color: #000; background-color: #FFFAFA; border-radius: 3px; border: 1px solid #E5E5E5;">
                    <ol style="list-style-type: none; line-height: 30px; padding: 0px 20px 0px 25px;">
                        @foreach ($errors->all() as $error)
                            <li><i class="fa fa-angle-double-right"></i> {{ $error }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div id="SuccessModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 100px; width: 30%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: #228B22;"><i class="fa fa-check"></i> Success</h4>
            </div>
            <div class="modal-body" style="padding: 15px; text-align: left; color: #000; ">
                <div style="padding: 20px 20px 20px 25px; text-align: left; font-size: 14px; color: #000; background-color: #F0FFF0; border-radius: 3px; border: 1px solid #E5E5E5;">
                    <i class="fa fa-angle-double-right"></i> {{ Session::get('success') }}
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div id="WarningModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 100px; width: 30%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: #F00;"><i class="fa fa-warning"></i> System Warning</h4>
            </div>
            <div class="modal-body" style="padding: 15px; text-align: left; color: #000; ">
                <div style="padding: 20px 20px 20px 25px; text-align: left; font-size: 14px; color: #000; background-color: #FFFAFA; border-radius: 3px; border: 1px solid #E5E5E5;">
                    <i class="fa fa-angle-double-right"></i> {{ Session::get('failed') }}
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    @if (count($errors) > 0)

    $(document).ready(function() {

        $('#FailedModal').modal('show');

    });
    
    @endif


    @if(Session::has('success'))

    $(document).ready(function() {

        $('#SuccessModal').modal('show');

    });

    @endif

    @if(Session::has('failed'))

    $(document).ready(function() {

        $('#WarningModal').modal('show');

    });

    @endif

</script>