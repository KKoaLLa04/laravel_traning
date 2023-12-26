<?php

use App\Models\Groups;
use App\Models\Doctors;

function getAllGroup()
{
    $groups = new Groups;
    return $groups->getAll();
}

// function isActiveDoctor($email)
// {
//     $count = Doctors::where('email', $email)->where('is_active', 1)->count();
//     if ($count > 0) {
//         return true;
//     }

//     return false;
// }

function isRole($dataArr, $moduleName, $role = 'view')
{
    if (!empty($dataArr[$moduleName])) {
        $checkPermission = $dataArr[$moduleName];
        if (!empty($checkPermission) && in_array($role, $checkPermission)) {
            return true;
        }
    }

    return false;
}
