<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use File;

class FaceBookController extends Controller
{
    /**
     * Login Using Facebook
     */
    public function loginUsingFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->user();

            $fileContents = file_get_contents($user->getAvatar() . '&access_token=' . $user->token);
            $pathImage = 'profile-photos/' . $user->id . "_avatar.jpg";
            $path = public_path() . '/storage//' . $pathImage;
            File::put($path, $fileContents);

            $saveUser = User::updateOrCreate([
                'facebook_id' => $user->getId(),
            ], [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => Hash::make($user->getName() . '@' . $user->getId()),
                'profile_photo_path' => $pathImage
            ]);

            Auth::loginUsingId($saveUser->id);

            return redirect()->route('plans');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
