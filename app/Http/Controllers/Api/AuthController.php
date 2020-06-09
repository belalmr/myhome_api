<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ForgetPasswordRequest;
use App\Http\Requests\Api\Auth\LoginAuth;
use App\Http\Requests\Api\Auth\PasswordChange;
use App\Http\Requests\Api\Auth\PasswordRequest;
use App\Http\Requests\Api\Auth\RefreshForm;
use App\Http\Requests\Api\Auth\RegistrationForm;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Requests\Api\Auth\ShowMe;
use App\Http\Requests\Api\Auth\UserRequest;
use App\Http\Requests\Api\Auth\UserRequestAuth;
use App\Models\User;
use App\Models\UserProfile;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    use ResponseTrait;

    /**
     * Create user
     *
     * @param RegistrationForm $form
     * @return ResponseTrait
     */
    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:cscart_users',
            'password' => 'required|string|min:6',
            'device_token' => 'string|required_with:device',
            'device' => 'string|required_with:device_token',
        ]);
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = md5($request->password);
//        $user->status = 'A';
//        $user->user_id = Auth::id();
        $user->user_login = 'user_';
//        $user->device_token = $this->device_token;
//        $user->device = $this->device;
//        $user->token = $this->token;
//        $user->date_added = Carbon::now();
//        if ($this->input('device_token')) {
//            $user->device_token = $this->device_token;
//            $user->device = $this->device;
//        }
        $user->save();

        Auth::attempt(request(['email', 'password']));
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        $user->refresh();
        $user['access_token'] = $tokenResult->accessToken;
        $user['token_type'] = 'Bearer';
        $user['expires_at'] = Carbon::parse(
            $tokenResult->token->expires_at
        )->toDateTimeString();
        return $this->successJsonResponse([__('auth.registration_successful')], $user, 'User');

    }

    public function login(LoginAuth $test)
    {
        return $test->persist();
    }

    /**
     * Logout user (Revoke the token)
     *
     * @param Request $request
     * @return ResponseTrait
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $request->user()->token()->delete();
        return $this->successJsonResponse([__('auth.logout')]);
    }

    public function show(Request $request)
//    public function show(ShowMe $form)
    {
        $user = $request->user();
        $user['profile'] = UserProfile::where('user_id', $request->user()->user_id)->first();
        $user['access_token'] = DB::table('oauth_access_tokens')->where($user->id)->first()->id;
        $user['token_type'] = 'Bearer';
        $user['expires_at'] = '';
        return $this->successJsonResponse([], $user, 'User');
    }

    /**
     * update user profile
     *
     * @param UserRequestAuth $request
     * @return  ResponseTrait
     */
    public function update(UserRequestAuth $request)
    {
        return $request->update();
    }

    /**
     * Refresh device token
     *
     * @param RefreshForm $request
     * @return  ResponseTrait
     */
    public function refresh(RefreshForm $request)
    {
        return $request->refresh();
    }

    /**
     * @param PasswordRequest $request
     * @return JsonResponse
     */
    public function change_password(PasswordChange $request)
    {
        return $request->update();
    }

    /**
     * @param ForgetPasswordRequest $request
     * @return JsonResponse
     */
    public function forget_password(ForgetPasswordRequest $request)
    {
        return $request->update();
    }

    /**
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function reset_password(ResetPasswordRequest $request)
    {
        return $request->update();
    }

}
