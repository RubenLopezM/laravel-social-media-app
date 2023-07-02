<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function assignRole(Request $request, User $user){
        $roles = $request->input('roles');
        $rolesId = DB::table('roles')->whereIn('name', $roles)->pluck('id');
        
        $user->roles()->attach($rolesId);

        return $user->roles->pluck('name');
    }
}
