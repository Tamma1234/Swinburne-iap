<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Google_Client;
use Google_Service_Drive;
use Illuminate\Support\Facades\Log;

class UploadImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $usersWithoutQR;
    public $connection;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($usersWithoutQR, $connection)
    {
        $this->usersWithoutQR = $usersWithoutQR;
        $this->onConnection($connection);

    }

    public function handle()
    {
        $client = new Google_Client();
        $client->setAuthConfig(config('services.google.credentials_path'));
        $client->addScope(Google_Service_Drive::DRIVE);

        $drive = new Google_Service_Drive($client);
        $file = $drive->files->create($this->fileMetadata, [
            'data' => $this->content,
            'mimeType' => 'image/svg+xml', // Đặt định dạng MIME là SVG
            'uploadType' => 'multipart',
            'fields' => 'id'
        ]);
        $fileId = $file->id;

        // Cập nhật cột 'file_qr' của người dùng
//        $user = User::find($this->fileMetadata['user_id']);
//        if ($user) {
//            $user->update(['file_qr' => $fileId]);
//        }
        // Lưu QR code dưới dạng file ảnh PNG vào thư mục public/qr_code
        // Cập nhật tên file QR code vào cột 'file_qr' của người dùng
//        $user->update(['file_qr' => $fileId]);
        Log::info("Image uploaded to Google Drive with ID: $fileId");
    }
}
