<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Admin\Role\RoleRepositoryInterface;
use App\Repositories\Admin\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use \Gate;

class UserController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository,RoleRepositoryInterface $roleRepository){
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * show all user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function index(){
        $roles = $this->roleRepository->getAll();
        $users = $this->userRepository->getAll();
        return view('admin.users.index',[
            'title'=>'Users Management',
            'users'=> $users,
            'roles'=>$roles
        ]);
//        $users = User::orderBy('id')->get();
//        return view('admin.users.index',[
//            'title'=>'Users Management',
//            'users'=> $users,
//        ]);
    }

    /**
     * Show single post
     *
     * @param $id in User ID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);
        return response()->json([
            'user'=>$user,
        ]);
    }
//
//    protected function isValidPassword(UserRequest $request)
//    {
//        if ($request->input('password') != $request->input('password_confirmation')) {
//            Session::flash('error', 'Passwords do not match');
//            return false;
//        }
//        return true;
//    }

    public function create(){
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::get();
        return view('admin.users.create',[
            'title'=>'Create New User',
            'roles'=>$roles,
        ]);
    }

    public function store(UserRequest $request){
//        $isValidPassword = $this->isValidPassword($request);
        try {
            DB::beginTransaction();
                $dataUser = [
                    'name'=> $request->input('name'),
                    'email'=>$request->input('email'),
                    'password'=>Hash::make($request->input('password')),
                ];
//                $saveDataUser = User::create($dataUser);
                $user = $this->userRepository->create($dataUser);
                $user->roles()->sync($request->input('roles', []));
                Session::flash('success','Create new user success');
            DB::commit();
        }catch (\Exception $err){
            Session::flash('error','Create new user fail');
            \Log::info($err->getMessage());
        }

        return redirect()->back();
    }

    public function edit($id){
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = $this->roleRepository->getAll();
        $user = $this->userRepository->find($id);
//        $user = User::find($id);
        return view('admin.users.edit',[
            'title'=>'Edit User',
            'roles'=>$roles,
            'user'=>$user,
        ]);
    }

    public function update(UserRequest $request, $id){
//        $user = User::find($id);
        $user = $this->userRepository->find($id);
        try {
            DB::beginTransaction();
            if ($user){
                $dataUser = [
                    'name'=> $request->input('name'),
                    'email'=>$request->input('email'),
//                    'password'=>$user->password,
                ];
//                $user->update($dataUser);
                $user = $this->userRepository->update($id, $dataUser);
                $user->roles()->sync($request->input('roles', []));
                DB::commit();
                Session::flash('success','Update user success');
            }
        }catch (\Exception $err){
            Session::flash('error','Update user fail');
            \Log::info($err->getMessage());
        }
        return redirect()->back();
    }

    public function delete(Request $request){
        $user = User::find($request->input('user_id'));
        $id = $request->input('user_id');
        if ($user) {
            $user->delete();
            $this->userRepository->delete($id);
            return redirect(route('admin.users.index'))
                ->with('success', __('Xóa thành công!'));
        }
        return redirect(route('admin.users.index'))
            ->with('error', __('xóa không thành công!'));
    }
}
