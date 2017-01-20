<?php

namespace App\Http\Controllers\Auth;

use Mail;
use Event;
use Reminder;
use Sentinel;
use App\Http\Controllers\Controller;
use App\Events\Backend\ResetPasswordEvent;
use Illuminate\Http\Request as BaseRequest;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use App\Http\Requests\Backend\WebLoginRequest as Request;
use App\Http\Requests\Auth\SignUpRequest;
use App\Http\Requests\Auth\LoginRequest;
use DB;
use App\Models\User;
use App\Models\SocialMedia;
use App\Models\LogActivity;
use Validator;

class AuthController extends Controller
{
    /**
     * Create a new Backend\AuthController instance.
     *
     * @return void
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->middleware('sentinel_guest', ['except' => 'getLogout']);
    }

    /**
     * Admin Login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        $form = [
            'url' => route('admin-login'),
            'autocomplete' => 'off',
        ];

        return view('auth.login', compact('form'));
    }

    /**
     * Admin Logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {

        try{
            $log['description'] = 'A user log out';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
            
            Sentinel::logout();
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
        
        }

        return redirect()->route('admin-login');
    }

    /**
     * Admin Handle login request.
     *
     * @param  \App\Http\Requests\Auth\WebLoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $backToLogin = redirect()->route('admin-login')->withInput();
        $findUser = Sentinel::findByCredentials(['login' => $request->input('email')]);


        // If we can not find user based on email...
        if (! $findUser) {
            flash()->error('Wrong email or username!');

            return $backToLogin;
        }

        try {
            $remember = (bool) $request->input('remember_me');
            // If password is incorrect...
            if (! Sentinel::authenticate($request->all(), $remember)) {
                flash()->error('Wrong email or username!');

                return $backToLogin;
            }

            if (strtolower(Sentinel::check()->roles[0]->slug) == 'cro') {
                flash()->error('You Have No Access!');
                Sentinel::logout();
                return $backToLogin;
            }

            $log['description'] = 'A user log in';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            flash()->success('Login success!');
            //return redirect()->route('admin-dashboard');
            return redirect()->route('admin-index-event');
        } catch (ThrottlingException $e) {

            $log['description'] = 'A user login failed because too many attempts';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            flash()->error('Too many attempts!');
        } catch (NotActivatedException $e) {
            flash()->error('Please activate your account before trying to log in.');
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
        
        }

        return $backToLogin;
    }

    /**
     * Reset password page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getResetPassword()
    {
        $form = [
            'url' => route('admin-reset-password'),
            'autocomplete' => 'off',
        ];

        return view('auth.reset-password', compact('form'));
    }

    /**
     * Process reset password.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postResetPassword(BaseRequest $request)
    {
        $param = $request->all();

        $rules = array(
                'email'   => 'required|email',
            );
        $validate = Validator::make($param,$rules);

        if($validate->fails()) {

            return redirect()->route('admin-reset-password')->withInput()->withErrors($validate->messages());

        } else {

            $findUser = Sentinel::findByCredentials(['login' => $request->input('email')]);

            // If we can not find user based on email...
            if (! $findUser) {
                flash()->error('Email is not registered.');

                return redirect()->route('admin-reset-password')->withInput();
            }

            ($reminder = Reminder::exists($findUser)) || ($reminder = Reminder::create($findUser));

            Event::fire(new ResetPasswordEvent($findUser, $reminder));

            flash()->success('Check your inbox to reset password!');

            return redirect()->route('admin-login');

        }
    }

    /**
     * Change password page.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getChangePassword(BaseRequest $request)
    {
        $user = Sentinel::findById($request->input('id'));

        if (! Reminder::exists($user, $request->input('code'))) {
            flash()->error('You have no right to change password!');

            return redirect()->action('Auth\AuthController@getLogin');
        }

        $data = [
            'form' => [
                'url' => action('Auth\AuthController@postChangePassword'),
                'autocomplete' => 'off',
            ],
            'data' => $request->all(),
        ];

        return view('auth.change-password', $data);
    }

    /**
     * Process change password.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postChangePassword(BaseRequest $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = Sentinel::findById($request->input('id'));
        Reminder::complete($user, $request->input('code'), $request->input('password'));

        flash()->success('Password successfully changed!');
        $log['description'] = 'A user have changed password';
        $insertLog = new LogActivity();
        $insertLog->insertNewLogActivity($log);

        return redirect()->action('Auth\AuthController@getLogin');
    }
}
