<?php

namespace App\Http\Controllers;

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

        // ユーザーが購入した商品を取得
        $soldItems = $user->soldItems;

        // ユーザーが出品した商品を取得
        $items = $user->items;

        $permissions = [];

        if ($user) {
            // ログインユーザーの権限を取得
            $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        } else {
            // ログインしていない場合はnullを設定するか、必要に応じてデフォルトの名前を設定します
            $userName = null;
        }

        // ビューにデータを渡してマイページをレンダリング
        return Inertia::render('MyPage', [
            'user' => $user,
            'soldItems' => $soldItems,
            'items' => $items,
            'permissions' => $permissions,
        ]);
    }

    public function profile(Request $request)
    {
        $userId = Auth::id();
        $profile = Profile::where('user_id', $userId)->first();

        // プロフィールが存在しない場合は空のプロフィールを生成
        if (!$profile) {
            $profile = new Profile();
            $profile->user_id = $userId;
        }

        return Inertia::render('AddressEditPage', ['profile' => $profile]);
    }

    public function updateProfile(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'postcode' => 'required',
            'address' => 'required',
            'building' => 'required',
        ]);
        // 画像がアップロードされた場合のみ処理を行う
        if ($request->hasFile('img')) {
            // 画像を保存するディレクトリを指定
            $image = $request->file('img');
            $filename = $image->getClientOriginalName();
            $path = $image->storeAs('public/images', $filename);

            // 保存された画像へのURLを取得
            $url = asset('storage/' . str_replace('public/', '', $path));

            // 画像のURLを更新
            $profile->img_url = $url;
        }
        // リクエストからデータを取得し、Item モデルを更新
        $profile->update($validated);

        // 更新後のリダイレクト先を指定（適切なURLやルートに変更する）
        return redirect()->route('items.index');
    }
}
