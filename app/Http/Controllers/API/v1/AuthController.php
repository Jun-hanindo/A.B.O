<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\API\v1\BaseApiController;
use App\Models\API\v1\User;
use Validator;
use Sentinel;
use DB;
use App\Models\API\v1\SocialMedia;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\API\v1\LogActivity;

class AuthController extends BaseApiController
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
    * Save Register User API.
    * paths url    : API/v1/signup 
    * methode      : POST
    * @param  string   $email          Email users
    * @param  string   $username       Username users
    * @param  string   $password       password users
    * @return Response
    */
    public function ApiUserSignUp(Request $req)
    {
        $param = $req->all();
        \Log::info('Api Register');
        \Log::info($param);

        $rules = array(
                'email'     => 'required|email|unique:users,email',
                'username'  => 'required|unique:users,username',
                'password'  => "required|min: 8",
            );
        $validate = Validator::make($param,$rules);
        if($validate->fails()) {

            $status = array('code'=>422,'message'=>trans('general.signup_error'),'data'=>$validate->errors());

            \Log::info('status');
            \Log::info($status);
            return response()->json(array('error'=>$status),200);

        } else {

            $newUser = $this->model->createNewUser($param);
            if($newUser['code'] == 200) {

                $status = array('code'=>200,
                                'message'=>trans('general.signup_success'),
                                'status'=>'success',
                                'data'=>$newUser['data']
                            );

                return response()->json($status,200);

            } else {
                $status = array('code'=>500,
                                'message'=>trans('general.signup_error'),
                                'status'=>'error',
                                'data'=>array()
                            );
                
                \Log::info('status');
                \Log::info($status);
                return response()->json(array('error'=>$status),200);
            }
        }
    }

    /**
    * Login User API.
    * paths url    : API/v1/login 
    * methode      : POST
    * @param  string   $email          Email users
    * @param  string   $password       password users
    * @return Response
    */
    
    public function ApiLogin(Request $req)
    {
        $param = $req->all();
        \Log::info('Parameter Login');
        \Log::info($param);

        if($param['login_type'] == 1) {

            $validate = $this->model->validationLoginEmail($param);

            if($validate->fails()) {

                $status = array('code'=>422,'message'=>trans('general.signup_error'),'data'=>$validate->errors());

                \Log::info('return');
                \Log::info($status);
                return response()->json(array('error'=>$status),200);

            } else {

                $login = $this->model->setLoginUser($param);
                if($login['code'] == '200') {

                    try {
                        // attempt to verify the credentials and create a token for the user
                        if ($token = JWTAuth::fromUser($login['data'])) {
                            
                            $login['data']->token = $token;
                            $status = array('code'=>200,
                                    'message'=>trans('general.login_success'),
                                    'status'=>'success',
                                    'data'=>$login['data']
                                );

                            $data['user_id'] = $login['data']->id;
                            $data['description'] = 'Login via mobile';
                            $insertLog = new LogActivity();
                            $insertLog->insertLogActivity($data);

                            return response()->json($status,200);

                        } else {

                            $status = array('code'=>500,
                                    'message'=>trans('general.login_error'),
                                    'status'=>'error',
                                    'data'=>array()
                                );
                            return response()->json(array('error'=>$status),200);
                        }
                    } catch (JWTException $e) {
                        // something went wrong whilst attempting to encode the token
                        $status = array('code'=>500,
                                'message'=>trans('general.login_error').'. '.$e->getMessage(),
                                'status'=>'error',
                                'data'=>array()
                            );
                        return response()->json(array('error'=>$status),200);
                    }

                } else {
                    $status = array('code'=>500,
                                'message'=>trans('general.login_error').'. '.$login['message'],
                                'status'=>'error',
                                'data'=>array()
                            );

                    \Log::info('return');
                    \Log::info($status);
                    return response()->json(array('error'=>$status),200);
                }

            }

        // if login type from social media
        } else {

            $dataParam['id'] = $param['id'];
            if($param['login_type'] == 2) {
                $dataParam['type'] = 'facebook';
                $dataParam['email'] = $param['email'];
                $dataParam['username'] = $param['email'];
            } else if($param['login_type'] == 3) {
                $dataParam['type'] = 'twitter';
                $dataParam['email'] = str_random(10).'@theclip.com';
                $dataParam['username'] = $param['username'];
            } else if ($param['login_type'] == 4) {
                $dataParam['type'] = 'google';
                $dataParam['email'] = $param['email'];
                $dataParam['username'] = $param['email'];
            }
            
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
            
                try{

                    $user_id = $checkUserExist->id;
                    $dataUser = Sentinel::login($checkUserExist);
                    $token = JWTAuth::fromUser($dataUser);

                    $SocialMedia = new SocialMedia();
                    $newSocialMedia = $SocialMedia->createNewSocialMedia($dataParam,$user_id);
                    
                    $dataUser->token = $token;
                    $status = array('code'=>200,
                                'message'=>trans('general.login_success'),
                                'status'=>'success',
                                'data'=>$dataUser
                            );

                    \Log::info('return');
                    \Log::info($status);
                    return response()->json($status,200);

                }catch(\Exception $e){

                    $status = array('code'=>500,
                                'message'=>trans('general.login_error').'. '.$e->getMessage(),
                                'status'=>'error',
                                'data'=>array()
                            );

                    \Log::info('return');
                    \Log::info($status);
                    return response()->json(array('error'=>$status),200);

                }
                    
            } else {
                $checkSosmedByID = SocialMedia::where('account_id','=',$param['id'])->first();
                if(count($checkSosmedByID) > 0) {

                    try{

                       $checkUserExist = User::find($checkSosmedByID->user_id);

                        $user_id = $checkUserExist->id;
                        $dataUser = Sentinel::login($checkUserExist);
                        $token = JWTAuth::fromUser($checkUserExist);

                        $SocialMedia = new SocialMedia();
                        $newSocialMedia = $SocialMedia->createNewSocialMedia($dataParam,$user_id);
                        
                        $dataUser->token = $token;
                        $status = array('code'=>200,
                                    'message'=>trans('general.login_success'),
                                    'status'=>'success',
                                    'data'=>$dataUser
                                );

                        \Log::info('return');
                        \Log::info($status);
                        return response()->json($status,200);

                    }catch(\Exception $e){

                        $status = array('code'=>500,
                                    'message'=>trans('general.login_error').'. '.$e->getMessage(),
                                    'status'=>'error',
                                    'data'=>array()
                                );

                        \Log::info('return');
                        \Log::info($status);
                        return response()->json(array('error'=>$status),200);

                    }
 
                } else {

                    $dataParam['password'] = str_random(10);
                    $newUser = $this->model->createNewUser($dataParam,'sosmed');
                    if($newUser['code'] == '200') {
                        
                        $user_id = $newUser['data']->id;
                        
                        $SocialMedia = new SocialMedia();
                        $newSocialMedia = $SocialMedia->createNewSocialMedia($dataParam,$user_id);
                        try{
                            $user = Sentinel::findById($user_id);
                            Sentinel::login($user);
                            if($token = JWTAuth::fromUser($user)) {
                                $user->token = $token;
                                $status = array('code'=>200,
                                        'message'=>trans('general.login_success'),
                                        'status'=>'success',
                                        'data'=>$user
                                    );

                                \Log::info('return');
                                \Log::info($status);
                                return response()->json($status,200);
                            } else {
                                $status = array('code'=>500,
                                        'message'=>trans('general.login_error'),
                                        'status'=>'error',
                                        'data'=>$user
                                    );

                                \Log::info('return');
                                \Log::info($status);
                                return response()->json(array('error'=>$status),200);
                            }
                            
                        }catch(\Exception $e){

                            $status = array('code'=>500,
                                    'message'=>trans('general.login_error').'. '.$e->getMessage(),
                                    'status'=>'error',
                                    'data'=>array()
                                );

                            \Log::info('return');
                            \Log::info($status);
                            return response()->json(array('error'=>$status),200);

                        }
                        
                    } else {

                        $status = array('code'=>500,
                                    'message'=>trans('general.login_error').'. '.$newUser['message'],
                                    'status'=>'error',
                                    'data'=>array()
                                );

                        \Log::info('return');
                        \Log::info($status);
                        return response()->json(array('error'=>$status),200);

                    }
                }

            }

        }

    }

    public function ApiResetPassword($email)
    {
        \Log::info('APi Reset Password');
        \Log::info($email);
        $credentials = [
                'login' => $email,
            ];

        $resetPassword = $this->model->resetPassword($credentials);
        if ($resetPassword['code']==200) {

            $status = array('code'=>200,
                            'message'=>$resetPassword['message'],
                            'status'=>'success',
                        );
            \Log::info('status');
            \Log::info($status);
            return response()->json($status,200);

        } else {

            $status = array('code'=>500,
                            'message'=>$resetPassword['message'],
                            'status'=>'error',
                        );
            
            \Log::info('status');
            \Log::info($status);
            return response()->json(array('error'=>$status),200);

        }
    }
}
