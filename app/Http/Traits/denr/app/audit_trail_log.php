<?php

use App\Models\denr\Audit_Trail_Log as AuditTrailLogModel;

    $auditTrail = [

        'user_id' => $user->id,
        'action_type' => $action_type,
        'window_page' => $window_page,
        'window_type' => $window_type,
        'module_code' => $module_code,
        'remarks' => $remarks,
        
    ];

    AuditTrailLogModel::insert($auditTrail);