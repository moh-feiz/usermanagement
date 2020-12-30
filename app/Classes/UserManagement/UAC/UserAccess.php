<?php

namespace App\Classes\UserManagement\UAC;

use App\Models\UserAccess as ModelsUserAccess;


class UserAccess
{

    public function set($name, $parent_id)
    {
        $userAccess = new ModelsUserAccess();
        $userAccess->name = $name;
        $userAccess->parent_id = $parent_id;

        if ($userAccess->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function alter($userAccess_id, $name, $parent_id)
    {
        $userAccess = ModelsUserAccess::where('id', '=', $userAccess_id)->first();

        $userAccess->name = $name;
        $userAccess->parent_id = $parent_id;

        if ($userAccess->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function softDelete($userAccess_id)
    {
        $userAccess = ModelsUserAccess::where('id', '=', $userAccess_id)->first();

        if ($userAccess->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
