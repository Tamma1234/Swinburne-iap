<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use \App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        return view('admin.permissions.create');
    }

    /**
     * @param PermissionRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            Permissions::create([
                'permission_name' => $request->permission_name,
            ]);
            DB::commit();
            return redirect()->route('permissions.index')->with('msg-add', 'Create roles successful');
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
