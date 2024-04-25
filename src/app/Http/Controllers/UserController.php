<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Comment;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    //
    public function mypage()
    {

        // ログインしているユーザーの情報を取得
        $user = auth()->user();

        $userComments = Comment::where('user_id', $user->id)
            ->with(['item', 'user'])
            ->get();
        // ユーザーが購入した商品を取得
        $soldItems = $user->soldItems;
        // ユーザーが出品した商品を取得
        $items = $user->items;

        $permissions = [];

        if ($user) {
            // ログインユーザーの権限を取得
            $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        } else {
            // ログインしていない場合はnullを設定
            $userName = null;
        }

        return Inertia::render('MyPage', [
            'user' => $user,
            'userComments' => $userComments,
            'soldItems' => $soldItems,
            'items' => $items,
            'permissions' => $permissions,
        ]);
    }

    public function profile()
    {
        $userId = Auth::id();
        $profile = Profile::where('user_id', $userId)->first();

        // プロフィールが存在しない場合は空のプロフィールを生成
        if (!$profile) {
            $profile = new Profile();
            $profile->user_id = $userId;
        }

        return Inertia::render('ProfileEditPage', ['profile' => $profile]);
    }

    public function updateProfile(ProfileRequest $request, Profile $profile)
    {
        // 画像アップロード処理
        if ($request->file('img') !== null) {
            // 画像を保存するディレクトリを指定
            $image = $request->file('img');
            $filename = $image->getClientOriginalName(); 
            $path = $image->storeAs('public/images', $filename); 

            $url = asset('storage/' . str_replace('public/', '', $path));

            $user = auth()->user();
            // プロフィールが存在する場合は更新、存在しない場合は新規作成
            if ($profile = $user->profile) {
                $profile->update([
                    'nickname' => $request->input('nickname'),
                    'postcode' => $request->input('postcode'),
                    'address' => $request->input('address'),
                    'building' => $request->input('building'),
                    'img_url' => $url,
                ]);
            } else {
                $userId = Auth::id();
                Profile::create([
                    'nickname' => $request->input('nickname'),
                    'postcode' => $request->input('postcode'),
                    'address' => $request->input('address'),
                    'building' => $request->input('building'),
                    'img_url' => $url,
                    'user_id' => $userId,
                ]);
            }

            return redirect()->route('user.mypage');
        }
    }
}
