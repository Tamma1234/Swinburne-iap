<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use \App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $permissions = Permissions::orderBy('id', 'asc')->paginate(20);
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $permissionChildrens = Permissions::where('parent_id', 0)->get();
        return view('admin.permissions.create', compact('permissionChildrens'));
    }

    /**
     * @param PermissionRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
            $permission = Permissions::create([
                'name' => $request->permission_name,
                'route_name' => $request->permission_name,
                'parent_id' => 0
            ]);

            foreach ($request->children as $value) {
                Permissions::create([
                    'name' => $value,
                    'route_name' => $value .'_' .$request->permission_name,
                    'parent_id' => $permission->id
                ]);
            }
            Alert::success('Successfully!', 'You Create Successfully');

            return redirect()->route('permissions.index');

    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request)
    {
        $permission = Permissions::find($request->id);
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * @param PermissionRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $permissions = Permissions::find($request->id);
        $permissions->update([
            'permission_name' => $request->permission_name
        ]);

        return redirect()->route('permissions.index')->with('msg-update', 'Update permissions successfuly');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $permissions = Permissions::find($request->id);
        $permissions->delete();

        return redirect()->route('permissions.index')->with('msg-delete', 'Delete permissions and cancel the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function permissionTrashOut(Request $request)
    {
        $permissions = Permissions::onlyTrashed()->get();
        return view('admin.permissions.trash', compact('permissions'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request)
    {
        $permissions = Permissions::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('permissions.trash')->with('msg-trash', 'Permissions deleted successfully');
    }
}
