    <div class="col-md-12" style="padding: 0px 5px 0px 5px;">

        <div class="col-lg-6" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #7CCD7C; border-radius: 0px;  margin: 0px; ">
                <a href="{{ route('home') }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Home</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-home"></i>
                            </div>
                            <!-- <div class="col-xs-9">
                                <div style=" font-size: 25px;">Welcome {{ Auth::user()->fname }} {{ Auth::user()->lname }}</div>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Main Menu</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #E3CF57; border-radius: 0px;  margin: 0px;">
                <a href="#" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;"> Search</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Search something here..</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> --}}

        <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #7D9EC0; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('user.account', ['path' => $path]) }}" >
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;"> {{ Auth::user()->fname }} {{ Auth::user()->lname }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">

                                @if(Auth::user()->user_type == '1')

                                    Super Admin

                                @elseif(Auth::user()->user_type == '2')

                                    Admin

                                @elseif(Auth::user()->user_type == '3')

                                    Employee

                                @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- <div class="col-lg-3" style="padding:10px;">
            <div class="panel panel" style="box-shadow: 1px 2px 3px 1px #8F8F8F; background-color: #C5C1AA; border-radius: 0px;  margin: 0px;">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="panel-heading" style="color: #FFF; text-align: left;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 20px;">Log-out</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 40px;">
                                <i class="fa fa-sign-out"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style=" font-size: 14px;">Destroy your session..</div>
                            </div>
                        </div>
                    </div>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div> -->

    </div>