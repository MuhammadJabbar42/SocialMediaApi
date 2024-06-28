<?php

namespace App\Services;

use App\Exceptions\UserException;
use App\Http\Controllers\CacheClearController;
use App\Http\Controllers\VerificationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class UserService
{

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if (!$user) {
            throw new UserException('No Account Made by that Credentials.', 404, null, false);
        } else {

            if (Hash::check($password, $user->password)) {
                $user->tokens()->delete();
                $token = $user->createToken('apiToken')->plainTextToken;
                return response()->json([
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'token' => $token,

                ], 200);
            } else {
                throw new UserException('Invalid Password.', 400);
            }
        }
    }

    public function signup(Request $request)
    {
        $transaction = DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profilepicture' => 'dummy.jpg',
            ]);

            if (!$user) {
                throw new UserException('Failed To Create User, Please Try Again Later.', 500);
            }

            $vf = new VerificationEmail();
            $vf->test($user->id);
            return ['message' => 'Account Created Successfully.'];
        });
        return response()->json($transaction, 201);
    }

    public function checkTokens(Request $request)
    {
        $userToken = $request->token;
        $find = PersonalAccessToken::findToken($userToken);

        if (!$find) {
            throw new UserException("Invalid Token.", 401);
        }
        return response()->json(['Message' => "Valid Token!"], 200);
    }

    public function logout()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return response()->json(['Message' => "Logged Out Successfully!"], 200);
    }

    public function userDetail()
    {
        $user = auth()->user();

        $cacheKey = 'user.details.' . $user->id;

        $userDetails = \Cache::remember($cacheKey, 3600, function () use ($user) {

            $userDetails = User::withCount(['followers', 'following', 'posts'])
                ->find($user->id);

            if (!$userDetails) {
                throw new UserException('No user found.', 404);
            }

            return [
                'id' => $userDetails->id,
                'name' => $userDetails->name,
                'profilepicture' => asset('images/' . $userDetails->profilepicture),
                'followers_count' => $userDetails->followers_count,
                'following_count' => $userDetails->following_count,
                'post_count' => $userDetails->posts_count,
                'bio' => $userDetails->bio,
            ];
        });

        return response()->json($userDetails, 200);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        CacheClearController::UserDetailClear($user->id);
        CacheClearController::Post();
        CacheClearController::UserPosts($user->id);

        return DB::transaction(function () use ($user, $request) {
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
        });
    }

    public function SearchForUsers(string $query)
    {
        $users = User::where('name', 'like',   $query . '%')->get();
            if($users->count() == 0) {
                throw new UserException('No User Found By That Name.', 404, null, false);
            }
            $users = $users->map(function ($user){
                return [
                    'name'=>$user->name,
                    'profilepicture'=>asset('images/'.$user->profilepicture),
                ];
            });

        return response()->json($users);

    }
}
