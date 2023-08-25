<?php

namespace App\Http\Controllers;

use App\Models\Fu\Campus;
use App\Models\User;
use App\Models\Younger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
//    public function __construct()
//    {
//        $this->connection = $_GET['campus_id'];
//    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $user = Auth::user();
        if ($user) {
            return redirect()->route('rooms.index');
        }
        $campus = Campus::select('id', 'campus_code', 'campus_name')->get();
        $campusCode = "";
//        if (isset($_GET['campus_id'])) {
//            $campusCode = $_GET['campus_id'];
//            if ($campusCode == "ph") {
//                $this->connection = $campusCode;
//            }
//        }

        return view('admin.auth.login', compact('campus', 'campusCode'));
    }
}
