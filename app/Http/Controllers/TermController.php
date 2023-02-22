<?php

namespace App\Http\Controllers;

use App\Models\Fu\Terms;
use App\Models\Permissions;
use Illuminate\Http\Request;

class TermController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $terms = Terms::all();
        return view('admin.term.index', compact('terms'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createTerm() {
        return view('admin.term.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $term = new Terms();
        $term->create([
            'term_name' => $request->term_name,
            'startday' => $request->start_day,
            'endday' => $request->end_day
        ]);

        return redirect()->route('term.index')->with('msg-add', 'Add Successful Term');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request) {
        $term = Terms::find($request->id);
        return view('admin.term.edit', compact('term'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $term = Terms::find($request->id);
        $term->update([
            'term_name' => $request->term_name,
            'startday' => $request->start_day,
            'endday' => $request->end_day
        ]);
        return redirect()->route('term.index')->with('msg-update', 'Update Successful Term');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $term = Terms::find($request->id);
        $term->delete();

        return redirect()->route('term.index')->with('msg-delete', 'Delete Term and cancel the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function termTrashOut(Request $request)
    {
        $terms = Terms::onlyTrashed()->get();
        return view('admin.term.trash', compact('terms'));
    }

    public function restore(Request $request) {
       $term = Terms::withTrashed('id', $request->id)->restore();
        return redirect()->route('term.index')->with('msg-delete', 'successful term recovery');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request)
    {
        $terms = Terms::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('term.trash')->with('msg-trash', 'Terms deleted successfully');
    }
}
