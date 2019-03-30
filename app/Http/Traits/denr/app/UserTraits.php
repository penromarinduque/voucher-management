<?php

namespace App\Http\Traits\denr\app;

use Crypt;
use Auth;
use Session;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//MODELS//
use App\Models\denr\User as UserModel;
use App\Models\denr\Employee_Position as PositionModel;
use App\Models\denr\Employee_Division as DivisionModel;
use App\Models\denr\Employee_Section as SectionModel;
use App\Models\denr\Employee_Unit as UnitModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait UserTraits
{
	public function ShowUserListFunction()
    {
        $user = Auth::user();

        //CHECK USER LEVEL
        if($user->user_type == '1') {

            $record = UserModel::all();
            return view('denr.app.user', array('user' => $record));

        } else {

            return back();
        }     
    }

    public function ShowUserFormFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1') {

            $position_record = PositionModel::all();
            $division_record = DivisionModel::all();
            $section_record = SectionModel::all();
            $unit_record = UnitModel::all();
            return view('denr.app.add_user')
                 ->with('position', $position_record)
                 ->with('division', $division_record)
                 ->with('section', $section_record)
                 ->with('unit', $unit_record);

        } else {

            return back();
        } 
    }


    public function AddUserFunction(Request $request) {

        $user = Auth::user();

        //CHECK USER LEVEL
        if($user->user_type == '1') {

            $this->validate(request(),[
                'username'=>'required',
                'password'=>'required',
                'fname'=>'required',
                'mname'=>'required',
                'lname'=>'required',
                'email'=>'required',
                'user_type'=>'required',
                'user_position'=>'required',
                'division'=>'required',
                'user_role'=>'required',
                'user_class'=>'required',
            ]);

            $username = $request->input('username');
            $email = $request->input('email');

            $middle_name = $request->input('mname');
            $firstCharacter = substr($middle_name, 0, 1);
                
            $user_count = UserModel::where('username', '=', $username)->count();
            $email_count = UserModel::where('email', '=', $email)->count();

                if($user_count == 0) {
                
                    if($email_count == 0) {

                        $user_acct = [

                            'username' => $request->input('username'),
                            'password' => bcrypt($request->input('password')),
                            'fname' => $request->input('fname'),
                            'mname' => $request->input('mname'),
                            'lname' => $request->input('lname'),
                            'mi' => $firstCharacter,
                            'email' => $request->input('email'),
                            'user_type' => $request->input('user_type'),
                            'user_status' => $request->input('user_status'),
                            'with_recom' => $request->input('with_recom'),
                            'user_position' => $request->input('user_position'),
                            'user_division' => $request->input('division'),
                            'user_section' => $request->input('section'),
                            'user_unit' => $request->input('unit'),
                            'user_role' => $request->input('user_role'),
                            'user_class' => $request->input('user_class'),
                        ];

                        UserModel::insert($user_acct);

                        //AUDIT TRAIL LOG
                        $new_user = $request->input('username');

                        $window_page = 'User';
                        $module_code = 'PIS';
                        $window_type = 'TM';
                        $action_type = 'ADD';
                        $remarks = 'Registered User/Employee '.$new_user;
                                                
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php'); 

                        Session::flash('success', 'User ('.$username.') successfully registered.');

                        //return redirect()->route('view.add.user');
                        return back();

                    } else {

                        Session::flash('failed', 'Email Address ('.$email.') already exist.');

                        return back();
                    }

                } else {

                    Session::flash('failed', 'Username ('.$username.') already exist.');

                    return back();
                }     

        } else {

            return back();
        }     
    }


    public function ShowAjaxSecFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1') {

            $division = Input::get('division');
            $sec_record = SectionModel::where('division_id', '=', $division)->get();
            return Response::json($sec_record);

        } else {

            return back();
        }     

    }

    public function ShowAjaxUnitFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1') {

            $section = Input::get('section');
            $unit_record = UnitModel::where('section_id', '=', $section)->get();
            return Response::json($unit_record);

        } else {

            return back();
        }     

    }

    public function ViewUserFunction(Request $request, $id) 
    {
        $user = Auth::user();

        //CHECK USER LEVEL
        if($user->user_type == '1') {

            $decode = Crypt::decrypt($id);
            $encode = Crypt::encrypt($id);
            $user_record = UserModel::where('id', '=', $decode)->get()->first();
            $position_record = PositionModel::all();
            $div_record = DivisionModel::all();
            $sec_record = SectionModel::all();
            $unit_record = UnitModel::all();
                
            return view('denr.app.edit_user')->with('record', $user_record)->with('division', $div_record)->with('section', $sec_record)->with('unit', $unit_record)->with('position', $position_record); 

        } else {

            return back();
        }              
    }


    public function EditUserFunction(Request $request) 
    {

        $user = Auth::user();

        //CHECK USER LEVEL
        if($user->user_type == '1') {

            $this->validate(request(),[
                'username'=>'required',
                'password'=>'required',
                'fname'=>'required',
                'mname'=>'required',
                'lname'=>'required',
                'email'=>'required',
                'user_type'=>'required',
                'user_role'=>'required',
                'user_class'=>'required',
            ]);

            $get_id = $request->input('get_id');
            $get_username = $request->input('get_username');
            $get_email = $request->input('get_email');
            $username = $request->input('username');
            $email = $request->input('email');
            $encode = Crypt::encrypt($get_id);
            $encode2 = Crypt::encrypt($get_id);

            $middle_name = $request->input('mname');
            $firstCharacter = substr($middle_name, 0, 1);

            $code_count = UserModel::where('username', '=', $username)
                                          ->where('username', '!=', $get_username)
                                          ->count();

            $email_count = UserModel::where('email', '=', $email)
                                           ->where('email', '!=', $get_email)
                                           ->count();

                if($code_count == 0) {

                    if($email_count == 0) {

                        $user_acct = [

                            'username' => $request->input('username'),
                            'fname' => $request->input('fname'),
                            'mname' => $request->input('mname'),
                            'lname' => $request->input('lname'),
                            'mi' => $firstCharacter,
                            'email' => $request->input('email'),
                            'user_type' => $request->input('user_type'),
                            'user_position' => $request->input('user_position'),
                            'user_division' => $request->input('division'),
                            'user_section' => $request->input('section'),
                            'user_unit' => $request->input('unit'),
                            'user_status' => $request->input('user_status'),
                            'with_recom' => $request->input('with_recom'),
                            'user_role' => $request->input('user_role'),
                            'user_class' => $request->input('user_class'),
                        ];

                        $update = UserModel::where('id','=', $get_id)->update($user_acct); 

                        //AUDIT TRAIL LOG
                        $new_user = $request->input('username');

                        $window_page = 'User';
                        $module_code = 'PIS';
                        $window_type = 'TM';
                        $action_type = 'EDIT';
                        $remarks = 'Modified User/Employee '.$new_user;
                                                
                        include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');
                        
                        Session::flash('success', 'User ('.$username.') successfully updated.');

                        return back();

                    } else {

                        Session::flash('failed', 'Email Address ('.$email.') already exist.');

                         return back();
                    }

                } else {

                    Session::flash('failed', 'Username ('.$username.') already exist.');

                    return back();
                }


        } else {

            return back();
        }     

    }


    public function DeleteUserFunction(Request $request)
    {

        $user = Auth::user();

        //CHECK USER LEVEL
        if($user->user_type == '1') {

            $del_id = $request->input('del_id');
            $del_id2 = $request->input('del_id2');
            $date2day = date('Y-m-d');
            $encode = Crypt::encrypt($del_id);

            UserModel::where('id', '=', $del_id)->delete();
                        
            $window_page = 'User';
            $module_code = 'PIS';
            $window_type = 'TM';
            $action_type = 'DEL';
            $remarks = 'Deleted User/Employee '.$del_id2;
                                                
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');       
            
            Session::flash('success', ' User/Employee ('.$del_id2.') successfully deleted.');

            return back();

        }
    }
}