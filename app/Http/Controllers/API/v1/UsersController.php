<?php

namespace App\Http\Controllers\API\v1;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\API\v1\BaseApiController;
use App\Models\API\v1\User;
use App\Models\API\v1\Province;
use App\Models\API\v1\Country;
use App\Models\API\v1\City;
use App\Models\API\v1\LogActivity;
use Validator;
use Sentinel;
use DB;
use App\Models\API\v1\SocialMedia;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use File;
use App\Helpers\Base64;
use Image;

use App\Http\Requests\Frontend\FollowRequest;

class UsersController extends BaseApiController
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
    * Get user by ID API.
    * paths url    : API/v1/user/{user_id} 
    * methode      : GET
    * @param  integer   $user_id        Id User
    * @return Response
    */
    public function getUserData(Request $req,$id)
    {   
        try
        {   
            $token = $req->input('token');

            $findUser = $this->model->findUserByID($id);

            if(!empty($findUser->avatar)) {
                $imageAvatar = $findUser->avatar;
                $findUser->avatar = env('APP_URL').'/uploads/users/'.$findUser->id.'/profile/'.$imageAvatar;                        
            } else if(!empty($findUser->avatar_social_media)){
                $findUser->avatar = $findUser->avatar_social_media;
            } else {
                $findUser->avatar = env('APP_URL').'/assets/frontend/img/default_user.png';
            }

            if(!empty($findUser->cover_image)) {
                $imageCover = $findUser->cover_image;
                $findUser->cover_image = env('APP_URL').'/uploads/users/'.$findUser->id.'/cover/'.$imageCover;
            } else {
                $findUser->cover_image = env('APP_URL').'/assets/frontend/img/default_cover.jpg';
            }

            $findUser->count_followers = $this->model->countFollower($findUser);
            
            $currentUser = $this->currentUser($token);
            if(!empty($currentUser)){
                $findUser->followed = $findUser->checkFollowerByID($findUser->id,$currentUser->id);
            } else {
                $findUser->followed = 0;
            }

            $status = array('code'=>200,
                        'message'=>trans('general.user_found'),
                        'status'=>'success',
                        'data'=>$findUser
                    );

            return response()->json($status,200);

        }catch(\Exception $e){

            $status = array('code'=>500,
                        'message'=>trans('general.user_not_found').'. '.$e->getMessage(),
                        'status'=>'error',
                        'data'=>array()
                    );

            \Log::info('return');
            \Log::info($status);
            return response()->json(array('error'=>$status),200);
        }
    }

    /**
    * post follow user.
    * paths url    : API/v1/user/follow 
    * methode      : POST
    * @param  integer   $user_id     Id User
    * @param  string    $type        type follow or unfollow
    * @return Response
    */
    public function apiPostFollowers(Request $req)
    {
        $param = $req->all();
        \Log::info('Api Follow User');
        \Log::info($param);

        $rules = array(
                'id'     => 'required',
                'type'  => 'required',
            );
        $validate = Validator::make($param,$rules);
        if($validate->fails()) {

            $status = array('code'=>422,'message'=>trans('general.following_failed'),'data'=>$validate->errors());

            \Log::info('status');
            \Log::info($status);
            return response()->json(array('error'=>$status),200);

        } else {

            try {
                
                $user = $this->model->find($param['id']);
                if(count($user)>0) {

                    $user_id_follower = $this->currentUser($param['token'])->id; 
                    $follow = $this->model->followUser($user->id,$user_id_follower,$param['type']);

                    $res['id'] = $param['id'];
                    $res['count_followers'] = $follow->countFollower($follow);

                    $data['user_id'] = $user_id_follower;
                    $data['description'] = ucwords($param['type']).' user id '.$param['id'];
                    $insertLog = new LogActivity();
                    $insertLog->insertLogActivity($data);

                    return response()->json([
                        'code' => 200,
                        'status' => 'success',
                        'data' => $res
                    ],200);

                } else {

                    $status = array('code'=>500,
                        'message'=>trans('general.user_not_found').'. '.$e->getMessage(),
                        'status'=>'error',
                        'data'=>array()
                    );

                    \Log::info('return');
                    \Log::info($status);
                    return response()->json(array('error'=>$status),200);

                }
            } catch (\Exception $e) {
                
                $status = array('code'=>500,
                        'message'=>trans('general.following_failed').'. '.$e->getMessage(),
                        'status'=>'error',
                        'data'=>array()
                    );

                \Log::info('return');
                \Log::info($status);
                return response()->json(array('error'=>$status),200);

            }
        }
    }

    /**
     * Get list country combo.
     * paths url    : user/countries/combo
     * methode      : POST
     * @param  string       $type     Type request, country, province or city
     * @param  integer      $id       Id country or id province
     * @param  string       $q        Search by name
     * @return \Illuminate\Http\Response
     */
    public function apiComboCountry(Request $request){
        $type = $request->type;
        $id = $request->id;
        $term = $request->q;    

        try {
            
            if($type == 'country'){
                $results = Country::where('name', 'ilike', '%'.$term.'%')->get();

                foreach ($results as $result) {
                    $data[] = array('id'=>$result->id,'text'=>$result->name);
                }
            }elseif($type == 'province'){
                $results = Province::where('countries_id', $id)->where('name', 'ilike', '%'.$term.'%')->get();

                foreach ($results as $result) {
                    $data[] = array('id'=>$result->id,'text'=>$result->name);
                }
            }
            else{
                $results = City::where('provinces_id', $id)->where('name', 'ilike', '%'.$term.'%')->get();

                foreach ($results as $result) {
                    $data[] = array('id'=>$result->id,'text'=>$result->name);
                }
            }

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'data' => $data
            ],200);

        } catch (\Exception $e) {
            
            $status = array('code'=>500,
                        'message'=>$e->getMessage(),
                        'status'=>'error',
                        'data'=>array()
                    );

            \Log::info('return');
            \Log::info($status);
            return response()->json(array('error'=>$status),200);

        }
        
    }

    /**
    * post follow user.
    * paths url    : API/v1/user/{id}/update 
    * methode      : POST
    * @param  integer   $id             Id User
    * @param  string    $username       Username user
    * @param  string    $email          Email user
    * @param  string    $first_name     First name user
    * @param  string    $last_name      Last name user
    * @param  string    $bio            bio user
    * @param  string    $country_id     Country id
    * @param  string    $province_id    Province id
    * @param  string    $city_id        City id
    * @param  string    $facebook       Link facebook user
    * @param  string    $twitter        Link twitter user
    * @param  string    $tumblr         Link tumblr user
    * @param  string    $instagram      Link instagram user
    * @param  string    $pinterest      Link pinterest user
    * @param  string    $youtube        Link youtube user
    * @return Response
    */
    public function updateProfile(Request $req,$id)
    {
        $param = $req->all();
        \Log::info('Update Profile');
        \Log::info($param);

        $validate = $this->model->validationUpdateUser($param,$id);
        if($validate->fails()) {

            $status = array('code'=>422,'message'=>trans('general.update_profile_error'),'data'=>$validate->errors());

            \Log::info('return');
            \Log::info($status);
            return response()->json(array('error'=>$status),200);

        } else {

            if ($id == $this->currentUser($param['token'])->id) {

                try {
                    $user = $this->model->find($id);
                    if(count($user) > 0) {

                        $updateUser = $this->model->updateProfile($param,$id);
                        if(!empty($updateUser)) {

                            if($user->username != $param['username'] || $user->email != $param['email']) {

                                $data_email = array('id'=>$updateUser->id,
                                    'email'=>$updateUser->email,
                                    'username'=>$updateUser->username,
                                    'password'=>'',
                                    'text_message'=>trans('general.text_email_update_profile'),
                                    'subject_email'=>trans('general.subject_udate_profile'),
                                    'activation_code'=>'');

                                $this->model->sendEmailVerifcation($data_email);

                            }

                            $status = array('code'=>200,
                                'status'=>'success',
                                'message' => trans('general.update_profile_success'),
                                'data' => $updateUser
                            );

                            \Log::info('return');
                            \Log::info($status);
                            return response()->json($status,200);
                        
                        } else {

                            $status = array('code'=>500,
                                'message'=>trans('general.update_profile_error'),
                                'status'=>'error',
                                'data'=>array()
                            );

                            \Log::info('return');
                            \Log::info($status);
                            return response()->json(array('error'=>$status),200);

                        }

                    } else {

                        $status = array('code'=>500,
                            'message'=>trans('general.user_not_found'),
                            'status'=>'error',
                            'data'=>array()
                        );

                        \Log::info('return');
                        \Log::info($status);
                        return response()->json(array('error'=>$status),200);

                    }

                } catch (\Exception $e) {
                    
                    $status = array('code'=>500,
                            'message'=>$e->getMessage(),
                            'status'=>'error',
                            'data'=>array()
                        );

                    \Log::info('return');
                    \Log::info($status);
                    return response()->json(array('error'=>$status),200);

                }
            
            } else {
                
                $status = array('code'=>500,
                            'message'=>trans('general.access_forbiden'),
                            'status'=>'error',
                            'data'=>array()
                        );

                    \Log::info('return');
                    \Log::info($status);
                    return response()->json(array('error'=>$status),200);

            }

        }

    }

    /**
    * list-follow user.
    * paths url    : user/follow/list 
    * methode      : POST
    * @param            $type           Type following or follower
    * @param            $id             User id
    * @param            $page           Page list follow
    * @param            $page           Page list follow
    * @param            $limit          Limit list data following user
    * @return Response
    */
    public function listFollow(Request $req)
    {
        $param = $req->all();
        \Log::info('List Following');
        \Log::info($param);

        $validate = $this->model->validateListFollowing($param);
        if($validate->fails()) {

            $status = array('code'=>422,'message'=>trans('general.get_list_following_error'),'data'=>$validate->errors());

            \Log::info('return');
            \Log::info($status);
            return response()->json(array('error'=>$status),200);

        } else {

            $user = $this->model->find($param['id']);
            if(count($user) > 0) {
                
                $type = $param['type'];
                $page = $param['page'];
                $currentUser = $this->currentUser($param['token']);
                $limit = $param['limit'];

                $listFollowing = $this->model->getListFollowing($user,$page,$type,$this->currentUser,$limit);
                if($listFollowing) {
                    $status = array('code'=>200,
                        'status'=>'success',
                        'message' => 'success',
                        'data' => $listFollowing
                    );

                    \Log::info('return');
                    \Log::info($status);
                    return response()->json($status,200);

                } else {
                    $status = array('code'=>500,
                        'message'=>trans('general.data_empty'),
                        'status'=>'error',
                        'data'=>array()
                    );

                    \Log::info('return');
                    \Log::info($status);
                    return response()->json(array('error'=>$status),200);
                }
            } else {
                $status = array('code'=>500,
                        'message'=>trans('general.data_not_found'),
                        'status'=>'error',
                        'data'=>array()
                    );

                \Log::info('return');
                \Log::info($status);
                return response()->json(array('error'=>$status),200);

            }
        
        }
    }

    /**
    * Change password user.
    * paths url    : user/change/password 
    * methode      : POST
    * @param            $password                   Type following or follower
    * @param            $password_confirmation      User id
    * @return Response
    */
    public function changePassword(Request $req)
    {
        $param = $req->all();
        \Log::info('Change Password');
        \Log::info($param);

        $validate = $this->model->validateChangePassword($param);
        if($validate->fails()) {

            $status = array('code'=>422,'message'=>trans('general.change_password_error'),'data'=>$validate->errors());

            \Log::info('return');
            \Log::info($status);
            return response()->json(array('error'=>$status),200);

        } else {

            $id = $this->currentUser($param['token'])->id;
            $updatePassword = $this->model->UpdatePasswordByID($id,$param['password']);
            if($updatePassword) {

                $data['description'] = 'Update password '.$updatePassword->$id.' '.$updatePassword->email;
                $data['user_id'] = $updatePassword->$id;
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($data);

                $status = array('code'=>200,
                        'status'=>'success',
                        'message' => trans('general.change_password_success'),
                        'data' => $updatePassword
                    );

                \Log::info('return');
                \Log::info($status);
                return response()->json($status,200);

            } else {
                $status = array('code'=>500,
                        'message'=>trans('general.data_not_found'),
                        'status'=>'error',
                        'data'=>array()
                    );

                \Log::info('return');
                \Log::info($status);
                return response()->json(array('error'=>$status),200);
            }

        }
    }

    /**
    * Change picture user.
    * paths url    : user/change/picture 
    * methode      : POST
    * @param            $image             Image cover or image profile on base64
    * @param            $type              type image is cover or profile
    * @return Response
    */
    public function updatePicture(Request $req)
    {
        $param = $req->all();
        \Log::info('Change Password');
        \Log::info($param);

        $validate = $this->model->validateChangePicture($param);
        if($validate->fails()) {

            $status = array('code'=>422,'message'=>trans('general.update_image_error'),'data'=>$validate->errors());

            \Log::info('return');
            \Log::info($status);
            return response()->json(array('error'=>$status),200);

        } else {

            try {
                
                // $param['image'] = base64_encode($param['image']);
                $user = $this->currentUser($param['token']);
                $pathDest = public_path().'/uploads/users/'.$user->id.'/'.$param['type'];
                File::makeDirectory($pathDest, $mode=0777,true,true);
                
                //decode image base64
                $decodeImage = Base64::decodeImage($param['image']);
                $image = $decodeImage['image'];
                $ext = $decodeImage['ext'];
                
                $filename = $param['type'].time().$user->id.$ext;
                $path = $pathDest.$filename;
                $img = Image::make($image);
                $img->save($pathDest.'/'.$filename);

                if($param['type'] == 'cover') {

                    $data['description'] = 'Update image cover '.$user->id.' '.$user->email;

                    if (!empty($user->cover_image)) {
                        $oldImage = $user->cover_image;
                        File::delete($pathDest.'/'.$oldImage);
                    }
                    $user->cover_image = $filename;
                } else {

                    $data['description'] = 'Update image profile '.$user->id.' '.$user->email;

                    if (!empty($user->avatar)) {
                        $oldImage = $user->avatar;
                        File::delete($pathDest.'/'.$oldImage);
                    }
                    $user->avatar = $filename;
                }
                
                $data['user_id'] = $user->id;
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($data);

                $user->save();

                $status = array('code'=>200,
                        'status'=>'success',
                        'message' => trans('general.update_image_success'),
                        'data' => $user
                    );

                \Log::info('return');
                \Log::info($status);
                return response()->json($status,200);

            } catch (\Exception $e) {
                $status = array('code'=>500,
                        'message'=>trans('general.update_image_error. '.$e->getMessage()),
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
