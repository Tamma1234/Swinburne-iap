<?php

namespace App\Http\Controllers;

use App\Mail\YourMailable;
use App\Models\Fu\Terms;
use App\Models\EmailDetail;
use App\Models\SendNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class NotificationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $terms = Terms::all();
        return view('admin.notifications.send-mail-group', compact('terms'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request) {
        $send = SendNotification::find($request->id);
        return view('admin.notifications.show', compact('send'));
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function listSend() {
        $sends = SendNotification::all();
        return view('admin.notifications.index', compact('sends'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function sendGrade() {
        $terms = Terms::all();
        return view('admin.notifications.send-grade', compact('terms'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSendMail(Request $request) {
       // dd($request->all());
        $content = $request->content;
        $title = $request->title_email;
        $dom= new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($content,LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');
            if (strpos($src, 'data:image') !== false) {
                list($type, $data) = explode(';', $src);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $image_name = "/upload/" . time() . $key . '.png';
                file_put_contents(public_path() . $image_name, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', url($image_name)); // Sử dụng đường dẫn URL đầy đủ
            }
        }
        $content = $dom->saveHTML();
//        $send_mail = SendNotification::create([
//            'title' => $title,
//            'content' => $content
//        ]);
//        $send_mail_id = $send_mail->id;
//        $sendMailFind = SendNotification::find($send_mail_id);
//        $title_send = $sendMailFind->title;
//        $content_send = $sendMailFind->content;
        $phong_ban = $request->phongban;
        $email = "thientam160796@gmail.com";
        //if ($phong_ban == "academic") {
        $emailDetail = EmailDetail::where('department', $phong_ban)->first();
        if ($emailDetail) {
                // Cấu hình email dựa trên thông tin lấy từ database
                Config::set('mail.mailers.second_smtp', [
                    'transport' => 'smtp',
                    'host' => $emailDetail->host,
                    'port' => $emailDetail->port,
                    'encryption' => $emailDetail->encryption,
                    'username' => $emailDetail->email,
                    'password' => $emailDetail->password,
                    'timeout' => null,
                    'auth_mode' => null,
                ]);
                Config::set('mail.from.address', $emailDetail->email);
                Config::set('mail.from.name', $emailDetail->email);
                Mail::mailer('second_smtp')->to($email)->send(new YourMailable($title, $content));
                // Gửi email bằng cấu hình động

            } else {
                // Xử lý nếu không tìm thấy thông tin email

                return back()->with('error', 'Không tìm thấy thông tin email cho phòng ban này.');
            }
//        } else {
//            Mail::to($email)->send(new YourMailable($data));
//
//        }
        return back()->with('success', 'Email đã được gửi thành công.');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function sendGroup() {
        return view('admin.notifications.send-mail-group');

    }

    public function uploadImage(Request $request) {
        dd($request->hasFile('file'));
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('images', 'public');
            return response()->json(['url' => Storage::url($path)]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
