<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function index($id)
    {

        $item = Item::find($id);
        $user = Auth::user();
        $permissions = [];

        if ($user) {
            // ログインユーザーの権限を取得
            $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        } else {
            // ログインしていない場合はnullを設定
            $userName = null;
        }

        $users = User::all();
        return Inertia::render('CommentForm', ['item' => $item,]);
    }

    public function create(CommentRequest $request, $id)
    {
        $userId = Auth::id();
        // コメントを保存
        Comment::create([
            'user_id' => $userId,
            'item_id' => $id,
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('items.index');
    }

    public function delete($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();
        return redirect()->route('user.mypage');
    }
}
