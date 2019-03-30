<?php

namespace App\Http\Traits\denr\dts\maintenance;

use Crypt;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//MODELS//
use App\Models\denr\User as UserModel;
use App\Models\denr\DTS_DocTypesModel as DocTypeModel;
use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

trait DocumentTypeTraits
{
	public function ShowDocTypeListFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $type_record = DocTypeModel::all();
            return view('denr.dts.maintenance.document_type', array('record' => $type_record));

        } else {

            return back();
        }  
    }

    public function ShowDocTypeFormFunction()
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            return view('denr.dts.maintenance.add_document_type');

        } else {

            return back();
        } 
    }

    public function AddDocTypeFunction(Request $request) 
    {

        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $this->validate(request(), [
                'doc_type'=>'required',
            ]);

            $doc_type = [

                'TYPE_NAME' => $request->input('doc_type'),
                //'created_by' => $user->id
                            
            ];

            $insert_doc_type = DocTypeModel::insert($doc_type); 

            //AUDIT TRAIL LOG
            $new_doc_type = $request->input('doc_type');

            $window_page = 'Document Type';
            $module_code = 'DTS';
            $window_type = 'TM';
            $action_type = 'ADD';
            $remarks = 'Added Document Type '.$new_doc_type;
                                    
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');

            Session::flash('success', 'Document Type successfully saved.');

            return back();

        } else {

            return back();
        } 

    }

    public function ViewDocTypeFunction(Request $request, $id)
    {
        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $decode = Crypt::decrypt($id);
            $encode = Crypt::encrypt($id);
            $doc_type_record = DocTypeModel::where('id', '=', $decode)->get()->first();
            return view('denr.dts.maintenance.edit_document_type', array('record' => $doc_type_record));

        } else {

            return back();
        }  
    }

    public function editDocTypeFunction(Request $request) 
    {

        $user = Auth::user();

        //CHECK USER TYPE
        if($user->user_type == '1' || $user->user_type == '2') {

            $this->validate(request(), [
                'doc_type'=>'required',
            ]);

            $get_id = $request->input('get_id');
            $encode = Crypt::encrypt($get_id);

            $doc_type = [

                'TYPE_NAME' => $request->input('doc_type'),
                            
            ];

            DocTypeModel::where('id', '=', $get_id)->update($doc_type);

            //AUDIT TRAIL LOG
            $new_doc_type = $request->input('doc_type');

            $window_page = 'Document Type';
            $module_code = 'DTS';
            $window_type = 'TM';
            $action_type = 'EDIT';
            $remarks = 'Modified Document Type '.$new_doc_type;

            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php'); 

            Session::flash('success', 'Document Type successfully updated.');

            return back();

        } else {

            return back();
        }

    }

    public function DeleteDocTypeFunction(Request $request)
    {

        $user = Auth::user();

        //CHECK USER LEVEL
        if($user->user_type == '1') {

            $del_id = $request->input('del_id');
            $del_id2 = $request->input('del_id2');
            $date2day = date('Y-m-d');
            $encode = Crypt::encrypt($del_id);

            DocTypeModel::where('id', '=', $del_id)->delete();
                        
            $window_page = 'Document Type';
            $module_code = 'DTS';
            $window_type = 'TM';
            $action_type = 'DEL';
            $remarks = 'Deleted Document Type '.$del_id2;
                                                
            include(app_path() . '/Http/Traits/denr/app/audit_trail_log.php');       
            
            Session::flash('success', ' Document Type ('.$del_id2.') successfully deleted.');

            return back();

        }
    }
}