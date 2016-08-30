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
    * Save Register User.
    * paths url    : signup
    * methode      : POST
    * @param  string   $email          Email users
    * @param  string   $password       password users
    * @return Response
    */
    public function PostUserSignUp(SignUpRequest $req)
    {
        $param = $req->all();
        $newUser = $this->model->createNewUser($param);
        if($newUser['code'] == '200') {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => trans('general.signup_success')
            ],200);

        } else {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => trans('general.signup_error').'. '.$newUser['message']
            ],400);
        }
    }

    /**
    * Login User.
    * paths url    : login
    * methode      : POST
    * @param  string   $email          Email users
    * @param  string   $password       password users
    * @return Response
    */
    public function PostUserLogin(LoginRequest $req)
    {
        $param = $req->all();
        $login = $this->model->setLoginUser($param);
        if($login['code'] == '200') {
            $insertLog = new LogActivity();
            $dataLog = array('user_id'=>$login['data']->id,'description'=>'Login via web');
            $insertLog->insertLogActivity($dataLog);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => trans('general.login_success')
            ],200);

        } else {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => trans('general.login_error').'. '.$login['message']
            ],400);
        }
    }

    /**
    * Activation Account User.
    * paths url    : activation-user/{code}
    * methode      : POST
    * @param  string   $code          Code Activation user
    * @return Response
    */
    public function activationUser($id, $code)
    {
        $user = Sentinel::findById($id);
        if ($user) {
            $activation = \Activation::exists($user);
            if($activation) {
                if (\Activation::complete($user, $code)){
                    Sentinel::login($user);
                    return redirect('/admin/login');
                } else {
                    return redirect('/admin/login');
                }
            } else {
                return redirect('/admin/login');
            }
        } else {
            return redirect('/admin/login');
        }
    }

    /**
    * Create new user from social media.
    * paths url    : auth-social-media
    * methode      : POST
    * @param  string   $token           Token Social Media
    * @param  string   $token_secret    Token Secret Social Media
    * @param  string   $id              Id social media
    * @param  string   $username        Username social media
    * @param  string   $email           Email social media
    * @param  string   $type_sosmed     Type social media
    * @return Response
    */
    public function authSocialMedia(BaseRequest $req)
    {
        $param = $req->all();

        $dataParam['email'] = $param['email'];
        if(array_key_exists('username', $param)) {
            $dataParam['username'] = $param['username'];
        } else {
            $dataParam['username'] = $param['email'];
        }
        $dataParam['id'] = $param['id'];
        $dataParam['type'] = $param['type_sosmed'];
        $dataParam['token'] = $param['token'];
        $dataParam['first_name'] = $param['first_name'];
        $dataParam['last_name'] = $param['last_name'];
        if(array_key_exists('token_secret', $param)) {
            $dataParam['token_secret'] = $param['token_secret'];
        } else {
            $dataParam['token_secret'] = '';
        }
        if(array_key_exists('image_url', $param)) {
            $dataParam['image_url'] = $param['image_url'];
        } else {
            $dataParam['image_url'] = '';
        }

        $checkUserExist = $this->model->checkUserByEmail($param['email']);
        if($checkUserExist) {
            $user_id = $checkUserExist->id;
            Sentinel::login($checkUserExist);

            $insertLog = new LogActivity();
            $dataLog = array('user_id'=>$user_id,'description'=>'Login via social media '.$param['type_sosmed']);
            $insertLog->insertLogActivity($dataLog);

            $SocialMedia = new SocialMedia();
            $newSocialMedia = $SocialMedia->createNewSocialMedia($dataParam,$user_id);
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => trans('general.login_success')
            ],200);
        } else {

            $dataParam['password'] = str_random(10);
            $newUser = $this->model->createNewUser($dataParam,'sosmed');
            if($newUser['code'] == '200') {

                $user_id = $newUser['data']->id;

                $SocialMedia = new SocialMedia();
                $newSocialMedia = $SocialMedia->createNewSocialMedia($dataParam,$user_id);

                $user = Sentinel::findById($user_id);
                Sentinel::login($user);

                $insertLog = new LogActivity();
                $dataLog = array('user_id'=>$user_id,'description'=>'Login via social media '.$param['type_sosmed']);
                $insertLog->insertLogActivity($dataLog);

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => trans('general.login_success')
                ],200);

            } else {

                return response()->json([
                    'code' => 400,
                    'status' => 'error',
                    'message' => trans('general.login_error').'. '.$newUser['message']
                ],400);

            }

        }

    }

    /**
    * Redirect to oauth twitter.
    * paths url    : auth-twitter
    * methode      : GET
    * @return Response
    */
    public function redirectSocialMedia($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    public function callbackTwitter(BaseRequest $req)
    {
        $data = $req->all();
        if(array_key_exists('denied', $data)){
            return redirect('/admin/login')->withModalshow('form_login')->withMessageshow(trans('general.login_error'));
        }else{

            $user = \Socialite::driver('twitter')->user();
            if(count($user) > 0) {

                session(['twitter.twitterTokenSecret'=>$user->tokenSecret,
                        'twitter.twitterToken'=>$user->token,
                        'twitter.twitterId' => $user->id,
                        'twitter.nickname'=>$user->nickname,
                        'twitter.name'=>$user->name,
                        'twitter.avatar'=>$user->avatar_original]);

                $SocialMedia = new SocialMedia();
                $checkUpdate = $SocialMedia->findTwitterByAccountIdUpdate($user);
                if ($checkUpdate['code'] == 200) {
                    try
                    {

                        $checkUser = Sentinel::findById($checkUpdate['data']->user_id);
                        Sentinel::login($checkUser);

                        $insertLog = new LogActivity();
                        $dataLog = array('user_id'=>$checkUpdate['data']->user_id,'description'=>'Login via social media twitter');
                        $insertLog->insertLogActivity($dataLog);

                        return redirect('/admin/login');

                    }catch(\Exception $e){

                        return redirect('/admin/login')->withModalshow('form_login')->withMessageshow(trans('general.login_error').'. '.$e->getMessage());

                    }

                } else {

                    $dataParam['email'] = str_random(10).'@theclip.com';
                    $dataParam['username'] = session('twitter.nickname');
                    $dataParam['id'] = session('twitter.twitterId');
                    $dataParam['type'] = 'twitter';
                    $dataParam['token'] = session('twitter.twitterToken');
                    $dataParam['first_name'] = session('twitter.name');
                    $dataParam['last_name'] = '';
                    $dataParam['token_secret'] = session('twitter.twitterTokenSecret');
                    $dataParam['image_url'] = session('twitter.avatar');
                    $dataParam['password'] = str_random(10);

                    $newUser = $this->model->createNewUser($dataParam,'sosmed');
                    if($newUser['code'] == '200') {

                        $user_id = $newUser['data']->id;

                        $SocialMedia = new SocialMedia();
                        $newSocialMedia = $SocialMedia->createNewSocialMedia($dataParam,$user_id);
                        try
                        {
                            $user = Sentinel::findById($user_id);
                            Sentinel::login($user);

                            $insertLog = new LogActivity();
                            $dataLog = array('user_id'=>$user_id,'description'=>'Login via social media twitter');
                            $insertLog->insertLogActivity($dataLog);

                            return redirect('/admin/login');

                        }catch(\Exception $e){

                            return redirect('/admin/login')->withModalshow('form_login')->withMessageshow(trans('general.login_error').'. '.$e->getMessage());

                        }

                    } else {

                        return redirect('/admin/login')->withModalshow('form_login')->withMessageshow(trans('general.login_error').'. '.$newUser['message']);

                    }

                }

            } else {
                return redirect('/admin/login')->withModalshow('form_login')->withMessageshow(trans('general.login_error'));
            }
        }

    }

    public function submitEmail(BaseRequest $req)
    {
        $param = $req->all();
        $rules = array(
                'email'   => 'required|email|unique:users,email',
            );
        $validate = Validator::make($param,$rules);
        if($validate->fails()) {

            return response()->json($validate->errors(),422);

        } else {

            $dataParam['email'] = $param['email'];
            $dataParam['username'] = session('twitter.nickname');
            $dataParam['id'] = session('twitter.twitterId');
            $dataParam['type'] = 'twitter';
            $dataParam['token'] = session('twitter.twitterToken');
            $dataParam['first_name'] = session('twitter.name');
            $dataParam['last_name'] = '';
            $dataParam['token_secret'] = session('twitter.twitterTokenSecret');
            $dataParam['image_url'] = session('twitter.avatar');
            $dataParam['password'] = str_random(10);

            $newUser = $this->model->createNewUser($dataParam,'sosmed');
            if($newUser['code'] == '200') {

                $user_id = $newUser['data']->id;

                $SocialMedia = new SocialMedia();
                $newSocialMedia = $SocialMedia->createNewSocialMedia($dataParam,$user_id);

                $user = Sentinel::findById($user_id);
                Sentinel::login($user);
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => trans('general.login_success')
                ],200);

            } else {

                return response()->json([
                    'code' => 400,
                    'status' => 'error',
                    'message' => trans('general.login_error').'. '.$newUser['message']
                ],400);

            }
        }
    }

    /**
    * For reset password user.
    * paths url    : reset-password
    * methode      : POST
    * @return Response
    */
    public function resetPasswordUser(BaseRequest $req)
    {
        $param = $req->all();
        $rules = array(
                'email'   => 'required|email',
            );
        $validate = Validator::make($param,$rules);
        if($validate->fails()) {

            return response()->json($validate->errors(),422);

        } else {

            $credentials = [
                'login' => $param['email'],
            ];

            $resetPassword = $this->model->resetPassword($credentials);
            if ($resetPassword['code']=200) {

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => $resetPassword['message']
                ],200);

            } else {

                return response()->json([
                    'code' => 400,
                    'status' => 'error',
                    'message' => $resetPassword['message']
                ],400);

            }

        }

    }

    /**
    * Verify code for reset password .
    * paths url    : reset-password
    * methode      : get
    * @return Response
    */
    public function verifyResetPassword($id,$code)
    {
        $checkCode = $this->model->verifyCodeResetPassword($id,$code);
        if ($checkCode['code'] == 200) {
            return redirect('/admin/login')->withModalshow('form_reset')
                                ->withMessageshow($checkCode['message'])
                                ->withCodereset($code)
                                ->withUseridreset($id);
        } else {
            return redirect('/admin/login')->withModalshow('form_login')->withMessageshow($checkCode['message']);
        }

    }

    /**
    * Change Password User.
    * paths url    : change-password
    * methode      : POST
    * @param  string   $code           Token reset password
    * @param  string   $user_id        Id User
    * @param  string   $password       New Password User
    * @return Response
    */
    public function changePasswordUser(BaseRequest $req)
    {
        $param = $req->all();
        $rules = [
            'password'  => "required|min: 8|confirmed",
        ];
        $validate = Validator::make($param,$rules);
        if($validate->fails()) {

            return response()->json($validate->errors(),422);

        } else {

            $user_id = $param['user_id'];
            $code = $param['code'];
            $password = $param['password'];
            $changePassword = $this->model->changePassword($user_id,$code,$password);
            if($changePassword['code'] == 200) {
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => $changePassword['message']
                ],200);
            } else {
                return response()->json([
                    'code' => 400,
                    'status' => 'error',
                    'message' => $changePassword['message']
                ],400);

            }
        }
    }

    /**
    * Show form Sign Up user.
    * paths url    : signup
    * methode      : GET
    * @param  string   $email          Email users
    * @param  string   $password       password users
    * @return Response
    */
    public function userSignUp()
    {
        return view('auth.signup');
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
        Sentinel::logout();

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
                //flash()->error('Password is incorrect!');
                flash()->error('Wrong email or username!');

                return $backToLogin;
            }

            if (strtolower(Sentinel::check()->roles[0]->slug) == 'cro') {
                flash()->error('You Have No Access!');
                Sentinel::logout();
                return $backToLogin;
            }

            flash()->success('Login success!');
            return redirect()->route('admin-dashboard');
        } catch (ThrottlingException $e) {
            flash()->error('Too many attempts!');
        } catch (NotActivatedException $e) {
            flash()->error('Please activate your account before trying to log in.');
        }

        return $backToLogin;
    }

    public function logoutUser()
    {
        Sentinel::logout();
        return redirect('/admin/login');
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

        return redirect()->action('Auth\AuthController@getLogin');
    }
}
