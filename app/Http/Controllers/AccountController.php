<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function register()
    {
        return view('admin.account.register');
    }

    public function processRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->passes()) {

            $user = new User();
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success', 'You have registered successfully');

            return response()->json([
                'status' => true,
                'errors' => [],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function login()
    {
        return view('admin.account.login');
    }

    public function authenticate(Request $request)
    {
        $rules = [
            'idendity' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $idendity = $request->input('idendity');

            $credentials = []; // Initialize empty array

            if (filter_var($idendity, FILTER_VALIDATE_EMAIL)) {
                $credentials = ['email' => $idendity];
            } else {
                $credentials = ['mobile' => $idendity]; // Assuming phone number is stored without country code
            }

            // Include password explicitly
            $credentials['password'] = $request->password;

            if (Auth::guard('admin')->attempt($credentials)) {

                if(Auth::guard('admin')->user()->role != 'admin') {
                    Auth::guard('admin')->logout();
                    return redirect()->back()->with('error', 'You are not authorized to access this page.');
                }
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid credentials. Please check your email, phone number, or password.');
            }
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function forgotPassword()
    {
        return view('admin.account.forgot-password');
    }

    public function processForgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return redirect()->route('forgotPassword')->withInput()->withErrors($validator);
        }

        $token = Str::random(60);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        //Send Mail
        $user = User::where('email', $request->email)->first();
        $mailData = [
            'token' => $token,
            'user' => $user,
            'subject' => 'You have requested to change your password.'
        ];

        Mail::to($request->email)->send(new ResetPasswordEmail($mailData));
        return redirect()->route('forgotPassword')->with('success', 'Rest Password email has been sent to your inbox.');
    }

    public function restPassword($tokenString)
    {
        $token = DB::table('password_reset_tokens')->where('token', $tokenString)->first();

        if ($token == null) {
            return redirect()->route('forgotPassword')->with('error', 'Invalid Token');
        }

        return view('admin.account.reset-password', [
            'tokenString' => $tokenString,
        ]);
    }

    public function processResetPassword(Request $request)
    {
        $token = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        if ($token == null) {
            return redirect()->route('forgotPassword')->with('error', 'Invalid Token');
        }

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return redirect()->route('restPassword', $request->token)->withErrors($validator);
        }

        User::where('email', $token->email)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('login')->with('success', 'You have successfully changed your password');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
