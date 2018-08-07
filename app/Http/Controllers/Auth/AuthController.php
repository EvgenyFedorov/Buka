<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\FevUser;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    public    $request;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);

        $this->request = $request;
        $input = $this->request->input();

        if(isset($input['redir'])){

            if($input['redir'] == "cart"){

                $this->redirectTo = "/user/cart";

            }

        }

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            //'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $password = FevUser::getGenerationCode(5, 10);
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($password),
            'no_hash_pass' => $password,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'last_ip' => $_SERVER['REMOTE_ADDR'],
            'id_group' => 2,
            'user_ranks' => 0,
            'confirm_email_link' => FevUser::getGenerationCode(10, 15),
            'confirm_email_status' => 0,
            'recovery_pass' => 0,
            'avatar' => 0,
            'status_online' => 0,
            'id_invite_user' => 0,
            'invite_code' => FevUser::getGenerationCode(10, 15),
        ]);
    }
    /*public function register(){

        return redirect('/');

    }
    public function showRegistrationForm(){

        return redirect('/');

    }*/
    /*public function login(){

        return redirect('/');

    }
    public function showLoginForm(){

        return redirect('/');

    }*/
}
