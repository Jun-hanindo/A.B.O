<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Sentinel;
use DB;
use Cartalyst\Sentinel\Users\EloquentUser as Model;
use Mail;
use Reminder;
use App\Models\LogActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{

    use Authenticatable, Authorizable, CanResetPassword;
    use SoftDeletes;
    protected $table = 'users';

    /**
     * Default password.
     *
     * @var string
     */
    const DEFAULT_PASSWORD = '12345678';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'email', 'password', 'permissions', 'first_name', 'last_name', 'avatar', 'is_admin', 'skin', 'username', 'phone', 'address', 'branch_id',
    ];

    /**
     * {@inheritDoc}
     */
    protected $hidden = [
        'password',
    ];
    
    protected $dates = ['deleted_at'];

    /**
     * Return user's query for Datatables.
     *
     * @param  bool|null $isAdmin
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function datatables($isAdmin = null)
    {
        return static::select(
            'users.id',
            'users.username',
            'users.email',
            'users.first_name',
            'users.last_name',
            'users.is_admin',
            'users.deleted',
            'roles.name as role',
            'users.last_login',
            'users.phone'
        )
        ->join('role_users', 'role_users.user_id', '=', 'users.id')
        ->join('roles', 'role_users.role_id', '=', 'roles.id')
        ->orderBy('users.created_at', 'desc');

        return $return;
    }

    public function branch()
    {
        return $this->belongsTo(BranchLocation::class, 'branch_id');
    }

    public function Country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }

    public function Province()
    {
        return $this->belongsTo('App\Models\Province','province_id');
    }

    public function City()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function SocialMedia()
    {
        return $this->hasMany('App\Models\SocialMedia','user_id');
    }

    public function RoleUsers(){
        return $this->belongsToMany('App\Models\Role','role_users','user_id');
    }

    public function VideoLikes(){
        return $this->belongsToMany('App\Models\Video','video_likes','user_id');
    }

    public function UserFollowing(){
        return $this->belongsToMany('App\Models\User','followers','follower_id');
    }

    public function UserFollowers(){
        return $this->belongsToMany('App\Models\User','followers','user_id');
    }

    public function GetUserFollowers(){
        return $this->belongsToMany('App\Models\User','followers','user_id','follower_id');
    }

    public function checkFollowerByID($user_id,$user_id_follower)
    {
        $user = $this->find($user_id);
        $check = $user->UserFollowers()->where('follower_id','=',$user_id_follower)->where('status','=',true)->count();
        return $check;
    }

    public function followUser($user_id,$user_id_follower,$type)
    {
        try {

            $user = $this->find($user_id);
            $check = $user->UserFollowers()->where('follower_id','=',$user_id_follower)->first();
            if (count($check) > 0) {
                if ($type == 'follow') {
                    $status = true;
                } else {
                    $status = false;
                }
                $follow = array('status'=>$status);
                DB::table('followers')
                    ->where('user_id', $user_id)
                    ->where('follower_id',$user_id_follower)
                    ->update(['status' => $status]);

                return $user;

            } else {

                $follow = array('follower_id'=>$user_id_follower);
                $followUser = $user->UserFollowers()->attach($user_id,$follow);

                return $user;

            }

        } catch (\Exception $e) {

            return false;
        }

    }

    public function countFollower($user)
    {
        return $user->UserFollowers()->where('status','=',true)->count();

    }

    /**
     * Get the hashtags for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hashtags()
    {
        return $this->hasMany(Hashtag::class);
    }

    public function createNewUser($data,$type = null,$role = null)
    {
        DB::beginTransaction();//begin transaction
        try{

            $credentials = [
                'email'    => $data['email'],
                'password' => $data['password'],
            ];

            if(array_key_exists('image_url', $data)) {
                $data['image_url'] = $data['image_url'];
            } else {
                $data['image_url'] = '';
            }

            $user = Sentinel::register($credentials);

            if(empty($role)) {
                $role = 'user';
            }

            Sentinel::findRoleBySlug($role)->users()->attach(Sentinel::findById($user->id));

            $activation = \Activation::create($user);

            $updateUser = $this->find($user->id);
            $updateUser->username = $data['username'];

            if($type == 'sosmed') {
                $updateUser->avatar_social_media = $data['image_url'];
                $updateUser->first_name = $data['first_name'];
                $updateUser->last_name = $data['last_name'];
            }

            $updateUser->save();

            if($type == 'sosmed' || $type == 'from_admin') {
                \Activation::complete($user, $activation->code);
                $data_email = array('id'=>$updateUser->id,
                                    'email'=>$updateUser->email,
                                    'username'=>$updateUser->username,
                                    'password'=>$data['password'],
                                    'subject_email'=>trans('general.subject_verification_email'),
                                    'activation_code'=>'');


            } else {
                //send email verification
                $data_email = array('id'=>$updateUser->id,
                                    'email'=>$updateUser->email,
                                    'username'=>$updateUser->username,
                                    'password'=>$data['password'],
                                    'subject_email'=>trans('general.subject_verification_email'),
                                    'activation_code'=>$activation->code);
            }

            $this->sendEmailVerifcation($data_email);

        }catch(\Exception $e){
            DB::rollback();

            $user = array();
            $status = array('code' => '400','status' => 'error','message' => $e->getMessage(),'data'=>$user);
            return $status;

        }
        DB::commit();//commit transactions
        \Log::info('model insert user');
        $status = array('code' => '200','status' => 'success','data'=>$updateUser);
        return $status;
    }

    public function sendEmailVerifcation($data)
    {
        $mail = Mail::queue('email.verification', $data,
            function($message) use($data) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'));
                $message->to($data['email'], $data['email'])->subject($data['subject_email']);
            });

    }

    public function resetPassword($credentials)
    {
        try
        {
            $findUser = Sentinel::findByCredentials($credentials);
            if(!empty($findUser)) {

                ($reminder = Reminder::exists($findUser)) || ($reminder = Reminder::create($findUser));
                $data_email = array('id'=>$findUser->id,
                                    'email'=>$findUser->email,
                                    'username'=>$findUser->username,
                                    'subject_email'=>trans('general.subject_reset_password'),
                                    'activation_code'=>$reminder->code);
                $this->sendEmailResetPassword($data_email);

                $status = array('code'=>200,'status'=>'success','message'=>trans('general.reset_password_success'));
                return $status;

            } else {
                $status = array('code'=>400,'status'=>'error','message'=>trans('general.reset_password_error').'. '.trans('general.user_not_found'));
                return $status;
            }

        }catch(\Exception $e){

            $status = array('code'=>400,'status'=>'error','message'=>trans('general.reset_password_error').'. '.$e->getMessage());
            return $status;

        }

    }

    public function UpdatePasswordByID($id,$password)
    {
        try
        {

            $findUser = Sentinel::findById($id);
            ($reminder = Reminder::exists($findUser)) || ($reminder = Reminder::create($findUser));
            Reminder::complete($findUser, $reminder->code, $password);

            $data_email = array('id'=>$findUser->id,
                                'email'=>$findUser->email,
                                'username'=>$findUser->username,
                                'subject_email'=>trans('general.subject_change_password'),
                                'password' => $password,
                                'activation_code' => '',
                                'text_message'=>trans('general.text_update_password'));

                $data['user_id'] = $findUser->id;
                $data['description'] = 'Have change password';
                $insertLog = new LogActivity();
                $insertLog->insertLogActivity($data);

                $this->sendEmailVerifcation($data_email);

            return $findUser;

        } catch (\Exception $e) {

            return false;

        }

    }

    public function verifyCodeResetPassword($user_id, $code)
    {
        $user = Sentinel::findById($user_id);
        if(!empty($user)) {

            if (Reminder::exists($user, $code)) {
                $user->code = $code;
                $status = array('code'=>200,'status'=>'success','message'=>trans('general.please_change_password'),'data'=>$user);
                return $status;

            } else {

                $status = array('code'=>400,'status'=>'error','message'=>trans('general.not_have_reset_password'),'data'=>array());
                return $status;

            }

        } else {

            $status = array('code'=>400,'status'=>'error','message'=>trans('general.user_not_found'),'data'=>array());
            return $status;

        }
    }

    public function sendEmailResetPassword($data)
    {
        $mail = Mail::queue('email.reset_password', $data,
            function($message) use($data) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'));
                $message->to($data['email'], $data['email'])->subject($data['subject_email']);
            });
    }


    public function setLoginUser($param){
        $credentials = [
            'email'    => $param['email'],
            'password' => $param['password'],
        ];

        try{

            $auth = Sentinel::authenticate($credentials);

            if(!empty($auth)){
                $status = array('code'=>'200','status'=>'success','data'=>$auth);
            } else {
                $status = array('code'=>'400','status'=>'error','message'=>trans('general.invalid_login'),'data'=>array());
            }
            return $status;

        }catch(\Exception $e){

            $status = array('code'=>'400','status'=>'error','message'=>$e->getMessage(),'data'=>array());
            return $status;

        }
    }

    public function checkUserByEmail($email)
    {
        $user = $this->where(['email'=>$email])->first();
        if (count($user) > 0) {
            return $user;
        } else {
            return false;
        }
    }

    public function changePassword($user_id,$code,$password)
    {
        $user = Sentinel::findById($user_id);
        if(!empty($user)) {

            try
            {
                Reminder::complete($user, $code, $password);
                $status = array('code'=>'200','status'=>'success','message'=>trans('general.change_password_success'),'data'=>$user);
                return $status;
            }catch(\Exception $e){
                $status = array('code'=>'400','status'=>'error','message'=>$e->getMessage(),'data'=>array());
                return $status;
            }
        } else {

            $status = array('code'=>'400','status'=>'error','message'=>trans('general.user_not_found'),'data'=>array());
            return $status;

        }

    }

    public function findUserByUsername($username)
    {
        $user = $this->where(['username'=>$username])->first();
        if(count($user) > 0) {

            $userData = $this->refactorAddressUser($user);

            return $userData;

        } else {
            return false;
        }
    }

    public function findUserByID($id)
    {
        $user = $this->find($id);
        if(count($user) > 0) {

            $userData = $this->refactorAddressUser($user);

            return $userData;

        } else {
            return false;
        }
    }



    public function updateDataUser($param,$id)
    {
        $user = $this->find($id);
        if(!empty($user)) {

            $user->email        = $param['email'];
            $user->first_name   = $param['first_name'];
            $user->last_name    = $param['last_name'];
            $user->phone        = $param['phone'];
            $user->username     = $param['username'];
            $user->bio          = $param['bio'];
            $user->address      = $param['address'];
            if(!empty($param['provinces'])){
                $user->province_id  = $param['provinces'];
            }
            if(!empty($param['city'])){
                $user->city_id      = $param['city'];
            }
            if(!empty($param['countries'])){
                $user->country_id   = $param['countries'];
            }
            if(!empty($param['role'])){

                $roleUser = $user->RoleUsers;
                $old_role = $roleUser[0]->slug;
                $new_role = $param['role'];
                if($old_role != $new_role){
                    $updateRole = Sentinel::findRoleBySlug($new_role);
                    $updateRole->users()->attach($user);

                    $removeRole = Sentinel::findRoleBySlug($old_role);
                    $removeRole->users()->detach($user);
                }
            }
            // $user->avatar       = $param['avatar'];
            // $user->facebook     = $param['facebook'];
            // $user->twitter      = $param['twitter'];
            // $user->google_plus  = $param['google_plus'];
            // $user->youtube      = $param['youtube'];
            // $user->instagram    = $param['instagram'];
            // $user->tumblr       = $param['tumblr'];
            // $user->pinterest    = $param['pinterest'];
            // if(isset($param['web'])){
            //     $user->web          = $param['web'];
            // }

            $user->save();

            $userData = $this->refactorAddressUser($user);

            return $userData;

        } else {
            return false;
        }
    }

    public function bannedByid($id)
    {
        $user = $this->find($id);
        if (!empty($user)) {
            $user->deleted = true;
            $user->save();
            return $user;
        } else {
            return false;
        }
    }

    public function restoreUserbyId($id)
    {
        $user = $this->find($id);
        if (!empty($user)) {
            $user->deleted = false;
            $user->save();
            return $user;
        } else {
            return false;
        }
    }

    public function refactorAddressUser ($user){
        if(!empty($user->Country->name)) {
            $user->countries = $user->Country->name;
        } else {
            $user->countries = '';
        }

        if(!empty($user->Province->name)) {
            $user->provinces = $user->Province->name;
        } else {
            $user->provinces = '';
        }

        if(!empty($user->City->name)) {
            $user->cities = $user->City->name;
        } else {
            $user->cities = '';
        }

        return $user;
    }

    public function UpdateProfileUser($param, $id)
    {

        $user = $this->find($id);
        if(!empty($user)) {

            $user->username     = $param['username'];
            $user->bio          = $param['bio'];
            if(!empty($param['provinces'])){
                $user->province_id  = $param['provinces'];
            } else {
                $user->province_id  = 0;
            }
            if(!empty($param['city'])){
                $user->city_id      = $param['city'];
            } else {
                $user->city_id      = 0;
            }
            if(!empty($param['countries'])){
                $user->country_id   = $param['countries'];
            } else {
                $user->country_id   = 0;
            }
            $user->web          = $param['web'];

            $user->save();

            $userData = $this->refactorAddressUser($user);

            return $userData;

        } else {
            return false;
        }

    }

    //get list follower or following
    public function getListFollowing($user,$page,$type,$currentUser,$limit)
    {
        try {

            if($type == 'following') {
                $followings = $user->UserFollowing()->wherePivot('status', true)->where('user_id','!=',$currentUser->id)->orderBy('created_at','asc')->paginate($limit);//->forPage($page,6)->get();
            } else {
                $followings = $user->GetUserFollowers()->wherePivot('status', true)->where('follower_id','!=',$currentUser->id)->orderBy('created_at','asc')->paginate($limit);//->forPage($page,6)->get();
            }

            if (count($followings) > 0) {
                $modelUser = new User();
                foreach ($followings as $following) {

                    if(!empty($following->avatar)) {
                        $imageAvatar = $following->avatar;
                        $following->avatar = env('APP_URL').'/uploads/users/'.$following->id.'/profile/'.$imageAvatar;
                    } else if(!empty($following->avatar_social_media)){
                        $following->avatar = $following->avatar_social_media;
                    } else {
                        $following->avatar = env('APP_URL').'/assets/frontend/img/default_user.png';
                    }

                    if(!empty($following->cover_image)) {
                        $imageCover = $following->cover_image;
                        $following->cover_image = env('APP_URL').'/uploads/users/'.$following->id.'/cover/'.$imageCover;
                    } else {
                        $following->cover_image = env('APP_URL').'/assets/frontend/img/default_cover.jpg';
                    }

                    $following->count_followers = $modelUser->countFollower($following);

                    if(!empty($currentUser)){
                        $following->followed = $following->checkFollowerByID($following->id,$currentUser->id);
                    } else {
                        $following->followed = 0;
                    }

                        $resData[] = $following;

                }
                return $followings;

            } else {
                return false;
            }

        } catch (\Exception $e) {
            return false;
        }

    }

    public function venues() {
        return $this->hasMany('App\Venue', 'user_id');
    }

    public function events() {
        return $this->hasMany('App\Event', 'user_id');
    }

    public function promotions() {
        return $this->hasMany('App\Promotion', 'user_id');
    }

    public function careers() {
        return $this->hasMany('App\Career', 'user_id');
    }

    public function departments() {
        return $this->hasMany('App\Department', 'user_id');
    }

    public function messageReplies() {
        return $this->hasMany('App\MessageReply', 'user_id');
    }

    public function dropdown(){
        return static::orderBy('first_name')->get();
    }
    
    public function deleteByID($id)
    {
        $data = $this->find($id);
        if(!empty($data)) {
            $data->delete();
            //$data->UserRoles()->detach();
            return $data;
        } else {
            return false;
        }
    }

    public function checkEmailExist($email){
        $data = $this->where('email', $email)->onlyTrashed()->first();

        if(!empty($data)) {
            return $data;
        } else {
            return false;
        }
    }

    public function reactivate($email){
        $data = $this->checkEmailExist($email);
        if(!empty($data)){
            $this->withTrashed()
            ->where('email', $email)
            ->restore();
            return $data;
        }else{
            return false;
        }


    }

}
