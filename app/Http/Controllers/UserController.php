<?php


namespace App\Http\Controllers;

use App\Facades\UserServiceFacade;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function signup(StoreUserRequest $request)
    {
        return UserServiceFacade::signup($request);
    }
    public function login(Request $request)
    {
        return UserServiceFacade::login($request);
    }
    public function logout()
    {
        return UserServiceFacade::logout();
    }
    public function checkTokens(Request $request)
    {
        return UserServiceFacade::checkTokens($request);
    }
    public function userDetail()
    {
        return UserServiceFacade::userDetail();
    }
    public function updateProfile(Request $request)
    {
        return UserServiceFacade::updateProfile($request);
    }
    
}