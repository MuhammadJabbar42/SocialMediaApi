<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerificationReminder;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class VerificationEmail extends Controller
{
    //**Just For Testing **/
    public function verify()
    {
        $user = auth()->user();
        $user->email_verified_at = now();
        $user->save();
    }


    //**Email Verification Via Verfication Code**/
    public function resend()
    {
        $user = auth()->user();
        $verificationCode = mt_rand(100000, 999999);
        $user->remember_token = $verificationCode;
        Mail::to($user->email)->send(new VerifyEmail($verificationCode));
        $user->save();
    }

    public function resendId(string $id)
    {
        $user = User::find($id);
        $verificationCode = mt_rand(100000, 999999);
        $user->remember_token = $verificationCode;
        Mail::to($user->email)->send(new VerifyEmail($verificationCode));
        $user->save();
    }

    //**Logic For Verifying The Code**/
    public function checkCode(Request $request)
    {
        $user = auth()->user();
        if ($user->remember_token == $request->code) {
            $user->email_verified_at = now();
            $user->save();
            return response()->json("Email Verified Successfully!",200);
        } else {
            return response()->json("Your Verification Code Does not match!",404);
        }
    }

    //** Verifying By Token **/

    public function viaUrl(string $id)
    {
        $randomString = Str::random(32);
        $user = User::find($id);
        $user->remember_token = $randomString;
        $user->save();
        $verificationUrl = ('http://192.168.1.6:8000/api/v1/verify/'.$randomString);
        return $verificationUrl;
    }
    public function test(string $id)
    {

        $user = User::find($id);
        if($user->email_verified_at != null)
        {
            return response()->json([
                'Message'=>"Email Already Verified!",
            ],400);
        }
        $verificationUrl = $this->viaUrl($user->id);
         Mail::to($user->email)->send(new EmailVerificationReminder($verificationUrl));
        return response()->json([
            'Message'=>"Email Sent Successfully!",
            'URL'=>$verificationUrl,
        ],200);

    }
    public function verifyEmail($token)
    {
        $user = User::where('remember_token',$token)->first();
        if ($user) {
            $user->email_verified_at = now();
            $user->remember_token = null;
            $user->save();
            return redirect()->away('http://192.168.1.12:8000');
        }
        else
        {
            return response()->json("Your Verification Code Does not match!",400);
        }
    }



}
