<?php


namespace App\Services;

use App\Http\Controllers\VerificationEmail;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\CssSelector\Node\FunctionNode;

use function PHPSTORM_META\map;

class UserService
{

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email',$email)->first();
        if($user)
        {
            if(Hash::check($password,$user->password))
            {
                $user->tokens()->delete();
                $token = $user->createToken('apiToken')->plainTextToken;
                return response()->json([
                    'id'=>$user->id,
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'token'=>$token,
                    
                ],200);
            }
            else
            {
                return response()->json(['Message'=>"Invalid Password!"],400);
            }
        }
        else
        {
            return response()->json(['Message'=>"User Not Found!"],400);
        }

    }
    public function signup(Request $request)
    {
         $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
         ]);

         if($user)
         {
           $vf = new VerificationEmail();
           $vf->test($user->id);
             return response()->json($user,201);
         }
         else
         {
             return response()->json(['Message'=>"Operation Failed!"],400);
         }
    }

    public function checkTokens(Request $request)
    {
        $userToken = $request->token;
        $find = PersonalAccessToken::findToken($userToken);

        if($find)
        {
            return response()->json(['Message'=>"Valid Token!"],200);
        }
        else
        {
            return response()->json(['Message'=>"Invalid Token!"],400);
        }
    }
    public function logout()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return response()->json(['Message'=>"Logged Out Successfully!"],200);
    }

    public function userDetail()
    {
        $us = auth()->user();

        $user = User::withCount(['followers', 'following','posts'])->find($us->id);
    
        if ($user) {
            $userDetails = [
                'id' => $user->id,
                'name' => $user->name,
                'profilepicture'=>asset('images/'.$user->profilepicture),
                'followers_count' => $user->followers_count,
                'following_count' => $user->following_count,
                'post_count'=>$user->posts_count,
                'bio' => $user->bio,
            ];
    
            return response()->json($userDetails, 200);
        }
    
        return response()->json(['message' => 'User not found'], 404);
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
    
        $name = $user->name;
        $bio = $user->bio;
        $profilepicture = $user->profilepicture;
    
        $user->name = $request->input('name', $name);
        $user->bio = $request->input('bio', $bio);
    
        if ($request->hasFile('profilepicture')) {
            $image = $request->file('profilepicture');

            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->profilepicture = $imageName;
        }
    
        $user->save();
    
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'bio' => $user->bio,
            'profilepicture' => asset('images/' . $user->profilepicture),
        ], 200);
    }
    

}