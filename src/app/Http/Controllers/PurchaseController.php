<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Profile;
use App\Models\SoldItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PurchaseController extends Controller
{
    public function index($id)
    {
        $item = Item::find($id);
        $user = Auth::user();
        $purchasedItems =
            $user ? $user->soldItems()->get() : collect();
        $purchasedItemIds = $purchasedItems->pluck('id')->toArray();


        return Inertia::render('PurchaseForm', ['item' => $item, 'purchasedItems' => $purchasedItems, 'purchasedItemIds' => $purchasedItemIds]);
    }

    public function purchase(Item $item)
    {
        // SoldItem モデルに新しいデータを作成して保存
        SoldItem::create([
            'user_id' => auth()->id(), // ログインユーザーのIDなど、購入したユーザーのIDを指定
            'item_id' => $item->id, // 購入したアイテムのIDを指定
            'purchased_at' => Carbon::now(), // 現在の日時を設定
        ]);
        return redirect()->route('purchase.address');
    }

    public function address()
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
        $userId = Auth::id();
        $profile = Profile::where('user_id', $userId)->first();

        // プロフィールが存在しない場合は空のプロフィールを生成
        if (!$profile) {
            $profile = new Profile();
            $profile->user_id = $userId;
        }

        return Inertia::render('ProfileEditPage', ['profile' => $profile, 'permissions' => $permissions,]);
    }

    public function updateAddress(Request $request, Profile $profile)
    {

        // 画像アップロード処理

        if ($request->file('img') !== null) {
            // 画像を保存するディレクトリを指定
            $image = $request->file('img');
            $filename = $image->getClientOriginalName(); // オリジナルのファイル名を取得
            $path = $image->storeAs('public/images', $filename); // ファイルをstorage/app/public/imagesに保存し、publicディスクを使用

            // 保存された画像へのURLを取得
            $url = asset('storage/' . str_replace('public/', '', $path));

            $user = auth()->user();
            $profile = $user->profile;

            // プロフィールが存在する場合は更新、存在しない場合は新規作成
            if ($profile->exists) {
                $profile->update([
                    'postcode' => $request->input('postcode'),
                    'address' => $request->input('address'),
                    'building' => $request->input('building'),
                    'img_url' => $url,
                    // 他のフォームフィールドに対応する項目を追加
                ]);
            } else {
                $userId = Auth::id();
                Profile::create([
                    'postcode' => $request->input('postcode'),
                    'address' => $request->input('address'),
                    'building' => $request->input('building'),
                    'img_url' => $url,
                    'user_id' => $userId,
                    // 他のフォームフィールドに対応する項目を追加
                ]);
            }

            // ここに他の Item モデルに対する処理を追加することができます

            return redirect()->route('items.index');
        }
    }
}
