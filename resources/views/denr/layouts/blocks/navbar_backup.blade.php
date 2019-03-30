<?php

use App\Helpers\Helper;
$user = Auth::user();
$user_type = $user->user_type;
$user_id = $user->id;
$path = helper::mod_path();
$doc_class = helper::doc_class();
$icon_class = helper::icon_class();

if($path == 'dts') { $module = 'Document Tracking System'; }
else if($path == 'toa') { $module = 'Travel Order Application'; }
else if($path == 'pis') { $module = 'Personal Information System'; }
else if($path == 'app') { $module = 'Application Manager'; }
else if($path == 'lms') { $module = 'Leave Monitoring System'; }
else if($path == 'my_account') { $module = 'My Accounts'; }

?>

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-image: URL('/img/green_bg.jpg');">
    
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('dashboard') }}" style="color: #FFF; text-shadow: 2px 4px 3px rgba(0,0,0,0.3); opacity: 1; font-size: 16px; font-weight: 100;">

        <img src="{{URL::asset('/img/denr_logo.png')}}" width="30" height="30" style="float: left; margin-top: -5px; margin-right: 5px;" />

        {{ config('app.name', 'Laravel') }}

        </a>
    </div>

    <ul class="nav navbar-top-links navbar-right">
       
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> {{ Auth::user()->fname }} {{ Auth::user()->lname }} &nbsp; <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="{{ route('user.account') }}"><i class="fa fa-user fa-fw"></i> My Account</a>
                </li>
                <li class="divider" style="margin-top:3px; margin-bottom: 3px;"></li>
                <li>
                    <a href="{{ route('change.password') }}"><i class="fa fa-key fa-fw"></i> Change Password</a>
                </li>
                <li class="divider" style="margin-top:3px; margin-bottom: 3px;"></li>
                <li>
                    <a href="{{ route('my.audit.trail.log.form') }}"><i class="fa fa-navicon fa-fw"></i> My Activity Log</a>
                </li>
                <li class="divider" style="margin-top:3px; margin-bottom: 3px;"></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-fw"></i>  Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                   </form>
                   
                </li>
            </ul>

        </li>

    </ul>

    <div class="navbar-default sidebar" role="navigation" style="border-right: 1px solid #CCC;">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                </li>

                <!-- DASHBOARD -->

                <li>
                    <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>

                <!-- MATERIAL MANAGEMENT -->


                <!-- Document Tracking -->
                @if($path == 'dts')
                    
                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Activity<span class="fa arrow"></span></a>

                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                            @if($user_type != '3')
                            <li>
                                <a href="{{ route('view.incoming.documents') }}"><i class="fa fa-sign-in fa-fw"></i> Incoming Document </a>
                            </li>
                            <li>
                                <a href="{{ route('view.outgoing.documents') }}"><i class="fa fa-sign-out fa-fw"></i> Outgoing Document </a>
                            </li>
                            <li>
                                <a href="{{ route('add.documents') }}"><i class="fa fa-plus fa-fw"></i> Add Document</a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ route('received.documents') }}"><i class="fa fa-arrow-down fa-fw"></i> Received Document</a>
                            </li>
                            <li>
                                <a href="{{ route('forwarded.documents') }}"><i class="fa fa-arrow-up fa-fw"></i> Forwarded Document</a>
                            </li>
                        </ul>

                    </li>

                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Maintenance<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                            <li>
                                <a href="#"><i class="fa fa-folder-open fa-fw"></i> Document Type <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="{{ route('doc.type.list') }}" style="color: #000;"><i class="fa fa-navicon fa-fw"></i> Master List</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('doc.type.form') }}" style="color: #000;"><i class="fa fa-plus fa-fw"></i> Add New</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Report<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                            <li>
                                <a href="#"><i class="fa fa-file-text fa-fw"></i> Incoming Document</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-file-text fa-fw"></i> Outgoing Document</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Travel Order Monitoring -->

                @if($path == 'toa')
                    
                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Activity<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                            <li>
                                <a href="{{ route('travel.order.list') }}"><i class="fa fa-navicon fa-fw"></i> Travel Order</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Maintenance<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                    
                        </ul>
                    </li>
                    @if($user_type != '3')
                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Report<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                            <li>
                                <a href="{{ route('travel.order.filter.form') }}"><i class="fa fa-file-text fa-fw"></i> Travel Order Report</a>
                            </li>
                            <li>
                                <a href="{{ route('employee.filter.form')    }}"><i class="fa fa-file-text fa-fw"></i> Employee Report</a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @php $signatory = DB::table('travel_order')->where('recommender', '=', $user->id)->where('approval_status','=','0')->orWhere('approver', '=', $user->id)->where('approval_status','!=','2')->count(); @endphp

                    @if($user_type == '1' || $user_type == '2' || $signatory > 0)

                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Approval Manager<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                            <li>
                                <a href="{{ route('pending.travel.order.list') }}"><i class="fa fa-exclamation-circle fa-fw"></i> Pending Travel Order</a>
                            </li>
                            <li>
                                <a href="{{ route('approved.travel.order.list') }}"><i class="fa fa-check fa-fw"></i> Approved Travel Order</a>
                            </li>
                            <li>
                                <a href="{{ route('disapproved.travel.order.list') }}"><i class="fa fa-times fa-fw"></i> Disapproved Travel Order</a>
                            </li>
                            <li>
                                <a href="{{ route('cancelled.travel.order.list') }}"><i class="fa fa-times-circle fa-fw"></i> Cancelled Travel Order</a>
                            </li>
                        </ul>
                    </li>
                    @endif

                @endif

                <!-- Personal Information System -->

                @if($path == 'pis')
                    <li>
                        <a href="#"><i class="fa fa-tasks fa-fw"></i> Personal Data Sheet<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level" style="margin-left: -5px; font-size: 11px; text-transform: uppercase;">
                            <li>
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
                            <li>
                                <a href="{{ route('voluntary.work') }}"><i class="fa fa-navicon fa-fw"></i> Voluntary Work</a>
                            </li>
                            <li>
                                <a href="{{ route('learning.development') }}"><i class="fa fa-navicon fa-fw"></i> Learning & Development</a>
                            </li>
                            <li>
                                <a href="{{ route('other.information') }}"><i class="fa fa-navicon fa-fw"></i> Other Information</a>
                            </li>
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

            </ul>
        </div>
    </div>

</nav>

        

                            