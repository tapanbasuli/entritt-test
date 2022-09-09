<?php

function checkPermission($permissions){
    $userAccess = getMyPermission(auth()->user()->is_permission);
    foreach ($permissions as $key => $value) {
        if($value == $userAccess){
            return true;
        }
    }
    return false;
}

function getMyPermission($id)
{
    switch ($id) {
        case 1:
            return 'admin';
            break;
        case 2:
            return 'superadmin';
            break;
        case 3:
            return 'staff';
            break;
        case 4:
            return 'accountant';
            break;
        default:
            return 'client';
            break;
    }
}

function getCreatedAtAttribute($value)
{
    $date = \Carbon\Carbon::parse($value);
    return $date->format('Y-m-d');
}

/**
  * Remove any elements where the value is empty
  * @param  array $array the array to walk
  * @return array
*/
function replaceNullValues(array &$array){
    foreach ($array as $key => &$value) {
      if (is_array($value)) {
        $value = replaceNullValues($value);
      }
      if ($value === NULL) {
        $array[$key] = "";
      }
    }
    return $array;
}

?>
