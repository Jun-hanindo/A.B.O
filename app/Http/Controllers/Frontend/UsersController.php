<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;
use Event;
use Reminder;
use Sentinel;
use App\Events\Backend\ResetPasswordEvent;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use App\Http\Requests\Frontend\ProfileRequest;
use App\Http\Requests\Frontend\PictureRequest;
use App\Http\Requests\Frontend\FollowRequest;
use App\Http\Requests\Frontend\ChangePasswordRequest;
use DB;
use App\Models\User;
use App\Models\LogActivity;
use Validator;
use Image;
use File;
use App\Helpers\Base64;

class UsersController extends Controller
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
    * update user.
    * paths url    : user/{id}/update
    * methode      : POST
    * @param            $username           Username User
    * @param            $bio                Bio User
    * @param            $country_id         Country id User
    * @param            $province_id        Province id User
    * @param            $city_id            City id User
    * @param            $web                Link web user
    * @return Response
    */
    public function updateProfile(ProfileRequest $req, $id)
    {
        $param = $req->all();

        $updateData = $this->model->UpdateProfileUser($param,$id);
        if(!empty($updateData)) {

            $data['user_id'] = $id;
            $data['description'] = 'Update profile '.$id;
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($data);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => $updateData->username.' '.trans('general.update_success'),
                'data' => $updateData
            ],200);

        } else {

            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => trans('general.update_error')
            ],400);

        }

    }

    public function updatePicture(PictureRequest $req,$id)
    {
        $param = $req->all();
        try {

            $user = $this->model->find($id);
            if($user->id == $this->currentUser->id){
                $pathDest = public_path().'/uploads/users/'.$user->id.'/'.$param['type'];
                File::makeDirectory($pathDest, $mode=0777,true,true);

                //decode image base64
                $decodeImage = Base64::decodeImage($param['base64']);
                $image = $decodeImage['image'];
                $ext = $decodeImage['ext'];

                $filename = $param['type'].time().$user->id.$ext;
                $path = $pathDest.$filename;
                $img = Image::make($image);
                $img->save($pathDest.'/'.$filename);

                if($param['type'] == 'cover') {

                    $data['description'] = 'Update image cover '.$id;

                    if (!empty($user->cover_image)) {
                        $oldImage = $user->cover_image;
                        File::delete($pathDest.'/'.$oldImage);
                    }
                    $user->cover_image = $filename;
                } else {

                    $data['description'] = 'Update image profile '.$id;

                    if (!empty($user->avatar)) {
                        $oldImage = $user->avatar;
                        File::delete($pathDest.'/'.$oldImage);
                    }
                    $user->avatar = $filename;
                }

                $data['user_id'] = $id;
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($data);

                $user->save();

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => $user->username.' '.trans('general.update_success'),
                    'data' => $user
                ],200);
            } else {

                return response()->json([
                    'code' => 400,
                    'status' => 'error',
                    'message' => trans('general.access_forbiden')
                ],400);

            }

        } catch (\Exception $e) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => trans('general.update_error').', '.$e->getMessage()
            ],400);
        }

    }

    /**
    * follow user.
    * paths url    : user/follow
    * methode      : POST
    * @param            $type           Type follow or unfollow
    * @param            $id             User id
    * @return Response
    */
    public function postFollow(FollowRequest $req)
    {
        $param = $req->all();
        $user_id = $param['id'];
        $type = $param['type'];
        $user_id_follower = $this->currentUser->id;
        $follow = $this->model->followUser($user_id,$user_id_follower,$type);

        if(!empty($follow)) {

            $data['user_id'] = $user_id_follower;
            $data['description'] = ucwords($type).' user id '.$user_id;
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($data);

            return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'data' => $follow->countFollower($follow)
                ],200);

        } else {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => trans('general.following_failed')
            ],400);
        }

    }

    /**
    * list-follow user.
    * paths url    : user/follow/list
    * methode      : POST
    * @param            $type           Type following or follower
    * @param            $id             User id
    * @return Response
    */
    public function listFollow(Request $req)
    {
        $param = $req->all();
        $user_id = $param['user_id'];
        $type = $param['type'];
        $page = $param['page'];
        $limit = 6;
        $user = $this->model->find($user_id);
        if(count($user) > 0) {

            $listFollowing = $this->model->getListFollowing($user,$page,$type,$this->currentUser,$limit);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'data' => $listFollowing
            ],200);

        } else {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'data' => array(),
                'message' => trans('general.data_not_found')
            ],400);
        }


    }

    /**
    * Change password user.
    * paths url    : user/change-password
    * methode      : POST
    * @param      string      $password                 New password user
    * @param      string      $password_confirmation    New password confirmation user
    * @return Response
    */
    public function changePassword(ChangePasswordRequest $req)
    {
        $param = $req->all();
        $id = $this->currentUser->id;
        $updatePassword = $this->model->UpdatePasswordByID($id,$param['password']);
        if($updatePassword) {

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => trans('general.change_password_success'),
                'data' => $updatePassword
            ],200);

        } else {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'data' => array(),
                'message' => trans('general.change_password_error')
            ],400);
        }
    }

}
