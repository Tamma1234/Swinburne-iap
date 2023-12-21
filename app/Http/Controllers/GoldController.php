<?php

namespace App\Http\Controllers;

use App\Models\GoldExport;
use App\Models\Golds;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Excel;

class GoldController extends Controller
{
    public function index() {
        $golds = Golds::selectRaw('SUM(gold) as total, gold_receiver')->orderBy('total', 'desc')
        ->groupBy('gold_receiver')->get();

        return view('admin.golds.index', compact('golds'));
    }

    public function goldPresent() {
        return view('admin.golds.add');
    }

    public function goldUpdate(Request $request) {
        $gold = $request->gold;
        $user = auth()->user();
        $des = $request->description;
        $user_login = json_decode($request->user_login);
        $table = [];
       foreach ($user_login as $item) {
           $table[] = [
               'gold_receiver' => $item->value,
               'gold' => $gold,
               'gold_giver' => $user->user_code,
               'description' => $des
           ];
       }
       Golds::insert($table);
       return redirect()->route('gold.index')->with('msg-add', 'Donate Gold Successfully');
    }

    public function goldDetail(Request $request) {
        $golds = Golds::where('gold_receiver', $request->user_code)->get();
        $user = \App\Models\User::where('user_code', $request->user_code)->first();
        $full_name = $user->user_surname .' '. $user->user_middlename .' '. $user->user_givenname;
        return view('admin.golds.detail', compact('golds', 'user', 'full_name'));
    }

    public function goldExport() {
        $timestamp = Carbon::now()->format('Ymd_His'); // Lấy ngày giờ hiện tại
        $filename = 'User-' . $timestamp . '.xlsx';

        return Excel::download(new GoldExport(), $filename);
    }
}
