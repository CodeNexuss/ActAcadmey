<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class LiveRestrict
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!isLiveEnv() || !isAdmin()) {
            return $next($request);
        }

        $delete_url = strlen((string)stripos(url()->current(),"delete"));

        // $unrestricted_routes = [
        //     'admin_authenticate',
        //     'send_email',
        //     'reports',
        //     'admin.add_admin_user',
        //     'admin.resubmit_listing',
        //     'admin.update_hostexp_status',
        //     'finance_reports',
        //     'admin.host_detailed_reports',
        //     'admin.host_table_reports',
        // ];

        $unrestricted_routes = [];
        
        if (($request->isMethod('POST') || $delete_url) && !in_array($request->route()->getName(),$unrestricted_routes)) {
            // Session::flash('alert-class', 'alert-danger');
            // Session::flash('message', 'Data add,edit & delete Operation are restricted in live.');
            // return redirect(url()->previous());
            return back()->with('error', 'Data add,edit & delete Operation are restricted in live');
        }

        return $next($request);
    }
}