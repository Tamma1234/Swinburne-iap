<?php

namespace App\Http\Controllers;

use App\Models\Guidline;
use App\Models\Items;
use App\Models\SwinGuiline;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;


class SwinGuidlineController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        return view('admin.guidline.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create() {
        return view('admin.guidline.create');
    }

    public function store(Request $request) {
        $content = $request->content;
        $description = $request->description;
        $date = $request->date_create;
        $name = $request->name;
        $type = $request->group_guidline;
        $fileId = "";
//        if ($request->hasFile('file_name')) {
//            $file = $request->file('file_name');
//            $driveFolderId = config('services.google.drive_folder_id_guidline');
//            $client = new Google_Client();
//
//            $client->setAuthConfig(config('services.google.credentials_path'));
//            $client->addScope(Google_Service_Drive::DRIVE);
//
//            $drive = new Google_Service_Drive($client);
//            $fileMetadata = new Google_Service_Drive_DriveFile([
//                'name' => $file->getClientOriginalName(),
//                'parents' => [$driveFolderId],
//            ]);
//            $content = file_get_contents($file->getRealPath());
//            $driveFile = $drive->files->create($fileMetadata, [
//                'data' => $content,
//                'mimeType' => $file->getClientMimeType(),
//                'uploadType' => 'multipart',
//            ]);
//
//            // Lấy ID của file mới tạo trên Google Drive
//            $fileId = $driveFile->id;
////            return response()->json(['id' => $fileId]);
////            $originalFileName = $request->image_url->getClientOriginalName();
////            $path = Storage::disk("google")->putFileAs("", $request->file('image_url'), $originalFileName);
////            $fileName = \Storage::disk("google")->getMetadata($path)['path'];
//        }
        SwinGuiline::create([
            'name' => $name,
            'group_guidline' => $type,
            'content' => $content,
            'date_create' => $date,
            'description' => $description,
            'images' => $fileId
        ]);
        return redirect()->route('guidline.index')->with('msg-add', 'Create Guidline Successfully');
    }
}
