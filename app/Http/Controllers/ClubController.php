<?php

namespace App\Http\Controllers;

use App\Models\Clubs;
use App\Models\User;
use App\Models\UserClub;
use App\Models\SwinClubMember;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index() {
        $clubs = Clubs::all();
        return view('admin.clubs.index', compact('clubs'));
    }

    public function detail(Request $request) {
        $id = $request->id;
        $club_detail = Clubs::where('id', $id)->first();
        $user_club = SwinClubMember::where('club_id', $id)->get();

        return view('admin.clubs.detail', compact('club_detail', 'id', 'user_club'));
    }

    public function addManagement(Request $request)
    {
        $id = $request->id;
        $users = User::where('user_level', 3)->get();

        return view('admin.clubs.add', compact('users', 'id'));
    }

    public function store(Request $request)
    {
        $club_id = $request->club_id;
        $permission = $request->permission;
        $user_code = $request->user_code;

        SwinClubMember::create([
            'user_code' => $user_code,
            'club_id' => $club_id,
            'permission' => $permission,
            'status' => 0
        ]);

        return redirect()->route('club.detail', ['id' => $club_id])->with('msg-add', 'Create Member Susscefully');
    }

    public function deleteMembder(Request $request) {
        $id = $request->id;
        $sw_club_member = SwinClubMember::find($id);
        $sw_club_member->delete();

        return response()->json(['msg_delete' => 'Delete User Club Successful']);
    }
}
