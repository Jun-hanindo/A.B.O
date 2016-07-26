<?php

namespace App\Http\Controllers\Backend\Admin;

use Sentinel;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests\Backend\UserTrusteeRequest as Request;
use App\Http\Controllers\Backend\BaseController as Controller;

class UserTrusteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.user-trustee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo '<pre>';print_r('$variable');
        die();
        return $this->createEdit();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->storeUpdate($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->createEdit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->storeUpdate($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->transaction(function ($model) use ($id) {
            $user = Sentinel::findById($id);
            $this->deleteAvatar($user->avatar);
            $user->delete();
        }, true);
    }

    /**
     * Datatables for User Trustee Management.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatables()
    {
        return datatables(User::datatables(true))
                ->addColumn('role', function ($user) {
                    return User::findOrFail($user->id)->roles[0]->name;
                })
                ->addColumn('action', function ($user) {
                    if (Sentinel::findById($user->id)->roles[0]->is_super_admin) {
                        return;
                    }

                    $url = action('Backend\UserTrusteeController@edit', $user->id);

                    return '<a href="'.$url.'" class="btn btn-warning" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;<a href="#" class="btn btn-danger" title="Delete" data-id="'.$user->id.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                })
                ->editColumn('last_login', function ($user) {
                    if (is_null($user->last_login)) {
                        return '--';
                    }

                    return ahloo_datetime($user->last_login);
                })
                ->make(true);
    }

    /**
     * Handle create and edit method.
     *
     * @param  int    $id
     * @return \Illuminate\Http\Response
     */
    protected function createEdit($id = 0)
    {
        $data = [
            'title' => ucfirst(ahloo_form_title($id)),
            'form' => [
                'url' => route('admin.user-trustee.menus.store'),
                'files' => true,
            ],
            'user' => [
                'email' => null,
                'first_name' => null,
                'last_name' => null,
                'avatar' => null,
                'role' => null,
            ],
            'dropdown' => Role::dropdown(),
        ];

        if ($id > 0) {
            $data['form']['url'] = route('admin.user-trustee.menus.store',$id);
            $data['form']['method'] = 'PUT';
            $data['user'] = User::findOrFail($id);
            $data['user']['role'] = $data['user']->roles[0]->id;
        }

        return view('backend.admin.user-trustee.form', $data);
    }

    /**
     * Handle store and update method.
     *
     * @param  App\Http\Requests\Backend\UserTrusteeRequest $request
     * @param  int                                          $id
     * @return \Illuminate\Http\Response
     */
    private function storeUpdate(Request $request, $id = 0)
    {
        $data = $request->except('_token', 'avatar', 'role');
        if ($request->hasFile('avatar')) {
            if ($avatar = $this->processAvatar($request)) {
                $data['avatar'] = $avatar;
            }
        }

        if (! $id) {
            $data['password'] = User::DEFAULT_PASSWORD;
            $data['is_admin'] = true;
        }

        // Saving to database...
        return $this->transaction(function ($model) use ($id, $request, $data) {
            if ($id) {
                $user = Sentinel::findById($id);
                if (isset($data['avatar'])) {
                    $this->deleteAvatar($user->avatar);
                }

                $role = Sentinel::findRoleById($user->roles[0]->id);
                $role->users()->detach($user);

                $user = Sentinel::update($user, $data);
            } else {
                $user = Sentinel::registerAndActivate($data);
            }

            $role = Sentinel::findRoleById($request->input('role'));
            $role->users()->attach($user);
        });
    }

    /**
     * Process avatar file request.
     *
     * @param  \App\Http\Requests\Backend\UserTrusteeRequest $request
     * @return bool|string
     */
    private function processAvatar(Request $request)
    {
        $file = $request->file('avatar');

        if (! $file->isValid()) {
            return false;
        }

        $fileName = date('Y_m_d_His').'_'.$file->getClientOriginalName();

        // Move, move, move!!!
        $file->move(avatar_path(), $fileName);

        return $fileName;
    }

    /**
     * Process delete avatar.
     *
     * @param  string $path
     * @return bool
     */
    private function deleteAvatar($path)
    {
        if (! $path) {
            return true;
        }

        $path = avatar_path($path);

        if (! file_exists($path)) {
            return true;
        }

        if (! unlink($path)) {
            return false;
        }

        return true;
    }
}
