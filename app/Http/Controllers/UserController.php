<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Jobs\EventMailJob;
use App\Jobs\UploadImageJob;
use App\Models\Bill;
use App\Models\Dra\Curriculum;
use App\Models\Fu\UserLevel;
use App\Models\Office;
use App\Models\Roles;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Gate::allows('view_user')) {
            $curriculums = Curriculum::all();
            $users = User::where('user_level', 3)->get();
            $url = 'https://example.com';

            $qrCode = QrCode::size(150)->generate($url);

            return view('admin.users.index', compact('users', 'curriculums', 'qrCode'));
        } else {
            abort(403);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createQR()
    {
        $usersWithoutQR = User::where('user_level', 3)->whereNull('file_qr')->get();
        $fileId = "";
        $campus_code = session('campus_db');
        foreach ($usersWithoutQR as $user) {
            // Sinh mã QR code từ mã sinh viên của người dùng
            $qrCodeContent = $user->user_code;
            //dd($user->user_code);
            // Tạo QR code
            $qrCode = QrCode::format('svg')->size(300)->generate($qrCodeContent);

            // Tên file cho QR code
            $filename = $user->user_code . '.svg';

            // Đường dẫn lưu trữ file QR code trong thư mục public/qr_code
            $path = 'qr_code/' . $filename;

            file_put_contents(public_path($path), $qrCode);

            $svgFilePath = public_path($path);

            $driveFolderId = config('services.google.drive_folder_id_qrcode');
            $fileMetadata = new Google_Service_Drive_DriveFile([
                'name' => $filename,
                'parents' => [$driveFolderId],
            ]);

//            Storage::disk('public')->put($path, $qrCode);

            $content = file_get_contents($svgFilePath);
            Queue::connection($campus_code)->push(new UploadImageJob($content, $fileMetadata, $driveFolderId, $campus_code));
//            $emailJob = (new UploadImageJob($content, $fileMetadata, $driveFolderId, $campus_code))->delay(Carbon::now()->addSeconds(10));
//            $this->dispatch($emailJob);
        }

        return "Đã tạo và lưu QR code cho các người dùng chưa có QR code.";
    }

    public function create()
    {
        $roles = Roles::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        $users = new User();
        $role_id = $request->role_id;
        $user = $users->create([
            'user_pass' => Hash::make($request->user_pass),
            'user_login' => $request->user_login,
            'user_surname' => $request->user_surname,
            'user_middlename' => $request->user_middlename,
            'user_email' => $request->user_email,
            'user_givenname' => $request->user_givenname,
            'user_code_au' => "",
            'cmt' => "",
            'alternative_code' => "",
            'user_status' => 0,
            'ngaycap' => null,
            'campus_id' => 0,
            'office_id' => 0
        ]);
        $user_id = $user->id;
        $user = User::find($user_id);
        $user->roles()->attach($role_id);

        try {
            DB::beginTransaction();

            DB::commit();
            return redirect()->route('users.index')->with('msg-add', 'Create Account Successfuly');

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
        $user = User::find($request->id);
        $userLevel = UserLevel::all();
        $roles = Roles::all();

        return view('admin.users.edit', compact('user', 'roles', 'userLevel'));
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);
//        $user->update([
//            'user_surname' => $request->user_surname,
//            'user_middlename' => $request->user_middlename,
//            'user_givenname' => $request->user_givenname,
//        ]);
        $user->roles()->sync($request->role_id);

        return redirect()->route('users.index')->with('msg-update', 'Update Account Successfuly');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function postSearch(Request $request)
    {
        $userLevel = $request->user_level;
        $studyStatus = $request->study_status;
        $curriculum = $request->curriculum_id;
        $name = $request->user_givenname;
//        dd($userLevel . ' '. $studyStatus. ' ' .$curriculum);
        if ($userLevel && $studyStatus == null && $curriculum == null && $name == null) {
            $valueSearch = User::where('user_level', $userLevel)->get();
            return view('admin.users.table-search', compact('valueSearch'));
        }
        if ($studyStatus && $userLevel == null && $curriculum == null && $name == null) {
            $valueSearch = User::where('study_status', $studyStatus)->get();
            return view('admin.users.table-search', compact('valueSearch'));
        }
        if ($curriculum && $userLevel == null && $studyStatus == null && $name == null) {
            $valueSearch = User::where('curriculum_id', $curriculum)->get();
            return view('admin.users.table-search', compact('valueSearch'));
        }
        if ($name && $userLevel == null && $studyStatus == null && $curriculum == null) {
            $valueSearch = User::where('user_givenname', 'like', '%' . $name . '%')->get();
            return view('admin.users.table-search', compact('valueSearch'));
        }
        if ($userLevel && $studyStatus && $name == null && $curriculum == null) {
            $valueSearch = User::where('study_status', $studyStatus)
                ->where('user_level', $userLevel)
                ->get();
            return view('admin.users.table-search', compact('valueSearch'));
        }
        if ($userLevel && $curriculum && $name == null && $studyStatus == null) {
            $valueSearch = User::where('user_level', $userLevel)
                ->where('curriculum_id', $curriculum)
                ->get();
            return view('admin.users.table-search', compact('valueSearch'));
        }
        if ($userLevel && $name && $studyStatus == null && $curriculum == null) {
            $valueSearch = User::where('user_level', $userLevel)
                ->where('user_givenname', 'like', '%' . $name . '%')
                ->get();
            return view('admin.users.table-search', compact('valueSearch'));
        }
        if ($studyStatus && $curriculum && $name == null && $userLevel == null) {
            $valueSearch = User::where('study_status', $studyStatus)
                ->where('curriculum_id', $curriculum)
                ->get();
            return view('admin.users.table-search', compact('valueSearch'));
        }
        if ($studyStatus && $name && $userLevel == null && $curriculum == null) {
            $valueSearch = User::where('study_status', $studyStatus)
                ->where('user_givenname', 'like', '%' . $name . '%')
                ->get();
            return view('admin.users.table-search', compact('valueSearch'));
        }
        if ($curriculum && $name && $studyStatus == null && $curriculum == null) {
            $valueSearch = User::where('curriculum_id', $curriculum)
                ->where('user_givenname', 'like', '%' . $name . '%')
                ->get();
            return view('admin.users.table-search', compact('valueSearch'));
        }
        if ($userLevel && $studyStatus && $curriculum && $name == null) {
            $valueSearch = User::where('user_level', $userLevel)
                ->where('study_status', $studyStatus)
                ->where('curriculum_id', $curriculum)
                ->get();
            return view('admin.users.table-search', compact('valueSearch'));
        }
        if ($userLevel && $studyStatus && $name && $curriculum == null) {
            $valueSearch = User::where('user_level', $userLevel)
                ->where('study_status', $studyStatus)
                ->where('user_givenname', 'like', '%' . $name . '%')
                ->get();
            return view('admin.users.table-search', compact('valueSearch'));
        }
        if ($userLevel && $curriculum && $name && $studyStatus == null) {
            $valueSearch = User::where('user_level', $userLevel)
                ->where('curriculum_id', $curriculum)
                ->where('user_givenname', 'like', '%' . $name . '%')
                ->get();
            return view('admin.users.table-search', compact('valueSearch'));
        }
        if ($studyStatus && $curriculum && $name && $userLevel == null) {
            $valueSearch = User::where('study_status', $studyStatus)
                ->where('curriculum_id', $curriculum)
                ->where('user_givenname', 'like', '%' . $name . '%')
                ->get();
            return view('admin.users.table-search', compact('valueSearch'));
        }
        if ($userLevel && $studyStatus && $curriculum && $name) {
            $valueSearch = User::where('user_level', $userLevel)
                ->where('study_status', $studyStatus)
                ->where('curriculum_id', $curriculum)
                ->where('user_givenname', 'like', '%' . $name . '%')
                ->get();
            return view('admin.users.table-search', compact('valueSearch'));
        } else {
            $valueSearch = User::all();
            return view('admin.users.table-search', compact('valueSearch'));
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $userLevel = $request->userLevel;
        $studyStatus = $request->studyStatus;
        $curriculum = $request->curriculum;

        $searchUserLevel = User::where('user_level', $userLevel)->get();
        $searchStatus = User::where('study_status', $studyStatus)->get();
        $searchCurriculum = User::join('dra_curriculum', 'fu_user.curriculum_id', '=', 'dra_curriculum.id')
            ->where('dra_curriculum.id', $curriculum)
            ->get();

        return view('admin.users.table-search', compact('searchCurriculum', 'searchStatus', 'searchUserLevel',
            'userLevel', 'studyStatus', 'curriculum'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

        return redirect()->route('users.index')->with('msg-delete', 'Delete the Users and cancel in the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function userTrashOut(Request $request)
    {
        $users = User::onlyTrashed()->get();
        return view('admin.users.trash', compact('users'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request)
    {
        $user = User::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('users.trash')->with('msg-trash', 'Delete Account Successfully');
    }

    public function profile(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        return view('admin.users.profile', compact('user'));
    }
}
