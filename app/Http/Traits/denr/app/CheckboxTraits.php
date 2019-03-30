<?php

namespace App\Http\Traits\denr\app;

use Crypt;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

trait CheckboxTraits
{
    private function getAllChkboxValues($id) {
        $chk_name = $id;
        $found = array(); 
        if(!empty($chk_name)) {
            foreach($chk_name as $key => $val) {
                if($val == '1') {
                    $found[] = $key;
                }
            }
        }
        
        foreach($found as $kev_f => $val_f) {
            unset($chk_name[$val_f+1]); 
        } 
        $final_arr = array(); 
        return $final_arr = array_values($chk_name); 
    }


    private function getAllChkboxValuesYN($id) {
        $chk_name = $id;
        $found = array(); 
        if(!empty($chk_name)) {
            foreach($chk_name as $key => $val) {
                if($val == 'Y') {
                    $found[] = $key;
                }
            }
        }
        
        foreach($found as $kev_f => $val_f) {
            unset($chk_name[$val_f+1]); 
        } 
        $final_arr = array(); 
        return $final_arr = array_values($chk_name); 
    }

}