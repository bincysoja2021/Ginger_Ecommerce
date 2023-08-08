<?php

namespace App\Helpers;

use Auth,Log;
use App\Models\User;

class SiteHelper
{
    public static function can($perm)
    {
    	$user_id = Auth::id();
    	$user = User::find($user_id);
    	$check_list = array();
    	foreach ($user->roles()->get() as $key => $value) {
    		$check_list = array_merge($check_list,$value->permissions()->pluck('permission.slug')->toArray());
    		$check_list = array_unique($check_list);
    	}
    	return in_array($perm, $check_list);
    }
}
?>