    
    <div id="FilterTravelOrderModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="margin-top: 100px; width: 1050px;">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #09C;"><i class="fa fa-search"></i> Filter Travel Order</h4>
                </div>
                <div class="modal-body" style="padding: 30px 25px 30px 25px; text-align: center;">
                                        
                      <div class="panel panel-default">
                                <table class="table table-striped table-bordered table-hover tooltip-demo">
                                    <tr>
                                         <td colspan="8" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; "><i class="fa fa-search-plus fa-fw"></i> FILTER AUDIT TRAIL LOG<a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100px; font-size: 12px; color: #5B5B5B; text-align: right; "> User</td>
                                        <td style="padding: 0px;">
                                            <select name="user_id" id="user_id" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; ">
                                                <option value=""> Select User</option>
                                                @foreach($users as $id => $col)
                                                <option value="{{ $col['id'] }}" @if(old('user_id') == $col['id']) selected @endif >{{ $col['fname'] }} {{ $col['mname'] }} {{ $col['lname'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width: 100px; font-size: 12px; color: #5B5B5B; text-align: right; "> Date From</td>
                                        <td style="padding: 0px;" ><input type="date" name="date_from" value="{{ old('date_from') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " ></td>
                                        <td style="width: 100px; font-size: 12px; color: #5B5B5B; text-align: right; "> Date To</td>
                                        <td style="padding: 0px;" ><input type="date" name="date_to" value="{{ old('date_to') }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; " ></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100px; font-size: 12px; color: #5B5B5B; text-align: right; "> Action Type</td>
                                        <td style="padding: 0px;">
                                            <select name="action_type" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" >
                                                <option value=""> Select Action Type</option>
                                                <option value="ADD"  @if(old('action_type') == 'ADD') selected @endif> Add/Enter </option>
                                                <option value="EDIT"  @if(old('action_type') == 'EDIT') selected @endif> Edit/Update/Modify </option>
                                                <option value="DELETE"  @if(old('action_type') == 'DELETE') selected @endif> Delete/Remove </option>
                                                <option value="APPROVE"  @if(old('action_type') == 'APPROVE') selected @endif> Approve </option>
                                                <option value="RECOMMEND"  @if(old('action_type') == 'RECOMMEND') selected @endif> Recommend </option>
                                                <option value="LOGIN"  @if(old('action_type') == 'LOGIN') selected @endif> Login </option>
                                                <option value="LOGOUT"  @if(old('action_type') == 'LOGOUT') selected @endif> Logout </option>
                                            </select>
                                        </td>
                                        <td style="width: 100px; font-size: 12px; color: #5B5B5B; text-align: right; "> Module Code</td>
                                        <td style="padding: 0px;">
                                            <select name="module_code" id="module_code" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; ">
                                                <option value=""> Select Module Code</option>
                                                <option value="PIS" @if(old('module_code') == 'PIS') selected @endif >PIS - Personal Information System</option>
                                            </select>
                                        </td>
                                        <td style="width: 100px; font-size: 12px; color: #5B5B5B; text-align: right; "> Form/Window</td>
                                        <td style="padding: 0px;">
                                            <select name="window_page" id="window_page" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; ">
                                                <option value=""> Select Form/Window</option>
                                                <option value="Login"> PIS - Login</option>
                                                <option value="Logout"> PIS - Logout</option>
                                                <option value="My Account"> PIS - My Account</option>
                                                <option value="Change Password"> PIS - Change Password</option>
                                                <option value="Personal Information"> PIS - Personal Information</option>
                                                <option value="Family Background"> PIS - Family Background</option>
                                                <option value="EducationalBackground"> PIS - EducationalBackground</option>
                                                <option value="Civil Service Eligibility"> PIS - Civil Service Eligibility</option>
                                                <option value="Work Experience"> PIS - Work Experience</option>
                                                <option value="Voluntary Work"> PIS - Voluntary Work</option>
                                                <option value="Learning & Development"> PIS - Learning & Development</option>
                                                <option value="Other Information"> PIS - Other Information</option>
                                                <option value="User"> PIS - User</option>
                                                <option value="Position"> PIS - Position</option>                                                    
                                                <option value="Division"> PIS - Division</option>
                                                <option value="Section"> PIS - Section</option>
                                                <option value="Unit"> PIS - Unit</option>
                                                <option value="Travel Order"> PIS - Travel Order</option>
                                                <option value="Travel Order Approval"> PIS - Travel Order Approval</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ></td>
                                        <td colspan="5">
                                            <input type="submit" name="filter" value="Filter" class="btn btn-success btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="left" title="Filter Data">
                                            <input type="reset" value="Clear" class="btn btn-danger btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="right" title="Clear Input Fields">
                                        </td>
                                    </tr>
                                </table>
                            </div>                          
                                           
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style='width:70px; height:30px; padding:2px 2px 2px 2px; float:right; margin-left:10px;'>Close</button>
                    <input type='submit' name='filter' value='Filter' class='btn btn-success' style='width:70px; height:30px; padding:2px 2px 2px 2px; float:right;'/>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function() {

            $('.btn-filter-travel-order').on('click', function() {
                                        
                $('#FilterTravelOrderModal').modal('show');
                                        
            });

        });

    </script>