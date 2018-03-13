<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin');
    }

    public function showLoginForm(){
        return view('auth.admin-login');
    }

    public function login(Request $request){
        // Validate the form data
        $this->validateLogin($request);

        // Attempt to login
        if($this->attemptLogin($request)){
            // if succesfull
            return $this->sendLoginResponse($request);
        }
        
        // if unsuccessfull
        return $this->sendFailedLoginResponse($request);
    }



    protected function sendLoginResponse(Request $request){
        $request->session()->regenerate();


        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        //
    }

    protected function attemptLogin(Request $request){
        $this->guard()->attempt($this->credentials($request), $request->filled('remember'));
    }

    protected function credentials(Request $request){
        return $request->only($this->username(), 'password');
    } 

    protected function validateLogin(Request $request){
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string'
        ]);
    }

    public function logout(Request $request)
    {
        $this->guard('admin')->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    public function username(){
        return 'email';
    }

    public function redirectPath(){
        return route('admin.dashboard');
    }

    protected function guard(){
        return Auth::guard('admin');
    }
}
