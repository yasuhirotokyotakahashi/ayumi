<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Profile;
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

        $item->delete();
        return redirect()->route('items.index');
    }


    public function address()
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




    public function updateAddress(Request $request, Profile $profile)
    {


        $userId = Auth::id();


        // 画像アップロード処理
        if ($request->file('img') !== null) {
            // 画像を保存するディレクトリを指定
            $image = $request->file('img');
            $filename = $image->getClientOriginalName(); // オリジナルのファイル名を取得
            $path = $image->storeAs('public/images', $filename); // ファイルをstorage/app/public/imagesに保存し、publicディスクを使用



            // 保存された画像へのURLを取得
            $url = asset('storage/' . str_replace('public/', '', $path));

            // Eloquentを使用してデータベースに保存
            Profile::create([
                'postcode' => $request->input('postcode'),
                'address' => $request->input('address'),
                'building' => $request->input('building'),
                'img_url' => $url,
                'user_id' => $userId,
                // 他のフォームフィールドに対応する項目を追加
            ]);

            // ここに他の Item モデルに対する処理を追加することができます


            return redirect()->route('items.index');
        }
    }

    public function editAddress(Request $request, Profile $profile)
    {


        $userId = Auth::id();


        // 画像アップロード処理
        if ($request->file('img') !== null) {
            // 画像を保存するディレクトリを指定
            $image = $request->file('img');
            $filename = $image->getClientOriginalName(); // オリジナルのファイル名を取得
            $path = $image->storeAs('public/images', $filename); // ファイルをstorage/app/public/imagesに保存し、publicディスクを使用



            // 保存された画像へのURLを取得
            $url = asset('storage/' . str_replace('public/', '', $path));

            // Eloquentを使用してデータベースに保存
            Profile::create([
                'postcode' => $request->input('postcode'),
                'address' => $request->input('address'),
                'building' => $request->input('building'),
                'img_url' => $url,
                'user_id' => $userId,
                // 他のフォームフィールドに対応する項目を追加
            ]);

            // ここに他の Item モデルに対する処理を追加することができます


            return redirect()->route('items.index');
        }
    }

    public function addressTest(Request $request)
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

    public function addressUp(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'postcode' => 'required',
            'address' => 'required',
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
