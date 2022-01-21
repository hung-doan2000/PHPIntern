<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PermissionRequest;
use App\Models\Permission;
use App\Repositories\Admin\Permission\PermissionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use \Gate;
class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository){
        $this->permissionRepository = $permissionRepository;
    }

    public function index(){
        $permissions = $this->permissionRepository->getAll();
        return view('admin.permissions.index',[
            'title' => 'Permissions Management',
            'permissions' => $permissions,
        ]);
    }

    public function create(){
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.permissions.create',[
            'title' => 'Create New Permission',
        ]);
    }

    public function store(PermissionRequest $request){
        try {
            $data = [
                'name' => $request->input('name'),
                'permission' => $request->input('permission'),
            ];
            $this->permissionRepository->create($data);
            Session::flash('success','Create new permission success');
        }catch (\Exception $err){
            Session::flash('error','Create new permission fail');
            \Log::info($err->getMessage());
        }
        return redirect()->back();
    }

    public function edit($id){
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permission = $this->permissionRepository->find($id);
        return view('admin.permissions.edit',[
            'title'=>'Edit Permission',
            'permission'=>$permission,
        ]);
    }

    public function update(PermissionRequest $request, $id){
        $role = $this->permissionRepository->find($id);
        try {
            if ($role){
                $this->permissionRepository->update($id, $request->all());
                Session::flash('success','Update permission success');
            }
        }catch (\Exception $err){
            Session::flash('error','Update permission fail');
            \Log::info($err->getMessage());
        }
        return redirect()->back();
    }

    public function delete(Request $request){
        $permission = Permission::find($request->input('permission_id'));
        $id = $request->input('permission_id');
        if ($permission) {
            $permission->delete();
            $this->permissionRepository->delete($id);
            return redirect(route('admin.permissions.index'))
                ->with('success', __('Xóa thành công!'));
        }
        return redirect(route('admin.permissions.index'))
            ->with('error', __('Xóa không thành công!'));
    }
}
