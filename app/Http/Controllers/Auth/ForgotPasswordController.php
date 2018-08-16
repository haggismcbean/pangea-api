<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\ResetToken;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getResetToken(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
        
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return response()->json(['data' => 'User doesn\'t exist'], 400);
        }

        $token = $this->broker()->createToken($user);

        Mail::to($user)->send(new ResetToken($token));

        return response()->json(['data' => 'Email sent'], 200);
    }
}
