<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;
use App\Models\PasswordReset;
use App\Models\UserLocation;

use Carbon\Carbon;
use Illuminate\Support\Str;

class AuthController extends ApiController
{

    public function login(Request $request)
    {
        $rules = ['email' => 'required|email', 'password' => 'required|min:8'];
        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), false);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
            //  dd($request->all());
            if (Auth::attempt($request->only(['email', 'password']))) {

                $token = Auth::user()->createToken('books')->accessToken;
                // parent::addUserDeviceData(Auth::user(), $request);
                return parent::success(['message' => 'Login Successfully', 'id' => Auth::id(), 'token' => $token, 'user' => Auth::user()]);

            } else {
                return parent::error('Credentials Not Matched');
            }
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }
    public function register(Request $request)
    {
        $rules = ['name' => 'required', 'email' => 'required|email|unique:users', 'password' => 'required|min:8', 'confirm_password' => 'required|min:8|same:password'];

        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), false);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
            // dd('ss');
            $input = $request->all();
            $input['password'] = Hash::make($request->password);
            $user = User::create($input);
            $user->save();
            $token = $user->createToken('books')->accessToken;
            return parent::successCreated(['message' => 'Created Successfully', 'token' => $token, 'user' => $user]);
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }
}