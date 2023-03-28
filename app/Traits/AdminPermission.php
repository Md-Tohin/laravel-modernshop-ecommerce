<?php

namespace App\Traits;
use Illuminate\Support\Facades\Route;

trait AdminPermission
{
    public function checkRequestPermission(){
        if (
            empty(auth()->user()->role->permission['permission']['role']['list']) && \Route::is('role.index') || 
            empty(auth()->user()->role->permission['permission']['role']['add']) && \Route::is('role.store') ||  
            empty(auth()->user()->role->permission['permission']['role']['edit']) && \Route::is('role.edit-update') ||  
            empty(auth()->user()->role->permission['permission']['role']['delete']) && \Route::is('role.destroy') || 
            empty(auth()->user()->role->permission['permission']['role']['status']) && \Route::is('role.status') || 

            empty(auth()->user()->role->permission['permission']['subadmin']['list']) && \Route::is('sub-admin.index') ||
            empty(auth()->user()->role->permission['permission']['subadmin']['add']) && \Route::is('sub-admin.store') ||  
            empty(auth()->user()->role->permission['permission']['subadmin']['edit']) && \Route::is('sub-admin.edit-update') ||  
            empty(auth()->user()->role->permission['permission']['subadmin']['delete']) && \Route::is('sub-admin.destroy') ||

            empty(auth()->user()->role->permission['permission']['permission']['list']) && \Route::is('permission.index') ||
            empty(auth()->user()->role->permission['permission']['permission']['add']) && \Route::is('permission.store') ||  
            empty(auth()->user()->role->permission['permission']['permission']['edit']) && \Route::is('permission.edit-update') ||  
            empty(auth()->user()->role->permission['permission']['permission']['delete']) && \Route::is('permission.destroy')



        ) {
            return response()->view('admin.dashboard');
        }
    }
}
