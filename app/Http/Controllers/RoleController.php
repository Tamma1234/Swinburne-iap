<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\RoleRequest;
use App\Models\Permissions;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $roles = Roles::orderBy('id', 'asc')->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create() {
        $permissions = Permissions::all();
        $permissionChildrens = Permissions::where('parent_id', 0)->get();
        return view('admin.roles.create', compact('permissions', 'permissionChildrens'));
    }

    /**
     * @param RoleRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRoleRequest $request) {
        try {
            DB::beginTransaction();
            $roles = new Roles();
            $role = $roles->create([
                'role_name' => $request->role_name,
                'is_active' => 1
            ]);
            $role->permissions()->attach($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index')->with('msg-add', 'Create Roles Success');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--GetLine' . $exception->getLine());
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request) {
        $role = Roles::find($request->id);
        $permissions = Permissions::all();
        $permissionChildrens = Permissions::where('parent_id', 0)->get();

        return view('admin.roles.edit', compact('role', 'permissions', 'permissionChildrens'));
    }

    /**
     * @param RoleRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
//        try {
//            DB::beginTransaction();
            $role = Roles::find($request->id);
            $role->update([
                'role_name' => $request->role_name,
                'is_active' => 1,
            ]);
            $role->permissions()->sync($request->permission_id);
//            DB::commit();
            return redirect()->route('roles.index')->with('msg-add', 'Update Role Success');
//        } catch (\Exception $exception) {
//            DB::rollBack();
//            Log::error('Message :' . $exception->getMessage() . '--GetLine' . $exception->getLine());
//        }
//
//        return redirect()->route('roles.index')->with('msg', 'Update Role successful');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request) {
        $role = Roles::find($request->id);
        $role->delete();

        return redirect()->route('roles.index')->with('msg-delete', 'Delete the Role and cancel in the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function roleTrashOut(Request $request) {
        $roles = Roles::onlyTrashed()->get();
        return view('admin.roles.trash', compact('roles'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request) {
        Roles::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('roles.trash')->with('msg', 'Roles deleted successfully');
    }
}
