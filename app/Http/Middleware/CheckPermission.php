<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\SiteHelper;
use Auth;
class CheckPermission
{
    /**
     * For checking user permission
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next ,$permission = null)
    {
        if (!SiteHelper::can($permission) ) {
             if ($request->ajax()) { 
                return response([
                    'error' => 'Forbidden',
                    'error_description' => 'Permission denied.',
                    'data' => [],
                ], 403);
            } else {

                return redirect('/forbidden');
            }
        }
        return $next($request);
    }
}