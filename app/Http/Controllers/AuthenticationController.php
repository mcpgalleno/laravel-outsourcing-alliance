<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthenticationController extends Controller
{

    protected $data;
    
    public function __construct(){
        $this->data['page_title'] = '';
    }

    public function login(Request $request) {
        $this->data['page_title'] = 'Login';
        return view('authentication.login', $this->data);
    }

    public function signupStepOne(Request $request) {
        $this->data['page_title'] = 'Sign Up';
        if('/login' === url()->previousPath()) {
           session()->forget('user_details');
        }
        $user_details = $request->session()->get('user_details');
        if(!empty($user_details)) {
            $this->data['user_details'] = $user_details;
        }
        return view('authentication.signup-step-one', $this->data);
    }

    public function signUpStepTwo(Request $request) {
        $this->data['page_title'] = 'Sign Up';
        $user_details = $request->session()->get('user_details');
        if(!empty($user_details)) {
            $this->data['user_details'] = $user_details;
        }
        return view('authentication.signup-step-two', $this->data);
    }
    
    public function createSignupStepOne(Request $request) {
        try {
            DB::beginTransaction();

            if(empty($request->session()->get('user_details'))) {
                $request->session()->put('user_details', [
                    'first_name' => $request->first_name,
                    'middle_name' => $request->last_name ? $request->last_name : null,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                ]);
            }

            $validatedData = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users',
                'mobile_number' => 'required',
            ]);

            $this->data['user_details'] = $request->session()->get('user_details');
            DB::commit();
            return redirect()->route('signup.step.two');

        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('notification-status', 'failed');
            session()->flash('notification-msg', $e->getMessage());
            return redirect()->back();
        }
    }

    public function createSignupStepTwo(Request $request) {
        try {

            DB::beginTransaction();

            session()->put('user_details.username', $request->username);
            session()->put('user_details.password', $request->password);
            session()->put('user_details.confirm_password', $request->confirm_password);
            
            $validatedData = $request->validate([
                'username' => 'required|unique:users',
                'password' => ['required', Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()],
                'confirm_password' => 'required',
            ]);
            
            if($request->password != $request->confirm_password) {
                DB::rollback();
                session()->flash('notification-status', 'failed');
                session()->flash('notification-msg', 'Passwords do not match.');
                return redirect()->route('signup.step.two');
            }

            $user_details = $request->session()->get('user_details');
            $user_details['username'] = $request->username;
            $user_details['password'] = Hash::make($request->password);

            $new_user = new User();
            $new_user->first_name = $user_details['first_name'];
            $new_user->middle_name = $user_details['middle_name'];
            $new_user->last_name = $user_details['last_name'];
            $new_user->email = $user_details['email'];
            $new_user->mobile_number = $user_details['mobile_number'];
            $new_user->username = $user_details['username'];
            $new_user->password = $user_details['password'];
            $new_user->save();

            DB::commit();
            session()->flash('notification-status', 'success');
            session()->flash('notification-msg', 'New user has been successfully created.');
            return redirect()->route('login');


        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('notification-status', 'failed');
            session()->flash('notification-msg', $e->getMessage());
            return redirect()->route('signup.step.two');
        }
    }

    public function handleLogin(Request $request) {
        try {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(!Auth::attempt(['email' => $request->email,'password' => $request->password])){
           throw new Exception('Invalid Email / Password.');
        }

        return redirect()->route('home');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('notification-status', 'failed');
            session()->flash('notification-msg', $e->getMessage());
            return redirect()->back();
        }
    }

    public function handleLogout(Request $request) {
        Auth::logout();
        return redirect()->back();
    }
}
