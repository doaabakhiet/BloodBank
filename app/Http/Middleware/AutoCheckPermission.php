<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutoCheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName=$request->route()->getName();
        $permissionData=Permission::whereRaw("FIND_IN_SET('$routeName',routes)")->first();
        // if($permissionData){
        //     $roles=$request->user()->roles;
        //     foreach($roles as $role){
        //         if($role){
        //             foreach($role->permissions as $permission){
        //                 if($permission->name == $permissionData->name){
        //                     return $next($request); 
        //                 }
        //                continue;
        //             }
        //         }
        //         else{
        //             abort(403);
        //         }
        //     }
        // }
        // else{
        //     abort(403);
        // }
        
    // dd($request->user());
    //dd(route('dashboard.users.index'));
        if($permissionData){
           if(!$request->user()->hasPermission($permissionData->name)){
                dd($request->user()->hasPermission('users-list'));
                abort(403);
            }
            return $next($request); 
        }
        else{
            return $next($request);
        }
    }
}
