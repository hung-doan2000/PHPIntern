<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Repositories\Admin\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use \Gate;
class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository){
        $this->roleRepository = $roleRepository;
    }

    public function index(){
        $roles = $this->roleRepository->getAll();
        return view('admin.roles.index',[
            'title' => 'Roles Management',
            'roles' => $roles,
        ]);
    }

    public function create(){
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::get();
        return view('admin.roles.create',[
            'title' => 'Create New Role',
            'permissions' => $permissions,
        ]);
    }

    public function store(RoleRequest $request){
        try {
            DB::beginTransaction();
            $saveDataRole = $this->roleRepository->create($request->all());
            $saveDataRole->permissions()->sync($request->input('permissions', []));
            Session::flash('success','Create new role success');
            DB::commit();
        }catch (\Exception $err){
            Session::flash('error','Create new role fail');
            \Log::info($err->getMessage());
        }
        return redirect()->back();
    }

    public function edit($id){
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::get();
        $role = $this->roleRepository->find($id);
        return view('admin.roles.edit',[
            'title'=>'Edit Role',
            'role'=>$role,
            'permissions'=>$permissions,
        ]);
    }

    public function update(RoleRequest $request, $id){
        $role = $this->roleRepository->find($id);
        try {
            DB::beginTransaction();
            if ($role){
                $role = $this->roleRepository->update($id, $request->all());
                $role->permissions()->sync($request->input('permissions', []));
                DB::commit();
                Session::flash('success','Update role success');
            }
        }catch (\Exception $err){
            Session::flash('error','Update role fail');
            \Log::info($err->getMessage());
        }
        return redirect()->back();
    }

    public function delete(Request $request){
        $role = Role::find($request->input('role_id'));
        $id = $request->input('role_id');
        if ($role) {
            $role->delete();
            $this->roleRepository->delete($id);
            return redirect(route('admin.roles.index'))
                ->with('success', __('Xóa thành công!'));
        }
        return redirect(route('admin.roles.index'))
            ->with('error', __('Xóa không thành công!'));
    }
}
