<?php

namespace App\Http\Controllers;

use App\Models\Clubs;
use App\Models\User;
use App\Models\UserClub;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index() {
        $clubs = Clubs::all();
        return view('admin.clubs.index', compact('clubs'));
    }

    public function listStudent() {
        $studentList = User::where('user_level', 3)->select('user_code')->pluck('user_code')->toArray();
        return response()->json($studentList);
    }

    public function detail(Request $request) {
        $id = $request->id;
        $club_detail = Clubs::where('id', $id)->first();
        $user_club = UserClub::where('club_id', $id)->select('user_login')->pluck('user_login')->toArray();

        return view('admin.clubs.detail', compact('club_detail', 'id'));
    }

    public function store(Request $request) {
        $user_login = $request->user_login;
        dd($user_login);
    }
}
