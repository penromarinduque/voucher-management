@extends('denr.layouts.app')

@section('page-css')

@endsection

@section('page-content')

            
            <div class="row">

                @include('denr.layouts.blocks.pageloc')

            </div>

            <div class="row">
                
                <div class="col-lg-12">
                    
                    <div class="panel panel-default" style="padding-top: 12px;">
                        
                        <ul class="nav nav-tabs" style="font-size: 11px; text-transform: uppercase;">

                            <li class="active" style="margin-left: 12px;">
                                <a href="{{ route('personal.information') }}"><i class="fa fa-navicon fa-fw"></i> Personal Information</a>
                            </li>
                            
                            <li>
                                <a href="{{ route('family.background') }}"><i class="fa fa-navicon fa-fw"></i> Family Background</a>
                            </li>

                            <li>
                                <a href="{{ route('educational.background') }}"><i class="fa fa-navicon fa-fw"></i> Educational Background</a>
                            </li>

                            <li>
                                <a href="{{ route('civil.service.eligibility') }}"><i class="fa fa-navicon fa-fw"></i> Civil Service Eligibility</a>
                            </li>

                            <li>
                                <a href="{{ route('work.experience') }}"><i class="fa fa-navicon fa-fw"></i> Work Experience</a>
                            </li>

                            <li style="float: right; margin-right: 12px;">
                                <a href="{{ route('voluntary.work') }}"><i class="fa fa-angle-double-right fa-fw"></i> Next</a>
                            </li>

                        </ul>

                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-lg-12">
                                    
                                    {{Form::open(array('action'=>'denr\pis\activity\PersonalInformationController@AddPersonalInfo'))}}

                                         <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td colspan="6" style="width:150px; font-weight:100; font-size: 11px; color: #5B5B5B; padding: 10px; "><i class="fa fa-pencil-square fa-fw"></i> PERSONAL INFORMATION <a href="#" title="Help" data-container="body" data-toggle="popover" data-placement="left" data-content="Add instruction here... " style="float: right; "><i class="fa fa-question-circle"></i> Help</a></td>
                                                </tr>
                                            </table>

                                        </div>

                                        <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; font-weight: bold; color: #5B5B5B; text-align: right; "><i class="fa fa-angle-double-down fa-fw"></i> PROFILE</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px; font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> SURNAME</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="lname" value="{{ $user['lname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('lname')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('lname'))Surname is required @else Company Code @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> FIRST NAME</td>
                                                    <td style="padding: 0px;"><input type="text" name="fname" value="{{ $user['fname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('fname')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('fname'))First Name is required @else Company Name @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "> EXT. NAME (Jr.,Sr.)</td>
                                                    <td style="padding: 0px;" ><input type="text" name="xname" value="{{ $user['xname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Extension Name"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> MIDDLE NAME</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="mname" value="{{ $user['mname'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('mname')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('mname'))Middle Name is required @else Short Name @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> BIRTH DATE</td>
                                                    <td style="padding: 0px;" ><input type="date" name="bdate" value="{{ $info['birth_date'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('bdate')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('bdate'))Birth Date is required @else Birth Date @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> BIRTH PLACE</td>
                                                    <td style="padding: 0px;" ><input type="text" name="bplace" value="{{ $info['birth_place'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('bplace')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('bplace'))Birth Place is required @else Birth Place @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> GENDER</td>
                                                    <td style="padding: 0px;" >
                                                        <select name="sex" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('sex')) border-color: #F08080;  box-shadow: none; @endif " data-toggle="tooltip" data-placement="left" title="Required" >
                                                            <option value=""> @if($errors->has('sex')) Please Select Gender @else Select Gender @endif </option>
                                                            <option value="M"  @if($info['sex'] == 'M')  selected  @endif> Male </option>
                                                            <option value="F"  @if($info['sex'] == 'F') selected  @endif> Female </option>
                                                        </select>
                                                    </td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> CIVIL STATUS</td>
                                                    <td style="padding: 0px;">
                                                        <select name="civil_status" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('civil_status')) border-color: #F08080;  box-shadow: none; @endif " data-toggle="tooltip" data-placement="left" title="Required" >
                                                            <option value=""> @if($errors->has('civil_status')) Please Select Civil Status @else Select Civil Status @endif </option>
                                                            <option value="Single"  @if($info['civil_status'] == 'Single')  selected  @endif> Single </option>
                                                            <option value="Married"  @if($info['civil_status'] == 'Married') selected  @endif> Married </option>
                                                            <option value="Widowed"  @if($info['civil_status'] == 'Widowed') selected  @endif> Widowed </option>
                                                            <option value="Seperated"  @if($info['civil_status'] == 'Seperated') selected  @endif> Seperated </option>
                                                            <option value="Others"  @if($info['civil_status'] == 'Others') selected  @endif> Others </option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> HEIGHT (m)</td>
                                                    <td style="padding: 0px;" ><input type="number" name="height_m" value="{{ $info['height'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('height_m')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('height_m'))Height is required @else Height @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> WEIGHT (kg)</td>
                                                    <td style="padding: 0px;"><input type="number" name="weight_kg" value="{{ $info['weight'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('weight_kg')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('weight_kg'))Weight is required @else Weight @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> BLLOD TYPE</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="blood_type" value="{{ $info['blood_type'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('blood_type')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('blood_type'))Blood Type required @else Blood Type @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> GSIS NO.</td>
                                                    <td style="padding: 0px;"><input type="text" name="gsis_no" value="{{ $info['gsis_no'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('gsis_no')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('gsis_no'))GSIS No. required @else GSIS No. @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> PAGIBIG NO.</td>
                                                    <td style="padding: 0px;"><input type="text" name="pagibig_no" value="{{ $info['pagibig_no'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('pagibig_no')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('pagibig_no'))Pagibig No. required @else Pagibig No. @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> PHILHEALTH NO.</td>
                                                    <td style="padding: 0px;"><input type="text" name="philhealth_no" value="{{ $info['philhealth_no'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('philhealth_no')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('philhealth_no'))Philhealth No. required @else philhealth No. @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> SSS NO.</td>
                                                    <td style="padding: 0px;" ><input type="text" name="sss_no" value="{{ $info['sss_no'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('sss_no')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('sss_no'))SSS No. required @else SSS No. @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> TIN NO.</td>
                                                    <td style="padding: 0px;" ><input type="text" name="tin_no" value="{{ $info['tin_no'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('tin_no')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('tin_no'))TIN No. required @else TIN No. @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> AGENCY EMP. NO.</td>
                                                    <td style="padding: 0px;" ><input type="text" name="agency_emp_no" value="{{ $info['agency_emp_no'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('agency_emp_no')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('agency_emp_no'))Agency Employee No. required @else Agency Employee No. @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> CITIZENSHIP</td>
                                                    <td style="padding: 0px;" colspan="3">
                                                        <input type="hidden" name="citizenship_filipino" value="0">
                                                        <input type="checkbox" name="citizenship_filipino" value="1" @if($info['citizenship_filipino'] == '1') checked  @endif style="height: 17px; width: 17px; margin-top: 8px; margin-left: 10px; float: left;">
                                                        <font style="float: left; margin-top: 8px; margin-left: 5px; font-size: 12px;">Filipino</font>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; font-style: italic; ">If Holder of Dual Citizenship</td>
                                                    <td style="padding: 0px;">
                                                        <input type="hidden" name="citizenship_dual" value="0">
                                                        <input type="checkbox" name="citizenship_dual" value="1" @if($info['citizenship_dual'] == '1') checked  @endif style="height: 17px; width: 17px; margin-top: 8px; margin-left: 10px; float: left;">
                                                        <font style="float: left; margin-top: 8px; margin-left: 5px; font-size: 12px;">Dual Citizenship</font>
                                                    </td>
                                                    <td style="padding: 0px;">
                                                        
                                                    </td>
                                                    <td style="padding: 0px;" >
                                                        <input type="hidden" name="by_birth" value="0">
                                                        <input type="checkbox" name="by_birth" value="1" @if($info['by_birth'] == '1') checked  @endif style="height: 17px; width: 17px; margin-top: 8px; margin-left: 10px; float: left;">
                                                        <font style="float: left; margin-top: 8px; margin-left: 5px; margin-right: 50px; font-size: 12px;">By Birth</font>

                                                        <input type="hidden" name="by_naturalization" value="0">
                                                        <input type="checkbox" name="by_naturalization" value="1" @if($info['by_naturalization'] == '1') checked  @endif style="height: 17px; width: 17px; margin-top: 8px; margin-left: 10px; float: left;">
                                                        <font style="float: left; margin-top: 8px; margin-left: 5px; margin-right: -70px; font-size: 12px;">By Naturalization</font>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; font-style: italic; ">Please Indicate Country</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="indicated_country" value="{{ $info['indicated_country'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Country"></td>
                                                </tr>
                                            </table>

                                        </div>

                                        <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; font-weight: bold; color: #5B5B5B; text-align: right; "><i class="fa fa-angle-double-down fa-fw"></i> RESIDENTIAL</td>
                                                    <td style="width:150px;  font-size: 11px; font-weight: bold; color: #5B5B5B; text-align: left; " colspan="3">ADDRESS</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; ">HOUSE/BLOCK/LOT NO.</td>
                                                    <td style="padding: 0px;" ><input type="text" name="res_house_block_lot" value="{{ $info['res_house_block_lot'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="House/Block/Lot No."></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; ">STREET</td>
                                                    <td style="padding: 0px;" ><input type="text" name="res_street" value="{{ $info['res_street'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Street"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; ">SUBDIVISION/VILLAGE</td>
                                                    <td style="padding: 0px;" ><input type="text" name="res_subdivision" value="{{ $info['res_subdivision'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Subdivision/Village"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> BARANGAY</td>
                                                    <td style="padding: 0px;" ><input type="text" name="res_barangay" value="{{ $info['res_barangay'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('res_barangay')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('res_barangay'))Barangay is required @else Barangay @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> CITY/MUNICIPALITY</td>
                                                    <td style="padding: 0px;" ><input type="text" name="res_municipality" value="{{ $info['res_municipality'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('res_municipality')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('res_municipality'))City/Municipality is required @else City/Municipality @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> PROVINCE</td>
                                                    <td style="padding: 0px;" ><input type="text" name="res_province" value="{{ $info['res_province'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('res_province')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('res_province'))Province is required @else Province @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> ZIP CODE</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="res_zip_code" value="{{ $info['res_zip_code'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('res_province')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('res_zip_code'))Zip Code is required @else Zip Code @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                            </table>

                                        </div>

                                        <div class="panel panel-default">

                                            <table class="table table-striped table-bordered table-hover tooltip-demo">
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; font-weight: bold; color: #5B5B5B; text-align: right; "><i class="fa fa-angle-double-down fa-fw"></i> PERMANENT</td>
                                                    <td style="width:150px;  font-size: 11px; font-weight: bold; color: #5B5B5B; text-align: left; " colspan="3">ADDRESS</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; ">HOUSE/BLOCK/LOT NO.</td>
                                                    <td style="padding: 0px;" ><input type="text" name="per_house_block_lot" value="{{ $info['per_house_block_lot'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="House/Block/Lot No."></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; ">STREET</td>
                                                    <td style="padding: 0px;" ><input type="text" name="per_street" value="{{ $info['per_street'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Street"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; ">SUBDIVISION/VILLAGE</td>
                                                    <td style="padding: 0px;" ><input type="text" name="per_subdivision" value="{{ $info['per_subdivision'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Subdivision/Village"></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> BARANGAY</td>
                                                    <td style="padding: 0px;" ><input type="text" name="per_barangay" value="{{ $info['per_barangay'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('per_barangay')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('per_barangay'))Barangay is required @else Barangay @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> CITY/MUNICIPALITY</td>
                                                    <td style="padding: 0px;" ><input type="text" name="per_municipality" value="{{ $info['per_municipality'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('per_municipality')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('per_municipality'))City/Municipality is required @else City/Municipality @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> PROVINCE</td>
                                                    <td style="padding: 0px;" ><input type="text" name="per_province" value="{{ $info['per_province'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('per_province')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('per_province'))Province is required @else Province @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> ZIP CODE</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="per_zip_code" value="{{ $info['per_zip_code'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('per_province')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('per_zip_code'))Zip Code is required @else Zip Code @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; ">TELEPHONE NO.</td>
                                                    <td style="padding: 0px;" ><input type="text" name="tel_no" value="{{ $info['tel_no'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px;" placeholder="Telephone No."></td>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> MOBILE NO.</td>
                                                    <td style="padding: 0px;" ><input type="text" name="mobile_no" value="{{ $info['mobile_no'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('mobile_no')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('mobile_no'))Mobile No. is required @else Mobile No. @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;  font-size: 11px; color: #5B5B5B; text-align: right; "><font style="color: #F00;">*</font> EMAIL ADDRESS</td>
                                                    <td style="padding: 0px;" colspan="3"><input type="text" name="email" value="{{ $user['email'] }}" class="form-control" style="height: 33px; font-size: 12px; border-radius: 0px; @if($errors->has('email')) border-color: #F08080;  box-shadow: none; @endif " placeholder="@if($errors->has('email'))Email Address is required @else Email Address @endif" data-toggle="tooltip" data-placement="left" title="Required" ></td>
                                                </tr>

                                                <tr>
                                                    <td ></td>
                                                    <td colspan="5">
                                                        <input type="submit" name="add" value="Save" class="btn btn-success btn-xs" style="height: 25px; width: 60px;" data-toggle="tooltip" data-placement="left" title="Are you sure you filled-up all required fields?">
                                                        <input type="reset" value="Clear" class="btn btn-danger btn-xs" style="height: 25px; width: 60px;">
                                                    </td>
                                                </tr>
                                            </table>
                                           
                                        </div>

                                    
                                    {{Form::close()}}

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            @include('denr.layouts.blocks.msgconfirmation')

@endsection