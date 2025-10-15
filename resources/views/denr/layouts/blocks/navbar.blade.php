<?php include(resource_path() . '/views/denr/layouts/helpers_data.php'); ?>

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-image: URL('/img/banner3.jpg'); background-size: cover; height: 120px; width: 100%;">
    
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand" href="#" style="color: #FFF; text-shadow: 1px 2px 6px #000; opacity: 1; font-size: 14px; font-weight: 100; font-family: arial; width: 100%">
            
            <div style="width: 6%; float: left;">
                <img src="{{URL::asset('/img/denr_logo.png')}}" style="float: left; width: 100%;" />
            </div>

            <div style="width: 92%; float: left; padding: 0px 0px 0px 10px;">
                REPUBLIC OF THE PHILIPPINES
                <hr style="height: 1px; margin-top: 5px; margin-bottom: 5px;" />
                <b style="font-size: 18px;">DEPARTMENT OF ENVIRONMENT AND NATURAL RESOURCES</b> <br/>
                MIMAROPA REGION <br/>
                PENRO - MARINDUQUE
            </div>

        </a>

    </div>

    <div class="navbar-default sidebar" role="navigation" style="border-right: 1px solid #CCC; margin-top: 120px;">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <li class="sidebar-search" style="background-color: #E6E6FA;">
                    <a href="{{ route('user.account', ['path' => $path]) }}" style="padding: 5px; ">
                        <div class="input-group custom-search-form" style="color: #000;">
                            <span class="input-group-btn">
                                <div class="btn btn-default" style="padding: 2px;">
                                    <img src="<?php echo asset("img/profile.jpg")?>" width="50" height="50"   /> 
                                </div>
                            </span>
                            &nbsp;&nbsp; <font style="color: #008B45">{{ $user->username }}</font> <br/>
                            &nbsp;&nbsp; {{ $user->fname }} {{ $user->lname }} <br/>
                            &nbsp;&nbsp; <i>@if($user->user_level == '1') Administrator @elseif($user->user_level == '2') Staff Officer @elseif($user->user_level == '1') Regular Member @endif</i> <br/>
                        </div>
                    </a>
                </li>

                <!-- DASHBOARD -->

                <li>
                    <a href="{{ route('home') }}"><i class="fa fa-home fa-fw"></i> Home </a>
                </li>

                <li>
                    <a href="{{ route($path) }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard </a>
                </li>

                <!-- MATERIAL MANAGEMENT -->


                <!-- Document Tracking -->
                @if($path == 'dts')
                    
                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Activity<span class="fa arrow"></span></a>

                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                            
                        @if($dts_access1 > 0)

                            <li>
                                <a href="{{ route('dts.document.index', ['id' => 'pending']) }}">
                                    <i class="fa fa-sign-in fa-fw"></i> Documents 
                                    @if($in_notification > 0)
                                    <div style="width: 17px; height: 17px; background-color: #F00; color: #FFF; border-radius: 50px; float: right; padding: 2px; font-size: 9px; text-align: center;">
                                        {{$in_notification}}
                                    </div>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dts.document.index', ['id' => 'acted']) }}">
                                    <i class="fa fa-sign-out fa-fw"></i> Acted Document
                                    @if($acted_notification > 0)
                                    <div style="width: 17px; height: 17px; background-color: #20C997; color: #FFF; border-radius: 50px; float: right; padding: 2px; font-size: 9px; text-align: center;">
                                        {{$acted_notification}}
                                    </div>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dts.document.index', ['id' => 'completed']) }}">
                                    <i class="fa fa-sign-out fa-fw"></i> Completed Document
                                    @if($completed_notification > 0)
                                    <div style="width: 17px; height: 17px; background-color: #20C997; color: #FFF; border-radius: 50px; float: right; padding: 2px; font-size: 9px; text-align: center;">
                                        {{$completed_notification}}
                                    </div>
                                    @endif
                                </a>
                            </li>

                        @endif

                        @if($dts_access2 > 0)
                            
                            @if($user_role != '4')
                                <li>
                                    <a href="{{ route('dts.document.create') }}"><i class="fa fa-plus fa-fw"></i> New Document</a>
                                </li>
                            @endif

                        @endif

                        </ul>

                    </li>

                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Maintenance<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">

                        @if($dts_access2 > 0)

                            <li>
                                <a href="#"><i class="fa fa-folder-open fa-fw"></i> Document Type <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="{{ route('doc.type.list') }}" style="color: #000;"><i class="fa fa-navicon fa-fw"></i> Master List</a>
                                    </li>

                                    @if($dts_access5 > 0)

                                    <li>
                                        <a href="{{ route('doc.type.form') }}" style="color: #000;"><i class="fa fa-plus fa-fw"></i> Add New</a>
                                    </li>

                                    @endif

                                </ul>
                            </li>

                        @endif 

                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Report<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                        
                        @if($dts_access4 > 0)

                            <li>
                                <a href="{{ route('document.report') }}"><i class="fa fa-file-text fa-fw"></i> Document Report</a>
                            </li>
                   
                        @endif

                        </ul>
                    </li>

                @endif

                <!-- Travel Order Monitoring -->

                @if($path == 'toa')
                    
                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Activity<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                        
                        @if($toa_access1 > 0)

                            <li>
                                <a href="{{ route('travel.order.list') }}"><i class="fa fa-navicon fa-fw"></i> Travel Order</a>
                            </li>

                        @endif

                        </ul>
                    </li>

                    <!-- <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Maintenance<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                    
                        </ul>
                    </li> -->

                    @if($user_type != '3')

                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Report<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                            
                        @if($toa_access3 > 0)

                            <li>
                                <a href="{{ route('travel.order.filter.form') }}"><i class="fa fa-file-text fa-fw"></i> Travel Order Report</a>
                            </li>

                        @endif

                        @if($toa_access4 > 0)

                            <li>
                                <a href="{{ route('employee.filter.form')    }}"><i class="fa fa-file-text fa-fw"></i> Employee Report</a>
                            </li>

                        @endif 

                        </ul>
                    </li>
                    @endif

                    @php $signatory = DB::table('travel_order')->where('recommender', '=', $user->id)->where('approval_status','=','0')->orWhere('approver', '=', $user->id)->where('approval_status','!=','2')->count(); @endphp

                    @if($user_type == '1' || $user_type == '2' || $signatory > 0)

                    <li>
                        <a href="#"><i class="fa fa-check-square fa-fw"></i> Approval Manager<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                            
                        @if($toa_access5 > 0)

                            <li>
                                <a href="{{ route('pending.travel.order.list') }}"><i class="fa fa-exclamation-circle fa-fw"></i> Pending Travel Order</a>
                            </li>

                        @endif

                        @if($toa_access6 > 0)

                            <li>
                                <a href="{{ route('approved.travel.order.list') }}"><i class="fa fa-check fa-fw"></i> Approved Travel Order</a>
                            </li>

                        @endif

                        @if($toa_access7 > 0)

                            <li>
                                <a href="{{ route('disapproved.travel.order.list') }}"><i class="fa fa-times fa-fw"></i> Disapproved Travel Order</a>
                            </li>

                        @endif

                        @if($toa_access8 > 0)

                            <li>
                                <a href="{{ route('cancelled.travel.order.list') }}"><i class="fa fa-times-circle fa-fw"></i> Cancelled Travel Order</a>
                            </li>

                        @endif

                        </ul>
                    </li>
                    @endif

                @endif

                <!-- Personal Information System -->

                @if($path == 'pis')
                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Personal Data Sheet<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">

                        @if($toa_access1 > 0)

                            <li>
                                <a href="{{ route('personal.information') }}"><i class="fa fa-navicon fa-fw"></i> Personal Information</a>
                            </li>
                        
                        @endif

                        @if($toa_access2 > 0)    

                            <li>
                                <a href="{{ route('family.background') }}"><i class="fa fa-navicon fa-fw"></i> Family Background</a>
                            </li>
                            
                        @endif

                        @if($toa_access3 > 0)

                            <li>
                                <a href="{{ route('educational.background') }}"><i class="fa fa-navicon fa-fw"></i> Educational Background</a>
                            </li>
                            
                        @endif

                        @if($toa_access4 > 0)

                            <li>
                                <a href="{{ route('civil.service.eligibility') }}"><i class="fa fa-navicon fa-fw"></i> Civil Service Eligibility</a>
                            </li>
                            
                        @endif

                        @if($toa_access5 > 0)

                            <li>
                                <a href="{{ route('work.experience') }}"><i class="fa fa-navicon fa-fw"></i> Work Experience</a>
                            </li>
                            
                        @endif

                        @if($toa_access6 > 0)

                            <li>
                                <a href="{{ route('voluntary.work') }}"><i class="fa fa-navicon fa-fw"></i> Voluntary Work</a>
                            </li>
                            
                        @endif

                        @if($toa_access7 > 0)

                            <li>
                                <a href="{{ route('learning.development') }}"><i class="fa fa-navicon fa-fw"></i> Learning & Development</a>
                            </li>
                            
                        @endif

                        @if($toa_access8 > 0)

                            <li>
                                <a href="{{ route('other.information') }}"><i class="fa fa-navicon fa-fw"></i> Other Information</a>
                            </li>
                        
                        @endif

                        </ul>
                    </li>
                @endif

                <!-- System Utilities -->

                @if($path == 'app')

                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Maintenance<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                            <li>
                                <a href="#"><i class="fa fa-folder-open fa-fw"></i> User / Employee <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="{{ route('employee.user.list') }}" style="color: #000;"><i class="fa fa-navicon fa-fw"></i> Master List</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('employee.user.form') }}" style="color: #000;"><i class="fa fa-plus fa-fw"></i> Register New</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-folder-open fa-fw"></i> User / Employee Position <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="{{ route('employee.position.list') }}" style="color: #000;"><i class="fa fa-navicon fa-fw"></i> Master List</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('employee.position.form') }}" style="color: #000;"><i class="fa fa-plus fa-fw"></i> Add New </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-folder-open fa-fw"></i> User / Employee Division <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="{{ route('employee.division.list') }}" style="color: #000;"><i class="fa fa-navicon fa-fw"></i>  Master List</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('employee.division.form') }}" style="color: #000;"><i class="fa fa-plus fa-fw"></i> Add New </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-folder-open fa-fw"></i> User / Employee Section <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="{{ route('employee.section.list') }}" style="color: #000;"><i class="fa fa-navicon fa-fw"></i> Master List</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('employee.section.form') }}" style="color: #000;"><i class="fa fa-plus fa-fw"></i> Add New</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-folder-open fa-fw"></i> User / Employee Unit <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="{{ route('employee.unit.list') }}" style="color: #000;"><i class="fa fa-navicon fa-fw"></i> Master List</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('employee.unit.form') }}" style="color: #000;"><i class="fa fa-plus fa-fw"></i> Add New</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('user.module.access') }}"><i class="fa fa-cog fa-fw"></i> User Module Access</a>
                            </li>
                            <li>
                                <a href="{{ route('user.access') }}"><i class="fa fa-cog fa-fw"></i> User Access</a>
                            </li>
                            <li>
                                <a href="{{ route('audit.trail.log.form') }}"><i class="fa fa-cog fa-fw"></i> Audit Trail - Log</a>
                            </li>
                            <li>
                                <a href="{{ route('form.signatory.form') }}"><i class="fa fa-cog fa-fw"></i> Travel Order Signatories </a>
                            </li>
                            <li>
                                <a href="{{ route('no.generation.form') }}"><i class="fa fa-cog fa-fw"></i> Form No. Generation</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Leave Monitoring System -->
                @if($path == 'lms')

                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Activity<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">

                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Maintenance<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">

                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Report<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">

                        </ul>
                    </li>

                @endif

                <li>
                    <a href="#" ><i class="fa fa-cog fa-fw"></i> Manage Account <span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                        <li>
                            <a href="{{ route('user.account', ['path' => $path]) }}"><i class="fa fa-user fa-fw"></i> My Profile </a>
                        </li>
                        <li>
                            <a href="{{ route('change.password', ['path' => $path]) }}"><i class="fa fa-key fa-fw"></i> Change Password </a>
                        </li>
                        <li>
                            <a href="{{ route('my.audit.trail.log.form', ['path' => $path]) }}"><i class="fa fa-undo fa-fw"></i> My History Logs</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out fa-fw"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>

                </li>

            </ul>
        </div>
    </div>

</nav>

        

                            