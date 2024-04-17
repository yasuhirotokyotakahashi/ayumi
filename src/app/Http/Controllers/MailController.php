<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Illuminate\Contracts\Mail\Mailer;

class MailController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $permissions = [];

        if ($user) {
            // ログインユーザーの権限を取得
            $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        } else {
            // ログインしていない場合はnullを設定するか、必要に応じてデフォルトの名前を設定します
            $userName = null;
        }

        $users = User::all();
        return Inertia::render('Mail/MailForm', ['users' => $users, 'permissions' => $permissions]);
    }

    //確認表示
    public function confirm(Request $request)
    {
        $recipientName = User::findOrFail($request->recipient_id)->name;
        return Inertia::render('Mail/Confirm', ['mail'  => $request->mail, 'body'  => $request->body, 'recipient_id'  => $request->recipient_id, 'recipient_name' => $recipientName,]);
    }


    //送信
    public function create(Request $request)
    {


        //問い合わせ内容を保存したりメールで送信する処理をここに記述
        // メールを送信

        $recipientId = $request->input('recipient_id');
        $recipientEmail = User::findOrFail($recipientId)->email;

        $mail = $request->input('mail');
        $body = $request->input('body');

        Mail::to($recipientEmail)->send(new SendMail($mail, $body));


        return Inertia::render('Mail/Complete');
    }
}
