<?php

namespace App\Http\Controllers\Sellers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function showProfile()
    {
        return view('sellers.users.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth('sellers')->user();

        $this->validate($request, [
            'seller_name' => 'required|string|max:191',
            'username' => 'required|string|max:191',
        ]);

        if ($request->password || $request->password_confirmation) {
            $this->validate($request, [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required',
            ]);

            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'image|max:2048',
            ]);

            $imageName = time() . '_' . $user->id . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/sellers/'), $imageName);

            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            $user->image = '/uploads/sellers/' . $imageName;
        }

        $user->seller_name = $request->seller_name;
        $user->username = $request->username;
        $user->bio = $request->bio;
        $user->save();

        if ($request->password) {
            DB::table('sessions')->where('user_id', auth('sellers')->user()->id)->delete();
        }


        $options = $request->only([
            'theme_color',
            'theme_font',
            'menu_type'
        ]);

        foreach ($options as $option => $value) {
            user_option_update($option, $value);
        }

        return response()->json('success');
    }
}
