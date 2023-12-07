<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $bills = Bills::all();
        return view('admin.bills.index', compact('bills'));
    }

    /**
     * @param Request $request
     */
    public function updateStatus(Request $request) {
        $id = $request->id;
        $bill = Bills::find($id);
        $bill->update([
            'status' => $request->active
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request) {
        $id = $request->id;
        $bill = Bills::find($id);
        $bill->delete();
        return redirect()->route('bills.index')->with('msg-add', 'Delete Bill Successfully');
    }
}
