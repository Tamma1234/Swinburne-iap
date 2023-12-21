<?php

namespace App\Http\Controllers;

use App\Models\Clubs;
use App\Models\User;
use App\Models\UserClub;
use App\Models\SwinClubMember;
use App\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;

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

    public function storeClub(Request $request) {
        $name = $request->club_name;
        $des = $request->description;
        $link_fb = $request->facebook;
        $date = $request->create_date;

        Service::clubSystemLog()->addClubLog($name);

        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');

            $driveFolderId = config('services.google.drive_folder_id_event');
            $client = new Google_Client();

            $client->setAuthConfig(config('services.google.credentials_path'));
            $client->addScope(Google_Service_Drive::DRIVE);

            $drive = new Google_Service_Drive($client);

            $fileMetadata = new Google_Service_Drive_DriveFile([
                'name' => $file->getClientOriginalName(),
                'parents' => [$driveFolderId],
            ]);
            $content = file_get_contents($file->getRealPath());
            $driveFile = $drive->files->create($fileMetadata, [
                'data' => $content,
                'mimeType' => $file->getClientMimeType(),
                'uploadType' => 'multipart',
            ]);
            // Lấy ID của file mới tạo trên Google Drive
            $fileId = $driveFile->id;
//            return response()->json(['id' => $fileId]);
//            $originalFileName = $request->image_url->getClientOriginalName();
//            $path = Storage::disk("google")->putFileAs("", $request->file('image_url'), $originalFileName);
//            $fileName = \Storage::disk("google")->getMetadata($path)['path'];
        }
        Clubs::create([
            'name' => $name,
            'description' => $des,
            'link_fb' => $link_fb,
            'date_thanh_lap' => $date,
            'image_url' => $fileId
        ]);

        return redirect()->route('club.index')->with('msg-add', 'Create Club Successfully');
    }

    public function store(Request $request)
    {
        $club_id = $request->club_id;
        $permission = $request->permission;
        $user_code = $request->user_code;
        Service::clubSystemLog()->addMemberClub($club_id, $user_code);
        SwinClubMember::create([
            'user_code' => $user_code,
            'club_id' => $club_id,
            'permission' => $permission,
            'status' => 0
        ]);

        return redirect()->route('club.detail', ['id' => $club_id])->with('msg-add', 'Create Member Susscefully');
    }

    public function edit(Request $request) {
        $club = Clubs::where('id', $request->id)->first();
        return view('admin.clubs.edit', compact('club'));
    }

    public function update(Request $request) {
        $club = Clubs::find($request->id);
        $club_images = $club->image_url;
        $fileId = "";

        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');

            $driveFolderId = config('services.google.drive_folder_id_event');
            $client = new Google_Client();

            $client->setAuthConfig(config('services.google.credentials_path'));
            $client->addScope(Google_Service_Drive::DRIVE);

            $drive = new Google_Service_Drive($client);

            $fileMetadata = new Google_Service_Drive_DriveFile([
                'name' => $file->getClientOriginalName(),
                'parents' => [$driveFolderId],
            ]);
            $content = file_get_contents($file->getRealPath());
            $driveFile = $drive->files->create($fileMetadata, [
                'data' => $content,
                'mimeType' => $file->getClientMimeType(),
                'uploadType' => 'multipart',
            ]);
            // Lấy ID của file mới tạo trên Google Drive
            $fileId = $driveFile->id;
//            return response()->json(['id' => $fileId]);
//            $originalFileName = $request->image_url->getClientOriginalName();
//            $path = Storage::disk("google")->putFileAs("", $request->file('image_url'), $originalFileName);
//            $fileName = \Storage::disk("google")->getMetadata($path)['path'];
        }
        Service::clubSystemLog()->editClubLog($club, $request->club_name);
        $club->update([
            'name' => $request->club_name,
            'description' => $request->description,
            'link_fb' => $request->facebook,
            'date_thanh_lap' => $request->create_date,
            'image_url' => $fileId
        ]);

        return redirect()->route('club.index')->with('msg-add', 'Update Club Successfully');
    }
    public function deleteMembder(Request $request) {
        $id = $request->id;
        $sw_club_member = SwinClubMember::find($id);
        Service::clubSystemLog()->deleteMemberClub($sw_club_member);
        $sw_club_member->delete();

        return response()->json(['msg_delete' => 'Delete User Club Successful']);
    }

    public function createClub()
    {
        return view('admin.clubs.create-club');
    }
}
