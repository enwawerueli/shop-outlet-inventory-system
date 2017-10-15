<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Permission;

class UserController extends BaseController
{
    public function index()
    {
        $template = 'manage.manage';
        $users = User::all();
        return view($template)->with(compact('users'));
    }

    public function edit($userId)
    {
        $template = 'manage.user_profile';
        $user = User::find($userId);
        return view($template)->with(compact('user'));
    }

    public function destroy(Request $request, $userId)
    {
        if ($userId == $request->user()->id) {
            $this->notify('info', 'Admin user can only be deleted by another admin.');
        } else {
            $deleted = User::find($userId)->delete();
            if ($deleted) {
                $this->notify('success', 'User has been deleted successfully.');
            }
        }
        return back();
    }

    /**
     * Display current permissions for user
     * @param  int $userId
     * @return view
     */
    public function getPermissions($userId)
    {
        $template = 'manage.change_permissions';
        $user = User::find($userId);
        $permissions = Permission::orderBy('level')->get();
        return view($template)->with(compact('user', 'permissions'));
    }

    /**
     * Update/Create permissions for user
     * @param  Request $request
     * @param  int  $userId
     * @return redirect
     */
    public function applyPermissions(Request $request, $userId)
    {
        $user = User::find($userId);
        if ($user->is($request->user())) {
            $this->notify('info', 'Permissions for an admin user can only be modified by another admin.');
            return back()->with(compact('user'));
        }
        $input = $request->except('_token');
        if ($input) {
            $permissions = Permission::all();
            $highest = $permissions->whereIn('id', array_values($input))->max('level');
            $current = $user->permissions->pluck('id');
            $new = $permissions->filter(function($permission) use($highest) {
                return $permission->level <= $highest;
            })->pluck('id');
            $added = $new->diff($current);
            $dropped = $current->diff($new);
            $user->permissions()->attach($added);
            $user->permissions()->detach($dropped);
        } else {
            $user->permissions()->detach($user->permissions->pluck('id')->toArray());
        }
        $message = 'Permissions for user, '.$user->name.', have been applied successfully.';
        $this->notify('success', $message);
        return back()->with(compact('user'));
    }
}
